import fs from 'fs';
import path from 'path';

/*
|--------------------------------------------------------------------------
| НАСТРОЙКИ
|--------------------------------------------------------------------------
*/

const DOWNLOAD_DIR = path.join(
    process.cwd(),
    'downloads'
);

const OUTPUT_FILE = path.join(
    DOWNLOAD_DIR,
    'cars.json'
);

const IMPORT_FILE = path.join(
    DOWNLOAD_DIR,
    'cars-import.json'
);

/*
 * Отдельная папка для фотографий.
 */
const PHOTOS_DIR = path.join(
    DOWNLOAD_DIR,
    'photos'
);


/*
|--------------------------------------------------------------------------
| ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ
|--------------------------------------------------------------------------
*/

/*
 * Безопасное преобразование строки.
 */
function cleanString(value) {

    if (
        value === null ||
        value === undefined
    ) {
        return null;
    }

    const result = String(value)
        .replace(/\s+/g, ' ')
        .trim();

    return result || null;
}

function cleanTitle(value) {
    const title = cleanString(value);

    if (!title) {
        return null;
    }

    return title
        .replace(/\s*[,.]?\s*лот\s*№\s*[^\s,]+/giu, '')
        .replace(/(\d{4})\s*г\./gu, '$1')
        .replace(/\s{2,}/g, ' ')
        .replace(/[ \t,]+$/g, '')
        || null;
}


/*
 * Получаем число из строки.
 *
 * Примеры:
 *
 * "50 000 км"     -> 50000
 * "33 кВт"        -> 33
 * "22 800 ¥"      -> 22800
 * "896 886 ₽"     -> 896886
 */
function parseNumber(value) {

    if (
        value === null ||
        value === undefined
    ) {
        return null;
    }

    const stringValue = String(value)
        .replace(/\s/g, '')
        .replace(',', '.');

    const match =
        stringValue.match(
            /-?\d+(?:\.\d+)?/
        );

    if (!match) {
        return null;
    }

    const number =
        Number(match[0]);

    return Number.isNaN(number)
        ? null
        : number;
}


/*
 * Пробег.
 */
function parseMileage(value) {

    return parseNumber(value);
}


/*
 * Цена.
 */
function parsePrice(value) {

    return parseNumber(value);
}


/*
 * Год.
 */
function parseYear(value) {

    if (!value) {
        return null;
    }

    const stringValue =
        String(value);

    const match =
        stringValue.match(
            /\b(19|20)\d{2}\b/
        );

    if (!match) {
        return null;
    }

    return Number(match[0]);
}


/*
 * Извлекаем значение характеристики
 * по названию.
 */
function findCharacteristic(
    characteristics,
    names
) {

    if (!Array.isArray(characteristics)) {
        return null;
    }

    if (!Array.isArray(names)) {
        names = [names];
    }

    const found =
        characteristics.find(item => {

            if (!item) {
                return false;
            }

            const name =
                cleanString(item.name);

            if (!name) {
                return false;
            }

            return names.includes(name);

        });

    return found
        ? cleanString(found.value)
        : null;
}


/*
 * Создаём объект характеристик.
 */
function buildSpecifications(
    characteristics
) {

    const specifications = {};

    if (
        !Array.isArray(
            characteristics
        )
    ) {
        return specifications;
    }

    for (
        const item of characteristics
        ) {

        if (!item) {
            continue;
        }

        const category =
            cleanString(
                item.category
            );

        const name =
            cleanString(
                item.name
            );

        const value =
            cleanString(
                item.value
            );

        if (!category || !name) {
            continue;
        }

        if (
            !specifications[category]
        ) {

            specifications[category] = {};

        }

        specifications[category][name] =
            value;
    }

    return specifications;
}


/*
|--------------------------------------------------------------------------
| НОРМАЛИЗАЦИЯ ХАРАКТЕРИСТИК
|--------------------------------------------------------------------------
*/

