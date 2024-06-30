<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translates()
    {
        return $this->hasMany(BlogCategoryTranslates::class, 'blog_category_id');
    }


    protected static function boot()
    {
        parent::boot();


        static::deleting(function ($category) {
            // Delete related translates
            $category->translates()->delete();
        });
    }







    public function getWithLocale($locale)
    {
        return $this->translates()->where('lang_key', $locale)->first();
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }

}
