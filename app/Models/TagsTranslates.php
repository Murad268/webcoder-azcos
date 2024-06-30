<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagsTranslates extends Model
{
    protected $guarded  = [];

    public function translate() {
        return $this->belongsTo(Tags::class, 'tag_id');
    }
}
