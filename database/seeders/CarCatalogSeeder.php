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
        // 1. Категории
        $categories = [
            ['name' => 'Китайские', 'slug' => 'china'],
            ['name' => 'Корейские', 'slug' => 'korea'],
            ['name' => 'ОАЭ', 'slug' => 'uae'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 2. Бренды и модели
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
                    [
                        'brand_id' => $brand->id,
                        'slug' => Str::slug($modelName)
                    ],
                    ['name' => $modelName]
                );
            }
        }

        // 3. Справочники
        $bodyTypes = ['vnedorozhnik'=>'Внедорожник','sedan'=>'Седан','hetchbek'=>'Хэтчбек','mikroavtobus'=>'Микроавтобус','pikap'=>'Пикап'];
        $engineTypes = ['elektromobil'=>'Электромобиль','benzin'=>'Бензин','diesel'=>'Дизель','gibrid'=>'Гибрид'];
        $drives = ['peredniy'=>'Передний','zadniy'=>'Задний','4wd'=>'4WD','polnyy-privod-po-centru'=>'Полный привод по центру'];
        $transmissions = ['automatic'=>'Автоматическая','mechanical'=>'Механическая','variator'=>'Вариатор','robot'=>'Робот'];
        $colors = ['Белый','Черный','Серебристый','Синий','Красный','Серый','Зеленый','Оранжевый'];

        $models = CarModel::with('brand')->get();
        $categoryIds = Category::pluck('id')->toArray();

        // 4. Машины
        for ($i = 1; $i <= 30; $i++) {

            $model = $models->random();
            $year = rand(2019, 2025);

            $title = "{$model->brand->name} {$model->name} {$year}";

            // 🔥 Генерация уникального slug
            $baseSlug = Str::slug($title);
            $slug = $baseSlug . '-' . uniqid();

            $car = Car::create([
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'brand_id' => $model->brand_id,
                'model_id' => $model->id,
                'lot' => 'LOT_' . rand(10000000, 99999999) . '_' . $i,
                'title' => $title,
                'slug' => $slug, // ✅ ВАЖНО
                'year' => $year,
                'month' => rand(1, 12),
                'mileage' => rand(0, 200000),
                'body_type' => array_rand($bodyTypes),
                'engine_type' => array_rand($engineTypes),
                'engine_power' => rand(70, 500),
                'engine_power_30min' => rand(50, 350),
                'engine_volume' => rand(1000, 6000),
                'color' => $colors[array_rand($colors)],
                'transmission' => array_rand($transmissions),
                'drive' => array_rand($drives),
                'price_china' => rand(80000, 600000),
                'price_russia' => rand(500000, 8000000),
                'is_min_util' => rand(0,1),
                'is_passable' => rand(0,1),
                'source_url' => 'https://example.com',
                'source_site' => 'demo',
                'description' => 'Описание автомобиля',
            ]);

            // изображения
            for ($j = 1; $j <= rand(3, 8); $j++) {
                CarImage::create([
                    'car_id' => $car->id,
                    'path' => 'cars/placeholder_' . rand(1, 5) . '.jpg',
                    'sort_order' => $j,
                ]);
            }
        }

        $this->command->info('✅ Готово');
    }
}
