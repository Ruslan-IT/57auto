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

    public function setTitleAttribute(?string $value): void
    {
        $this->attributes['title'] = static::sanitizeTitle($value);
    }

    public static function sanitizeTitle(?string $title): ?string
    {
        if ($title === null) {
            return null;
        }

        $clean = trim($title);
        $clean = preg_replace('~\s*[,.]?\s*лот\s*№\s*[^\s,]+~iu', '', $clean) ?? $clean;
        $clean = preg_replace('/\s{2,}/u', ' ', $clean) ?? $clean;
        $clean = rtrim($clean, " \t,");

        return $clean === '' ? null : $clean;
    }

    public function carAttributes()
    {
        return $this->hasMany(CarAttribute::class, 'car_id');
    }

    public function currentPriceAmount(): ?float
    {
        if ($this->price_russia) {
            return (float) $this->price_russia;
        }

        if ($this->price_china) {
            return (float) $this->price_china;
        }

        return null;
    }

    public function currentPriceCurrency(): string
    {
        return $this->price_russia ? '₽' : '¥';
    }

    /**
     * Зачёркнутая цена только если это реальная предыдущая цена
     * и она выше актуальной. price_china — цена в юанях, не old_price.
     */
    public function oldPriceAmount(): ?float
    {
        $old = $this->getAttribute('old_price');

        if ($old === null || $old === '' || (float) $old <= 0) {
            return null;
        }

        $current = $this->price_russia ? (float) $this->price_russia : null;

        if ($current === null) {
            return null;
        }

        $old = (float) $old;

        if ($old <= $current) {
            return null;
        }

        return $old;
    }

    public function category() { return $this->belongsTo(Category::class); }
    public function brand() { return $this->belongsTo(Brand::class); }
    public function model() { return $this->belongsTo(CarModel::class, 'model_id'); }
    public function images() { return $this->hasMany(CarImage::class)->orderBy('sort_order'); }

    public function visibleImages()
    {
        return $this->images->filter(function ($image) {
            $path = trim((string) $image->path);

            if ($path === '') {
                return false;
            }

            return is_file(storage_path('app/public/' . $path));
        })->values();
    }
}
