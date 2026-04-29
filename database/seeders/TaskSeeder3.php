<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder3 extends Seeder
{
    public function run(): void
    {
        // Получаем или создаём тему "Агрегация"
        $aggregationTopicId = DB::table('topics')->where('slug', 'aggregation')->value('id');
        if (!$aggregationTopicId) {
            $aggregationTopicId = DB::table('topics')->insertGetId([
                'title' => 'Агрегация и группировка',
                'slug' => 'aggregation',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $aggregationTasks = [
            // ========== COUNT ==========
            [
                'title' => 'Подсчёт всех товаров',
                'slug' => 'count-all-products',
                'h1' => 'Сколько всего товаров в таблице?',
                'seo_title' => 'SQL: COUNT(*) для подсчёта всех строк',
                'seo_description' => 'Используйте COUNT(*) чтобы узнать общее количество товаров',
                'seo_keywords' => 'COUNT, агрегация, задачи по sql',
                'topic_id' => $aggregationTopicId,
                'description' => 'Подсчитайте общее количество товаров в таблице `products`.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Хлеб', 30),
(2, 'Молоко', 60),
(3, 'Сыр', 150),
(4, 'Икра', 500);
",
                'expected_sql' => "SELECT COUNT(*) FROM products;",
                'hint' => 'Используйте функцию COUNT(*)',
                'motivation' => 'Самое ценное — это практика. Чтение теории важно, но реальный рост начинается, когда ты решаешь задачи и сталкиваешься с ошибками. Именно через практику формируется мышление разработчика: умение анализировать, искать решения и оптимизировать код. Постепенно ты начинаешь видеть закономерности и писать более чистый и эффективный код. И в какой-то момент понимаешь, что программирование — это уже не сложно, а интересно и даже увлекательно.',
            ],
            [
                'title' => 'Количество товаров с ценой > 100',
                'slug' => 'count-price-greater-100',
                'h1' => 'Сколько дорогих товаров?',
                'seo_title' => 'SQL: COUNT с условием WHERE',
                'seo_description' => 'Подсчёт строк, удовлетворяющих условию',
                'seo_keywords' => 'COUNT, WHERE, обучение sql',
                'topic_id' => $aggregationTopicId,
                'description' => 'Посчитайте, сколько товаров имеют цену больше 100.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Хлеб', 30),
(2, 'Молоко', 60),
(3, 'Сыр', 150),
(4, 'Икра', 500);
",
                'expected_sql' => "SELECT COUNT(*) FROM products WHERE price > 100;",
                'hint' => 'Сначала отфильтруйте через WHERE, затем посчитайте',
                'motivation' => 'Важно понимать, что знания SQL и программирования — это не “дополнительный плюс”, а основа. Даже если ты занимаешься фронтендом или мобильной разработкой, тебе придётся работать с API и данными. Чем лучше ты понимаешь, как устроены базы и запросы, тем сильнее ты как специалист. Это даёт уверенность на собеседованиях и ускоряет решение задач. В итоге ты становишься не просто исполнителем, а инженером, который понимает систему целиком.',
            ],
            [
                'title' => 'Количество уникальных категорий',
                'slug' => 'count-distinct-categories',
                'h1' => 'Сколько различных категорий товаров?',
                'seo_title' => 'SQL: COUNT(DISTINCT ...)',
                'seo_description' => 'Подсчёт уникальных значений в столбце',
                'seo_keywords' => 'COUNT DISTINCT, уникальные значения, sql тренажер онлайн',
                'topic_id' => $aggregationTopicId,
                'description' => 'Посчитайте, сколько уникальных категорий представлено в таблице `products`.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT
);
INSERT INTO products VALUES
(1, 'Хлеб', 'Бакалея'),
(2, 'Молоко', 'Молочные'),
(3, 'Сыр', 'Молочные'),
(4, 'Яблоко', 'Фрукты');
",
                'expected_sql' => "SELECT COUNT(DISTINCT category) FROM products;",
                'hint' => 'Используйте COUNT(DISTINCT category)',
                'motivation' => 'Особое место занимает SQL — язык работы с базами данных. Практически любое приложение хранит данные: пользователей, заказы, статистику. Умение писать запросы, объединять таблицы и анализировать информацию — это базовый навык разработчика. SQL используется в веб-разработке, аналитике и даже в машинном обучении. Без понимания работы с данными сложно расти дальше в IT.',
            ],
            // ========== SUM ==========
            [
                'title' => 'Общая стоимость всех товаров',
                'slug' => 'sum-all-prices',
                'h1' => 'Суммарная цена товаров',
                'seo_title' => 'SQL: SUM для суммирования',
                'seo_description' => 'Посчитайте общую стоимость всех продуктов',
                'seo_keywords' => 'SUM, суммирование, курс основы sql',
                'topic_id' => $aggregationTopicId,
                'description' => 'Найдите сумму цен всех товаров в таблице `products`.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Хлеб', 30),
(2, 'Молоко', 60),
(3, 'Сыр', 150),
(4, 'Икра', 500);
",
                'expected_sql' => "SELECT SUM(price) FROM products;",
                'hint' => 'Примените функцию SUM(price)',
                'motivation' => 'Любой **sql курс** начинается с азов, но именно регулярная **практика sql** превращает теорию в навык. На **интерактивном тренажёре по sql** вы можете без страха ошибаться и пробовать разные варианты. **Обучение sql с нуля** требует терпения, но каждая решённая задача приближает вас к уровню профессионала. Помните: даже гуру когда-то начинали с простых суммирований.',
            ],
            [
                'title' => 'Выручка от товаров дороже 50',
                'slug' => 'sum-price-where-greater-50',
                'h1' => 'Суммарная стоимость товаров дороже 50',
                'seo_title' => 'SQL: SUM с фильтрацией WHERE',
                'seo_description' => 'Суммирование только отобранных строк',
                'seo_keywords' => 'SUM, WHERE, sql обучение онлайн',
                'topic_id' => $aggregationTopicId,
                'description' => 'Посчитайте суммарную стоимость товаров, цена которых больше 50.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Хлеб', 30),
(2, 'Молоко', 60),
(3, 'Сыр', 150),
(4, 'Икра', 500);
",
                'expected_sql' => "SELECT SUM(price) FROM products WHERE price > 50;",
                'hint' => 'Сначала отфильтруйте WHERE, затем примените SUM',
                'motivation' => '**Бесплатные курсы по sql** дают отличную базу, но настоящий рост начинается, когда вы решаете **задачи по sql** ежедневно. **SQL запросы mysql** становятся понятнее, если вы постоянно тренируетесь. Не бойтесь сложностей – каждая ошибка учит вас чему-то новому. Со временем вы заметите, как легко пишутся даже сложные выборки. Продолжайте в том же духе!',
            ],
            // ========== AVG ==========
            [
                'title' => 'Средняя цена товара',
                'slug' => 'avg-price',
                'h1' => 'Средняя стоимость товара',
                'seo_title' => 'SQL: AVG для среднего арифметического',
                'seo_description' => 'Вычислите среднюю цену всех товаров',
                'seo_keywords' => 'AVG, среднее, mysql запрос таблиц',
                'topic_id' => $aggregationTopicId,
                'description' => 'Найдите среднюю цену всех товаров.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Хлеб', 30),
(2, 'Молоко', 60),
(3, 'Сыр', 150),
(4, 'Икра', 500);
",
                'expected_sql' => "SELECT AVG(price) FROM products;",
                'hint' => 'Используйте AVG(price)',
                'motivation' => '**Тренажер sql запросов** – это ваш личный наставник. Он позволяет проверить себя и увидеть прогресс. **Обучение sql онлайн** даёт гибкость: вы можете заниматься в удобное время. Главное – не сдаваться после первой ошибки. Каждый правильно написанный запрос укрепляет вашу уверенность. Вы уже знаете больше, чем вчера – и это главное.',
            ],
            [
                'title' => 'Средняя цена молочных товаров',
                'slug' => 'avg-price-dairy',
                'h1' => 'Средняя цена в категории "Молочные"',
                'seo_title' => 'SQL: AVG с GROUP BY? Нет, просто WHERE',
                'seo_description' => 'Среднее арифметическое для отфильтрованной группы',
                'seo_keywords' => 'AVG, WHERE, sql тренажер онлайн бесплатно',
                'topic_id' => $aggregationTopicId,
                'description' => 'Вычислите среднюю цену товаров из категории `Молочные`.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные', 150),