function buildNormalizedSpecs(
    car
) {

    const characteristics =
        Array.isArray(car.characteristics)
            ? car.characteristics
            : [];

    const mainSpecs =
        car.main_specs || {};

    const year =
        parseYear(
            mainSpecs.year
        );

    const mileage =
        parseMileage(
            mainSpecs.mileage
        );

    const power =
        parseNumber(
            mainSpecs.power
        );

    const power30min =
        parseNumber(
            mainSpecs.power_30min
        );

    const prices =
        car.prices || {};

    const priceChina =
        parsePrice(
            prices.china
        );

    const priceRussia =
        parsePrice(
            prices.russia
        );

    const lengthWidthHeight =
        findCharacteristic(
            characteristics,
            [
                'Длина*ширина*высота(мм)',
                'Длина*ширина*высота (мм)'
            ]
        );

    const height =
        findCharacteristic(
            characteristics,
            [
                'Высота(мм)',
                'Высота (мм)'
            ]
        );

    const width =
        findCharacteristic(
            characteristics,
            [
                'Ширина(мм)',
                'Ширина (мм)'
            ]
        );

    const length =
        findCharacteristic(
            characteristics,
            [
                'Длина(мм)',
                'Длина (мм)'
            ]
        );

    const wheelbase =
        findCharacteristic(
            characteristics,
            [
                'Колесная база (мм)'
            ]
        );

    const doors =
        findCharacteristic(
            characteristics,
            [
                'Количество дверей'
            ]
        );

    const seats =
        findCharacteristic(
            characteristics,
            [
                'Количество мест'
            ]
        );

    const trunkVolume =
        findCharacteristic(
            characteristics,
            [
                'Объем багажника (л)'
            ]
        );

    const curbWeight =
        findCharacteristic(
            characteristics,
            [
                'Снаряженная масса (кг)'
            ]
        );

    const drive =
        findCharacteristic(
            characteristics,
            [
                'Режим привода'
            ]
        );

    const battery =
        findCharacteristic(
            characteristics,
            [
                'Тип батареи'
            ]
        );

    const batteryCapacity =
        findCharacteristic(
            characteristics,
            [
                'Энергия аккумулятора (кВтч)'
            ]
        );

    const electricRange =
        findCharacteristic(
            characteristics,
            [
                'Запас хода на чистом электричестве по NEDC (км)'
            ]
        );

    const maxSpeed =
        findCharacteristic(
            characteristics,
            [
                'Максимальная скорость (км/ч)'
            ]
        );

    const maxTorque =
        findCharacteristic(
            characteristics,
            [
                'Максимальный крутящий момент (Н·м)'
            ]
        );

    const engineName =
        findCharacteristic(
            characteristics,
            [
                'Тип двигателя'
            ]
        );

    return {

        year,

        mileage,

        body:
            cleanString(
                mainSpecs.body
            ),

        engine:
            cleanString(
                mainSpecs.engine
            ),

        power_kw:
        power,

        power_30min_kw:
        power30min,

        color:
            cleanString(
                mainSpecs.color
            ),

        transmission:
            cleanString(
                mainSpecs.transmission
            ),

        price_china:
        priceChina,

        price_russia:
        priceRussia,

        dimensions:
        lengthWidthHeight,

        length_mm:
            parseNumber(length),

        width_mm:
            parseNumber(width),

        height_mm:
            parseNumber(height),

        wheelbase_mm:
            parseNumber(wheelbase),

        doors:
            parseNumber(doors),

        seats:
            parseNumber(seats),

        trunk_volume_l:
            parseNumber(trunkVolume),

        curb_weight_kg:
            parseNumber(curbWeight),

        drive,

        battery,

        battery_capacity_kwh:
            parseNumber(
                batteryCapacity
            ),

        electric_range_km:
            parseNumber(
                electricRange
            ),

        max_speed_kmh:
            parseNumber(
                maxSpeed
            ),

        max_torque_nm:
            parseNumber(
                maxTorque
            ),

        engine_type:
        engineName
    };
}


