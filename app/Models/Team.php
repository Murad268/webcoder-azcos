<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translates()
    {
        return $this->hasMany(TeamTranslates::class, 'team_id');
    }
    public function images()
    {
        return $this->hasMany(TeamImages::class, 'team_id');
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

    public function product_types()
    {
        return $this->belongsToMany(Brand::class, 'category_producttypes', 'producttype_id', 'category_id');
    }
}