(2, 'Молоко', 'Молочные', 60),
(3, 'Йогурт', 'Молочные', 80),
(4, 'Хлеб', 'Бакалея', 30);
",
                'expected_sql' => "SELECT AVG(price) FROM products WHERE category = 'Молочные';",
                'hint' => 'Не забывайте про кавычки для строк',
                'motivation' => '**Курс sql server** или **mysql запросы** – не важно, что вы учите. Важна системность. **Практика sql** на разных платформах помогает быстрее запоминать синтаксис. Используйте **sql тренажёр онлайн бесплатно** и решайте хотя бы 2-3 задачи в день. Так вы незаметно для себя перейдёте от новичка до уверенного пользователя. Дисциплина решает всё!',
            ],
            // ========== MIN / MAX ==========
            [
                'title' => 'Самый дешёвый товар',
                'slug' => 'min-price',
                'h1' => 'Найти минимальную цену',
                'seo_title' => 'SQL: MIN для поиска минимума',
                'seo_description' => 'Определите самую низкую цену',
                'seo_keywords' => 'MIN, минимум, sql запросы курсы',
                'topic_id' => $aggregationTopicId,
                'description' => 'Найдите минимальную цену среди всех товаров.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Хлеб', 30),
(2, 'Молоко', 60),
(3, 'Сыр', 150),
(4, 'Икра', 500);
",
                'expected_sql' => "SELECT MIN(price) FROM products;",
                'hint' => 'Используйте MIN(price)',
                'motivation' => '**Запросы базы данных mysql** – это не магия, а чёткая логика. Когда вы решаете **задачи по sql**, ваш мозг учится структурировать информацию. Это полезно не только в IT, но и в жизни. **SQL запросы обучение** развивает аналитическое мышление. Постепенно вы начнёте видеть не только таблицы, но и скрытые связи между данными. Это суперсила, которую стоит развивать.',
            ],
            [
                'title' => 'Самый дорогой товар в категории "Фрукты"',
                'slug' => 'max-price-fruits',
                'h1' => 'Максимальная цена среди фруктов',
                'seo_title' => 'SQL: MAX с условием',
                'seo_description' => 'Максимум в отфильтрованной группе',
                'seo_keywords' => 'MAX, WHERE, sql запросы mysql',
                'topic_id' => $aggregationTopicId,
                'description' => 'Найдите максимальную цену среди товаров категории `Фрукты`.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Яблоко', 'Фрукты', 70),
