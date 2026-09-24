import { chromium } from 'playwright';
import fs from 'fs';
import path from 'path';

/*
|--------------------------------------------------------------------------
| НАСТРОЙКИ
|--------------------------------------------------------------------------
*/

/*
 * Пока тестируем только 5 автомобилей.
 *
 * Когда всё проверим:
 *
 * const MAX_CARS = 100;
 */
const MAX_CARS =1005;

/*
 * Стартовая страница каталога.
 */
const START_URL = 'https://revocars.ru/china-used/?eng_v_from=700&eng_v_to=1600&eng_type=benzin';

/*
 * Папка результатов.
 */
const DOWNLOAD_DIR =
    path.join(process.cwd(), 'downloads');


/*
|--------------------------------------------------------------------------
| ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ
|--------------------------------------------------------------------------
*/

/*
 * Преобразует slug в нормальное название.
 *
 * changan
 * →
 * Changan
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

    return brands[slug] || slugToName(slug);
}


/*
 * Разбираем URL автомобиля.
 *
 * Например:
 *
 * /china-used/neta/nezha-v/1_91932343/
 *
 * Получаем:
 *
 * brand_slug = neta
 * model_slug = nezha-v
 * lot        = 1_91932343
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
                getBrandName(brandSlug),

            brand_slug:
            brandSlug,

            model:
                slugToName(modelSlug),

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

    return name

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
                .extname(urlWithoutQuery)
                .replace('.', '')
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
 *
 * Убираем лишние пробелы и переносы.
 */
function cleanText(value) {

    if (!value) {
        return '';
    }

    return value
        .replace(/\s+/g, ' ')
        .trim();
}


/*
|--------------------------------------------------------------------------
| ПАРСЕР
|--------------------------------------------------------------------------
*/

