import fs from 'fs';
import path from 'path';

const DOWNLOAD_DIR = path.join(process.cwd(), 'downloads');

const OUTPUT_FILE = path.join(
    DOWNLOAD_DIR,
    'cars-korea.json'
);

const IMPORT_FILE = path.join(
    DOWNLOAD_DIR,
    'cars-import-korea.json'
);

const PHOTOS_DIR = path.join(
    DOWNLOAD_DIR,
    'photos-korea'
);

// ---------------------------------------------------------
// Вспомогательные функции
// ---------------------------------------------------------

function cleanString(value) {
    if (value === null || value === undefined) {
        return null;
    }

    const result = String(value).trim();

    return result !== '' ? result : null;
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

function parseNumber(value) {
    if (value === null || value === undefined) {
        return null;
    }

    if (typeof value === 'number') {
        return Number.isFinite(value) ? value : null;
    }

    const normalized = String(value)
        .replace(/\s+/g, '')
        .replace(',', '.')
        .replace(/[^\d.-]/g, '');

    if (!normalized) {
        return null;
    }

    const number = Number(normalized);

    return Number.isFinite(number) ? number : null;
}

function parseMileage(value) {
    if (value === null || value === undefined) {
        return null;
    }

    if (typeof value === 'number') {
        return Math.round(value);
    }

    const normalized = String(value)
        .replace(/\s+/g, '')
        .replace(/[^\d]/g, '');

    if (!normalized) {
        return null;
    }

    return Number(normalized);
}

function parsePrice(value) {
    if (value === null || value === undefined) {
        return null;
    }

    if (typeof value === 'number') {
        return Number.isFinite(value) ? value : null;
    }

    const normalized = String(value)
        .replace(/\s+/g, '')
        .replace(/[^\d.-]/g, '');

    if (!normalized) {
        return null;
    }

    const number = Number(normalized);

    return Number.isFinite(number) ? number : null;
}

function parseYear(value) {
    if (value === null || value === undefined) {
        return null;
    }

    const match = String(value).match(/\b(19|20)\d{2}\b/);

    return match ? Number(match[0]) : null;
}

function ensureDirectory(directory) {
    if (!fs.existsSync(directory)) {
        fs.mkdirSync(directory, {
            recursive: true
        });
    }
}

function readJson(filePath) {
    try {
        return JSON.parse(
            fs.readFileSync(filePath, 'utf8')
        );
    } catch (error) {
        console.error(
            `❌ Ошибка чтения JSON: ${filePath}`
        );

        console.error(error.message);

        return null;
    }
}

// ---------------------------------------------------------
// Подготовка фотографий
// ---------------------------------------------------------

function preparePhotos(car, sourceFolder, folderName) {
    const sourceFiles = Array.isArray(car.image_files)
        ? car.image_files
        : [];

    const targetFolder = path.join(
        PHOTOS_DIR,
        folderName
    );

    ensureDirectory(targetFolder);

    const localFiles = [];

    for (let index = 0; index < sourceFiles.length; index++) {

        const sourceFile = sourceFiles[index];

        if (!sourceFile) {
            continue;
        }

        let sourcePath = sourceFile;

        // Если путь относительный
        if (!path.isAbsolute(sourcePath)) {
            sourcePath = path.join(
                process.cwd(),
                sourcePath
            );
        }

        // Если указанный путь не существует,
        // пробуем найти файл непосредственно
        // в папке автомобиля.
        if (!fs.existsSync(sourcePath)) {

            const basename = path.basename(
                sourceFile
            );

            const fallbackPath = path.join(
                sourceFolder,
                basename
            );

            if (fs.existsSync(fallbackPath)) {
                sourcePath = fallbackPath;
            }
        }

        if (!fs.existsSync(sourcePath)) {
            console.log(
                `   ⚠️ Фото не найдено: ${sourceFile}`
            );

            continue;
        }

        const extension = path.extname(
            sourcePath
        ) || '.webp';

        const fileName =
            `${String(index + 1).padStart(3, '0')}${extension}`;

        const targetPath = path.join(
            targetFolder,
            fileName
        );

        try {
            fs.copyFileSync(
                sourcePath,
                targetPath
            );

            // Именно такой путь потом попадёт
            // в cars-import-korea.json
            const relativePath = path
                .relative(
                    DOWNLOAD_DIR,
                    targetPath
                )
                .split(path.sep)
                .join('/');

            localFiles.push(relativePath);

        } catch (error) {

            console.error(
                `   ❌ Ошибка копирования фото: ${sourcePath}`
            );

            console.error(error.message);
        }
    }

    return {
        count: sourceFiles.length,
        downloaded: localFiles.length,
        local: localFiles,
        folder: path
            .relative(
                DOWNLOAD_DIR,
                targetFolder
            )
            .split(path.sep)
            .join('/')
    };
}

// ---------------------------------------------------------
// Нормализация характеристик
// ---------------------------------------------------------

function buildSpecifications(car) {

    const raw = car.raw_specifications;

    if (!raw || typeof raw !== 'object') {
        return {};
    }

    const specifications = {};

    for (const [key, value] of Object.entries(raw)) {

        const cleanKey = cleanString(key);
        const cleanValue = cleanString(value);

        if (!cleanKey || !cleanValue) {
            continue;
        }

        specifications[cleanKey] = cleanValue;
    }

    return specifications;
}

// ---------------------------------------------------------
// Нормализация автомобиля
// ---------------------------------------------------------

function normalizeCar(car) {

    const year =
        parseYear(car.year) ||
        parseYear(car.production_date) ||
        parseYear(car.title);

    const mileage =
        parseMileage(car.mileage);

    const body =
        cleanString(car.body);

    const engine =
        cleanString(car.engine);

    const engineVolume =
        parseNumber(car.engine_volume);

    const power =
        cleanString(car.power);

    const powerHp =
        parseNumber(car.power_hp);

    const powerKw =
        parseNumber(car.power_kw);

    const fuel =
        cleanString(car.fuel);

    const color =
        cleanString(car.color);

    const transmission =
        cleanString(car.transmission);

    const drive =
        cleanString(car.drive);

    const priceKorea =
        parsePrice(car.price_korea);

    const priceChina =
        parsePrice(car.price_china);

    const priceRussia =
        parsePrice(car.price_russia);

    return {
        year,
        production_date: cleanString(
            car.production_date
        ),

        mileage,

        body,

        generation: cleanString(
            car.generation
        ),

        engine,

        engine_volume: engineVolume,

        power,

        power_hp: powerHp,

        power_kw: powerKw,

        power_30min: cleanString(
            car.power_30min
        ),

        power_30min_kw: parseNumber(
            car.power_30min_kw
        ),

        fuel,

        color,

        transmission,

        drive,

        sale_city: cleanString(
            car.sale_city
        ),

        listing_date: cleanString(
            car.listing_date
        ),

        price_korea: priceKorea,

        price_china: priceChina,

        price_russia: priceRussia,

        engine_type: cleanString(
            car.engine_type
        )
    };
}

// ---------------------------------------------------------
// Поиск data.json
// ---------------------------------------------------------

function findDataFiles() {

    if (!fs.existsSync(DOWNLOAD_DIR)) {
        return [];
    }

    const entries = fs.readdirSync(
        DOWNLOAD_DIR,
        {
            withFileTypes: true
        }
    );

    const files = [];

    for (const entry of entries) {

        if (!entry.isDirectory()) {
            continue;
        }

        const folderPath = path.join(
            DOWNLOAD_DIR,
            entry.name
        );

        const dataFile = path.join(
            folderPath,
            'data.json'
        );

        if (fs.existsSync(dataFile)) {
            files.push({
                folderName: entry.name,
                folderPath,
                dataFile
            });
        }
    }

    return files;
}

// ---------------------------------------------------------
// Основной процесс
// ---------------------------------------------------------

console.log('');
console.log('🇰🇷 ========================================');
console.log('🇰🇷   PARSER V2 — KOREA');
console.log('🇰🇷 ========================================');
console.log('');

ensureDirectory(DOWNLOAD_DIR);
ensureDirectory(PHOTOS_DIR);

const dataFiles = findDataFiles();

console.log(
    `📁 Найдено папок с data.json: ${dataFiles.length}`
);

console.log('');

const cars = [];

for (let index = 0; index < dataFiles.length; index++) {

    const {
        folderName,
        folderPath,
        dataFile
    } = dataFiles[index];

    console.log(
        `🚗 ${index + 1}/${dataFiles.length}: ${folderName}`
    );

    const car = readJson(dataFile);

    if (!car) {
        console.log(
            '   ❌ Пропуск — не удалось прочитать data.json'
        );

        continue;
    }

    // Проверяем, что это действительно
    // новый корейский формат
    if (
        !Object.prototype.hasOwnProperty.call(
            car,
            'raw_specifications'
        ) &&
        !Object.prototype.hasOwnProperty.call(
            car,
            'price_korea'
        )
    ) {

        console.log(
            '   ⚠️ Похоже, это не корейский data.json'
        );

        console.log(
            '   ⚠️ Пропуск'
        );

        continue;
    }

    const normalized = normalizeCar(car);

    const photos = preparePhotos(
        car,
        folderPath,
        folderName
    );

    const specifications =
        buildSpecifications(car);

    const lot =
        cleanString(car.lot);

    const sourceLot =
        cleanString(car.source_lot);

    const result = {

        number:
            Number(car.number) || index + 1,

        brand:
            cleanString(car.brand),

        brand_slug:
            cleanString(car.brand_slug),

        model:
            cleanString(car.model),

        model_slug:
            cleanString(car.model_slug),

        lot,

        source_lot: sourceLot,

        title:
            cleanTitle(car.title),

        url:
            cleanString(car.url),

        normalized,

        specifications,

        raw_specifications:
            car.raw_specifications || {},

        images: photos,

        characteristics:
            Array.isArray(car.characteristics)
                ? car.characteristics
                : [],

        folder:
            path.relative(
                process.cwd(),
                folderPath
            ).split(path.sep).join('/')
    };

    cars.push(result);

    console.log(
        `   ✓ ${result.title || 'Без названия'}`
    );

    console.log(
        `   Год: ${normalized.year ?? '—'}`
    );

    console.log(
        `   Пробег: ${normalized.mileage ?? '—'}`
    );

    console.log(
        `   Кузов: ${normalized.body ?? '—'}`
    );

    console.log(
        `   Двигатель: ${normalized.engine ?? '—'}`
    );

    console.log(
        `   Мощность: ${normalized.power_kw ?? '—'} кВт`
    );

    console.log(
        `   Фото: ${photos.downloaded}/${photos.count}`
    );

    console.log('');
}

// ---------------------------------------------------------
// cars-korea.json
// ---------------------------------------------------------

fs.writeFileSync(
    OUTPUT_FILE,
    JSON.stringify(
        cars,
        null,
        2
    ),
    'utf8'
);

// ---------------------------------------------------------
// cars-import-korea.json
// ---------------------------------------------------------

const importCars = cars.map(car => {

    return {

        number: car.number,

        brand: car.brand,

        brand_slug: car.brand_slug,

        model: car.model,

        model_slug: car.model_slug,

        lot: car.lot,

        source_lot: car.source_lot,

        title: car.title,

        url: car.url,

        year:
        car.normalized.year,

        production_date:
        car.normalized.production_date,

        mileage:
        car.normalized.mileage,

        body:
        car.normalized.body,

        generation:
        car.normalized.generation,

        engine:
        car.normalized.engine,

        engine_type:
        car.normalized.engine_type,

        engine_volume:
        car.normalized.engine_volume,

        power:
        car.normalized.power,

        power_hp:
        car.normalized.power_hp,

        power_kw:
        car.normalized.power_kw,

        power_30min:
        car.normalized.power_30min,

        power_30min_kw:
        car.normalized.power_30min_kw,

        fuel:
        car.normalized.fuel,

        color:
        car.normalized.color,

        transmission:
        car.normalized.transmission,

        drive:
        car.normalized.drive,

        sale_city:
        car.normalized.sale_city,

        listing_date:
        car.normalized.listing_date,

        price_korea:
        car.normalized.price_korea,

        price_china:
        car.normalized.price_china,

        price_russia:
        car.normalized.price_russia,

        images_count:
        car.images.count,

        images_downloaded:
        car.images.downloaded,

        image_files:
        car.images.local,

        image_folder:
        car.images.folder,

        folder:
        car.folder,

        specifications:
        car.specifications,

        raw_specifications:
        car.raw_specifications
    };
});

fs.writeFileSync(
    IMPORT_FILE,
    JSON.stringify(
        importCars,
        null,
        2
    ),
    'utf8'
);

// ---------------------------------------------------------
// Итог
// ---------------------------------------------------------

console.log('');
console.log('🇰🇷 ========================================');
console.log('🇰🇷   ГОТОВО');
console.log('🇰🇷 ========================================');
console.log('');

console.log(
    `🚗 Автомобилей обработано: ${cars.length}`
);

console.log(
    `📄 ${OUTPUT_FILE}`
);

console.log(
    `📄 ${IMPORT_FILE}`
);

console.log(
    `📸 ${PHOTOS_DIR}`
);

console.log('');
console.log('⚠️ Laravel importer пока НЕ запускаем.');
console.log('');