(2, 'Банан', 'Фрукты', 90),
(3, 'Апельсин', 'Фрукты', 120),
(4, 'Хлеб', 'Бакалея', 30);
",
                'expected_sql' => "SELECT MAX(price) FROM products WHERE category = 'Фрукты';",
                'hint' => 'Сначала отберите фрукты, потом максимум',
                'motivation' => '**Курс основы sql** закладывает фундамент, а **интерактивный тренажер по sql** помогает отточить навыки. Не гонитесь за скоростью – лучше поймите, как работают агрегатные функции. Когда вы поймёте суть, скорость придёт сама. И помните: даже опытные разработчики иногда заглядывают в документацию. Учиться – нормально.',
            ],
            // ========== GROUP BY ==========
            [
                'title' => 'Количество товаров в каждой категории',
                'slug' => 'count-by-category',
                'h1' => 'Группировка по категориям',
                'seo_title' => 'SQL: GROUP BY с COUNT',
                'seo_description' => 'Сколько товаров в каждой категории?',
                'seo_keywords' => 'GROUP BY, COUNT, sql обучение онлайн',
                'topic_id' => $aggregationTopicId,
                'description' => 'Для каждой категории выведите количество товаров.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные'),
(2, 'Молоко', 'Молочные'),
(3, 'Яблоко', 'Фрукты'),
(4, 'Хлеб', 'Бакалея');
",
                'expected_sql' => "SELECT category, COUNT(*) FROM products GROUP BY category;",
                'hint' => 'Используйте GROUP BY category',
                'motivation' => '**SQL тренажер** – это безопасная среда, где можно экспериментировать. Не бойтесь писать «неправильные» запросы – ошибки запоминаются лучше. **Обучение sql бесплатно** сегодня доступно каждому, главное – ваше желание. Каждая решённая задача делает вас на шаг ближе к работе мечты. Вы уже лучше, чем вчера – продолжайте!',
            ],
            [
                'title' => 'Суммарная цена товаров по категориям',
                'slug' => 'sum-by-category',
                'h1' => 'Общая стоимость товаров в каждой категории',
                'seo_title' => 'SQL: GROUP BY с SUM',
                'seo_description' => 'Сумма цен в разрезе категорий',
                'seo_keywords' => 'GROUP BY, SUM, mysql запрос таблиц',
                'topic_id' => $aggregationTopicId,
                'description' => 'Для каждой категории выведите сумму цен всех товаров этой категории.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные', 150),
(2, 'Молоко', 'Молочные', 60),
(3, 'Яблоко', 'Фрукты', 70),
(4, 'Хлеб', 'Бакалея', 30);
",
                'expected_sql' => "SELECT category, SUM(price) FROM products GROUP BY category;",
                'hint' => 'GROUP BY category, SUM(price)',
                'motivation' => '**Бесплатные курсы по sql** часто ограничиваются теорией, но настоящий рост даёт только **практика sql**. Регулярно решайте **задачи по sql** – хотя бы 15 минут в день. Вы удивитесь, как быстро начнёте замечать прогресс. Главное – не сравнивать себя с другими, а радоваться своим маленьким победам. Каждый правильный запрос – это победа.',
            ],
            [
                'title' => 'Средняя цена по категориям',
                'slug' => 'avg-by-category',
                'h1' => 'Средняя цена в каждой категории',
                'seo_title' => 'SQL: GROUP BY с AVG',
                'seo_description' => 'Среднее арифметическое по группам',
                'seo_keywords' => 'GROUP BY, AVG, курс основы sql',
                'topic_id' => $aggregationTopicId,
                'description' => 'Для каждой категории вычислите среднюю цену товара.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные', 150),
(2, 'Молоко', 'Молочные', 60),
(3, 'Йогурт', 'Молочные', 80),
(4, 'Хлеб', 'Бакалея', 30);
",
                'expected_sql' => "SELECT category, AVG(price) FROM products GROUP BY category;",
                'hint' => 'AVG(price) с GROUP BY',
                'motivation' => '**Курс sql databases** покажет вам теорию, но **тренажер sql запросов** даст бесценный опыт. Не стесняйтесь пользоваться подсказками – они для того и созданы. Со временем вы запомните синтаксис и перестанете в них нуждаться. Главное – не сдаваться после первых трудностей. Каждый эксперт когда-то был новичком. Ваше упорство приведёт к успеху.',
            ],
            [
                'title' => 'Минимальная и максимальная цена по категориям',
                'slug' => 'min-max-by-category',
                'h1' => 'Диапазон цен в каждой категории',
                'seo_title' => 'SQL: MIN и MAX с GROUP BY',
                'seo_description' => 'Найдите самый дешёвый и самый дорогой товар в каждой категории',
                'seo_keywords' => 'GROUP BY, MIN, MAX, sql тренажер ответы',
                'topic_id' => $aggregationTopicId,
                'description' => 'Для каждой категории выведите минимальную и максимальную цену.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные', 150),
