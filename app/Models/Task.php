<?php

namespace App\Models;

use App\Services\SchemaParserService;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'schema_sql',
        'expected_sql',
        'hint',
        'table_preview',
        'level',
        'topic_id',
        'slug',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'h1',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }


    protected static function booted()
    {
        static::saving(function ($task) {

            if (!$task->schema_sql) {
                return;
            }

            $parser = app(SchemaParserService::class);

            $preview = $parser->parse($task->schema_sql);

            $task->table_preview = json_encode($preview, JSON_PRETTY_PRINT);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }





}