/*
|--------------------------------------------------------------------------
| ФОТОГРАФИИ
|--------------------------------------------------------------------------
*/

/*
 * Проверяем, является ли файл фотографией.
 */
function isImageFile(fileName) {

    const extension =
        path.extname(
            fileName
        ).toLowerCase();

    return [
        '.jpg',
        '.jpeg',
        '.png',
        '.webp'
    ].includes(
        extension
    );
}


/*
 * Создаём отдельную папку автомобиля
 * и копируем туда фотографии.
 *
 * Возвращает массив относительных
 * путей к фотографиям.
 */
function prepareCarPhotos(
    sourceFolder,
    folderName
) {

    /*
     * Папка конкретного автомобиля.
     *
     * downloads/photos/001_Renault_...
     */
    const targetFolder =
        path.join(
            PHOTOS_DIR,
            folderName
        );


    /*
     * Создаём папку.
     */
    fs.mkdirSync(
        targetFolder,
        {
            recursive: true
        }
    );


    /*
     * Получаем фотографии
     * из исходной папки.
     */
    const sourceImages =
        fs.readdirSync(
            sourceFolder,
            {
                withFileTypes: true
            }
        )

            .filter(
                item => {

                    if (!item.isFile()) {
                        return false;
                    }

                    return isImageFile(
                        item.name
                    );

                }
            )

            .map(
                item => item.name
            )

            .sort(
                (a, b) =>
                    a.localeCompare(
                        b,
                        undefined,
                        {
                            numeric: true,
                            sensitivity: 'base'
                        }
                    )
            );


    /*
     * Сюда записываем пути
     * скопированных фотографий.
     */
    const localImages = [];


    /*
     * Копируем фотографии.
     */
    sourceImages.forEach(
        (sourceFileName, index) => {

            const extension =
                path.extname(
                    sourceFileName
                ).toLowerCase();


            /*
             * 001.jpg
             * 002.jpg
             * 003.jpg
             */
            const newFileName =
                `${String(index + 1).padStart(3, '0')}${extension}`;


            const sourceFile =
                path.join(
                    sourceFolder,
                    sourceFileName
                );


            const targetFile =
                path.join(
                    targetFolder,
                    newFileName
                );


            /*
             * Копируем только если
             * файла ещё нет либо размер отличается.
             */
            let needCopy = true;


            if (
                fs.existsSync(
                    targetFile
                )
            ) {

                const sourceStat =
                    fs.statSync(
                        sourceFile
                    );

                const targetStat =
                    fs.statSync(
                        targetFile
                    );


                if (
                    sourceStat.size ===
                    targetStat.size
                ) {

                    needCopy = false;

                }

            }


            if (needCopy) {

                fs.copyFileSync(
                    sourceFile,
                    targetFile
                );

            }


            /*
             * Путь относительно
             * папки downloads.
             */
            const relativePath =
                path
                    .relative(
                        DOWNLOAD_DIR,
                        targetFile
                    )
                    .replace(
                        /\\/g,
                        '/'
                    );


            localImages.push(
                relativePath
            );

        }
    );


    return {
        count:
        localImages.length,

        files:
        localImages,

        folder:
            path
                .relative(
                    DOWNLOAD_DIR,
                    targetFolder
                )
                .replace(
                    /\\/g,
                    '/'
                )
    };
}


/*
|--------------------------------------------------------------------------
| ОСНОВНАЯ ОБРАБОТКА
|--------------------------------------------------------------------------
*/

console.log('');

console.log(
    '======================================'
);

console.log(
    'PARSER V2'
);

console.log(
    'Обработка уже собранных данных'
);

console.log(
    '======================================'
);

console.log('');


/*
 * Проверяем downloads.
 */
if (
    !fs.existsSync(
        DOWNLOAD_DIR
    )
) {

    console.error(
        'Папка downloads не найдена.'
    );

    console.error(
        `Ожидаемый путь: ${DOWNLOAD_DIR}`
    );

    process.exit(1);

}


