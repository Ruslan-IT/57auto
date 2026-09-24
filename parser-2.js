import { chromium } from 'playwright';
import fs from 'fs';
import path from 'path';

/*
|--------------------------------------------------------------------------
| НАСТРОЙКИ
|--------------------------------------------------------------------------
*/

/*
 * Сколько автомобилей обработать.
 *
 * 10  = тест
 * 100 = тест
 * 1500 = полный запуск
 */
const MAX_CARS = 5;


/*
 * Количество автомобилей на странице сайта.
 */
const CARS_PER_PAGE = 20;


/*
 * Каталог.
 *
 * ВАЖНО:
 * Здесь сразу указываем те же параметры,
 * которые используем на следующих страницах.
 */
const START_URL =
    'https://revocars.ru/korea/?sort=price_asc';


/*
 * Базовый URL каталога.
 */
const CATALOG_URL =
    'https://revocars.ru/korea/';


/*
 * Папка результатов.
 */
const DOWNLOAD_DIR =
    path.join(
        process.cwd(),
        'downloads'
    );


/*
 * Файл прогресса.
 *
 * В нём будут храниться URL уже найденных автомобилей.
 */
const PROGRESS_FILE =
    path.join(
        DOWNLOAD_DIR,
        'cars_progress.json'
    );


/*
 * Пауза между автомобилями.
 *
 * Можно увеличить до 1500-2000,
 * если сайт начинает блокировать.
 */
const DELAY_BETWEEN_CARS = 1000;


/*
 * Пауза после открытия страницы автомобиля.
 */
const CAR_PAGE_DELAY = 1500;


/*
|--------------------------------------------------------------------------
| ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ
|--------------------------------------------------------------------------
*/


/*
 * Пауза.
 */
function sleep(ms) {

    return new Promise(
        resolve => setTimeout(
            resolve,
            ms
        )
    );

}


/*
 * Преобразует slug в нормальное название.
 *
 * nezha-v
 * →
 * Nezha V
 */
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


/*
 * Нормальные названия известных марок.
 */
function getBrandName(slug) {

    const brands = {

        byd: 'BYD',
        changan: 'Changan',
        chery: 'Chery',
        geely: 'Geely',
        exeed: 'Exeed',
        hongqi: 'Hongqi',
        zeekr: 'Zeekr',

        li: 'Li',
        lixiang: 'Li Auto',

        nio: 'NIO',

        neta: 'NETA',
        'neta-auto': 'NETA',

        voyah: 'Voyah',
        tank: 'Tank',
        gac: 'GAC',
        jac: 'JAC',
        baic: 'BAIC',
        jetour: 'Jetour',
        omoda: 'Omoda',
        jaecoo: 'Jaecoo',

        renault: 'Renault',
        volkswagen: 'Volkswagen',
        audi: 'Audi',
        bmw: 'BMW',
        mercedes: 'Mercedes-Benz',
        toyota: 'Toyota',
        honda: 'Honda',
        nissan: 'Nissan',
        mazda: 'Mazda',
        ford: 'Ford',
        kia: 'Kia',
        hyundai: 'Hyundai',
        skoda: 'Skoda',
        volvo: 'Volvo',
        tesla: 'Tesla',
        peugeot: 'Peugeot',
        citroen: 'Citroen',

        buick: 'Buick',
        cadillac: 'Cadillac',
        chevrolet: 'Chevrolet',
        jeep: 'Jeep',

        'land-rover': 'Land Rover',

        porsche: 'Porsche'

    };

    return (
        brands[slug] ||
        slugToName(slug)
    );

}


/*
 * Разбираем URL автомобиля.
 */
