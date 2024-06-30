<?php

namespace App\Repositories;

use App\Models\BlogTags;
use App\Models\BlogTagsTranslates;

class BlogTagRepository
{
    protected $modelClassCategories = BlogTags::class;
    protected $modelClassCategoriesTranslates = BlogTagsTranslates::class;

    public function all_active()
    {
        return $this->modelClassCategories::orderBy('order')->where('status', 1)->get();
    }

    public function all($p)
    {
        return $this->modelClassCategories::orderBy('order')->paginate($p);
    }
    public function getAll()
    {
        return $this->modelClassCategories::orderBy('order')->get();
    }
    public function getClassCategories()
    {
        return $this->modelClassCategories;
    }

    public function getClassCategoriesTranslates()
    {
        return $this->modelClassCategoriesTranslates;
    }


    public function findWhereInGet(array $data)
    {
        return $this->modelClassCategories::whereIn('id', $data)->get();
    }

    public function find($id)
    {
        return $this->modelClassCategories::findOrFail($id);
    }

    public function findWith($id, $translates)
    {
        return $this->modelClassCategories::with($translates)->findOrFail($id);
    }

    public function search($q, $lang, $p)
    {
        $translateIds = $this->modelClassCategoriesTranslates::where('tag', 'like', '%' . $q . '%')
            ->pluck('tag_id');

        // Fetch translations based on translate IDs and locale
        return $this->modelClassCategories::whereIn('id', $translateIds)

            ->paginate($p);
    }
}