/*
 * Создаём общую папку фотографий.
 */
fs.mkdirSync(
    PHOTOS_DIR,
    {
        recursive: true
    }
);


/*
 * Получаем папки автомобилей.
 *
 * ВАЖНО:
 *
 * photos не попадёт сюда,
 * потому что это тоже папка.
 *
 * Поэтому исключаем её.
 */
const folders =
    fs.readdirSync(
        DOWNLOAD_DIR,
        {
            withFileTypes: true
        }
    )

        .filter(
            item =>
                item.isDirectory() &&
                item.name !== 'photos'
        )

        .map(
            item =>
                item.name
        )

        .sort();


console.log(
    `Папок автомобилей найдено: ${folders.length}`
);

console.log('');


/*
 * Здесь будут все автомобили.
 */
const cars = [];


/*
|--------------------------------------------------------------------------
| ОБРАБАТЫВАЕМ КАЖДЫЙ DATA.JSON
|--------------------------------------------------------------------------
*/

for (
    let i = 0;
    i < folders.length;
    i++
) {

    const folderName =
        folders[i];


    const folder =
        path.join(
            DOWNLOAD_DIR,
            folderName
        );


    const dataFile =
        path.join(
            folder,
            'data.json'
        );


    console.log(
        `Обработка ${i + 1}/${folders.length}: ${folderName}`
    );


    /*
     * data.json существует?
     */
    if (
        !fs.existsSync(
            dataFile
        )
    ) {

        console.log(
            '  ⚠ data.json не найден'
        );

        continue;

    }


    /*
     * Читаем JSON.
     */
    let car;

    try {

        const content =
            fs.readFileSync(
                dataFile,
                'utf8'
            );


        car =
            JSON.parse(
                content
            );

    } catch (error) {

        console.log(
            `  ⚠ Ошибка чтения JSON: ${error.message}`
        );

        continue;

    }


    /*
     * Основные данные.
     */
    const mainSpecs =
        car.main_specs || {};


    const prices =
        car.prices || {};


    /*
     * Изображения из data.json.
     */
    const images =
        Array.isArray(
            car.images
        )
            ? car.images
            : [];


    /*
     * Характеристики.
     */
    const characteristics =
        Array.isArray(
            car.characteristics
        )
            ? car.characteristics
            : [];


    /*
     * Lot.
     */
    const lot =
        cleanString(
            car.lot
        );


    const sourceLot =
        cleanString(
            mainSpecs.lot
        );


    /*
     * Нормализованные характеристики.
     */
    const normalizedSpecs =
        buildNormalizedSpecs(
            car
        );


    /*
     * Сгруппированные характеристики.
     */
    const specifications =
        buildSpecifications(
            characteristics
        );


    /*
     * Относительный путь к исходной
     * папке автомобиля.
     */
    const relativeFolder =
        path.relative(
            process.cwd(),
            folder
        );


    /*
     |--------------------------------------------------------------------------
     | СОЗДАЁМ ОТДЕЛЬНУЮ ПАПКУ ФОТО
     |--------------------------------------------------------------------------
     */

    const preparedPhotos =
        prepareCarPhotos(
            folder,
            folderName
        );


    /*
     * Формируем итоговый объект.
     */
    const normalizedCar = {

        number:
            car.number ?? i + 1,

        brand:
            cleanString(
                car.brand
            ),

        brand_slug:
            cleanString(
                car.brand_slug
            ),

        model:
            cleanString(
                car.model
            ),

        model_slug:
            cleanString(
                car.model_slug
            ),

        lot,

        source_lot:
        sourceLot,

        title:
            cleanTitle(
                car.title
            ),

        url:
            cleanString(
                car.url
            ),

        main_specs:
        mainSpecs,

        prices:
        prices,

        normalized:
        normalizedSpecs,

        specifications:
        specifications,

        images: {

            count:
            images.length,

            downloaded:
                Number(
                    car.images_downloaded || 0
                ),

            urls:
            images,

            local:
            preparedPhotos.files,

            folder:
            preparedPhotos.folder

        },

        characteristics:
        characteristics,

        folder:
        relativeFolder

    };


    cars.push(
        normalizedCar
    );


    console.log(
        `  ✓ ${normalizedCar.brand} ${normalizedCar.model}`
    );

    console.log(
        `  ✓ Характеристик: ${characteristics.length}`
    );

    console.log(
        `  ✓ Фото: ${images.length}`
    );

    console.log(
        `  ✓ Фото скопировано: ${preparedPhotos.count}`
    );

    console.log(
        `  ✓ Папка фото: downloads/${preparedPhotos.folder}`
    );

    console.log(
        `  ✓ Цена РФ: ${normalizedSpecs.price_russia ?? '-'}`
    );

    console.log('');
}


