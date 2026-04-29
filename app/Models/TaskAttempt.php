<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'task_id',
        'user_sql',
        'is_correct',
        'attempt_number',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