(2, 'Молоко', 'Молочные', 60),
(3, 'Хлеб', 'Бакалея', 30),
(4, 'Печенье', 'Бакалея', 50);
",
                'expected_sql' => "SELECT category, MIN(price), MAX(price) FROM products GROUP BY category;",
                'hint' => 'Две агрегатные функции в одном SELECT',
                'motivation' => '**SQL обучение онлайн** удобно тем, что вы сами выбираете темп. Не старайтесь пройти всё за один день – мозгу нужно время, чтобы усвоить информацию. Делайте перерывы, возвращайтесь к сложным темам. **Интерактивный тренажёр по sql** запоминает ваш прогресс и помогает повторять. Выстроите привычку – и результат не заставит себя ждать.',
            ],
            [
                'title' => 'Количество заказов у каждого клиента',
                'slug' => 'count-orders-per-customer',
                'h1' => 'Сколько заказов сделал каждый клиент?',
                'seo_title' => 'SQL: GROUP BY на примере заказов',
                'seo_description' => 'Подсчёт количества заказов в разрезе клиентов',
                'seo_keywords' => 'GROUP BY, COUNT, задачи по sql',
                'topic_id' => $aggregationTopicId,
                'description' => 'Таблица `orders` содержит `customer_id`. Посчитайте количество заказов для каждого клиента.',
                'schema_sql' => "
CREATE TABLE orders (
    order_id INT,
    customer_id INT
);
INSERT INTO orders VALUES
(101, 1),
(102, 2),
(103, 1),
(104, 3),
(105, 1);
",
                'expected_sql' => "SELECT customer_id, COUNT(*) FROM orders GROUP BY customer_id;",
                'hint' => 'Группируйте по customer_id',
                'motivation' => '**MySQL запросы** – это основа большинства веб-проектов. Умение группировать и агрегировать данные сделает вас ценным сотрудником. **Сайт sql тренажёр** поможет отточить навыки в игровой форме. Не забывайте, что даже 5 минут практики в день лучше, чем час раз в неделю. Маленькие шаги приводят к большим результатам. Верьте в себя!',
            ],
            // ========== HAVING ==========
            [
                'title' => 'Категории с более чем 2 товарами',
                'slug' => 'having-count-greater-2',
                'h1' => 'Фильтрация групп: только популярные категории',
                'seo_title' => 'SQL: HAVING для фильтрации групп',
                'seo_description' => 'Оставьте только те категории, где количество товаров > 2',
                'seo_keywords' => 'HAVING, фильтрация групп, sql запросы обучение',
                'topic_id' => $aggregationTopicId,
                'description' => 'Найдите категории, в которых количество товаров больше 2.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные'),
(2, 'Молоко', 'Молочные'),
(3, 'Сметана', 'Молочные'),
(4, 'Йогурт', 'Молочные'),
(5, 'Хлеб', 'Бакалея'),
(6, 'Печенье', 'Бакалея');
",
                'expected_sql' => "SELECT category, COUNT(*) FROM products GROUP BY category HAVING COUNT(*) > 2;",
                'hint' => 'HAVING применяется после GROUP BY',
                'motivation' => '**Запросы базы данных mysql** могут показаться сложными, но разбивайте их на части. Сначала поймите, что делает `GROUP BY`, потом добавьте `HAVING`. **Обучение sql с нуля** требует терпения, но оно того стоит. Вы уже знаете больше, чем многие ваши сверстники. Продолжайте в том же духе – вы на правильном пути!',
            ],
            [
                'title' => 'Категории с суммарной стоимостью > 200',
                'slug' => 'having-sum-greater-200',
                'h1' => 'Категории с общей стоимостью выше 200',
                'seo_title' => 'SQL: HAVING с SUM',
                'seo_description' => 'Отфильтровать группы по сумме',
                'seo_keywords' => 'HAVING, SUM, курс sql databases',
                'topic_id' => $aggregationTopicId,
                'description' => 'Выведите категории, общая стоимость товаров в которых превышает 200.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные', 150),
(2, 'Молоко', 'Молочные', 60),
(3, 'Масло', 'Молочные', 100),
(4, 'Хлеб', 'Бакалея', 30),
(5, 'Печенье', 'Бакалея', 50);
",
                'expected_sql' => "SELECT category, SUM(price) FROM products GROUP BY category HAVING SUM(price) > 200;",
                'hint' => 'HAVING SUM(price) > 200',
                'motivation' => '**SQL тренажер онлайн бесплатно** – отличный инструмент для самопроверки. Но не забывайте и про реальные проекты – попробуйте написать запросы для своих данных (например, список книг, фильмов). **Практика sql** на личных данных мотивирует гораздо сильнее. Вы удивитесь, как быстро начнёте видеть практическую пользу от своих навыков.',
            ],
            [
                'title' => 'Средняя цена категории выше 100',
                'slug' => 'having-avg-greater-100',
                'h1' => 'Категории со средней ценой > 100',
                'seo_title' => 'SQL: HAVING с AVG',
                'seo_description' => 'Отбор групп по среднему арифметическому',
                'seo_keywords' => 'HAVING, AVG, sql тренажер онлайн',
                'topic_id' => $aggregationTopicId,
                'description' => 'Найдите категории, у которых средняя цена товара больше 100.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные', 150),
