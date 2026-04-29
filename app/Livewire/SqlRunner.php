<?php

namespace App\Livewire;

use App\Models\TaskAttempt;
use App\Services\SqlExecutionService;
use App\Services\SqlValidationService;
use App\Services\TaskAttemptService;
use App\Services\UserProgressService;
use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class SqlRunner extends Component
{
    public $task;
    public $sql = '';

    public $result = null;
    public $success = null;
    public $error = null;

    public $xpPopup = false;
    public $xpValue = 0;


    protected $sqlExecution;
    protected $validator;

    protected $attemptService;

    protected $progressService;




    public function boot(
        SqlExecutionService $sqlExecution,
        SqlValidationService $validator,
        TaskAttemptService $attemptService,
        UserProgressService $progressService
    )

    {
        $this->sqlExecution = $sqlExecution;
        $this->validator = $validator;
        $this->attemptService = $attemptService;
        $this->progressService = $progressService;
    }



    protected $listeners = [
        'hide-xp' => 'hideXpPopup',
    ];

    //  НОВОЕ (для UI)
    public $userRating;
    public $userLevel;
    public $lastScore = 0;

    public function mount(Task $task)
    {
        $this->task = $task;

        //  сразу показываем рейтинг
        $this->refreshUserStats();
    }

    public function run()
    {
        //очищаем старые результаты (UI state)
        $this->reset(['result', 'success', 'error', 'lastScore']);

        //проверка: пользователь вообще ввёл SQL?
        if (empty(trim($this->sql))) {
            $this->error = '❌ Введите SQL запрос';
            return;
        }

        $user = auth()->user(); // 👈 ВАЖНО ОДИН РАЗ



        try {

            //  1. создаём временную SQLite БД и загружаем схему задачи
            $db = $this->sqlExecution->createTempDb($this->task->schema_sql);

            // 2 получаем правильный (ожидаемый) результат задачи
            $expected = $this->sqlExecution->runQuery($db, $this->task->expected_sql);

            // 3 выполняем SQL пользователя
            $userResult = $this->sqlExecution->runQuery($db, $this->sql);



            // 4 сравниваем результаты (проверка правильности решения)
            $isCorrect = $this->validator->compare($expected, $userResult);

            // 5. получаем количество неправильных попыток пользователя
            $wrongAttempts = $this->attemptService->getWrongAttempts($this->task->id);


            // 6. проверяем — решал ли пользователь задачу ранее
            $alreadySolved = $this->attemptService->isAlreadySolved($this->task->id);

            //7. сохраняем попытку (ВСЕГДА сохраняем, независимо от результата)
            if ($user) {
                $this->attemptService->createAttempt(
                    $this->task->id,
                    $this->sql,
                    $isCorrect
                );
            }


            //  8. считаем очки (XP система)
            $score = 0;

            // - начисляем очки только если:
            // - ответ правильный
            // - и задача решена впервые

            if ($user && $isCorrect && !$alreadySolved) {

                //  считаем очки с учётом ошибок
                $score = $this->progressService->calculateScore($wrongAttempts, $isCorrect);

                //  добавляем рейтинг пользователю
                $this->progressService->addRating($score);

                //  показываем popup с XP
                $this->xpValue = $score;
                $this->xpPopup = true;
                $this->dispatch('xp-shown');


                //  сохраняем последний score для UI
                $this->lastScore = $score;
            }

            //  сообщение пользователю (UI feedback)
            if ($isCorrect) {
                $this->success = '✅ Верно!';

                $this->dispatch('task-solved', taskId: $this->task->id);

            } else {
                $this->error = '❌ Неверно';
            }

            //   вывод результата SQL запроса (таблица)
            $this->result = $userResult;

            //  обновляем рейтинг и уровень пользователя в UI
            $this->refreshUserStats();

        } catch (\Exception $e) {
            $this->error = '❌ SQL ошибка: ' . $e->getMessage();
        }
    }



    //  обновление UI
    private function refreshUserStats()
    {
        $user = auth()->user();

        if (!$user) {
            $this->userRating = 0;
            $this->userLevel = 'Guest';
            return;
        }

        $user = $user->fresh();

        $this->userRating = $user->rating;
        $this->userLevel = $user->getLevel();
    }

    public function hideXpPopup()
    {
        $this->xpPopup = false;
    }

    public function render()
    {
        return view('livewire.sql-runner');
    }
}
