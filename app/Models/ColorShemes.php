<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorShemes extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translates()
    {
        return $this->hasMany(ColorShemesTranslates::class, 'color_shemes_id');
    }
    public function images()
    {
        return $this->hasMany(ColorShemesImages::class, 'color_shemes_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $maxOrder = self::max('order');
            $model->order = $maxOrder !== null ? $maxOrder + 1 : 1;
        });
        static::deleting(function ($category) {
            // Delete related translates
            $category->translates()->delete();
            $category->images()->delete();
        });
    }







    public function getWithLocale($locale)
    {
        return $this->translates()->where('lang_key', $locale)->first();
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_color_scheme');
    }

    public function brands()
    {
        return $this->belongsToMany(Category::class, 'brand_color');
    }
}