function parseCarUrl(carUrl) {

    try {

        const url =
            new URL(carUrl);

        const parts =
            url.pathname
                .split('/')
                .filter(Boolean);


        if (
            parts.length < 4 ||
            parts[0] !== 'china-used'
        ) {

            return {

                brand: null,
                brand_slug: null,

                model: null,
                model_slug: null,

                lot: null

            };

        }


        const brandSlug =
            parts[1];

        const modelSlug =
            parts[2];

        const lot =
            parts[3];


        return {

            brand:
                getBrandName(
                    brandSlug
                ),

            brand_slug:
            brandSlug,

            model:
                slugToName(
                    modelSlug
                ),

            model_slug:
            modelSlug,

            lot:
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


/*
 * Безопасное имя папки.
 */
function makeSafeFolderName(name) {

    return String(name || '')

        .replace(
            /[\\/:*?"<>|]/g,
            ''
        )

        .replace(
            /\s+/g,
            ' '
        )

        .trim();

}


/*
 * Получаем расширение изображения.
 */
function getImageExtension(imageUrl) {

    let ext =
        'webp';

    try {

        const urlWithoutQuery =
            imageUrl.split('?')[0];

        const detectedExt =
            path
                .extname(
                    urlWithoutQuery
                )
                .replace(
                    '.',
                    ''
                )
                .toLowerCase();

        if (detectedExt) {

            ext =
                detectedExt;

        }

    } catch (error) {

        ext =
            'webp';

    }


    const allowedExtensions = [

        'jpg',
        'jpeg',
        'png',
        'webp'

    ];


    if (
        !allowedExtensions.includes(ext)
    ) {

        ext =
            'webp';

    }


    return ext;

}


/*
 * Очищаем текст.
 */
function cleanText(value) {

    if (!value) {
        return '';
    }

    return String(value)
        .replace(
            /\s+/g,
            ' '
        )
        .trim();

}

function cleanTitle(value) {
    const title = cleanText(value);

    if (!title) {
        return '';
    }

    return title
        .replace(/\s*[,.]?\s*лот\s*№\s*[^\s,]+/giu, '')
        .replace(/(\d{4})\s*г\./gu, '$1')
        .replace(/\s{2,}/g, ' ')
        .replace(/[ \t,]+$/g, '');
}


/*
|--------------------------------------------------------------------------
| ПРОГРЕСС
|--------------------------------------------------------------------------
*/


/*
 * Загружаем прогресс.
 */
function loadProgress() {

    try {

        if (
            !fs.existsSync(
                PROGRESS_FILE
            )
        ) {

            return [];

        }


        const data =
            fs.readFileSync(
                PROGRESS_FILE,
                'utf8'
            );


        const parsed =
            JSON.parse(data);


        if (
            !Array.isArray(parsed)
        ) {

            return [];

        }


        return parsed;

    } catch (error) {

        console.log(
            'Не удалось загрузить progress.',
            error.message
        );

        return [];

    }

}


/*
 * Сохраняем прогресс.
 */
function saveProgress(
    processedUrls
) {

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
| СОЗДАНИЕ НОВОЙ СТРАНИЦЫ
|--------------------------------------------------------------------------
*/


async function createPage(
    context
) {

    const page =
        await context.newPage();


    await page.setViewportSize({

        width: 1600,
        height: 900

    });


    return page;

}


/*
|--------------------------------------------------------------------------
| СБОР АВТОМОБИЛЕЙ СО СТРАНИЦЫ
|--------------------------------------------------------------------------
*/


async function collectCarsFromPage(
    page,
    pageNumber
) {

    const url =
        pageNumber === 1

            ? START_URL

            : `${CATALOG_URL}?page=${pageNumber}&body=vnedorozhnik&sort=price_asc`;


    console.log('');
    console.log(
        '======================================'
    );

    console.log(
        `СТРАНИЦА ${pageNumber}`
    );

    console.log(
        url
    );

    console.log(
        '======================================'
    );


    /*
     * Открываем каталог.
     */
    try {

        await page.goto(

            url,

            {

                waitUntil:
                    'domcontentloaded',

                timeout:
                    60000

            }

        );

    } catch (error) {

        console.error(
            `Ошибка загрузки страницы ${pageNumber}:`
        );

        console.error(
            error.message
        );

        return [];

    }


    /*
     * Ждём карточки.
     */
    try {

        await page.waitForSelector(

            '.card',

            {

                timeout:
                    30000

            }

        );

    } catch (error) {

        console.log(
            'Карточки автомобилей не найдены.'
        );

        return [];

    }


    await sleep(1000);


    /*
     * Получаем карточки.
     */
    const pageCars =
        await page.$$eval(

            '.card',

            cards => {

                return cards

                    .map(card => {

                        const link =
                            card.querySelector(
                                'a.pic'
                            );


                        return {

                            title:
                                card
                                    .querySelector(
                                        '.card__name'
                                    )
                                    ?.innerText
                                    ?.trim() ||
                                null,

                            url:
                                link
                                    ?.href ||
                                null

                        };

                    })

                    .filter(
                        car =>
                            car.url
                    );

            }

        );


    console.log(
        `Карточек на странице: ${pageCars.length}`
    );


    return pageCars;

}


/*
|--------------------------------------------------------------------------
| ПОЛУЧЕНИЕ ОСНОВНЫХ ХАРАКТЕРИСТИК
|--------------------------------------------------------------------------
*/


async function getMainSpecs(
    page
) {

    return await page.$$eval(

        '.car-card__right .specifs',

        blocks => {

            const result = {

                lot: '',
                year: '',
                mileage: '',
                body: '',
                engine: '',

                power: '',
                power_30min: '',

                color: '',
                transmission: '',
                source: ''

            };


            const columns =
                blocks.flatMap(

                    block =>
                        Array.from(
                            block.querySelectorAll(
                                '.specifs__col'
                            )
                        )

                );


            columns.forEach(
                column => {

                    const spans =
                        Array.from(
                            column.querySelectorAll(
                                ':scope > span'
                            )
                        );


                    for (
                        let i = 0;
                        i < spans.length;
                        i += 2
                    ) {

                        const name =
                            spans[i]
                                ?.innerText
                                ?.replace(
                                    /\s+/g,
                                    ' '
                                )
                                ?.trim() ||
                            '';


                        const valueElement =
                            spans[i + 1];


                        if (
                            !name ||
                            !valueElement
                        ) {

                            continue;

                        }


                        const value =
                            valueElement
                                .innerText
                                ?.replace(
                                    /\s+/g,
                                    ' '
                                )
                                ?.trim() ||
                            '';


                        switch (name) {

                            case 'Лот':

                                result.lot =
                                    value;

                                break;


                            case 'Год выпуска':

                                result.year =
                                    value;

                                break;


                            case 'Пробег':

                                result.mileage =
                                    value;

                                break;


                            case 'Кузов':

                                result.body =
                                    value;

                                break;


                            case 'Двигатель':

                                result.engine =
                                    value;

                                break;


                            case 'Мощность':

                                result.power =
                                    value;

                                break;


                            case '30-мин. мощность':

                                result.power_30min =
                                    value;

                                break;


                            case 'Цвет':

                                result.color =
                                    value;

                                break;


                            case 'Трансмиссия':

                                result.transmission =
                                    value;

                                break;


                            case 'Источник':

                                result.source =
                                    value;

                                break;

                        }

                    }

                }
            );


            /*
             * Дополнительный поиск лота.
             */
            const lotElement =
                document.querySelector(
                    '.specifs .lot-number'
                );


            if (lotElement) {

                const lot =
                    lotElement
                        .innerText
                        .trim();


                if (lot) {

                    result.lot =
                        lot;

                }

            }


            /*
             * Источник.
             */
            const sourceElement =
                document.querySelector(
                    '.specifs .site-label.che'
                );


            if (sourceElement) {

                const sourceText =
                    sourceElement
                        .innerText
                        .trim();


                if (sourceText) {

                    result.source =
                        sourceText;

                }

            }


            return result;

        }

    );

}


/*
|--------------------------------------------------------------------------
| ЦЕНЫ
|--------------------------------------------------------------------------
*/


async function getPrices(
    page
) {

    return await page.$$eval(

        '.car-card__right .car-price__item',

        items => {

            const result = {

                china: '',
                russia: ''

            };


            items.forEach(
                item => {

                    const spans =
                        item.querySelectorAll(
                            ':scope > span'
                        );


                    if (
                        spans.length < 2
                    ) {

                        return;

                    }


                    const name =
                        spans[0]
                            ?.innerText
                            ?.replace(
                                /\s+/g,
                                ' '
                            )
                            ?.trim() ||
                        '';


                    const value =
                        spans[1]
                            ?.innerText
                            ?.replace(
                                /\s+/g,
                                ' '
                            )
                            ?.trim() ||
                        '';


                    if (
                        name ===
                        'Цена в Китае'
                    ) {

                        result.china =
                            value;

                    }


                    if (
                        name ===
                        'Цена в России (с ПТС)'
                    ) {

                        result.russia =
                            value;

                    }

                }
            );


            return result;

        }

    );

}


/*
|--------------------------------------------------------------------------
| ХАРАКТЕРИСТИКИ КОМПЛЕКТАЦИИ
|--------------------------------------------------------------------------
*/


async function getCharacteristics(
    page
) {

    return await page.$$eval(

        '.comparison__section',

        sections => {

            const result = [];


            sections.forEach(
                section => {

                    const category =
                        section
                            .querySelector(
                                '.comparison__title span'
                            )
                            ?.innerText
                            ?.trim() ||
                        '';


                    const rows =
                        section.querySelectorAll(
                            '.comparison__row'
                        );


                    rows.forEach(
                        row => {

                            const cols =
                                row.querySelectorAll(
                                    '.comparison__col span'
                                );


                            if (
                                cols.length >= 2
                            ) {

                                const name =
                                    cols[0]
                                        ?.innerText
                                        ?.trim() ||
                                    '';


                                const value =
                                    cols[1]
                                        ?.innerText
                                        ?.trim() ||
                                    '';


                                if (
                                    name ||
                                    value
                                ) {

                                    result.push({

                                        category:
                                        category,

                                        name:
                                        name,

                                        value:
                                        value

                                    });

                                }

                            }

                        }
                    );

                }
            );


            return result;

        }

    );

}


/*
|--------------------------------------------------------------------------
| ФОТОГРАФИИ
|--------------------------------------------------------------------------
*/


async function getImages(
    page
) {

    return await page.evaluate(

        () => {

            const result = [];


            /*
             * Главное изображение.
             */
            const mainImageLink =
                document.querySelector(
                    'a[data-fancybox="gal"]'
                );


            if (mainImageLink) {

                const mainImage =
                    mainImageLink.getAttribute(
                        'href'
                    );


                if (
                    mainImage &&
                    !mainImage.includes(
                        'image_lazy.svg'
                    )
                ) {

                    try {

                        result.push(

                            new URL(
                                mainImage,
                                window.location.href
                            ).href

                        );

                    } catch (error) {

                    }

                }

            }


            /*
             * Остальные изображения.
             */
            const galleryImages =
                Array.from(

                    document.querySelectorAll(
                        '.slick-slide img'
                    )

                );


            galleryImages.forEach(
                img => {

                    let url =
                        img.getAttribute(
                            'data-srcset'
                        );


                    if (!url) {

                        url =
                            img.getAttribute(
                                'src'
                            );

                    }


                    if (url) {

                        url =
                            url
                                .split(',')
                                [0]
                                .trim()
                                .split(' ')[0];

                    }


                    if (
                        url &&
                        !url.includes(
                            'image_lazy.svg'
                        )
                    ) {

                        try {

                            result.push(

                                new URL(
                                    url,
                                    window.location.href
                                ).href

                            );

                        } catch (error) {

                        }

                    }

                }
            );


            /*
             * Удаляем дубли.
             *
             * Главное фото остаётся первым.
             */
            return [
                ...new Set(result)
            ];

        }

    );

}


/*
|--------------------------------------------------------------------------
| СКАЧИВАНИЕ ФОТОГРАФИЙ
|--------------------------------------------------------------------------
*/


async function downloadImages(
    request,
    images,
    folder
) {

    let downloadedImages =
        0;


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

                        timeout:
                            60000

                    }

                );


            if (
                !response.ok()
            ) {

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


            /*
             * Если фото уже есть,
             * повторно его не скачиваем.
             */
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
     * Папка автомобиля.
     */
    const folderName =
        makeSafeFolderName(

            `${String(number).padStart(3, '0')}_${parsed.brand}_${parsed.model}_${parsed.lot}`

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
     * Открываем автомобиль.
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

        title =
            await page
                .locator(
                    'h1.section-title'
                )
                .innerText();


        title =
            cleanTitle(
                title
            );


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

    let mainSpecs = {

        lot: '',
        year: '',
        mileage: '',
        body: '',
        engine: '',

        power: '',
        power_30min: '',

        color: '',
        transmission: '',
        source: ''

    };


    try {

        mainSpecs =
            await getMainSpecs(
                page
            );


        console.log(
            'Основные характеристики:',
            mainSpecs
        );


    } catch (error) {

        console.log(
            'Ошибка получения основных характеристик:',
            error.message
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ЦЕНЫ
    |--------------------------------------------------------------------------
    */

    let prices = {

        china: '',
        russia: ''

    };


    try {

        prices =
            await getPrices(
                page
            );


        console.log(
            'Цены:',
            prices
        );


    } catch (error) {

        console.log(
            'Ошибка получения цен:',
            error.message
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ХАРАКТЕРИСТИКИ
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
                page
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
    | СКАЧИВАЕМ ФОТО
    |--------------------------------------------------------------------------
    */

    let downloadedImages =
        0;


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

        number:
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

        title:
        cleanTitle(title),

        url:
        car.url,

        main_specs:
        mainSpecs,

        prices:
        prices,

        images:
        images,

        images_downloaded:
        downloadedImages,

        characteristics:
        characteristics

    };


    /*
     * Сохраняем JSON.
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
        `Год: ${mainSpecs.year}`
    );

    console.log(
        `Пробег: ${mainSpecs.mileage}`
    );

    console.log(
        `Кузов: ${mainSpecs.body}`
    );

    console.log(
        `Двигатель: ${mainSpecs.engine}`
    );

    console.log(
        `Мощность: ${mainSpecs.power}`
    );

    console.log(
        `Цена Китай: ${prices.china}`
    );

    console.log(
        `Цена Россия: ${prices.russia}`
    );

    console.log(
        `Характеристик: ${characteristics.length}`
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

    /*
     * Создаём папку downloads.
     */
    fs.mkdirSync(

        DOWNLOAD_DIR,

        {
            recursive: true
        }

    );


    /*
     * Загружаем ранее обработанные URL.
     */
    const processedUrls =
        new Set(
            loadProgress()
        );


    console.log('');
    console.log(
        '======================================'
    );

    console.log(
        'ЗАПУСК ПАРСЕРА'
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


    /*
     * Запускаем браузер.
     */
    const browser =
        await chromium.launch({

            headless: false,

            slowMo: 100

        });


    /*
     * Контекст.
     */
    const context =
        await browser.newContext({

            viewport: {

                width: 1600,
                height: 900

            },

            /*
             * Немного реалистичнее браузер.
             */
            userAgent:
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/148 Safari/537.36'

        });


    /*
     * API request context для скачивания фотографий.
     */
    const request =
        await context.request;


    /*
     * Создаём страницу.
     */
    let page =
        await createPage(
            context
        );


    /*
     * Счётчик обработанных автомобилей
     * в текущем запуске.
     */
    let processedThisRun =
        0;


    /*
     * Следующая страница каталога.
     */
    let currentPage =
        1;


    try {

        /*
        |--------------------------------------------------------------------------
        | ЦИКЛ ПО СТРАНИЦАМ
        |--------------------------------------------------------------------------
        */

        while (
            processedThisRun < MAX_CARS
            ) {

            /*
             * Если страница закрылась,
             * создаём новую.
             */
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


            /*
             * Получаем автомобили со страницы.
             */
            const pageCars =
                await collectCarsFromPage(

                    page,

                    currentPage

                );


            /*
             * Если автомобилей нет,
             * прекращаем работу.
             */
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


            /*
             * Обрабатываем автомобили страницы.
             */
            for (
                let i = 0;
                i < pageCars.length;
                i++
            ) {

                /*
                 * Достигли MAX_CARS.
                 */
                if (
                    processedThisRun >= MAX_CARS
                ) {

                    break;

                }


                const car =
                    pageCars[i];


                /*
                 * Если этот URL уже был обработан
                 * в предыдущем запуске — пропускаем.
                 */
                if (
                    processedUrls.has(
                        car.url
                    )
                ) {

                    console.log('');

                    console.log(
                        `ПРОПУСК: уже обработан`
                    );

                    console.log(
                        car.url
                    );

                    continue;

                }


                /*
                 * Номер автомобиля.
                 */
                const number =
                    processedUrls.size +
                    1;


                /*
                 * Если страница была закрыта —
                 * создаём новую.
                 */
                if (
                    page.isClosed()
                ) {

                    console.log(
                        'Страница закрыта. Перезапускаем.'
                    );


                    page =
                        await createPage(
                            context
                        );

                }


                /*
                 * Обрабатываем автомобиль.
                 *
                 * ВАЖНО:
                 * ошибка одной машины НЕ остановит весь парсер.
                 */
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


                /*
                 * Добавляем URL в прогресс.
                 *
                 * Даже если на одном фото была 404,
                 * автомобиль всё равно считается обработанным.
                 */
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


                /*
                 * Пауза между автомобилями.
                 */
                await sleep(
                    DELAY_BETWEEN_CARS
                );


                /*
                 * Проверяем лимит.
                 */
                if (
                    processedThisRun >= MAX_CARS
                ) {

                    break;

                }

            }


            /*
             * Следующая страница.
             */
            currentPage++;


            /*
             * Небольшая пауза перед новой страницей.
             */
            await sleep(1000);

        }


        /*
        |--------------------------------------------------------------------------
        | ЗАВЕРШЕНИЕ
        |--------------------------------------------------------------------------
        */

        console.log('');
        console.log(
            '======================================'
        );

        console.log(
            'ПАРСИНГ ЗАВЕРШЕН'
        );

        console.log(
            `Обработано в этом запуске: ${processedThisRun}`
        );

        console.log(
            `Всего обработано ранее и сейчас: ${processedUrls.size}`
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


        /*
         * Даже при критической ошибке
         * сохраняем прогресс.
         */
        saveProgress(
            Array.from(
                processedUrls
            )
        );


    } finally {

        /*
         * Закрываем browser только здесь.
         */
        try {

            await browser.close();

        } catch (error) {

        }

    }

})();
