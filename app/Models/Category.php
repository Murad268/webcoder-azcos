<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translates()
    {
        return $this->hasMany(CategoryTranslates::class, 'category_id');
    }
    public function images()
    {
        return $this->hasMany(CategoryImage::class, 'category_id');
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

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }





    public function getWithLocale($locale)
    {
        return $this->translates()->where('lang_key', $locale)->first();
    }

    public function product_types()
    {
        return $this->belongsToMany(Brand::class, 'category_producttypes', 'producttype_id', 'category_id');
    }
    public function colorSchemes()
    {
        return $this->belongsToMany(ColorShemes::class, 'brand_color', 'brand_id', 'color_id');
    }

}
