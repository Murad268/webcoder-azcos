<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTranslates extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translate()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
