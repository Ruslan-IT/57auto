<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParsingLog extends Model
{
    protected $fillable = [
        'url',
        'status',
        'message',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    // Скоупы для фильтрации
    public function scopeSuccess($query)
    {
        return $query->where('status', 'success');
    }

    public function scopeErrors($query)
    {
        return $query->where('status', 'error');
    }

    public function scopeWarnings($query)
    {
        return $query->where('status', 'warning');
    }
}
