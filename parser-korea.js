import { chromium } from 'playwright';
import fs from 'fs';
import path from 'path';

/*
|--------------------------------------------------------------------------
| НАСТРОЙКИ
|--------------------------------------------------------------------------
*/

const MAX_CARS = 2;

const CARS_PER_PAGE = 20;

const START_URL = 'https://revocars.ru/korea/';

const CATALOG_URL = 'https://revocars.ru/korea/';

const DOWNLOAD_DIR = path.join(
    process.cwd(),
    'downloads'
);

const PROGRESS_FILE = path.join(
    DOWNLOAD_DIR,
    'cars_progress.json'
);

const DELAY_BETWEEN_CARS = 1000;

const CAR_PAGE_DELAY = 1500;


/*
|--------------------------------------------------------------------------
| ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ
|--------------------------------------------------------------------------
*/

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}


function slugToName(slug) {
    if (!slug) {
        return '';
    }

    return slug
        .split('-')
        .filter(Boolean)
        .map(word => {
            return (
                word.charAt(0).toUpperCase() +
                word.slice(1)
            );
        })
        .join(' ');
}


function getBrandName(slug) {
    const brands = {
        audi: 'Audi',
        bmw: 'BMW',
        genesis: 'Genesis',
        hyundai: 'Hyundai',
        kia: 'Kia',
        mercedes: 'Mercedes-Benz',
        'mercedes-benz': 'Mercedes-Benz',
        jeep: 'Jeep',
        volkswagen: 'Volkswagen',
        toyota: 'Toyota',
        lexus: 'Lexus',
        honda: 'Honda',
        nissan: 'Nissan',
        mazda: 'Mazda',
        ford: 'Ford',
        chevrolet: 'Chevrolet',
        cadillac: 'Cadillac',
        chrysler: 'Chrysler',
        dodge: 'Dodge',
        daewoo: 'Daewoo',
        daihatsu: 'Daihatsu',
        'land-rover': 'Land Rover',
        porsche: 'Porsche',
        ferrari: 'Ferrari',
        lamborghini: 'Lamborghini',
        bentley: 'Bentley',
        'rolls-royce': 'Rolls-Royce',
        maserati: 'Maserati',
        maybach: 'Maybach',
        mini: 'MINI',
        smart: 'Smart',
        renault: 'Renault',
        'renault-samsung': 'Renault Samsung',
        peugeot: 'Peugeot',
        citroen: 'Citroen',
        volvo: 'Volvo',
        tesla: 'Tesla',
        subaru: 'Subaru',
        suzuki: 'Suzuki',
        mitsubishi: 'Mitsubishi',
        ssangyong: 'SsangYong',
        byd: 'BYD',
        geely: 'Geely',
        chery: 'Chery',
        changan: 'Changan'
    };

    return brands[slug] || slugToName(slug);
}


function parseCarUrl(carUrl) {
    try {
        const url = new URL(carUrl);

        const parts = url.pathname
            .split('/')
            .filter(Boolean);

        if (
            parts.length < 4 ||
            parts[0] !== 'korea'
        ) {
            return {
                brand: null,
                brand_slug: null,
                model: null,
                model_slug: null,
                lot: null
            };
        }

        const brandSlug = parts[1];

        const modelSlug = parts[2];

        const lot = parts[3]
            .replace(/\.html$/i, '');

        return {
            brand: getBrandName(brandSlug),
            brand_slug: brandSlug,
            model: slugToName(modelSlug),
            model_slug: modelSlug,
            lot
        };

    } catch (error) {
        return {
            brand: null,
            brand_slug: null,
            model: null,
            model_slug: null,
            lot: null
        };
    }
}


