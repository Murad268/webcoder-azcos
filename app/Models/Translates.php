<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translates extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translates() {
        return $this->hasMany(TranslatesTranslates::class, 'translate_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($translate) {
            // Delete related translates
            $translate->translates()->delete();
        });
    }

    public function getWithLocale($locale)
    {
        $translation = $this->translates()->where('locale', $locale)->first();
        return $translation ? $translation->value : '';
    }
    public function getCode($code)
    {
        $translation = $this->where('code', $code)->first();
        return $translation ? $translation->value : '';
    }
}
