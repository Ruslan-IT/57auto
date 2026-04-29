<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateAggregationSeoSeeder extends Seeder
{
    public function run(): void
    {
        $topicId = DB::table('topics')->where('slug', 'aggregation')->value('id');
        if (!$topicId) {
            $this->command->error('Тема "aggregation" не найдена!');
            return;
        }

        // Список ключевых слов (каждое будет использовано для отдельной задачи)
        $allKeywords = [
            'mysql запросы', 'обучение sql', 'sql тренажер онлайн', 'задачи по sql',
            'курс sql server', 'практика sql', 'интерактивный тренажер по sql',
            'sql запросы mysql', 'mysql запрос таблиц', 'sql тренажер ответы',
            'sql тренажер онлайн бесплатно', 'обучение sql с нуля', 'обучение sql бесплатно',
            'бесплатные курсы по sql', 'sql обучение онлайн', 'запросы базы данных mysql',
            'курс sql databases', 'тренажер sql запросов', 'sql запросы курсы',
            'sql запросы обучение', 'курс основы sql', 'mysql запросы в базе',
            'курс sql аналитика', 'курсы sql с нуля', 'mysql запросы php',
            'онлайн курс sql', 'курсы по sql для начинающих', 'синтаксис mysql запросов',
            'практикум курсы sql', 'интерактивный тренажер по sql ответы'
        ];

        $tasks = DB::table('tasks')->where('topic_id', $topicId)->get();
        $keywordIndex = 0;
        $totalKeywords = count($allKeywords);

        foreach ($tasks as $task) {
            // Берём одно ключевое слово для текущей задачи (циклически)
            $currentKeyword = $allKeywords[$keywordIndex % $totalKeywords];
            $keywordIndex++;

            $baseTitle = $task->h1 ?? $task->title;

            // SEO-заголовок с этим ключевым словом
            $newSeoTitle = $currentKeyword;

            // SEO-описание с этим же ключевым словом
            $newSeoDescription = 'Практическая задача по SQL: ' . $task->description . ' Изучайте ' . $currentKeyword . ' на нашем тренажёре.';

            // В seo_keywords помещаем только это одно ключевое слово (или можно добавить пару)
            $newSeoKeywords = $currentKeyword;

            DB::table('tasks')
                ->where('id', $task->id)
                ->update([
                    'seo_title' => $newSeoTitle,
                    'seo_description' => $newSeoDescription,
                    'seo_keywords' => $newSeoKeywords,
                    'updated_at' => now(),
                ]);
        }

        $this->command->info('SEO-поля для задач темы "Агрегация" обновлены (каждая задача получила уникальное ключевое слово).');
    }
}
