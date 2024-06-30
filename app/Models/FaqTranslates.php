<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqTranslates extends Model
{
    protected $guarded  = [];

    public function translate() {
        return $this->belongsTo(Faq::class, 'faq_id');
    }
}
