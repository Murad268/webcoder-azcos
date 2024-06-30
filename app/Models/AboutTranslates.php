<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTranslates extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translate() {
        return $this->belongsTo(Addresses::class, 'category_id');
    }
}
