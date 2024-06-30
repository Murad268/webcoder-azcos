<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\BlogImages;
use App\Models\BlogTagsTranslates;
use App\Models\BlogTranslates;

class BlogRepository
{
    protected $modelClass = Blog::class;
    protected $modelClassTranslates = BlogTranslates::class;
    protected $modelClassImage = BlogImages::class;

    public function all_active()
    {
        return $this->modelClass::orderBy('order')->where('status', 1)->get();
    }

    public function all($p)
    {
        return $this->modelClass::orderBy('order')->with(['translates', 'category'])->paginate($p);
    }
    public function getAll()
    {
        return $this->modelClass::orderBy('order')->with(['translates', 'category'])->get();
    }
    public function getClassProducts()
    {
        return $this->modelClass;
    }

    public function getClassProductsTranslates()
    {
        return $this->modelClassTranslates;
    }

    public function getClassImage()
    {
        return $this->modelClassImage;
    }

    public function findWhereInGet(array $data)
    {
        return $this->modelClass::whereIn('id', $data)->get();
    }

    public function find($id)
    {
        return $this->modelClass::findOrFail($id);
    }

    public function findWith($id, $translates)
    {
        return $this->modelClass::with($translates)->findOrFail($id);
    }

    public function search($q, $lang, $p)
    {
        // $langi silmə!!!!


        // Fetch translate IDs by searching in the value (currently commented out)
        // $translateIds = $this->modelClassTranslates::where('value', 'like', '%' . $q . '%')
        //     ->pluck('product_id');

        // Translate IDs using the translate model and checking the title


        $translateIds = $this->modelClassTranslates::whereHas('translate', function ($query) use ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        })
            ->pluck('blog_id');

        // Fetch translations based on translate IDs and locale
        return $this->modelClass::whereIn('id', $translateIds)
            ->paginate($p);
    }


    public function searchAll($q)
    {
        // $langi silmə!!!!




        $translateIds = $this->modelClassTranslates::whereHas('translate', function ($query) use ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        })
            ->pluck('blog_id');

        // Fetch translations based on translate IDs and locale
        return $this->modelClass::whereIn('id', $translateIds)->where('status', 1)->get();
    }
}
