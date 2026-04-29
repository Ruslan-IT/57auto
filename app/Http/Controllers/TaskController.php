<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController
{

    public function show(Task $task)
    {

        $user = auth()->user();

        // 👤 гость
        if (!$user && $task->topic->slug !== 'basics') {
            return redirect('/register')
                ->with('error', 'Зарегистрируйтесь, чтобы открыть задачу');
        }

        // 🔐 пользователь, но НЕ оплатил
        if ($user && !$user->isPremiumActive() && $task->topic->slug !== 'basics') {
            return redirect('/pricing')->with('error', 'Оформите доступ к курсу');
        }

        /*config(['database.connections.temp' => [
             'driver' => 'sqlite',
             'database' => ':memory:',
         ]]);

         DB::purge('temp');

         $db = DB::connection('temp');

         // создаём структуру БД
         $db->unprepared($task->schema_sql);

         // получаем таблицы
         $tables = $db->select("
         SELECT name
         FROM sqlite_master
         WHERE type='table'
     ");*/




        $preview = [];

       /* $tableName = $tables[0]->name ?? null;

        if ($tableName) {
            $preview = $db->select("SELECT * FROM {$tableName}");
        }*/

        $tasks = Task::orderBy('id')->get();

        $solvedTaskIds = TaskAttempt::where('user_id', auth()->id())
            ->where('is_correct', true)
            ->pluck('task_id')
            ->toArray();




        $schema = json_decode($task->table_preview, true);

        //dd($schema);

        return view('tasks.show', compact(
            'task',
            'tasks',
            'solvedTaskIds',
            'preview',
            'schema'
        ));
    }


    public function index()
    {
        $tasks = Task::all();

        $solvedTaskIds = TaskAttempt::where('user_id', auth()->id())
            ->where('is_correct', true)
            ->pluck('task_id')
            ->toArray();

        return view('tasks.index', compact('tasks', 'solvedTaskIds'));
    }



}
