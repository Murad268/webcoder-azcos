<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded  = [];
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }
    public function translates()
    {
        return $this->hasMany(BlogTranslates::class, 'blog_id');
    }
    public function images()
    {
        return $this->hasMany(BlogImages::class, 'blog_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $maxOrder = self::max('order');
            $model->order = $maxOrder !== null ? $maxOrder + 1 : 1;
        });
        static::deleting(function ($product) {
            // Delete related translates
            $product->translates()->delete();
            $product->images()->delete();
        });
    }







    public function getWithLocale($locale)
    {
        return $this->translates()->where('lang_key', $locale)->first();
    }


    public function tags()
    {
        return $this->belongsToMany(BlogTags::class, 'tags_blogs', 'blog_id', 'tag_id');
    }



}
