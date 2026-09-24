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

    public function hasDisplayValue(): bool
    {
        $value = is_string($this->value) ? trim($this->value) : $this->value;

        if ($value === null || $value === '') {
            return false;
        }

        $empty = [
            '-',
            '—',
            '–',
            'null',
            'undefined',
            'none',
            'n/a',
            'не указано',
            'не указан',
            'не указана',
            'нет',
        ];

        return !in_array(mb_strtolower((string) $value), $empty, true);
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
