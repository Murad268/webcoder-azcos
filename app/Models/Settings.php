<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translates()
    {
        return $this->hasMany(SettingsTranslates::class, 'settings_id');
    }
    public function images()
    {
        return $this->hasMany(SettingsImages::class, 'settings_id');
    }




    public function getWithLocale($locale)
    {
        return $this->translates()->where('lang_key', $locale)->first();
    }
}
