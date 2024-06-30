<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranslatesTranslates extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translate() {
        return $this->belongsTo(Translates::class, 'translate_id');
    }
}
