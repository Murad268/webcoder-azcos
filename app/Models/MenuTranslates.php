<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuTranslates extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translate()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
