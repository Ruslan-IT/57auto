<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Services\SchemaParserService;
use Illuminate\Console\Command;

class GenerateTablePreviews extends Command
{
    protected $signature = 'tasks:generate-previews';
    protected $description = 'Генерирует table_preview для всех задач на основе schema_sql';

    public function handle(SchemaParserService $parser)
    {
        $tasks = Task::whereNotNull('schema_sql')
            ->where('schema_sql', '!=', '')
            ->get();

        if ($tasks->isEmpty()) {
            $this->info('Нет задач с заполненным schema_sql.');
            return 0;
        }

        $bar = $this->output->createProgressBar($tasks->count());
        $bar->start();

        $updated = 0;

        foreach ($tasks as $task) {
            try {
                $parsed = $parser->parse($task->schema_sql);

                $preview = $this->buildPreview($parsed);

                if ($preview !== $task->table_preview) {
                    $task->table_preview = $preview;
                    $task->saveQuietly(); // сохраняем без событий
                    $updated++;
                }
            } catch (\Exception $e) {
                $this->error("\nОшибка в задаче ID {$task->id}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Обновлено задач: {$updated} из {$tasks->count()}");

        return 0;
    }

    private function buildPreview(array $parsed): string
    {
        $preview = '';

        // Таблицы и колонки
        foreach ($parsed['tables'] as $table) {
            $preview .= "📋 Таблица: {$table['name']}\n";
            foreach ($table['columns'] as $col) {
                $preview .= "   - {$col['name']} ({$col['type']})\n";
            }
            $preview .= "\n";
        }

        // Связи (если есть)
        if (!empty($parsed['relations'])) {
            $preview .= "🔗 Связи:\n";
            foreach ($parsed['relations'] as $rel) {
                $preview .= "   {$rel['from_table']}.{$rel['from_column']} → {$rel['to_table']}.{$rel['to_column']}\n";
            }
        }

        return trim($preview);
    }
}
