<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translates()
    {
        return $this->hasMany(AddressesTranslate::class, 'address_id');
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
        });
    }







    public function getWithLocale($locale)
    {
        return $this->translates()->where('lang_key', $locale)->first();
    }
}
