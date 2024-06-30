<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translates()
    {
        return $this->hasMany(MenuTranslates::class, 'menu_id');
    }


    protected static function boot()
    {
        parent::boot();


        static::deleting(function ($brand) {
            $brand->translates()->delete();
        });
    }







    public function getWithLocale($locale)
    {
        return $this->translates()->where('lang_key', $locale)->first();
    }


}
