<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Support\Str;

class CarCatalogSeeder extends Seeder
{
    public function run()
    {
        // 1. Создаём категории
        $categories = [
            ['name' => 'Китайские', 'slug' => 'china'],
            ['name' => 'Корейские', 'slug' => 'korea'],
            ['name' => 'ОАЭ', 'slug' => 'uae'],
        ];
        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 2. Бренды и модели (из формы)
        $brandsData = [
            'BYD' => ['Song Plus', 'Han', 'Tang', 'Seal'],
            'Chery' => ['Tiggo 7', 'Tiggo 8', 'Arrizo 8', 'Exeed LX'],
            'Hongqi' => ['E-HS9', 'H5', 'HS5', 'E-QM5'],
            'Geely' => ['Monjaro', 'Tugella', 'Atlas', 'Coolray'],
            'Great Wall' => ['Haval Jolion', 'Haval F7', 'Tank 300'],
            'Hyundai' => ['Santa Fe', 'Tucson', 'Sonata', 'Elantra'],
            'Kia' => ['Sportage', 'Sorento', 'K5', 'Ceed'],
            'Toyota' => ['Land Cruiser 300', 'Camry', 'RAV4', 'Highlander'],
            'Nissan' => ['X-Trail', 'Pathfinder', 'Sentra', 'Qashqai'],
            'BMW' => ['X5', 'X3', '5 Series', '3 Series'],
            'Mercedes-Benz' => ['GLE', 'GLC', 'E-Class', 'C-Class'],
        ];

        foreach ($brandsData as $brandName => $models) {
            $brand = Brand::firstOrCreate(
                ['slug' => Str::slug($brandName)],
                ['name' => $brandName]
            );
            foreach ($models as $modelName) {
                CarModel::firstOrCreate(
                    ['brand_id' => $brand->id, 'slug' => Str::slug($modelName)],
                    ['name' => $modelName]
                );
            }
        }

        // 3. Справочники параметров
        $bodyTypes = [
            'vnedorozhnik' => 'Внедорожник',
            'sedan' => 'Седан',
            'hetchbek' => 'Хэтчбек',
            'mikroavtobus' => 'Микроавтобус',
            'pikap' => 'Пикап',
        ];
        $engineTypes = [
            'elektromobil' => 'Электромобиль',
            'benzin' => 'Бензин',
            'diesel' => 'Дизель',
            'gibrid' => 'Гибрид',
        ];
        $drives = [
            'peredniy' => 'Передний',
            'zadniy' => 'Задний',
            '4wd' => '4WD',
            'polnyy-privod-po-centru' => 'Полный привод по центру',
        ];
        $transmissions = [
            'automatic' => 'Автоматическая',
            'mechanical' => 'Механическая',
            'variator' => 'Вариатор',
            'robot' => 'Робот',
        ];
        $colors = ['Белый', 'Черный', 'Серебристый', 'Синий', 'Красный', 'Серый', 'Зеленый', 'Оранжевый'];

        $models = CarModel::with('brand')->get();
        $categoryIds = Category::pluck('id')->toArray();

        // 4. Создаём 30 автомобилей
        for ($i = 1; $i <= 30; $i++) {
            $model = $models->random();
            $year = rand(2019, 2025);
            $month = rand(1, 12);
            $mileage = rand(0, 200000);
            $priceChina = rand(80000, 600000);
            $priceRussia = $priceChina * 12.5 + rand(-500000, 500000);
            if ($priceRussia < 500000) $priceRussia = 500000;

            $bodyKey = array_rand($bodyTypes);
            $engineKey = array_rand($engineTypes);
            $driveKey = array_rand($drives);
            $transKey = array_rand($transmissions);
            $color = $colors[array_rand($colors)];
            $lot = 'LOT_' . rand(10000000, 99999999) . '_' . $i;

            $car = Car::create([
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'brand_id' => $model->brand_id,
                'model_id' => $model->id,
                'lot' => $lot,
                'title' => "{$model->brand->name} {$model->name} {$year} г., лот № {$i}",
                'year' => $year,
                'month' => $month,
                'mileage' => $mileage,
                'body_type' => $bodyKey,
                'engine_type' => $engineKey,
                'engine_power' => rand(70, 500),
                'engine_power_30min' => rand(50, 350),
                'engine_volume' => rand(1000, 6000),
                'color' => $color,
                'transmission' => $transKey,
                'drive' => $driveKey,
                'price_china' => $priceChina,
                'price_russia' => $priceRussia,
                'is_min_util' => (bool) rand(0, 1),
                'is_passable' => (bool) rand(0, 1),
                'source_url' => "https://www.che168.com/dealer/598038/{$lot}.html",
                'source_site' => 'che168.com',
                'description' => "Автомобиль {$model->brand->name} {$model->name} {$year} года выпуска. Пробег: {$mileage} км. Кузов: {$bodyTypes[$bodyKey]}, двигатель: {$engineTypes[$engineKey]}, привод: {$drives[$driveKey]}, трансмиссия: {$transmissions[$transKey]}. Цвет: {$color}. Отличное состояние.",
            ]);

            // Добавляем от 3 до 8 изображений (заглушки)
            for ($j = 1; $j <= rand(3, 8); $j++) {
                CarImage::create([
                    'car_id' => $car->id,
                    'path' => 'cars/placeholder_' . rand(1, 5) . '.jpg',
                    'sort_order' => $j,
                ]);
            }
        }

        $this->command->info('✅ Создано категорий: ' . Category::count());
        $this->command->info('✅ Создано брендов: ' . Brand::count());
        $this->command->info('✅ Создано моделей: ' . CarModel::count());
        $this->command->info('✅ Создано автомобилей: ' . Car::count());
        $this->command->info('✅ Создано изображений: ' . CarImage::count());
    }
}
