<?php

namespace App\Console\Commands;


use App\Models\Task;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'app:generate-sitemap';

    protected $signature = 'sitemap:generate';

    protected $description = 'Generate sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/tasks'));

        foreach (Task::cursor() as $task) {
            $sitemap->add(
                Url::create("/tasks/{$task->slug}")
                    ->setLastModificationDate($task->updated_at ?? now())
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated!');
    }
}
