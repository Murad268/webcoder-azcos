<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translates()
    {
        return $this->hasMany(AboutTranslates::class, 'about_id');
    }
    public function images()
    {
        return $this->hasMany(AboutImages::class, 'about_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $maxOrder = self::max('order');
            $model->order = $maxOrder !== null ? $maxOrder + 1 : 1;
        });
        static::deleting(function ($about) {
            // Delete related translates
            $about->translates()->delete();
            $about->images()->delete();
        });
    }


    public function getWithLocale($locale)
    {
        return $this->translates()->where('lang_key', $locale)->first();
    }

   
}
