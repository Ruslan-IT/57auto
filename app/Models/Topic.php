<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Topic extends Model
{
    protected $fillable = ['title', 'slug', 'order'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'topic_id');
    }
}
