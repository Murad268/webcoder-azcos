<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translates()
    {
        return $this->hasMany(ProductTranslates::class, 'product_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $maxOrder = self::max('order');
            $model->order = $maxOrder !== null ? $maxOrder + 1 : 1;
        });
        static::deleting(function ($product) {
            // Delete related translates
            $product->translates()->delete();
            $product->images()->delete();
        });
    }







    public function getWithLocale($locale)
    {
        return $this->translates()->where('lang_key', $locale)->first();
    }

    public  function brand()
    {
        return $this->belongsTo(Category::class, 'brand_id');
    }


    public function colorSchemes()
    {
        return $this->belongsToMany(ColorShemes::class, 'product_color_scheme', 'product_id', 'color_shemes_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'product_tag', 'product_id', 'tag_id');
    }
}
