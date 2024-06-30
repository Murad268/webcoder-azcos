<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandTranslates extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translate() {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
