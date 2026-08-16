<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarAttribute;
use App\Models\CarImage;
use App\Models\ParsingLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CarParserController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Валидация
            $validated = $request->validate([
                'title' => 'required|string|max:500',
                'source_url' => 'required|url',
                'source_site' => 'nullable|string|max:100',
                'lot' => 'nullable|string|max:100',
                'price_china' => 'nullable|numeric',
                'price_russia' => 'nullable|numeric',
                'description' => 'nullable|string',
                'attributes' => 'nullable|array',
                'images' => 'nullable|array',
                'images.*' => 'url',
                'category_name' => 'nullable|string',
                'brand_name' => 'nullable|string',
                'model_name' => 'nullable|string',
            ]);

            // Проверяем дубликат
            $existingCar = Car::where('source_url', $validated['source_url'])
                ->orWhere('lot', $validated['lot'] ?? '')
                ->first();

            if ($existingCar) {
                // Обновляем существующий автомобиль
                $car = $this->updateCar($existingCar, $validated);
                $message = 'Автомобиль обновлен';
            } else {
                // Создаем новый
                $car = $this->createCar($validated);
                $message = 'Автомобиль создан';
            }

            // Сохраняем атрибуты
            if (!empty($validated['attributes'])) {
                $this->saveAttributes($car, $validated['attributes']);
            }

            // Сохраняем изображения
            if (!empty($validated['images'])) {
                $this->saveImages($car, $validated['images']);
            }

            DB::commit();

            // Логируем успех
            ParsingLog::create([
                'url' => $validated['source_url'],
                'status' => 'success',
                'message' => $message,
                'data' => ['car_id' => $car->id, 'title' => $car->title]
            ]);

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => [
                    'car_id' => $car->id,
                    'title' => $car->title
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            // Логируем ошибку
            ParsingLog::create([
                'url' => $request->source_url ?? null,
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => ['request' => $request->all()]
            ]);

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function createCar($data)
    {
        // Находим или создаем категорию
        $categoryId = null;
        if (!empty($data['category_name'])) {
            $category = \App\Models\Category::firstOrCreate(
                ['name' => $data['category_name']],
                ['slug' => Str::slug($data['category_name'])]
            );
            $categoryId = $category->id;
        }

        // Находим или создаем бренд
        $brandId = null;
        if (!empty($data['brand_name'])) {
            $brand = \App\Models\Brand::firstOrCreate(
                ['name' => $data['brand_name']],
                ['slug' => Str::slug($data['brand_name'])]
            );
            $brandId = $brand->id;
        }

        // Находим или создаем модель
        $modelId = null;
        if (!empty($data['model_name']) && $brandId) {
            $model = \App\Models\CarModel::firstOrCreate(
                [
                    'brand_id' => $brandId,
                    'name' => $data['model_name']
                ],
                ['slug' => Str::slug($data['model_name'])]
            );
            $modelId = $model->id;
        }

        return Car::create([
            'category_id' => $categoryId,
            'brand_id' => $brandId,
            'model_id' => $modelId,
            'title' => $data['title'],
            'slug' => Str::slug($data['title']) . '-' . uniqid(),
            'source_url' => $data['source_url'],
            'source_site' => $data['source_site'] ?? 'revocars.ru',
            'lot' => $data['lot'] ?? null,
            'price_china' => $data['price_china'] ?? null,
            'price_russia' => $data['price_russia'] ?? null,
            'description' => $data['description'] ?? null,
            'year' => $this->extractYear($data['attributes'] ?? []),
            'mileage' => $this->extractMileage($data['attributes'] ?? []),
            'body_type' => $this->extractAttribute($data['attributes'] ?? [], 'кузов'),
            'engine_type' => $this->extractAttribute($data['attributes'] ?? [], 'двигатель'),
            'engine_volume' => $this->extractAttribute($data['attributes'] ?? [], 'объём'),
            'engine_power' => $this->extractAttribute($data['attributes'] ?? [], 'мощность'),
            'color' => $this->extractAttribute($data['attributes'] ?? [], 'цвет'),
            'transmission' => $this->extractAttribute($data['attributes'] ?? [], 'трансмиссия'),
        ]);
    }

    private function updateCar($car, $data)
    {
        $car->update([
            'title' => $data['title'] ?? $car->title,
            'price_china' => $data['price_china'] ?? $car->price_china,
            'price_russia' => $data['price_russia'] ?? $car->price_russia,
            'description' => $data['description'] ?? $car->description,
        ]);

        return $car;
    }

    private function saveAttributes($car, $attributes)
    {
        // Очищаем старые атрибуты
        $car->attributes()->delete();

        $labels = Car::getAttributeLabels();
        $sortOrder = 0;

        foreach ($attributes as $key => $value) {
            if (empty($value)) continue;

            // Определяем display_name
            $displayName = $labels[$key] ?? $key;

            CarAttribute::create([
                'car_id' => $car->id,
                'key' => $key,
                'value' => $value,
                'display_name' => $displayName,
                'sort_order' => $sortOrder++
            ]);
        }
    }

    private function saveImages($car, $imageUrls)
    {
        $sortOrder = 0;

        foreach ($imageUrls as $url) {
            if (empty($url)) continue;

            // Скачиваем и сохраняем изображение локально
            try {
                $imagePath = $this->downloadImage($url, $car);

                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $imagePath,
                    'sort_order' => $sortOrder++
                ]);
            } catch (\Exception $e) {
                // Логируем ошибку загрузки изображения
                \Log::warning('Failed to download image: ' . $url, [
                    'car_id' => $car->id,
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

    private function downloadImage($url, $car)
    {
        $contents = file_get_contents($url);

        if ($contents === false) {
            throw new \Exception('Failed to download image');
        }

        $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
        if (empty($extension)) {
            $extension = 'jpg';
        }

        $filename = uniqid() . '.' . $extension;
        $path = 'cars/' . $car->id . '/' . $filename;

        Storage::disk('public')->put($path, $contents);

        return $path;
    }

    // Вспомогательные методы для извлечения данных
    private function extractAttribute($attributes, $key)
    {
        return $attributes[$key] ?? null;
    }

    private function extractYear($attributes)
    {
        $yearStr = $attributes['год_выпуска'] ?? null;
        if (!$yearStr) return null;

        // Парсим "2024/2" или "2024"
        if (strpos($yearStr, '/') !== false) {
            $parts = explode('/', $yearStr);
            return intval($parts[0]);
        }

        return intval(preg_replace('/[^0-9]/', '', $yearStr));
    }

    private function extractMileage($attributes)
    {
        $mileageStr = $attributes['пробег'] ?? null;
        if (!$mileageStr) return 0;

        // Удаляем все не цифры
        return intval(preg_replace('/[^0-9]/', '', $mileageStr));
    }
}