(2, 'Молоко', 'Молочные', 60),
(3, 'Икра', 'Деликатесы', 500),
(4, 'Хлеб', 'Бакалея', 30);
",
                'expected_sql' => "SELECT category, AVG(price) FROM products GROUP BY category HAVING AVG(price) > 100;",
                'hint' => 'HAVING AVG(price) > 100',
                'motivation' => '**Курс sql server** учит синтаксису, а **интерактивный тренажер по sql** учит думать. Когда вы понимаете, зачем нужна та или иная конструкция, запоминание происходит само собой. Не заучивайте – пытайтесь осмыслить. Представьте, какую бизнес-задачу решает ваш запрос. Такой подход превращает скучную теорию в увлекательное приключение.',
            ],
            [
                'title' => 'Клиенты с количеством заказов >= 2',
                'slug' => 'having-count-orders-gte-2',
                'h1' => 'Постоянные клиенты (2+ заказа)',
                'seo_title' => 'SQL: HAVING для частоты заказов',
                'seo_description' => 'Выберите клиентов, которые сделали не менее 2 заказов',
                'seo_keywords' => 'HAVING, COUNT, mysql запрос таблиц',
                'topic_id' => $aggregationTopicId,
                'description' => 'Из таблицы `orders` выведите `customer_id` тех клиентов, у которых количество заказов не менее 2.',
                'schema_sql' => "
CREATE TABLE orders (
    order_id INT,
    customer_id INT
);
INSERT INTO orders VALUES
(1, 101),
(2, 102),
(3, 101),
(4, 103),
(5, 101);
",
                'expected_sql' => "SELECT customer_id, COUNT(*) FROM orders GROUP BY customer_id HAVING COUNT(*) >= 2;",
                'hint' => 'HAVING COUNT(*) >= 2',
                'motivation' => '**Задачи по sql** на группировку и фильтрацию групп – самые частые на собеседованиях. Уделите им особое внимание. **Обучение sql онлайн** даёт вам возможность повторять сложные темы столько раз, сколько нужно. Не торопитесь, разбирайте каждую ошибку. Со временем вы начнёте писать запросы на автомате – и это будет ваш пропуск в мир больших данных.',
            ],
            // ========== WHERE vs HAVING ==========
            [
                'title' => 'WHERE против HAVING: фильтрация до группировки',
                'slug' => 'where-vs-having-before-group',
                'h1' => 'Отличие WHERE и HAVING на примере',
                'seo_title' => 'SQL: WHERE фильтрует строки, HAVING — группы',
                'seo_description' => 'Показать, как WHERE отсекает данные до группировки',
                'seo_keywords' => 'WHERE, HAVING, разница, обучение sql бесплатно',
                'topic_id' => $aggregationTopicId,
                'description' => 'Выведите категории, в которых количество товаров с ценой > 50 больше 1. Сначала отфильтруйте товары дороже 50, затем сгруппируйте и примените HAVING.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные', 150),
