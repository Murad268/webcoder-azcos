<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTagsTranslates extends Model

{
    protected $guarded  = [];

    public function translate() {
        return $this->belongsTo(BlogTags::class, 'tag_id');
    }
}

