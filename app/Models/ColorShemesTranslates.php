<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ColorShemes;
class ColorShemesTranslates extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translate()
    {
        return $this->belongsTo(Colorshemes::class, 'color_shemes_id');
    }
}