(2, 'Молоко', 'Молочные', 60),
(3, 'Хлеб', 'Бакалея', 30),
(4, 'Печенье', 'Бакалея', 80),
(5, 'Икра', 'Деликатесы', 500);
",
                'expected_sql' => "SELECT category, COUNT(*) FROM products WHERE price > 50 GROUP BY category HAVING COUNT(*) > 1;",
                'hint' => 'Сначала WHERE price > 50, потом GROUP BY, потом HAVING',
                'motivation' => '**SQL запросы курсы** часто объясняют разницу между `WHERE` и `HAVING` на пальцах, но лучше один раз написать самому. **Практика sql** – единственный способ закрепить материал. Не стесняйтесь пользоваться **sql тренажером** – он покажет ваши ошибки и даст обратную связь. Каждый исправленный запрос делает вас лучше. Вы справитесь!',
            ],
            [
                'title' => 'Ошибка новичка: HAVING без GROUP BY',
                'slug' => 'having-without-groupby',
                'h1' => 'Можно ли HAVING без GROUP BY?',
                'seo_title' => 'SQL: HAVING без GROUP BY работает как WHERE для агрегата',
                'seo_description' => 'Использование HAVING для фильтрации одного агрегатного значения',
                'seo_keywords' => 'HAVING, без GROUP BY, sql тренажер ответы',
                'topic_id' => $aggregationTopicId,
                'description' => 'Посчитайте общее количество товаров в таблице, но только если их больше 3. Используйте HAVING без GROUP BY.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT
);
INSERT INTO products VALUES
(1, 'Хлеб'),
(2, 'Молоко'),
(3, 'Сыр'),
(4, 'Икра');
",
                'expected_sql' => "SELECT COUNT(*) FROM products HAVING COUNT(*) > 3;",
                'hint' => 'HAVING можно применять к одной группе (всей таблице)',
                'motivation' => '**Бесплатные курсы по sql** – это старт, но не останавливайтесь на достигнутом. Ищите **задачи по sql** в интернете, участвуйте в челленджах. **Обучение sql с нуля** может показаться долгим, но каждый месяц вы будете замечать, как легко вам даются вещи, которые раньше ставили в тупик. Радуйтесь своему прогрессу и двигайтесь дальше.',
            ],
            // ========== Дополнительные задачи ==========
            [
                'title' => 'Общая выручка по каждому товару (сумма продаж)',
                'slug' => 'sum-sales-per-product',
                'h1' => 'Выручка от каждого товара',
                'seo_title' => 'SQL: SUM с группировкой по товару',
                'seo_description' => 'Посчитать сумму продаж для каждого товара',
                'seo_keywords' => 'SUM, GROUP BY, sql запросы mysql',
                'topic_id' => $aggregationTopicId,
                'description' => 'Таблица `sales` содержит `product_id` и `amount`. Посчитайте общую сумму продаж для каждого товара.',
                'schema_sql' => "
CREATE TABLE sales (
    sale_id INT,
    product_id INT,
    amount INT
);
INSERT INTO sales VALUES
(1, 101, 500),
(2, 102, 300),
(3, 101, 200),
(4, 103, 700);
",
                'expected_sql' => "SELECT product_id, SUM(amount) FROM sales GROUP BY product_id;",
                'hint' => 'Группируйте по product_id',
                'motivation' => '**Интерактивный тренажер по sql** хорош тем, что вы можете сразу увидеть результат. Используйте его для закрепления каждой новой темы. **Курс основы sql** даст структуру, а тренажёр – практику. Не забывайте делать заметки: выписывайте часто используемые конструкции. Это ускорит запоминание. Вы уже прошли большую часть – осталось совсем немного!',
            ],
            [
                'title' => 'Средний чек по каждому клиенту',
                'slug' => 'avg-order-per-customer',
                'h1' => 'Средняя сумма заказа на клиента',
                'seo_title' => 'SQL: AVG с группировкой по клиенту',
                'seo_description' => 'Вычислить среднюю сумму заказа для каждого покупателя',
                'seo_keywords' => 'AVG, GROUP BY, курс sql databases',
                'topic_id' => $aggregationTopicId,
                'description' => 'Таблица `orders` содержит `customer_id` и `order_total`. Найдите среднюю сумму заказа для каждого клиента.',
                'schema_sql' => "
CREATE TABLE orders (
    order_id INT,
    customer_id INT,
    order_total INT
);
INSERT INTO orders VALUES
(1, 1, 100),
(2, 2, 200),
(3, 1, 150),
(4, 1, 120),
(5, 3, 300);
",
                'expected_sql' => "SELECT customer_id, AVG(order_total) FROM orders GROUP BY customer_id;",
                'hint' => 'AVG(order_total) с GROUP BY',
                'motivation' => '**Тренажер sql запросов** – это ваш личный полигон. Здесь можно и нужно ошибаться, потому что ошибки – лучшие учителя. **Обучение sql онлайн** даёт вам свободу, но требует самодисциплины. Поставьте цель – решать хотя бы одну задачу в день. Через месяц вы не узнаете себя. Вы станете гораздо увереннее. Давайте, вы сможете!',
            ],
            [
                'title' => 'Количество проданных единиц по товарам (SUM)',
                'slug' => 'sum-quantity-per-product',
                'h1' => 'Общее количество проданных единиц',
                'seo_title' => 'SQL: SUM количества в разрезе товаров',
                'seo_description' => 'Подсчитать суммарные продажи в штуках',
                'seo_keywords' => 'SUM, GROUP BY, mysql запрос таблиц',
                'topic_id' => $aggregationTopicId,
                'description' => 'Таблица `order_items` содержит `product_id` и `quantity`. Посчитайте общее количество проданных единиц для каждого товара.',
                'schema_sql' => "
CREATE TABLE order_items (
    id INT,
    product_id INT,
    quantity INT
);
INSERT INTO order_items VALUES
(1, 101, 2),
(2, 102, 1),
(3, 101, 3),
(4, 103, 5);
",
                'expected_sql' => "SELECT product_id, SUM(quantity) FROM order_items GROUP BY product_id;",
                'hint' => 'SUM(quantity)',
                'motivation' => '**MySQL запросы** – это не только SELECT. Агрегация позволяет превращать сырые данные в информацию. **Практика sql** на таких задачах научит вас мыслить как аналитик. Не бойтесь сложных комбинаций – разбивайте их на подзадачи. И всегда помните: Google и документация – ваши друзья. Даже senior-разработчики ими пользуются. Учитесь учиться – это главный навык в IT.',
            ],
            [
                'title' => 'Товары, которые ни разу не продались (HAVING с SUM = 0)',
                'slug' => 'products-with-zero-sales',
                'h1' => 'Неходовые товары',
                'seo_title' => 'SQL: HAVING SUM(quantity) = 0',
                'seo_description' => 'Найти товары, у которых нет продаж',
                'seo_keywords' => 'HAVING, SUM, задачи по sql',
                'topic_id' => $aggregationTopicId,
                'description' => 'Таблица `products` (все товары) и `sales` (продажи). Найдите товары, которые ни разу не были проданы (их количество в продажах равно 0 или отсутствуют).',
                'schema_sql' => "
CREATE TABLE products (id INT, name TEXT);
INSERT INTO products VALUES (1, 'Хлеб'), (2, 'Молоко'), (3, 'Сыр');
CREATE TABLE sales (product_id INT, quantity INT);
INSERT INTO sales VALUES (1, 10), (1, 5), (3, 2);
",
                'expected_sql' => "SELECT products.id, products.name, COALESCE(SUM(sales.quantity), 0) as total FROM products LEFT JOIN sales ON products.id = sales.product_id GROUP BY products.id HAVING total = 0;",
                'hint' => 'Используйте LEFT JOIN и COALESCE, затем HAVING',
                'motivation' => '**SQL тренажер онлайн** часто даёт задачи на JOIN + HAVING – это один из самых сложных, но и самых полезных блоков. **Обучение sql бесплатно** позволяет проходить их в своём темпе. Не расстраивайтесь, если не получается с первого раза. Попробуйте разобрать решение, перепишите его руками. Со временем логика станет очевидной. Каждый такой запрос – как пазл, и вы уже умеете собирать сложные картинки.',
            ],
            [
                'title' => 'Самый дорогой товар в каждой категории (MAX с GROUP BY)',
                'slug' => 'max-price-per-category',
                'h1' => 'Лидер по цене в каждой категории',
                'seo_title' => 'SQL: MAX с GROUP BY',
                'seo_description' => 'Найти максимальную цену в каждой группе',
                'seo_keywords' => 'MAX, GROUP BY, sql тренажер онлайн',
                'topic_id' => $aggregationTopicId,
                'description' => 'Для каждой категории найдите максимальную цену товара.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные', 150),
