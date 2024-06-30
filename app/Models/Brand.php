<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translates()
    {
        return $this->hasMany(BrandTranslates::class, 'brand_id');
    }
    public function images()
    {
        return $this->hasMany(BrandImage::class, 'brand_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $maxOrder = self::max('order');
            $model->order = $maxOrder !== null ? $maxOrder + 1 : 1;
        });
        static::deleting(function ($brand) {
            // Delete related translates
            $brand->translates()->delete();
            $brand->images()->delete();
        });
    }







    public function getWithLocale($locale)
    {
        return $this->translates()->where('lang_key', $locale)->first();
    }

    public  function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function colorSchemes()
    {
        return $this->belongsToMany(ColorShemes::class, 'brand_color', 'brand_id', 'color_id');
    }

}