function makeSafeFolderName(name) {
    return String(name || '')
        .replace(/[\\/:*?"<>|]/g, '')
        .replace(/\s+/g, ' ')
        .trim();
}


function getImageExtension(imageUrl) {
    let ext = 'webp';

    try {
        const urlWithoutQuery = imageUrl.split('?')[0];

        const detectedExt = path
            .extname(urlWithoutQuery)
            .replace('.', '')
            .toLowerCase();

        if (detectedExt) {
            ext = detectedExt;
        }

    } catch (error) {
        ext = 'webp';
    }

    const allowedExtensions = [
        'jpg',
        'jpeg',
        'png',
        'webp'
    ];

    if (!allowedExtensions.includes(ext)) {
        ext = 'webp';
    }

    return ext;
}


function cleanText(value) {
    if (!value) {
        return '';
    }

    return String(value)
        .replace(/\s+/g, ' ')
        .trim();
}


function parseNumber(value) {
    if (!value) {
        return null;
    }

    const normalized = String(value)
        .replace(/\s/g, '')
        .replace(',', '.')
        .replace(/[^\d.-]/g, '');

    if (!normalized) {
        return null;
    }

    const number = Number(normalized);

    return Number.isFinite(number)
        ? number
        : null;
}


function parseInteger(value) {
    const number = parseNumber(value);

    return number !== null
        ? Math.round(number)
        : null;
}


function parsePower(value) {
    if (!value) {
        return {
            hp: null,
            kw: null
        };
    }

    const text = cleanText(value);

    const hpMatch = text.match(
        /([\d.,]+)\s*л\.?\s*с\.?/i
    );

    const kwMatch = text.match(
        /([\d.,]+)\s*кВт/i
    );

    return {
        hp: hpMatch
            ? parseNumber(hpMatch[1])
            : null,

        kw: kwMatch
            ? parseNumber(kwMatch[1])
            : null
    };
}


function parseYear(value) {
    if (!value) {
        return null;
    }

    const match = String(value).match(
        /(19|20)\d{2}/
    );

    return match
        ? Number(match[0])
        : null;
}


/*
|--------------------------------------------------------------------------
| ПРОГРЕСС
|--------------------------------------------------------------------------
*/

function loadProgress() {
    try {
        if (!fs.existsSync(PROGRESS_FILE)) {
            return [];
        }

        const data = fs.readFileSync(
            PROGRESS_FILE,
            'utf8'
        );

        const parsed = JSON.parse(data);

        if (!Array.isArray(parsed)) {
            return [];
        }

        return parsed;

    } catch (error) {
        console.log(
            'Не удалось загрузить progress:',
            error.message
        );

        return [];
    }
}


function saveProgress(processedUrls) {
    try {
        fs.writeFileSync(
            PROGRESS_FILE,
            JSON.stringify(
                processedUrls,
                null,
                4
            ),
            'utf8'
        );

    } catch (error) {
        console.error(
            'Ошибка сохранения progress:',
            error.message
        );
    }
}


/*
|--------------------------------------------------------------------------
| СОЗДАНИЕ СТРАНИЦЫ
|--------------------------------------------------------------------------
*/

async function createPage(context) {
    const page = await context.newPage();

    await page.setViewportSize({
        width: 1600,
        height: 900
    });

    return page;
}


/*
|--------------------------------------------------------------------------
| СПИСОК АВТОМОБИЛЕЙ
|--------------------------------------------------------------------------
*/

async function collectCarsFromPage(
    page,
    pageNumber
) {
    const url =
        pageNumber === 1
            ? START_URL
            : `${CATALOG_URL}?page=${pageNumber}`;

    console.log('');
    console.log(
        '======================================'
    );
    console.log(
        `СТРАНИЦА ${pageNumber}`
    );
    console.log(url);
    console.log(
        '======================================'
    );

    try {
        await page.goto(
            url,
            {
                waitUntil: 'domcontentloaded',
                timeout: 60000
            }
        );

    } catch (error) {
        console.error(
            `Ошибка загрузки страницы ${pageNumber}:`
        );

        console.error(error.message);

        return [];
    }

    await sleep(2000);

    try {
        await page.waitForSelector(
            '.card',
            {
                timeout: 30000
            }
        );

    } catch (error) {
        console.log('');
        console.log(
            'КАРТОЧКИ .card НЕ НАЙДЕНЫ'
        );

        try {
            const html = await page.content();

            fs.writeFileSync(
                path.join(
                    DOWNLOAD_DIR,
                    `debug_page_${pageNumber}.html`
                ),
                html,
                'utf8'
            );

        } catch (error) {}

        return [];
    }

    const pageCars = await page.$$eval(
        '.card',
        cards => {
            return cards
                .map(card => {
                    const link =
                        card.querySelector(
                            'a[href*="/korea/"]'
                        );

                    const titleElement =
                        card.querySelector(
                            '.card__name'
                        );

                    return {
                        title:
                            titleElement
                                ?.innerText
                                ?.trim() ||
                            null,

                        url:
                            link?.href ||
                            null
                    };
                })
                .filter(car => car.url);
        }
    );

    console.log(
        `Карточек на странице: ${pageCars.length}`
    );

    pageCars
        .slice(0, 3)
        .forEach((car, index) => {
            console.log(
                `${index + 1}. ${car.title}`
            );

            console.log(
                `   ${car.url}`
            );
        });

    return pageCars;
}


/*
|--------------------------------------------------------------------------
| ОСНОВНЫЕ ХАРАКТЕРИСТИКИ
|--------------------------------------------------------------------------
*/

async function getMainSpecs(page) {
    return await page.evaluate(() => {
        const result = {};

        const columns = Array.from(
            document.querySelectorAll(
                '.car-card__right .specifs__col, .specifs__col'
            )
        );

        columns.forEach(column => {
            const spans = Array.from(
                column.querySelectorAll(
                    ':scope > span'
                )
            );

            for (
                let i = 0;
                i < spans.length - 1;
                i += 2
            ) {
                const name = spans[i]
                    ?.innerText
                    ?.replace(/\s+/g, ' ')
                    ?.trim() || '';

                const value = spans[i + 1]
                    ?.innerText
                    ?.replace(/\s+/g, ' ')
                    ?.trim() || '';

                if (!name || !value) {
                    continue;
                }

                result[name] = value;
            }
        });

        return result;
    });
}


/*
|--------------------------------------------------------------------------
| НОРМАЛИЗАЦИЯ ХАРАКТЕРИСТИК
|--------------------------------------------------------------------------
*/

function normalizeSpecs(raw) {
    const productionDate =
        raw['Дата производства'] ||
        raw['Год выпуска'] ||
        '';

    const mileage =
        raw['Пробег, км'] ||
        raw['Пробег'] ||
        '';

    const body =
        raw['Тип'] ||
        raw['Кузов'] ||
        '';

    const power =
        parsePower(
            raw['Мощность'] || ''
        );

    return {
        lot:
            raw['Лот'] ||
            '',

        sale_city:
            raw['Город продажи'] ||
            '',

        listing_date:
            raw['Дата размещения'] ||
            '',

        production_date:
        productionDate,

        year:
            parseYear(
                productionDate
            ),

        body,

        generation:
            raw['Поколение'] ||
            '',

        transmission:
            raw['Трансмиссия'] ||
            '',

        drive:
            raw['Привод'] ||
            '',

        engine:
            raw['Двигатель'] ||
            '',

        engine_volume:
            parseInteger(
                raw['Объем, см3'] ||
                raw['Объем, см³'] ||
                ''
            ),

        power:
            raw['Мощность'] ||
            '',

        power_hp:
        power.hp,

        power_kw:
        power.kw,

        mileage:
            parseInteger(mileage),

        fuel:
            raw['Топливо'] ||
            '',

        color:
            cleanText(
                raw['Цвет'] ||
                ''
            )
    };
}


/*
|--------------------------------------------------------------------------
| ЦЕНЫ
|--------------------------------------------------------------------------
*/

async function getPrices(page) {
    return await page.evaluate(() => {
        const result = {
            korea: '',
            china: '',
            russia: ''
        };

        const items = document.querySelectorAll(
            '.car-price__item'
        );

        items.forEach(item => {
            const spans = item.querySelectorAll(
                ':scope > span'
            );

            if (spans.length < 2) {
                return;
            }

            const name = spans[0]
                ?.innerText
                ?.replace(/\s+/g, ' ')
                ?.trim() || '';

            const value = spans[1]
                ?.innerText
                ?.replace(/\s+/g, ' ')
                ?.trim() || '';

            if (
                name.includes('Цена в Корее')
            ) {
                result.korea = value;
            }

            if (
                name.includes('Цена в Китае')
            ) {
                result.china = value;
            }

            if (
                name.includes('Цена в России')
            ) {
                result.russia = value;
            }
        });

        return result;
    });
}


/*
|--------------------------------------------------------------------------
| ЧИСЛОВЫЕ ЦЕНЫ
|--------------------------------------------------------------------------
*/

function normalizePrices(prices) {
    return {
        korea:
            parseInteger(
                prices.korea
            ),

        china:
            parseInteger(
                prices.china
            ),

        russia:
            parseInteger(
                prices.russia
            )
    };
}


/*
|--------------------------------------------------------------------------
| КОМПЛЕКТАЦИЯ
|--------------------------------------------------------------------------
*/

async function getCharacteristics(page) {
    return await page.evaluate(() => {
        const result = [];

        const sections =
            document.querySelectorAll(
                '.comparison__section'
            );

        sections.forEach(section => {
            const category =
                section
                    .querySelector(
                        '.comparison__title span'
                    )
                    ?.innerText
                    ?.trim() || '';

            const rows =
                section.querySelectorAll(
                    '.comparison__row'
                );

            rows.forEach(row => {
                const cols =
                    row.querySelectorAll(
                        '.comparison__col span'
                    );

                if (cols.length >= 2) {
                    const name =
                        cols[0]
                            ?.innerText
                            ?.trim() || '';

                    const value =
                        cols[1]
                            ?.innerText
                            ?.trim() || '';

                    if (name || value) {
                        result.push({
                            category,
                            name,
                            value
                        });
                    }
                }
            });
        });

        return result;
    });
}


/*
|--------------------------------------------------------------------------
| ФОТОГРАФИИ
|--------------------------------------------------------------------------
|
| Главная проблема старой версии:
|
| /800/фото.webp
| /200/фото.webp
|
| считались разными фотографиями.
|
| Также в DOM попадали изображения
| рекомендаций других автомобилей.
|
| Здесь собираем только изображения,
| относящиеся к текущему автомобилю.
|--------------------------------------------------------------------------
*/

async function getImages(page, currentLot) {
    return await page.evaluate((currentLot) => {
        const result = [];

        function addImage(url) {
            if (!url) {
                return;
            }

            if (
                url.includes('image_lazy.svg')
            ) {
                return;
            }

            try {
                const absoluteUrl =
                    new URL(
                        url,
                        window.location.href
                    ).href;

                result.push(
                    absoluteUrl
                );

            } catch (error) {}
        }

        /*
        |--------------------------------------------------------------------------
        | Вариант 1. Fancybox
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                'a[data-fancybox="gal"]'
            )
            .forEach(link => {
                addImage(
                    link.getAttribute('href')
                );
            });


        /*
        |--------------------------------------------------------------------------
        | Вариант 2. Slick gallery
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                '.slick-slide img'
            )
            .forEach(img => {
                let url =
                    img.getAttribute(
                        'data-srcset'
                    );

                if (!url) {
                    url =
                        img.getAttribute(
                            'data-src'
                        );
                }

                if (!url) {
                    url =
                        img.getAttribute(
                            'src'
                        );
                }

                if (url) {
                    url = url
                        .split(',')[0]
                        .trim()
                        .split(' ')[0];
                }

                addImage(url);
            });


        /*
        |--------------------------------------------------------------------------
        | Вариант 3. Изображения текущей карточки
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                '.car-card img'
            )
            .forEach(img => {
                let url =
                    img.getAttribute(
                        'data-src'
                    );

                if (!url) {
                    url =
                        img.getAttribute(
                            'src'
                        );
                }

                addImage(url);
            });


        /*
        |--------------------------------------------------------------------------
        | Убираем URL фотографий других автомобилей.
        |--------------------------------------------------------------------------
        |
        | У текущей машины URL выглядит примерно:
        |
        | /files/2502000/2501720/800/...
        |
        | Нам нужен lot текущей машины:
        |
        | 2501720
        |
        |--------------------------------------------------------------------------
        */

        let filtered = result;

        if (currentLot) {
            const currentLotString =
                String(currentLot);

            filtered =
                result.filter(url => {
                    return url.includes(
                        `/${currentLotString}/`
                    );
                });
        }


        /*
        |--------------------------------------------------------------------------
        | Убираем размер /200, оставляем /800
        |--------------------------------------------------------------------------
        */

        const normalized = [];

        const seen = new Set();

        filtered.forEach(url => {
            let normalizedUrl = url;

            normalizedUrl =
                normalizedUrl.replace(
                    /\/(200|400|600|800|1200)\//,
                    '/IMAGE_SIZE/'
                );

            /*
             * Если уже есть такая фотография —
             * пропускаем.
             */

            if (
                seen.has(normalizedUrl)
            ) {
                return;
            }

            seen.add(normalizedUrl);

            /*
             * Предпочитаем 800px.
             */

            let bestUrl = url;

            if (
                url.includes('/200/')
            ) {
                const candidate =
                    url.replace(
                        '/200/',
                        '/800/'
                    );

                const has800 =
                    result.includes(
                        candidate
                    );

                if (has800) {
                    bestUrl =
                        candidate;
                }
            }

            normalized.push(bestUrl);
        });


        /*
        |--------------------------------------------------------------------------
        | Финальный Set
        |--------------------------------------------------------------------------
        */

        return [
            ...new Set(
                normalized
            )
        ];

    }, currentLot);
}


/*
|--------------------------------------------------------------------------
| СКАЧИВАНИЕ ФОТО
|--------------------------------------------------------------------------
*/

async function downloadImages(
    request,
    images,
    folder
) {
    let downloadedImages = 0;

    for (
        let j = 0;
        j < images.length;
        j++
    ) {
        const imageUrl =
            images[j];

        const filenameBase =
            String(j + 1)
                .padStart(
                    3,
                    '0'
                );

        console.log(
            `Фото ${j + 1}/${images.length}`
        );

        try {
            const response =
                await request.get(
                    imageUrl,
                    {
                        timeout: 60000
                    }
                );

            if (!response.ok()) {
                console.log(
                    `HTTP ошибка: ${response.status()}`
                );

                continue;
            }

            const ext =
                getImageExtension(
                    imageUrl
                );

            const filename =
                `${filenameBase}.${ext}`;

            const filepath =
                path.join(
                    folder,
                    filename
                );

            if (
                fs.existsSync(
                    filepath
                )
            ) {
                console.log(
                    `Уже существует: ${filename}`
                );

                downloadedImages++;

                continue;
            }

            const body =
                await response.body();

            fs.writeFileSync(
                filepath,
                body
            );

            downloadedImages++;

        } catch (error) {
            console.log(
                `Ошибка фото ${j + 1}: ${error.message}`
            );
        }
    }

    return downloadedImages;
}


/*
|--------------------------------------------------------------------------
| ПАРСИНГ ОДНОГО АВТОМОБИЛЯ
|--------------------------------------------------------------------------
*/

async function processCar(
    page,
    request,
    car,
    number,
    total
) {
    console.log('');
    console.log(
        '======================================'
    );
    console.log(
        `АВТОМОБИЛЬ ${number}/${total}`
    );
    console.log(
        '======================================'
    );


    /*
    |--------------------------------------------------------------------------
    | URL
    |--------------------------------------------------------------------------
    */

    const parsed =
        parseCarUrl(
            car.url
        );

    console.log(
        `Марка: ${parsed.brand}`
    );

    console.log(
        `Модель: ${parsed.model}`
    );

    console.log(
        `Lot URL: ${parsed.lot}`
    );

    console.log(
        `URL: ${car.url}`
    );


    /*
    |--------------------------------------------------------------------------
    | ПАПКА
    |--------------------------------------------------------------------------
    */

    const folderName =
        makeSafeFolderName(
            `${String(number).padStart(3, '0')}_${parsed.brand || 'Unknown'}_${parsed.model || 'Unknown'}_${parsed.lot || 'Unknown'}`
        );

    const folder =
        path.join(
            DOWNLOAD_DIR,
            folderName
        );

    fs.mkdirSync(
        folder,
        {
            recursive: true
        }
    );


    /*
    |--------------------------------------------------------------------------
    | ОТКРЫВАЕМ АВТОМОБИЛЬ
    |--------------------------------------------------------------------------
    */

    try {
        await page.goto(
            car.url,
            {
                waitUntil:
                    'domcontentloaded',
                timeout:
                    60000
            }
        );

    } catch (error) {
        console.error(
            'Ошибка открытия автомобиля:'
        );

        console.error(
            error.message
        );

        return false;
    }


    await sleep(
        CAR_PAGE_DELAY
    );


    /*
    |--------------------------------------------------------------------------
    | TITLE
    |--------------------------------------------------------------------------
    */

    let title =
        car.title;

    try {
        const titleElement =
            page.locator(
                'h1.section-title'
            );

        if (
            await titleElement.count() > 0
        ) {
            title =
                await titleElement
                    .first()
                    .innerText();

            title =
                cleanText(
                    title
                );
        }

    } catch (error) {
        console.log(
            'H1 не найден. Используем название карточки.'
        );
    }

    console.log(
        `Название: ${title}`
    );


    /*
    |--------------------------------------------------------------------------
    | ОСНОВНЫЕ ХАРАКТЕРИСТИКИ
    |--------------------------------------------------------------------------
    */

    let rawSpecs = {};

    try {
        rawSpecs =
            await getMainSpecs(
                page
            );

        console.log('');
        console.log(
            'НАЙДЕННЫЕ ХАРАКТЕРИСТИКИ:'
        );

        console.log(
            rawSpecs
        );

    } catch (error) {
        console.log(
            'Ошибка получения характеристик:',
            error.message
        );
    }


    const mainSpecs =
        normalizeSpecs(
            rawSpecs
        );


    /*
    |--------------------------------------------------------------------------
    | ЦЕНЫ
    |--------------------------------------------------------------------------
    */

    let prices = {
        korea: '',
        china: '',
        russia: ''
    };

    try {
        prices =
            await getPrices(
                page
            );

    } catch (error) {
        console.log(
            'Ошибка получения цен:',
            error.message
        );
    }


    const normalizedPrices =
        normalizePrices(
            prices
        );


    /*
    |--------------------------------------------------------------------------
    | КОМПЛЕКТАЦИЯ
    |--------------------------------------------------------------------------
    */

    let characteristics = [];

    try {
        characteristics =
            await getCharacteristics(
                page
            );

        console.log(
            `Характеристик комплектации: ${characteristics.length}`
        );

    } catch (error) {
        console.log(
            'Ошибка получения характеристик:',
            error.message
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ФОТО
    |--------------------------------------------------------------------------
    */

    let images = [];

    try {
        images =
            await getImages(
                page,
                parsed.lot
            );

        console.log(
            `Фотографий найдено: ${images.length}`
        );

        console.log(
            'Главное фото:',
            images[0] ||
            'не найдено'
        );

    } catch (error) {
        console.log(
            'Ошибка получения фотографий:',
            error.message
        );
    }


    /*
    |--------------------------------------------------------------------------
    | СКАЧИВАНИЕ
    |--------------------------------------------------------------------------
    */

    let downloadedImages = 0;

    if (
        images.length > 0
    ) {
        downloadedImages =
            await downloadImages(
                request,
                images,
                folder
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DATA.JSON
    |--------------------------------------------------------------------------
    */

    const carData = {
        number,

        brand:
        parsed.brand,

        brand_slug:
        parsed.brand_slug,

        model:
        parsed.model,

        model_slug:
        parsed.model_slug,

        lot:
        parsed.lot,

        source_lot:
            mainSpecs.lot ||
            null,

        title,

        url:
        car.url,

        year:
        mainSpecs.year,

        production_date:
        mainSpecs.production_date,

        mileage:
        mainSpecs.mileage,

        body:
        mainSpecs.body,

        generation:
        mainSpecs.generation,

        engine:
        mainSpecs.engine,

        engine_volume:
        mainSpecs.engine_volume,

        power:
        mainSpecs.power,

        power_hp:
        mainSpecs.power_hp,

        power_kw:
        mainSpecs.power_kw,

        power_30min:
            null,

        power_30min_kw:
            null,

        fuel:
        mainSpecs.fuel,

        color:
        mainSpecs.color,

        transmission:
        mainSpecs.transmission,

        drive:
        mainSpecs.drive,

        sale_city:
        mainSpecs.sale_city,

        listing_date:
        mainSpecs.listing_date,

        price_korea:
        normalizedPrices.korea,

        price_china:
        normalizedPrices.china,

        price_russia:
        normalizedPrices.russia,

        raw_specifications:
        rawSpecs,

        images_count:
        images.length,

        images_downloaded:
        downloadedImages,

        image_urls:
        images,

        image_files:
            images.map(
                (_, index) => {
                    const ext =
                        getImageExtension(
                            images[index]
                        );

                    return path
                        .join(
                            path.basename(folder),
                            `${String(index + 1).padStart(3, '0')}.${ext}`
                        )
                        .replace(
                            /\\/g,
                            '/'
                        );
                }
            ),

        image_folder:
            path.basename(folder),

        folder,

        characteristics
    };


    /*
    |--------------------------------------------------------------------------
    | DATA.JSON
    |--------------------------------------------------------------------------
    */

    fs.writeFileSync(
        path.join(
            folder,
            'data.json'
        ),
        JSON.stringify(
            carData,
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
        '--------------------------------------'
    );

    console.log(
        `ГОТОВО ${number}/${total}`
    );

    console.log(
        `Марка: ${parsed.brand}`
    );

    console.log(
        `Модель: ${parsed.model}`
    );

    console.log(
        `Lot: ${parsed.lot}`
    );

    console.log(
        `Внешний Lot: ${mainSpecs.lot}`
    );

    console.log(
        `Год: ${mainSpecs.year}`
    );

    console.log(
        `Дата производства: ${mainSpecs.production_date}`
    );

    console.log(
        `Пробег: ${mainSpecs.mileage}`
    );

    console.log(
        `Кузов: ${mainSpecs.body}`
    );

    console.log(
        `Поколение: ${mainSpecs.generation}`
    );

    console.log(
        `Двигатель: ${mainSpecs.engine}`
    );

    console.log(
        `Объём: ${mainSpecs.engine_volume}`
    );

    console.log(
        `Мощность: ${mainSpecs.power_kw} кВт`
    );

    console.log(
        `Топливо: ${mainSpecs.fuel}`
    );

    console.log(
        `Привод: ${mainSpecs.drive}`
    );

    console.log(
        `Трансмиссия: ${mainSpecs.transmission}`
    );

    console.log(
        `Цена Корея: ${normalizedPrices.korea}`
    );

    console.log(
        `Цена Россия: ${normalizedPrices.russia}`
    );

    console.log(
        `Фотографий: ${images.length}`
    );

    console.log(
        `Скачано: ${downloadedImages}`
    );

    console.log(
        `Папка: ${folder}`
    );

    console.log(
        '--------------------------------------'
    );

    return true;
}


/*
|--------------------------------------------------------------------------
| ОСНОВНОЙ ПАРСЕР
|--------------------------------------------------------------------------
*/

(async () => {
    fs.mkdirSync(
        DOWNLOAD_DIR,
        {
            recursive: true
        }
    );


    const processedUrls =
        new Set(
            loadProgress()
        );


    console.log('');

    console.log(
        '======================================'
    );

    console.log(
        'ЗАПУСК ПАРСЕРА KOREA'
    );

    console.log(
        `MAX_CARS: ${MAX_CARS}`
    );

    console.log(
        `Уже обработано: ${processedUrls.size}`
    );

    console.log(
        `Папка: ${DOWNLOAD_DIR}`
    );

    console.log(
        '======================================'
    );


    const browser =
        await chromium.launch({
            headless: false,
            slowMo: 100
        });


    const context =
        await browser.newContext({
            viewport: {
                width: 1600,
                height: 900
            },

            userAgent:
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/148 Safari/537.36'
        });


    const request =
        context.request;


    let page =
        await createPage(
            context
        );


    let processedThisRun = 0;

    let currentPage = 1;


    try {
        while (
            processedThisRun < MAX_CARS
            ) {

            if (
                page.isClosed()
            ) {
                console.log(
                    'Страница была закрыта. Создаём новую.'
                );

                page =
                    await createPage(
                        context
                    );
            }


            const pageCars =
                await collectCarsFromPage(
                    page,
                    currentPage
                );


            if (
                pageCars.length === 0
            ) {
                console.log('');
                console.log(
                    'Автомобили на странице не найдены.'
                );

                console.log(
                    'Парсинг завершён.'
                );

                break;
            }


            console.log('');

            console.log(
                `Получено автомобилей на странице: ${pageCars.length}`
            );


            for (
                let i = 0;
                i < pageCars.length;
                i++
            ) {

                if (
                    processedThisRun >= MAX_CARS
                ) {
                    break;
                }


                const car =
                    pageCars[i];


                if (
                    processedUrls.has(
                        car.url
                    )
                ) {
                    console.log('');
                    console.log(
                        'ПРОПУСК: уже обработан'
                    );

                    console.log(
                        car.url
                    );

                    continue;
                }


                const number =
                    processedUrls.size + 1;


                if (
                    page.isClosed()
                ) {
                    console.log(
                        'Страница закрыта. Создаём новую.'
                    );

                    page =
                        await createPage(
                            context
                        );
                }


                try {
                    await processCar(
                        page,
                        request,
                        car,
                        number,
                        MAX_CARS
                    );

                } catch (error) {
                    console.error('');
                    console.error(
                        'ОШИБКА ПРИ ОБРАБОТКЕ АВТОМОБИЛЯ'
                    );

                    console.error(
                        car.url
                    );

                    console.error(
                        error.message
                    );
                }


                processedUrls.add(
                    car.url
                );


                saveProgress(
                    Array.from(
                        processedUrls
                    )
                );


                processedThisRun++;


                console.log('');

                console.log(
                    '======================================'
                );

                console.log(
                    `ПРОГРЕСС: ${processedThisRun}/${MAX_CARS}`
                );

                console.log(
                    `Всего обработано: ${processedUrls.size}`
                );

                console.log(
                    '======================================'
                );


                await sleep(
                    DELAY_BETWEEN_CARS
                );


                if (
                    processedThisRun >= MAX_CARS
                ) {
                    break;
                }
            }


            currentPage++;

            await sleep(1000);
        }


        console.log('');

        console.log(
            '======================================'
        );

        console.log(
            'ПАРСИНГ KOREA ЗАВЕРШЕН'
        );

        console.log(
            `Обработано в этом запуске: ${processedThisRun}`
        );

        console.log(
            `Всего обработано: ${processedUrls.size}`
        );

        console.log(
            `Результаты: ${DOWNLOAD_DIR}`
        );

        console.log(
            `Progress: ${PROGRESS_FILE}`
        );

        console.log(
            '======================================'
        );


    } catch (error) {
        console.error('');
        console.error(
            'КРИТИЧЕСКАЯ ОШИБКА'
        );

        console.error(
            error
        );


        saveProgress(
            Array.from(
                processedUrls
            )
        );


    } finally {
        try {
            await browser.close();
        } catch (error) {}
    }

})();