(2, 'Молоко', 'Молочные', 60),
(3, 'Икра', 'Деликатесы', 500),
(4, 'Хлеб', 'Бакалея', 30);
",
                'expected_sql' => "SELECT category, MAX(price) FROM products GROUP BY category;",
                'hint' => 'MAX(price)',
                'motivation' => '**Курс sql server** или любой другой – это лишь инструмент. Главное – ваше намерение и регулярность. **Интерактивный тренажер по sql** помогает не терять мотивацию, потому что вы видите свой прогресс. Ставьте себе мини-рекорды: сегодня решил 3 задачи, завтра – 5. Похвалите себя за каждую выполненную задачу. Вы заслуживаете аплодисментов!',
            ],
            [
                'title' => 'Самый дешёвый товар в каждой категории (MIN с GROUP BY)',
                'slug' => 'min-price-per-category',
                'h1' => 'Бюджетный товар в категории',
                'seo_title' => 'SQL: MIN с GROUP BY',
                'seo_description' => 'Найти минимальную цену в каждой группе',
                'seo_keywords' => 'MIN, GROUP BY, mysql запросы',
                'topic_id' => $aggregationTopicId,
                'description' => 'Для каждой категории найдите минимальную цену товара.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные', 150),
(2, 'Молоко', 'Молочные', 60),
(3, 'Икра', 'Деликатесы', 500),
(4, 'Хлеб', 'Бакалея', 30);
",
                'expected_sql' => "SELECT category, MIN(price) FROM products GROUP BY category;",
                'hint' => 'MIN(price)',
                'motivation' => '**Запросы базы данных mysql** станут вашей суперсилой, если вы будете практиковаться каждый день. **Обучение sql с нуля** может показаться скучным, но когда вы начнёте применять знания на практике – например, проанализируете свои расходы с помощью SQL – вы почувствуете кайф. Не останавливайтесь, вы уже прошли половину пути!',
            ],
            [
                'title' => 'Количество заказов по месяцам (группировка по дате)',
                'slug' => 'count-orders-per-month',
                'h1' => 'Динамика заказов по месяцам',
                'seo_title' => 'SQL: GROUP BY по дате с EXTRACT',
                'seo_description' => 'Сгруппировать заказы по месяцу',
                'seo_keywords' => 'GROUP BY, дата, sql обучение онлайн',
                'topic_id' => $aggregationTopicId,
                'description' => 'Таблица `orders` имеет поле `order_date` (тип DATE). Посчитайте количество заказов за каждый месяц (независимо от года).',
                'schema_sql' => "
CREATE TABLE orders (
    id INT,
    order_date DATE
);
INSERT INTO orders VALUES
(1, '2024-01-15'),
(2, '2024-01-20'),
(3, '2024-02-10'),
(4, '2024-02-28'),
(5, '2024-03-05');
",
                'expected_sql' => "SELECT EXTRACT(MONTH FROM order_date) AS month, COUNT(*) FROM orders GROUP BY EXTRACT(MONTH FROM order_date);",
                'hint' => 'Используйте EXTRACT(MONTH FROM order_date)',
                'motivation' => '**Бесплатные курсы по sql** дают базу, но настоящий уровень нарабатывается на **тренажере sql запросов**. Особенно важна работа с датами – она встречается везде. Не ленитесь разбираться с функциями извлечения года, месяца, дня. Это окупится сторицей. Каждая новая функция расширяет ваш арсенал. Вы уже умеете то, что умеет не каждый джуниор. Гордитесь собой!',
            ],
            [
                'title' => 'Средняя продолжительность обработки заказа (AVG с датами)',
                'slug' => 'avg-processing-time',
                'h1' => 'Среднее время обработки заказа',
                'seo_title' => 'SQL: AVG разницы дат',
                'seo_description' => 'Вычислить среднее количество дней между созданием и отправкой',
                'seo_keywords' => 'AVG, даты, практика sql',
                'topic_id' => $aggregationTopicId,
                'description' => 'Таблица `orders` содержит `created_at` и `shipped_at`. Найдите среднюю разницу в днях между созданием и отправкой заказа.',
                'schema_sql' => "
CREATE TABLE orders (
    id INT,
    created_at DATE,
    shipped_at DATE
);
INSERT INTO orders VALUES
(1, '2024-01-01', '2024-01-03'),
(2, '2024-01-02', '2024-01-04'),
(3, '2024-01-05', '2024-01-05');
",
                'expected_sql' => "SELECT AVG(DATEDIFF(shipped_at, created_at)) FROM orders;",
                'hint' => 'Используйте DATEDIFF (в MySQL) или аналоги',
                'motivation' => '**SQL запросы обучение** – это марафон, а не спринт. Не ждите мгновенных результатов, но верьте в процесс. **Практика sql** на задачах с датами и средними значениями отлично тренирует внимание к деталям. Представьте, что вы оптимизируете бизнес-процессы – разве это не круто? Вы не просто учите SQL, вы учитесь думать как инженер. Продолжайте – вы на верном пути!',
            ],
            [
                'title' => 'Категории, где максимальная цена более чем в 2 раза выше минимальной',
                'slug' => 'having-price-spread',
                'h1' => 'Большой разброс цен в категории',
                'seo_title' => 'SQL: HAVING с арифметикой',
                'seo_description' => 'Отобрать категории, где MAX(price) > 2 * MIN(price)',
                'seo_keywords' => 'HAVING, MAX, MIN, sql тренажер ответы',
                'topic_id' => $aggregationTopicId,
                'description' => 'Найдите категории, в которых максимальная цена более чем в 2 раза превышает минимальную.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    category TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Молочные', 50),
