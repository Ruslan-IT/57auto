<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем ID темы "Основы" (basics)
        $basicTopicId = DB::table('topics')->where('slug', 'basics')->value('id');
        if (!$basicTopicId) {
            // Если темы нет, создадим её
            $basicTopicId = DB::table('topics')->insertGetId([
                'title' => 'Основы',
                'slug' => 'basics',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $tasks = [
            // === Тема 1. Выборка всех столбцов (SELECT *) ===
            [
                'title' => 'Показать все товары',
                'slug' => 'pokazat-vse-tovary',
                'h1' => 'Показать все товары',
                'seo_title' => 'Задача SQL: показать все товары из таблицы products',
                'seo_description' => 'Вывести все столбцы и строки из таблицы products',
                'seo_keywords' => 'SELECT *, выборка всех столбцов, основы SQL',
                'topic_id' => $basicTopicId,
                'description' => 'В таблице `products` хранятся товары. Выведите все данные из этой таблицы.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT,
    category TEXT
);

INSERT INTO products VALUES
(1, 'Хлеб', 30, 'Бакалея'),
(2, 'Молоко', 60, 'Молочные'),
(3, 'Сыр', 150, 'Молочные'),
(4, 'Яблоки', 80, 'Фрукты');
",
                'expected_sql' => "SELECT * FROM products;",
                'hint' => 'Для вывода всех столбцов используется символ `*` после `SELECT`.',
            ],
            [
                'title' => 'Вывести всех сотрудников',
                'slug' => 'vyvesti-vsekh-sotrudnikov',
                'h1' => 'Вывести всех сотрудников',
                'seo_title' => 'SQL задача: показать всех сотрудников из таблицы employees',
                'seo_description' => 'Выберите все записи из таблицы сотрудников',
                'seo_keywords' => 'SELECT *, сотрудники, выборка данных',
                'topic_id' => $basicTopicId,
                'description' => 'В таблице `employees` находится информация о сотрудниках. Отобразите все столбцы и строки.',
                'schema_sql' => "
CREATE TABLE employees (
    id INT,
    full_name TEXT,
    position TEXT,
    salary INT
);

INSERT INTO employees VALUES
(1, 'Иван Петров', 'Менеджер', 50000),
(2, 'Мария Смирнова', 'Разработчик', 70000),
(3, 'Алексей Иванов', 'Тестировщик', 45000);
",
                'expected_sql' => "SELECT * FROM employees;",
                'hint' => 'Команда `SELECT *` выбирает все столбцы. Не забудьте указать имя таблицы после `FROM`.',
            ],
            [
                'title' => 'Посмотреть всех студентов',
                'slug' => 'posmotret-vsekh-studentov',
                'h1' => 'Посмотреть всех студентов',
                'seo_title' => 'SQL: вывести всех студентов из таблицы students',
                'seo_description' => 'Напишите запрос, который покажет полную информацию о студентах',
                'seo_keywords' => 'SELECT *, студенты, база данных',
                'topic_id' => $basicTopicId,
                'description' => 'В таблице `students` хранятся данные о студентах. Выведите все записи.',
                'schema_sql' => "
CREATE TABLE students (
    id INT,
    name TEXT,
    age INT,
    course INT
);

INSERT INTO students VALUES
(1, 'Ольга', 19, 1),
(2, 'Дмитрий', 20, 2),
(3, 'Елена', 18, 1),
(4, 'Сергей', 21, 3);
",
                'expected_sql' => "SELECT * FROM students;",
                'hint' => 'Используйте `SELECT * FROM students;`',
            ],
            [
                'title' => 'Показать все книги',
                'slug' => 'pokazat-vse-knigi',
                'h1' => 'Показать все книги',
                'seo_title' => 'Задача SQL: вывести все книги из таблицы books',
                'seo_description' => 'Получите полный список книг со всеми полями',
                'seo_keywords' => 'SELECT *, книги, выборка данных',
                'topic_id' => $basicTopicId,
                'description' => 'В библиотеке есть таблица `books`. Напишите запрос, чтобы увидеть все книги.',
                'schema_sql' => "
CREATE TABLE books (
    id INT,
    title TEXT,
    author TEXT,
    year INT
);

INSERT INTO books VALUES
(1, 'Мастер и Маргарита', 'Булгаков', 1967),
(2, 'Преступление и наказание', 'Достоевский', 1866),
(3, 'Война и мир', 'Толстой', 1869);
",
                'expected_sql' => "SELECT * FROM books;",
                'hint' => '`SELECT *` – самый простой способ посмотреть всё содержимое таблицы.',
            ],
            [
                'title' => 'Вывести все автомобили',
                'slug' => 'vyvesti-vse-avtomobili',
                'h1' => 'Вывести все автомобили',
                'seo_title' => 'SQL: показать все автомобили из таблицы cars',
                'seo_description' => 'Отобразите все строки и столбцы таблицы cars',
                'seo_keywords' => 'SELECT *, автомобили, таблица',
                'topic_id' => $basicTopicId,
                'description' => 'В автосалоне есть таблица `cars`. Выведите все данные о машинах.',
                'schema_sql' => "
CREATE TABLE cars (
    id INT,
    brand TEXT,
    model TEXT,
    price INT
);

INSERT INTO cars VALUES
(1, 'Toyota', 'Camry', 2500000),
(2, 'Honda', 'Civic', 1800000),
(3, 'Hyundai', 'Solaris', 1200000);
",
                'expected_sql' => "SELECT * FROM cars;",
                'hint' => 'Звёздочка `*` заменяет перечисление всех имён столбцов.',
            ],

            // === Тема 2. Выборка конкретных столбцов ===
            [
                'title' => 'Показать только названия и цены товаров',
                'slug' => 'pokazat-nazvaniya-i-tseny-tovarov',
                'h1' => 'Показать только названия и цены товаров',
                'seo_title' => 'Выбрать конкретные столбцы name и price из products',
                'seo_description' => 'Напишите запрос, который выводит только название и цену товара',
                'seo_keywords' => 'SELECT, конкретные столбцы, name, price',
                'topic_id' => $basicTopicId,
                'description' => 'Из таблицы `products` выведите только два столбца: `name` (название) и `price` (цена).',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT,
    category TEXT
);

INSERT INTO products VALUES
(1, 'Хлеб', 30, 'Бакалея'),
(2, 'Молоко', 60, 'Молочные'),
(3, 'Сыр', 150, 'Молочные'),
(4, 'Яблоки', 80, 'Фрукты');
",
                'expected_sql' => "SELECT name, price FROM products;",
                'hint' => 'Перечислите нужные столбцы через запятую после `SELECT`.',
            ],
            [
                'title' => 'Вывести имена и должности сотрудников',
                'slug' => 'vyvesti-imena-i-dolzhnosti-sotrudnikov',
                'h1' => 'Вывести имена и должности сотрудников',
                'seo_title' => 'SQL запрос: выборка full_name и position из employees',
                'seo_description' => 'Получите список имён сотрудников и их должностей',
                'seo_keywords' => 'SELECT, конкретные столбцы, сотрудники',
                'topic_id' => $basicTopicId,
                'description' => 'Из таблицы `employees` получите только столбцы `full_name` (имя) и `position` (должность).',
                'schema_sql' => "
CREATE TABLE employees (
    id INT,
    full_name TEXT,
    position TEXT,
    salary INT
);

INSERT INTO employees VALUES
(1, 'Иван Петров', 'Менеджер', 50000),
(2, 'Мария Смирнова', 'Разработчик', 70000),
(3, 'Алексей Иванов', 'Тестировщик', 45000);
",
                'expected_sql' => "SELECT full_name, position FROM employees;",
                'hint' => 'Укажите имена столбцов через запятую.',
            ],
            [
                'title' => 'Показать имена и возраст студентов',
                'slug' => 'pokazat-imena-i-vozrast-studentov',
                'h1' => 'Показать имена и возраст студентов',
                'seo_title' => 'SQL: выбрать name и age из таблицы students',
                'seo_description' => 'Выведите только имена студентов и их возраст',
                'seo_keywords' => 'SELECT, столбцы, студенты, name, age',
                'topic_id' => $basicTopicId,
                'description' => 'Из таблицы `students` выведите столбцы `name` (имя) и `age` (возраст).',
                'schema_sql' => "
CREATE TABLE students (
    id INT,
    name TEXT,
    age INT,
    course INT
);

INSERT INTO students VALUES
(1, 'Ольга', 19, 1),
(2, 'Дмитрий', 20, 2),
(3, 'Елена', 18, 1),
(4, 'Сергей', 21, 3);
",
                'expected_sql' => "SELECT name, age FROM students;",
                'hint' => 'Перечисляйте только нужные поля.',
            ],
            [
                'title' => 'Вывести названия книг и авторов',
                'slug' => 'vyvesti-nazvaniya-knig-i-avtorov',
                'h1' => 'Вывести названия книг и авторов',
                'seo_title' => 'Запрос SQL: выборка title и author из books',
                'seo_description' => 'Получите список названий книг и их авторов',
                'seo_keywords' => 'SELECT, книги, авторы, title, author',
                'topic_id' => $basicTopicId,
                'description' => 'Из таблицы `books` выведите столбцы `title` (название) и `author` (автор).',
                'schema_sql' => "
CREATE TABLE books (
    id INT,
    title TEXT,
    author TEXT,
    year INT
);

INSERT INTO books VALUES
(1, 'Мастер и Маргарита', 'Булгаков', 1967),
(2, 'Преступление и наказание', 'Достоевский', 1866),
(3, 'Война и мир', 'Толстой', 1869);
",
                'expected_sql' => "SELECT title, author FROM books;",
                'hint' => 'После `SELECT` пишутся имена столбцов, которые нужно показать.',
            ],
            [
                'title' => 'Показать бренд и модель автомобилей',
                'slug' => 'pokazat-brend-i-model-avtomobilei',
                'h1' => 'Показать бренд и модель автомобилей',
                'seo_title' => 'SQL: выбрать brand и model из таблицы cars',
                'seo_description' => 'Выведите марку и модель всех машин',
                'seo_keywords' => 'SELECT, автомобили, brand, model',
                'topic_id' => $basicTopicId,
                'description' => 'Из таблицы `cars` выведите столбцы `brand` (бренд) и `model` (модель).',
                'schema_sql' => "
CREATE TABLE cars (
    id INT,
    brand TEXT,
    model TEXT,
    price INT
);

INSERT INTO cars VALUES
(1, 'Toyota', 'Camry', 2500000),
(2, 'Honda', 'Civic', 1800000),
(3, 'Hyundai', 'Solaris', 1200000);
",
                'expected_sql' => "SELECT brand, model FROM cars;",
                'hint' => 'Укажите два столбца через запятую.',
            ],

            // === Тема 3. Псевдонимы столбцов (AS) ===
            [
                'title' => 'Переименовать столбец `name` в `product_name`',
                'slug' => 'pereimenovat-name-v-product-name',
                'h1' => 'Переименовать столбец name в product_name',
                'seo_title' => 'SQL: использование AS для переименования столбца',
                'seo_description' => 'Выведите названия товаров, переименовав столбец name в product_name',
                'seo_keywords' => 'AS, псевдоним, переименование столбца',
                'topic_id' => $basicTopicId,
                'description' => 'Из таблицы `products` выведите столбец `name`, но в результате он должен называться `product_name`.',
                'schema_sql' => "
CREATE TABLE products (
    id INT,
    name TEXT,
    price INT,
    category TEXT
);

INSERT INTO products VALUES
(1, 'Хлеб', 30, 'Бакалея'),
(2, 'Молоко', 60, 'Молочные'),
(3, 'Сыр', 150, 'Молочные'),
(4, 'Яблоки', 80, 'Фрукты');
",
                'expected_sql' => "SELECT name AS product_name FROM products;",
                'hint' => 'После имени столбца напишите `AS` и новое имя.',
            ],
            [
                'title' => 'Переименовать `full_name` в `employee`',
                'slug' => 'pereimenovat-full-name-v-employee',
                'h1' => 'Переименовать full_name в employee',
                'seo_title' => 'SQL псевдоним: full_name AS employee',
                'seo_description' => 'Выведите имена сотрудников с заголовком столбца «employee»',
                'seo_keywords' => 'AS, псевдоним, сотрудники',
                'topic_id' => $basicTopicId,
                'description' => 'Из таблицы `employees` выведите столбец `full_name` под именем `employee`.',
                'schema_sql' => "
CREATE TABLE employees (
    id INT,
    full_name TEXT,
    position TEXT,
    salary INT
);

INSERT INTO employees VALUES
(1, 'Иван Петров', 'Менеджер', 50000),
(2, 'Мария Смирнова', 'Разработчик', 70000),
(3, 'Алексей Иванов', 'Тестировщик', 45000);
",
                'expected_sql' => "SELECT full_name AS employee FROM employees;",
                'hint' => '`AS` можно не писать, но для ясности лучше использовать.',
            ],
            [
                'title' => 'Название студента как `student_name`',
                'slug' => 'nazvanie-studenta-kak-student-name',
                'h1' => 'Название студента как student_name',
                'seo_title' => 'Псевдоним столбца name в таблице students',
                'seo_description' => 'Выведите имена студентов, переименовав столбец name в student_name',
                'seo_keywords' => 'AS, псевдоним, студенты',
                'topic_id' => $basicTopicId,
                'description' => 'Из таблицы `students` выведите столбец `name` с псевдонимом `student_name`.',
                'schema_sql' => "
CREATE TABLE students (
    id INT,
    name TEXT,
    age INT,
    course INT
);

INSERT INTO students VALUES
(1, 'Ольга', 19, 1),
(2, 'Дмитрий', 20, 2),
(3, 'Елена', 18, 1),
(4, 'Сергей', 21, 3);
",
                'expected_sql' => "SELECT name AS student_name FROM students;",
                'hint' => 'Псевдоним задаётся через `AS`.',
            ],
            [
                'title' => 'Переименовать `title` в `book_title`',
                'slug' => 'pereimenovat-title-v-book-title',
                'h1' => 'Переименовать title в book_title',
                'seo_title' => 'SQL AS: выборка названий книг с псевдонимом',
                'seo_description' => 'Выведите столбец title как book_title из таблицы books',
                'seo_keywords' => 'AS, псевдоним, книги',
                'topic_id' => $basicTopicId,
                'description' => 'Из таблицы `books` выведите столбец `title`, назвав его `book_title`.',
                'schema_sql' => "
CREATE TABLE books (
    id INT,
    title TEXT,
    author TEXT,
    year INT
);

INSERT INTO books VALUES
(1, 'Мастер и Маргарита', 'Булгаков', 1967),
(2, 'Преступление и наказание', 'Достоевский', 1866),
(3, 'Война и мир', 'Толстой', 1869);
",
                'expected_sql' => "SELECT title AS book_title FROM books;",
                'hint' => '`AS` помогает сделать вывод более читаемым.',
            ],
            [
                'title' => 'Переименовать `brand` в `car_brand`',
                'slug' => 'pereimenovat-brand-v-car-brand',
                'h1' => 'Переименовать brand в car_brand',
                'seo_title' => 'Использование AS для столбца brand в таблице cars',
                'seo_description' => 'Выведите бренд автомобиля с псевдонимом car_brand',
                'seo_keywords' => 'AS, псевдоним, автомобили, brand',
                'topic_id' => $basicTopicId,
                'description' => 'Из таблицы `cars` выведите столбец `brand` под именем `car_brand`.',
                'schema_sql' => "
CREATE TABLE cars (
    id INT,
    brand TEXT,
    model TEXT,
    price INT
);

INSERT INTO cars VALUES
(1, 'Toyota', 'Camry', 2500000),
(2, 'Honda', 'Civic', 1800000),
(3, 'Hyundai', 'Solaris', 1200000);
",
                'expected_sql' => "SELECT brand AS car_brand FROM cars;",
                'hint' => 'Новое имя указывается сразу после `AS`.',
            ],
        ];

        foreach ($tasks as $task) {
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
