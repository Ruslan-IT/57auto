<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Car extends Model
{
    protected $fillable = [
        'category_id', 'brand_id', 'model_id', 'lot', 'title', 'year', 'month',
        'mileage', 'body_type', 'engine_type', 'engine_power', 'engine_power_30min',
        'engine_volume', 'color', 'transmission', 'drive', 'price_china',
        'price_russia', 'is_min_util', 'is_passable', 'source_url', 'slug', 'source_site',
        'description'
    ];

    protected $casts = [
        'is_min_util' => 'boolean',
        'is_passable' => 'boolean',
        'month' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($car) {
            if (!$car->slug) {
                $car->slug = Str::slug($car->title) . '-' . uniqid();
            }
        });
    }

    public function category() { return $this->belongsTo(Category::class); }
    public function brand() { return $this->belongsTo(Brand::class); }
    public function model() { return $this->belongsTo(CarModel::class, 'model_id'); }
    public function images() { return $this->hasMany(CarImage::class)->orderBy('sort_order'); }
}
