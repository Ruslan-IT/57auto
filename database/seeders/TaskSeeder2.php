<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskSeeder2 extends Seeder
{
    public function run(): void
    {

        // Получаем или создаём тему "Фильтрация"
        $filteringTopicId = DB::table('topics')->where('slug', 'filtering')->value('id');
        if (!$filteringTopicId) {
            $filteringTopicId = DB::table('topics')->insertGetId([
                'title' => 'Фильтрация и сортировка',
                'slug' => 'filtering',
                'order' => 2, // порядок отображения
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $filteringTasks = [
            // === WHERE с числами ===
            [
                'title' => 'Товары дороже 100',
                'slug' => 'tovary-dorozhe-100',
                'h1' => 'Товары дороже 100',
                'seo_title' => 'SQL: найти товары с ценой больше 100',
                'seo_description' => 'Используйте WHERE price > 100',
                'seo_keywords' => 'WHERE, фильтрация, числа',
                'topic_id' => $filteringTopicId,
                'description' => 'Выведите все товары из таблицы `products`, у которых цена (`price`) больше 100.',
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
                'expected_sql' => "SELECT * FROM products WHERE price > 100;",
                'hint' => 'Используйте `WHERE price > 100`',
            ],
            // === WHERE с текстом ===
            [
                'title' => 'Найти пользователя по имени',
                'slug' => 'nayti-polzovatelya-po-imeni',
                'h1' => 'Найти пользователя по имени',
                'seo_title' => 'SQL: выборка по строковому полю',
                'seo_description' => 'WHERE name = "Иван"',
                'seo_keywords' => 'WHERE, строка, равенство',
                'topic_id' => $filteringTopicId,
                'description' => 'Из таблицы `users` выберите пользователя с именем `Иван`.',
                'schema_sql' => "
CREATE TABLE users (
    id INT,
    name TEXT
);
INSERT INTO users VALUES
(1, 'Иван'),
(2, 'Петр'),
(3, 'Сидор');
",
                'expected_sql' => "SELECT * FROM users WHERE name = 'Иван';",
                'hint' => 'Строковые значения заключаются в одинарные кавычки.',
            ],
            // === AND ===
            [
                'title' => 'Дорогие товары из категории "Молочные"',
                'slug' => 'dorogie-molochnye-tovary',
                'h1' => 'Дорогие товары из категории "Молочные"',
                'seo_title' => 'SQL: AND с двумя условиями',
                'seo_description' => 'Используйте AND для фильтрации по категории и цене',
                'seo_keywords' => 'AND, два условия',
                'topic_id' => $filteringTopicId,
                'description' => 'Выведите товары из категории `Молочные` с ценой больше 100.',
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
(4, 'Икра', 'Деликатесы', 500);
",
                'expected_sql' => "SELECT * FROM products WHERE category = 'Молочные' AND price > 100;",
                'hint' => 'Оба условия должны быть истинными. Используйте `AND`.',
            ],
            // === OR ===
            [
                'title' => 'Товары с ценой меньше 50 или больше 500',
                'slug' => 'tovary-menshe-50-ili-bolshe-500',
                'h1' => 'Товары с ценой меньше 50 или больше 500',
                'seo_title' => 'SQL: OR для альтернативных условий',
                'seo_description' => 'Выберите товары, цена которых либо очень низкая, либо очень высокая',
                'seo_keywords' => 'OR, альтернатива',
                'topic_id' => $filteringTopicId,
                'description' => 'Выведите товары, у которых цена меньше 50 ИЛИ больше 500.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Хлеб', 30),
(2, 'Масло', 120),
(3, 'Телевизор', 600),
(4, 'Часы', 400);
",
                'expected_sql' => "SELECT * FROM products WHERE price < 50 OR price > 500;",
                'hint' => 'Используйте `OR` для объединения условий.',
            ],
            // === NOT ===
            [
                'title' => 'Все товары, кроме хлеба',
                'slug' => 'vse-tovary-krome-hleba',
                'h1' => 'Все товары, кроме хлеба',
                'seo_title' => 'SQL: NOT для отрицания условия',
                'seo_description' => 'Исключите товар "Хлеб"',
                'seo_keywords' => 'NOT, отрицание',
                'topic_id' => $filteringTopicId,
                'description' => 'Выберите все товары, кроме `Хлеб`.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT
);
INSERT INTO products VALUES
(1, 'Хлеб'),
(2, 'Молоко'),
(3, 'Сыр');
",
                'expected_sql' => "SELECT * FROM products WHERE NOT name = 'Хлеб';",
                'hint' => 'Можно также использовать `<>` или `!=`.',
            ],
            // === BETWEEN ===
            [
                'title' => 'Товары в ценовом диапазоне от 50 до 150',
                'slug' => 'tovary-v-diapazone-50-150',
                'h1' => 'Товары в ценовом диапазоне от 50 до 150',
                'seo_title' => 'SQL: BETWEEN для диапазонов',
                'seo_description' => 'Выберите товары, цена которых от 50 до 150 включительно',
                'seo_keywords' => 'BETWEEN, диапазон',
                'topic_id' => $filteringTopicId,
                'description' => 'Выведите товары с ценой от 50 до 150 (включительно).',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Молоко', 50),
(2, 'Сыр', 120),
(3, 'Колбаса', 200),
(4, 'Хлеб', 30);
",
                'expected_sql' => "SELECT * FROM products WHERE price BETWEEN 50 AND 150;",
                'hint' => '`BETWEEN ... AND ...` включает границы.',
            ],
            // === IN ===
            [
                'title' => 'Товары из списка категорий',
                'slug' => 'tovary-iz-spiska-kategorii',
                'h1' => 'Товары из списка категорий',
                'seo_title' => 'SQL: IN для множественного выбора',
                'seo_description' => 'Выберите товары, относящиеся к категориям "Молочные" или "Фрукты"',
                'seo_keywords' => 'IN, множество',
                'topic_id' => $filteringTopicId,
                'description' => 'Выведите товары, у которых категория входит в список: `Молочные`, `Фрукты`.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные'),
(2, 'Яблоко', 'Фрукты'),
(3, 'Хлеб', 'Бакалея'),
(4, 'Молоко', 'Молочные');
",
                'expected_sql' => "SELECT * FROM products WHERE category IN ('Молочные', 'Фрукты');",
                'hint' => '`IN` проверяет, входит ли значение в список.',
            ],
            // === LIKE (простая маска) ===
            [
                'title' => 'Товары, начинающиеся на "С"',
                'slug' => 'tovary-na-bukvu-s',
                'h1' => 'Товары, начинающиеся на "С"',
                'seo_title' => 'SQL: LIKE с шаблоном %',
                'seo_description' => 'Выберите товары, название которых начинается на букву С',
                'seo_keywords' => 'LIKE, поиск по шаблону',
                'topic_id' => $filteringTopicId,
                'description' => 'Найдите товары, название которых начинается на букву `С`.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT
);
INSERT INTO products VALUES
(1, 'Сыр'),
(2, 'Сметана'),
(3, 'Молоко'),
(4, 'Сок');
",
                'expected_sql' => "SELECT * FROM products WHERE name LIKE 'С%';",
                'hint' => '`%` заменяет любое количество символов.',
            ],
            // === IS NULL ===
            [
                'title' => 'Пользователи без указанного возраста',
                'slug' => 'polzovateli-bez-vozrasta',
                'h1' => 'Пользователи без указанного возраста',
                'seo_title' => 'SQL: IS NULL для пустых значений',
                'seo_description' => 'Найти записи, где возраст не заполнен',
                'seo_keywords' => 'IS NULL, пустые значения',
                'topic_id' => $filteringTopicId,
                'description' => 'Выведите пользователей, у которых поле `age` равно NULL.',
                'schema_sql' => "
CREATE TABLE users (
    id INT,
    name TEXT,
    age INT
);
INSERT INTO users VALUES
(1, 'Иван', 25),
(2, 'Петр', NULL),
(3, 'Сидор', 30),
(4, 'Федор', NULL);
",
                'expected_sql' => "SELECT * FROM users WHERE age IS NULL;",
                'hint' => 'Для проверки на NULL используется `IS NULL`, а не `= NULL`.',
            ],
            // === IS NOT NULL ===
            [
                'title' => 'Пользователи с указанным возрастом',
                'slug' => 'polzovateli-s-vozrastom',
                'h1' => 'Пользователи с указанным возрастом',
                'seo_title' => 'SQL: IS NOT NULL для непустых значений',
                'seo_description' => 'Найти записи, где возраст заполнен',
                'seo_keywords' => 'IS NOT NULL, непустые значения',
                'topic_id' => $filteringTopicId,
                'description' => 'Выведите пользователей, у которых поле `age` не равно NULL.',
                'schema_sql' => "
CREATE TABLE users (
    id INT,
    name TEXT,
    age INT
);
INSERT INTO users VALUES
(1, 'Иван', 25),
(2, 'Петр', NULL),
(3, 'Сидор', 30),
(4, 'Федор', NULL);
",
                'expected_sql' => "SELECT * FROM users WHERE age IS NOT NULL;",
                'hint' => 'Используйте `IS NOT NULL`.',
            ],
            // === ORDER BY (ASC) ===
            [
                'title' => 'Товары в порядке возрастания цены',
                'slug' => 'tovary-po-vozrastaniyu-tseny',
                'h1' => 'Товары в порядке возрастания цены',
                'seo_title' => 'SQL: ORDER BY ASC',
                'seo_description' => 'Отсортируйте товары от дешёвых к дорогим',
                'seo_keywords' => 'ORDER BY, сортировка, ASC',
                'topic_id' => $filteringTopicId,
                'description' => 'Выведите все товары, отсортированные по цене по возрастанию.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Хлеб', 30),
(2, 'Сыр', 150),
(3, 'Молоко', 60),
(4, 'Икра', 500);
",
                'expected_sql' => "SELECT * FROM products ORDER BY price ASC;",
                'hint' => '`ASC` можно не писать, так как это значение по умолчанию.',
            ],
            // === ORDER BY (DESC) ===
            [
                'title' => 'Товары в порядке убывания цены',
                'slug' => 'tovary-po-ubyvaniyu-tseny',
                'h1' => 'Товары в порядке убывания цены',
                'seo_title' => 'SQL: ORDER BY DESC',
                'seo_description' => 'Отсортируйте товары от дорогих к дешёвым',
                'seo_keywords' => 'ORDER BY, сортировка, DESC',
                'topic_id' => $filteringTopicId,
                'description' => 'Выведите все товары, отсортированные по цене по убыванию.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Хлеб', 30),
(2, 'Сыр', 150),
(3, 'Молоко', 60),
(4, 'Икра', 500);
",
                'expected_sql' => "SELECT * FROM products ORDER BY price DESC;",
                'hint' => 'Укажите `DESC` после имени столбца.',
            ],
            // === ORDER BY по нескольким колонкам ===
            [
                'title' => 'Сортировка по категории и цене',
                'slug' => 'sortirovka-po-kategorii-i-tsene',
                'h1' => 'Сортировка по категории и цене',
                'seo_title' => 'SQL: сортировка по двум полям',
                'seo_description' => 'Сначала по категории (A-Z), затем по цене (возрастание)',
                'seo_keywords' => 'ORDER BY, несколько полей',
                'topic_id' => $filteringTopicId,
                'description' => 'Выведите товары, отсортированные сначала по категории (по алфавиту), а затем по цене (по возрастанию).',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    category TEXT,
    price INT
);
INSERT INTO products VALUES
(1, 'Сыр', 'Молочные', 150),
(2, 'Хлеб', 'Бакалея', 30),
(3, 'Молоко', 'Молочные', 60),
(4, 'Печенье', 'Бакалея', 50);
",
                'expected_sql' => "SELECT * FROM products ORDER BY category ASC, price ASC;",
                'hint' => 'Укажите оба поля через запятую.',
            ],
        ];


        foreach ($filteringTasks as $task) {
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
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


    }













}
