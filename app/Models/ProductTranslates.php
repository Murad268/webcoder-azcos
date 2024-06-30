<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslates extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translate()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
