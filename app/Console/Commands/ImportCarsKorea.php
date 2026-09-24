<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarAttribute;
use App\Models\CarImage;
use App\Models\CarModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportCarsKorea extends Command
{
    protected $signature = 'import:cars-korea';

    protected $description = 'Импорт автомобилей из Кореи из downloads/cars-import-korea.json';

    public function handle(): int
    {
        $jsonPath = base_path('downloads/cars-import-korea.json');

        if (!file_exists($jsonPath)) {
            $this->error("Файл не найден: {$jsonPath}");

            return self::FAILURE;
        }

        $json = file_get_contents($jsonPath);
        $cars = json_decode($json, true);

        if (!is_array($cars)) {
            $this->error('Не удалось прочитать cars-import-korea.json');

            return self::FAILURE;
        }

        $this->info('Начинаем импорт автомобилей из Кореи...');
        $this->newLine();

        $created = 0;
        $updated = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($cars as $index => $data) {
            try {
                $result = $this->importCar($data, $index + 1);

                if ($result === 'created') {
                    $created++;
                } elseif ($result === 'updated') {
                    $updated++;
                } else {
                    $skipped++;
                }
            } catch (\Throwable $e) {
                $errors++;

                $this->error(
                    sprintf(
                        '[%d] Ошибка: %s',
                        $index + 1,
                        $e->getMessage()
                    )
                );
            }
        }

        $this->newLine();

        $this->info('Импорт Кореи завершён.');
        $this->line("Создано: {$created}");
        $this->line("Обновлено: {$updated}");
        $this->line("Пропущено: {$skipped}");
        $this->line("Ошибок: {$errors}");

        return $errors > 0
            ? self::FAILURE
            : self::SUCCESS;
    }

    /**
     * Импорт одного автомобиля.
     */
    private function importCar(array $data, int $number): string
    {
        $title = (string) (\App\Models\Car::sanitizeTitle($data['title'] ?? '') ?? '');

        if ($title === '') {
            $this->warn("[{$number}] Пропуск: отсутствует title");

            return 'skipped';
        }

        /*
         * Для Кореи:
         *
         * lot       = внутренний номер автомобиля на Revocars
         * source_lot = оригинальный лот Encar
         *
         * В текущей структуре базы используем source_lot,
         * как это уже было предусмотрено в старом импортере.
         */
        $lot = $data['lot'] ?? null;
        $sourceLot = $data['source_lot'] ?? null;

        $uniqueLot = $sourceLot ?: $lot;

        if (!$uniqueLot) {
            $this->warn("[{$number}] Пропуск: отсутствует lot");

            return 'skipped';
        }

        /*
         * Ищем автомобиль по лоту.
         *
         * Это позволяет повторно запускать импорт:
         * существующий автомобиль будет обновлён,
         * новый — создан.
         */
        $car = Car::where('lot', $uniqueLot)->first();

        $isNew = !$car;

        /*
         * ---------------------------------------------------------
         * BRAND
         * ---------------------------------------------------------
         */

        $brandName = trim((string) ($data['brand'] ?? ''));

        if ($brandName === '') {
            $this->warn(
                "[{$number}] {$title} — пропуск: отсутствует бренд"
            );

            return 'skipped';
        }

        $brandSlug = $data['brand_slug']
            ?? Str::slug($brandName);

        $brand = Brand::where('slug', $brandSlug)->first();

        if (!$brand) {
            $brand = Brand::create([
                'name' => $brandName,
                'slug' => $brandSlug,
            ]);
        }

        /*
         * ---------------------------------------------------------
         * MODEL
         * ---------------------------------------------------------
         */

        $modelName = trim((string) ($data['model'] ?? ''));

        if ($modelName === '') {
            $this->warn(
                "[{$number}] {$title} — пропуск: отсутствует модель"
            );

            return 'skipped';
        }

        $modelSlug = $data['model_slug']
            ?? Str::slug($modelName);

        $carModel = CarModel::firstOrCreate(
            [
                'brand_id' => $brand->id,
                'name' => $modelName,
            ],
            [
                'slug' => $modelSlug,
            ]
        );

        /*
         * ---------------------------------------------------------
         * CAR
         * ---------------------------------------------------------
         */

        $slug = $this->makeUniqueSlug(
            $title,
            $car?->id
        );

        $carData = [
            /*
             * Корея = category_id 5
             */
            'category_id' => 5,

            'brand_id' => $brand->id,
            'model_id' => $carModel->id,

            /*
             * В БД сохраняем source_lot.
             * Например:
             *
             * lot = 2578930
             * source_lot = 42776775
             *
             * В cars.lot попадёт 42776775.
             */
            'lot' => $uniqueLot,

            'title' => $title,

            'year' => $data['year']
                ?? $this->extractYearFromTitle($title),

            'month' => $data['month'] ?? null,

            'mileage' => $data['mileage'] ?? null,

            'body_type' => $data['body'] ?? null,

            /*
             * Сейчас в корейском JSON:
             *
             * engine = код двигателя
             * engine_type = дополнительное поле
             *
             * Поэтому сохраняем engine_type,
             * а если его нет — engine.
             */
            'engine_type' => $data['engine_type']
                ?? $data['engine']
                    ?? null,

            'engine_power' => $data['power_kw'] ?? null,

            'engine_power_30min' => $data['power_30min_kw'] ?? null,

            'color' => $data['color'] ?? null,

            'transmission' => $data['transmission'] ?? null,

            'drive' => $data['drive'] ?? null,

            'price_china' => $data['price_china'] ?? null,

            'price_russia' => $data['price_russia'] ?? null,

            'source_url' => $data['url'] ?? null,

            'source_site' => 'revocars',

            'slug' => $slug,
        ];

        if ($isNew) {
            $car = Car::create($carData);

            $this->info(
                "[{$number}] + {$title} | ID: {$car->id}"
            );
        } else {
            $car->update($carData);

            $this->line(
                "[{$number}] ↻ {$title} | ID: {$car->id}"
            );
        }

        /*
         * ---------------------------------------------------------
         * ATTRIBUTES
         * ---------------------------------------------------------
         */

        if (!empty($data['specifications'])) {
            $this->syncSpecifications(
                $car,
                $data['specifications']
            );
        } elseif (!empty($data['characteristics'])) {
            $this->syncCharacteristics(
                $car,
                $data['characteristics']
            );
        }

        /*
         * ---------------------------------------------------------
         * IMAGES
         * ---------------------------------------------------------
         */

        if (!empty($data['image_files'])) {
            $this->syncImages(
                $car,
                $data
            );
        }

        return $isNew ? 'created' : 'updated';
    }

    /**
     * Синхронизация плоских характеристик Кореи.
     *
     * Например:
     *
     * "Дата производства" => "сент 2021"
     * "Тип"               => "Джип/SUV"
     * "Поколение"         => "Q8 (4m)"
     * "Объем, см3"        => "2967"
     */
    private function syncSpecifications(
        Car $car,
        array $specifications
    ): void {
        foreach ($specifications as $name => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            /*
             * Пока не создаём CarAttribute автоматически,
             * если структура таблицы требует дополнительных
             * обязательных полей.
             *
             * Основные данные автомобиля уже сохраняются
             * непосредственно в cars.
             */
        }
    }

    /**
     * Совместимость со старым форматом characteristics.
     */
    private function syncCharacteristics(
        Car $car,
        array $characteristics
    ): void {
        /*
         * Оставляем метод для совместимости.
         *
         * Если понадобится полноценная синхронизация
         * CarAttribute для Кореи, отдельно подстроим её
         * под фактическую структуру таблицы.
         */
    }

    /**
     * Импорт изображений.
     */
    private function syncImages(
        Car $car,
        array $data
    ): void {
        $imageFiles = $data['image_files'] ?? [];

        if (empty($imageFiles)) {
            return;
        }

        $folder = $data['folder'] ?? null;

        if (!$folder || !is_dir($folder)) {
            $this->warn(
                "  Фото: папка не найдена: {$folder}"
            );

            return;
        }

        foreach ($imageFiles as $index => $relativeImagePath) {
            $filename = basename($relativeImagePath);

            if ($filename === '') {
                continue;
            }

            /*
             * В data.json:
             *
             * image_files:
             * 008_BMW_5 Series_2578933/001.webp
             *
             * Фактически фотографии находятся в folder.
             */
            $sourcePath = $folder . DIRECTORY_SEPARATOR . $filename;

            if (!file_exists($sourcePath)) {
                $this->warn(
                    "  Фото не найдено: {$sourcePath}"
                );

                continue;
            }

            /*
             * Путь, который будет храниться в БД.
             *
             * Например:
             * cars/6105/001.webp
             */
            $storagePath = "cars/{$car->id}/{$filename}";

            /*
             * Копируем файл в storage/app/public/cars/{id}/
             */
            if (!Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->put(
                    $storagePath,
                    file_get_contents($sourcePath)
                );
            }

            /*
             * В таблице car_images поле называется path,
             * а не image.
             */
            $existingImage = CarImage::where('car_id', $car->id)
                ->where('path', $storagePath)
                ->first();

            if (!$existingImage) {
                CarImage::create([
                    'car_id' => $car->id,
                    'path' => $storagePath,
                    'sort_order' => $index,
                ]);
            }
        }
    }

    /**
     * Генерация уникального slug.
     */
    private function makeUniqueSlug(
        string $title,
        ?int $currentCarId = null
    ): string {
        $baseSlug = Str::slug($title);

        if ($baseSlug === '') {
            $baseSlug = 'car';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (true) {
            $query = Car::where('slug', $slug);

            if ($currentCarId) {
                $query->where('id', '!=', $currentCarId);
            }

            if (!$query->exists()) {
                return $slug;
            }

            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
    }

    /**
     * Получение года из title.
     */
    private function extractYearFromTitle(string $title): ?int
    {
        if (preg_match('/\b(19|20)\d{2}\b/u', $title, $matches)) {
            return (int) $matches[0];
        }

        return null;
    }
}