(async () => {

    /*
     * Создаём downloads.
     */
    fs.mkdirSync(

        DOWNLOAD_DIR,

        {
            recursive: true
        }

    );


    /*
     * Запускаем Chromium.
     */
    const browser =
        await chromium.launch({

            headless: false,

            slowMo: 200

        });


    const context =
        await browser.newContext({

            viewport: {

                width: 1600,
                height: 900

            }

        });


    const page =
        await context.newPage();


    /*
     * Здесь будут собранные автомобили.
     */
    const cars = [];


    /*
     * Защита от дублей.
     */
    const uniqueUrls =
        new Set();


    try {

        /*
        |--------------------------------------------------------------------------
        | ЭТАП 1
        | СБОР АВТОМОБИЛЕЙ ИЗ КАТАЛОГА
        |--------------------------------------------------------------------------
        */

        console.log('');

        console.log(
            '======================================'
        );

        console.log(
            'ЭТАП 1. СБОР АВТОМОБИЛЕЙ'
        );

        console.log(
            '======================================'
        );


        let currentPage = 1;


        while (cars.length < MAX_CARS) {

            /*
             * Формируем URL страницы.
             */
            const url =
                currentPage === 1
                    ? START_URL
                    : `https://revocars.ru/china-used/?page=${currentPage}&eng_v_from=700&eng_v_to=1600&eng_type=benzin`;

            console.log('');

            console.log(`Страница ${currentPage}`);

            console.log(url);


            /*
             * Загружаем каталог.
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
                    `Ошибка загрузки страницы ${currentPage}`
                );

                console.error(
                    error.message
                );

                break;

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

                break;

            }


            await page.waitForTimeout(
                1000
            );


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


            /*
             * Добавляем автомобили.
             */
            let added =
                0;


            for (
                const car of pageCars
                ) {

                if (
                    uniqueUrls.has(
                        car.url
                    )
                ) {

                    continue;

                }


                uniqueUrls.add(
                    car.url
                );


                cars.push({

                    number:
                        cars.length + 1,

                    title:
                    car.title,

                    url:
                    car.url

                });


                added++;


                console.log(
                    `${cars.length}. ${car.title}`
                );


                if (
                    cars.length >= MAX_CARS
                ) {

                    break;

                }

            }


            console.log(
                `Новых автомобилей: ${added}`
            );

            console.log(
                `Всего собрано: ${cars.length}/${MAX_CARS}`
            );


            /*
             * Нужное количество собрано.
             */
            if (
                cars.length >= MAX_CARS
            ) {

                break;

            }


            /*
             * Проверяем следующую страницу.
             */
            const nextPage =
                await page

                    .locator(
                        '.pagination__nav .pag_next_arr'
                    )

                    .getAttribute(
                        'href'
                    );


            if (!nextPage) {

                console.log(
                    'Следующей страницы нет.'
                );

                break;

            }


            currentPage++;

        }


        /*
        |--------------------------------------------------------------------------
        | СОБРАЛИ АВТОМОБИЛИ
        |--------------------------------------------------------------------------
        */

        console.log('');

        console.log(
            '======================================'
        );

        console.log(
            `СОБРАНО АВТОМОБИЛЕЙ: ${cars.length}`
        );

        console.log(
            '======================================'
        );


        /*
        |--------------------------------------------------------------------------
        | ЭТАП 2
        | ПАРСИНГ КАЖДОГО АВТОМОБИЛЯ
        |--------------------------------------------------------------------------
        */

        console.log('');

        console.log(
            '======================================'
        );

        console.log(
            'ЭТАП 2. ПАРСИНГ АВТОМОБИЛЕЙ'
        );

        console.log(
            '======================================'
        );


        for (
            let i = 0;
            i < cars.length;
            i++
        ) {

            const car =
                cars[i];


            console.log('');

            console.log(
                '======================================'
            );

            console.log(
                `АВТОМОБИЛЬ ${i + 1}/${cars.length}`
            );

            console.log(
                '======================================'
            );


            /*
             * Разбираем URL.
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
                `Lot: ${parsed.lot}`
            );

            console.log(
                `URL: ${car.url}`
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

                continue;

            }


            /*
             * Ждём загрузку.
             */
            await page.waitForTimeout(
                2000
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
                    cleanText(
                        title
                    );


            } catch (error) {

                console.log(
                    'H1 не найден. Используем title карточки.'
                );

            }


            console.log(
                `Название: ${title}`
            );


            /*
            |--------------------------------------------------------------------------
            | ОСНОВНЫЕ ХАРАКТЕРИСТИКИ
            |--------------------------------------------------------------------------
            |
            | Берём:
            |
            | .car-card__right
            |     .specifs
            |
            | Здесь получаем:
            |
            | Лот
            | Год выпуска
            | Пробег
            | Кузов
            | Двигатель
            | Мощность
            | 30-мин. мощность
            | Цвет
            | Трансмиссия
            | Источник
            |
            |--------------------------------------------------------------------------
            */

            const mainSpecs =
                await page.$$eval(

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


                        /*
                         * На странице два .specifs__col.
                         */
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


                                /*
                                 * Идём парами:
                                 *
                                 * span = название
                                 * span = значение
                                 */
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
                         * На всякий случай ищем lot-number.
                         *
                         * Потому что внутри ссылки
                         * может быть дополнительная
                         * вложенность span.
                         */
                        const lotElement =
                            document.querySelector(
                                '.specifs .lot-number'
                            );


                        if (
                            lotElement
                        ) {

                            result.lot =
                                lotElement
                                    .innerText
                                    .trim();

                        }


                        /*
                         * Источник может находиться
                         * в отдельном span.site-label.
                         */
                        const sourceElement =
                            document.querySelector(
                                '.specifs .site-label.che'
                            );


                        if (
                            sourceElement
                        ) {

                            const sourceText =
                                sourceElement
                                    .innerText
                                    .trim();


                            if (
                                sourceText
                            ) {

                                result.source =
                                    sourceText;

                            }

                        }


                        return result;

                    }

                );


            console.log(
                'Основные характеристики:',
                mainSpecs
            );


            /*
            |--------------------------------------------------------------------------
            | ЦЕНЫ
            |--------------------------------------------------------------------------
            */

            const prices =
                await page.$$eval(

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


            console.log(
                'Цены:',
                prices
            );


            /*
            |--------------------------------------------------------------------------
            | ХАРАКТЕРИСТИКИ КОМПЛЕКТАЦИИ
            |--------------------------------------------------------------------------
            */

            const characteristics =
                await page.$$eval(

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
                                    section

                                        .querySelectorAll(
                                            '.comparison__row'
                                        );


                                rows.forEach(
                                    row => {

                                        const cols =
                                            row

                                                .querySelectorAll(
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


            console.log(
                `Характеристик комплектации: ${characteristics.length}`
            );


            /*
            |--------------------------------------------------------------------------
            | СОЗДАЁМ ПАПКУ
            |--------------------------------------------------------------------------
            */

            const folderName =
                makeSafeFolderName(

                    `${String(i + 1).padStart(3, '0')}_${parsed.brand}_${parsed.model}_${parsed.lot}`

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
 | ФОТОГРАФИИ
 |--------------------------------------------------------------------------
 |
 | Логика:
 |
 | 1. Сначала ищем главное фото:
 |    a[data-fancybox="gal"]
 |
 | 2. Затем собираем остальные фото
 |    из .slick-slide img
 |
 | 3. Главное фото всегда ставим первым.
 |
 | 4. Убираем дубли.
 |
 |--------------------------------------------------------------------------
 */

            const images =
                await page.evaluate(() => {

                    const result = [];

                    /*
                    |--------------------------------------------------------------------------
                    | 1. ГЛАВНОЕ ФОТО
                    |--------------------------------------------------------------------------
                    |
                    | На странице оно находится отдельно:
                    |
                    | <a data-fancybox="gal" href="ORIGINAL">
                    |     <img src="RESIZED">
                    | </a>
                    |
                    | Берём href, потому что там оригинальное изображение.
                    |--------------------------------------------------------------------------
                    */

                    const mainImageLink =
                        document.querySelector(
                            'a[data-fancybox="gal"]'
                        );

                    if (mainImageLink) {

                        const mainImage =
                            mainImageLink.getAttribute('href');

                        if (
                            mainImage &&
                            !mainImage.includes('image_lazy.svg')
                        ) {

                            result.push(
                                new URL(
                                    mainImage,
                                    window.location.href
                                ).href
                            );
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | 2. ОСТАЛЬНЫЕ ФОТОГРАФИИ
                    |--------------------------------------------------------------------------
                    */

                    const galleryImages =
                        Array.from(
                            document.querySelectorAll(
                                '.slick-slide img'
                            )
                        );


                    galleryImages.forEach(img => {

                        /*
                        * Сначала data-srcset
                        */
                        let url =
                            img.getAttribute(
                                'data-srcset'
                            );


                        /*
                        * Если нет — src
                        */
                        if (!url) {

                            url =
                                img.getAttribute(
                                    'src'
                                );
                        }


                        /*
                        * Иногда srcset содержит
                        * несколько URL.
                        */
                        if (url) {

                            url =
                                url
                                    .split(',')
                                    [0]
                                    .trim()
                                    .split(' ')[0];
                        }


                        /*
                        * Проверяем изображение
                        */
                        if (
                            url &&
                            !url.includes(
                                'image_lazy.svg'
                            )
                        ) {

                            result.push(
                                new URL(
                                    url,
                                    window.location.href
                                ).href
                            );
                        }

                    });


                    /*
                    |--------------------------------------------------------------------------
                    | 3. УДАЛЯЕМ ДУБЛИКАТЫ
                    |--------------------------------------------------------------------------
                    |
                    | Главное фото уже находится первым.
                    |--------------------------------------------------------------------------
                    */

                    return [
                        ...new Set(result)
                    ];

                });


            console.log(
                `Фотографий найдено: ${images.length}`
            );

            console.log(
                'Главное фото:',
                images[0] || 'не найдено'
            );




            console.log(
                `Фотографий найдено: ${images.length}`
            );


            /*
            |--------------------------------------------------------------------------
            | СКАЧИВАЕМ ФОТО
            |--------------------------------------------------------------------------
            */

            let downloadedImages =
                0;


            for (
                let j = 0;
                j < images.length;
                j++
            ) {

                const imageUrl =
                    images[j];


                try {

                    console.log(
                        `Фото ${j + 1}/${images.length}`
                    );


                    const response =
                        await context
                            .request
                            .get(

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
                        `${String(j + 1).padStart(3, '0')}.${ext}`;


                    fs.writeFileSync(

                        path.join(
                            folder,
                            filename
                        ),

                        await response.body()

                    );


                    downloadedImages++;


                } catch (error) {

                    console.log(
                        `Ошибка фото ${j + 1}: ${error.message}`
                    );

                }

            }


            /*
            |--------------------------------------------------------------------------
            | DATA.JSON
            |--------------------------------------------------------------------------
            */

            const carData = {

                /*
                 * Порядковый номер автомобиля
                 */
                number:
                car.number,


                /*
                 * Марка
                 */
                brand:
                parsed.brand,

                brand_slug:
                parsed.brand_slug,


                /*
                 * Модель
                 */
                model:
                parsed.model,

                model_slug:
                parsed.model_slug,


                /*
                 * Lot
                 */
                lot:
                parsed.lot,


                /*
                 * Название
                 */
                title:
                title,


                /*
                 * URL
                 */
                url:
                car.url,


                /*
                 * Основные характеристики
                 */
                main_specs:
                mainSpecs,


                /*
                 * Цены
                 */
                prices:
                prices,


                /*
                 * Список URL фотографий
                 */
                images:
                images,


                /*
                 * Количество скачанных фотографий
                 */
                images_downloaded:
                downloadedImages,


                /*
                 * Полные характеристики комплектации
                 */
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
            | ИТОГ ПО АВТОМОБИЛЮ
            |--------------------------------------------------------------------------
            */

            console.log('');

            console.log(
                '--------------------------------------'
            );

            console.log(
                `ГОТОВО ${i + 1}/${cars.length}`
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


            /*
             * Пауза между автомобилями.
             */
            await page.waitForTimeout(
                1000
            );

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
            `Автомобилей обработано: ${cars.length}`
        );

        console.log(
            `Результаты: ${DOWNLOAD_DIR}`
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


    } finally {

        await browser.close();

    }

})();
