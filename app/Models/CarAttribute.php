<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarAttribute extends Model
{
    protected $fillable = [
        'car_id',
        'key',
        'value',
        'display_name',
        'sort_order'
    ];

    protected $casts = [
        'sort_order' => 'integer'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // Аксессор для красивого отображения
    public function getDisplayValueAttribute()
    {
        // Можно добавить форматирование для определенных ключей
        $formatters = [
            'пробег' => function($value) {
                return $value . ' км';
            },
            'мощность' => function($value) {
                return $value;
            },
        ];

        return $formatters[$this->key] ?? $this->value;
    }
}