(2, 'Молочные', 120),
(3, 'Электроника', 1000),
(4, 'Электроника', 5000),
(5, 'Книги', 200),
(6, 'Книги', 250);
",
                'expected_sql' => "SELECT category, MIN(price), MAX(price) FROM products GROUP BY category HAVING MAX(price) > 2 * MIN(price);",
                'hint' => 'HAVING MAX(price) > 2 * MIN(price)',
                'motivation' => '**Курс основы sql** и **интерактивный тренажёр по sql** – ваши лучшие друзья на пути к мастерству. Вы уже дошли до задач с арифметикой внутри `HAVING` – это серьёзный уровень. Похвалите себя! Но не останавливайтесь. Впереди ещё много интересного: оконные функции, подзапросы, индексы. Каждая новая тема делает вас сильнее. Идите дальше с гордо поднятой головой!',
            ],
            [
                'title' => 'Общая выручка с группировкой по году',
                'slug' => 'sum-revenue-per-year',
                'h1' => 'Выручка по годам',
                'seo_title' => 'SQL: SUM и GROUP BY по году',
                'seo_description' => 'Суммировать продажи за каждый год',
                'seo_keywords' => 'SUM, GROUP BY, год, курс основы sql',
                'topic_id' => $aggregationTopicId,
                'description' => 'Таблица `sales` имеет `sale_date` и `amount`. Посчитайте общую сумму продаж за каждый год.',
                'schema_sql' => "
CREATE TABLE sales (
    id INT,
    sale_date DATE,
    amount INT
);
INSERT INTO sales VALUES
(1, '2023-05-10', 1000),
(2, '2023-08-20', 1500),
(3, '2024-01-15', 2000),
(4, '2024-03-01', 2500);
",
                'expected_sql' => "SELECT YEAR(sale_date), SUM(amount) FROM sales GROUP BY YEAR(sale_date);",
                'hint' => 'Используйте YEAR(sale_date)',
                'motivation' => '**MySQL запросы** к реальным данным часто требуют группировки по годам или месяцам. **Обучение sql онлайн** позволяет отработать это на учебных примерах, но попробуйте потом применить на своих данных (например, список фильмов по годам). Чем больше вы практикуетесь, тем увереннее чувствуете себя. Вы уже почти прошли блок агрегации – осталась последняя задача. Давайте!',
            ],
            [
                'title' => 'Товары, которых на складе меньше 5 единиц (HAVING SUM(quantity) < 5)',
                'slug' => 'low-stock-products',
                'h1' => 'Товары с низким остатком',
                'seo_title' => 'SQL: HAVING с SUM для остатков',
                'seo_description' => 'Найти товары, общее количество которых на складе менее 5',
                'seo_keywords' => 'HAVING, SUM, mysql запрос таблиц',
                'topic_id' => $aggregationTopicId,
                'description' => 'Таблица `inventory` содержит `product_id` и `quantity` (по партиям). Найдите товары, суммарное количество которых на складе меньше 5.',
                'schema_sql' => "
CREATE TABLE inventory (
    id INT,
    product_id INT,
    quantity INT
);
INSERT INTO inventory VALUES
(1, 101, 3),
(2, 101, 1),
(3, 102, 10),
(4, 103, 2);
",
                'expected_sql' => "SELECT product_id, SUM(quantity) FROM inventory GROUP BY product_id HAVING SUM(quantity) < 5;",
                'hint' => 'HAVING SUM(quantity) < 5',
                'motivation' => 'Поздравляем! Вы завершили блок агрегации и группировки. **Задачи по sql** из этого модуля – фундамент для всего дальнейшего обучения. **SQL тренажер онлайн бесплатно** позволит вам возвращаться к ним для повторения. Помните: путь в тысячу миль начинается с первого шага, а вы уже прошли сотни. Продолжайте в том же духе, и скоро вы станете тем специалистом, на которого равняются другие. Отличная работа!',
            ],
            [
                'title' => 'Количество клиентов, сделавших более 3 заказов (HAVING)',
                'slug' => 'customers-with-many-orders',
                'h1' => 'VIP-клиенты',
                'seo_title' => 'SQL: HAVING для отбора лояльных клиентов',
                'seo_description' => 'Найти клиентов с количеством заказов больше 3',
                'seo_keywords' => 'HAVING, COUNT, sql запросы mysql',
                'topic_id' => $aggregationTopicId,
                'description' => 'Из таблицы `orders` (customer_id) найдите клиентов, которые сделали более 3 заказов.',
                'schema_sql' => "
CREATE TABLE orders (
    order_id INT,
    customer_id INT
);
INSERT INTO orders VALUES
(1, 1), (2, 1), (3, 1), (4, 1),
(5, 2), (6, 2),
(7, 3);
",
                'expected_sql' => "SELECT customer_id, COUNT(*) FROM orders GROUP BY customer_id HAVING COUNT(*) > 3;",
                'hint' => 'HAVING COUNT(*) > 3',
                'motivation' => 'Финальный аккорд! Вы успешно решили 30 задач по агрегации. Теперь вы умеете считать, суммировать, находить средние, минимумы и максимумы, группировать и фильтровать группы. **Практика sql** на этом уровне – отличная база для перехода к **sql запросам курсы** следующего уровня (JOIN, подзапросы, окна). Не останавливайтесь, идите дальше. Вы – молодец!',
            ],
        ];

        foreach ($aggregationTasks as $task) {
            DB::table('tasks')->insert([
                'title' => $task['title'],
                'slug' => $task['slug'],
                'h1' => $task['h1'],
                'seo_title' => $task['seo_title'],
                'seo_description' => $task['seo_description'],
                'seo_keywords' => $task['seo_keywords'],
                'topic_id' => $task['topic_id'],
                'description' => $task['description'],
                'schema_sql' => $task['schema_sql'],
                'expected_sql' => $task['expected_sql'],
                'hint' => $task['hint'],
                'motivation' => $task['motivation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