/*
|--------------------------------------------------------------------------
| СОХРАНЯЕМ CARS.JSON
|--------------------------------------------------------------------------
*/

fs.writeFileSync(

    OUTPUT_FILE,

    JSON.stringify(
        cars,
        null,
        4
    ),

    'utf8'

);


/*
|--------------------------------------------------------------------------
| СОЗДАЁМ УПРОЩЁННЫЙ ФАЙЛ ДЛЯ LARAVEL
|--------------------------------------------------------------------------
*/

const importCars =
    cars.map(
        car => ({

            number:
            car.number,

            brand:
            car.brand,

            brand_slug:
            car.brand_slug,

            model:
            car.model,

            model_slug:
            car.model_slug,

            lot:
            car.lot,

            source_lot:
            car.source_lot,

            title:
            cleanTitle(car.title),

            url:
            car.url,

            year:
            car.normalized.year,

            mileage:
            car.normalized.mileage,

            body:
            car.normalized.body,

            engine:
            car.normalized.engine,

            power_kw:
            car.normalized.power_kw,

            power_30min_kw:
            car.normalized.power_30min_kw,

            color:
            car.normalized.color,

            transmission:
            car.normalized.transmission,

            price_china:
            car.normalized.price_china,

            price_russia:
            car.normalized.price_russia,

            length_mm:
            car.normalized.length_mm,

            width_mm:
            car.normalized.width_mm,

            height_mm:
            car.normalized.height_mm,

            wheelbase_mm:
            car.normalized.wheelbase_mm,

            doors:
            car.normalized.doors,

            seats:
            car.normalized.seats,

            trunk_volume_l:
            car.normalized.trunk_volume_l,

            curb_weight_kg:
            car.normalized.curb_weight_kg,

            drive:
            car.normalized.drive,

            battery:
            car.normalized.battery,

            battery_capacity_kwh:
            car.normalized.battery_capacity_kwh,

            electric_range_km:
            car.normalized.electric_range_km,

            max_speed_kmh:
            car.normalized.max_speed_kmh,

            max_torque_nm:
            car.normalized.max_torque_nm,

            engine_type:
            car.normalized.engine_type,

            images_count:
            car.images.count,

            images_downloaded:
            car.images.downloaded,

            image_urls:
            car.images.urls,

            image_files:
            car.images.local,

            image_folder:
            car.images.folder,

            folder:
            car.folder,

            specifications:
            car.specifications

        })
    );


fs.writeFileSync(

    IMPORT_FILE,

    JSON.stringify(
        importCars,
        null,
        4
    ),

    'utf8'

);


/*
|--------------------------------------------------------------------------
| ИТОГ
|--------------------------------------------------------------------------
*/

console.log('');

console.log(
    '======================================'
);

console.log(
    'PARSER V2 ЗАВЕРШЕН'
);

console.log(
    `Автомобилей обработано: ${cars.length}`
);

console.log('');

console.log(
    `Подробный файл: ${OUTPUT_FILE}`
);

console.log(
    `Файл для импорта: ${IMPORT_FILE}`
);

console.log('');

console.log(
    `Фотографии: ${PHOTOS_DIR}`
);

console.log('');

console.log(
    '======================================'
);
