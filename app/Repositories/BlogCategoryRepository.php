<?php

namespace App\Repositories;

use App\Models\BlogCategory;
use App\Models\BlogCategoryTranslates;

class BlogCategoryRepository
{
    protected $modelClassCategories = BlogCategory::class;
    protected $modelClassCategoriesTranslates = BlogCategoryTranslates::class;

    public function all_active()
    {
        return $this->modelClassCategories::where('status', 1)->get();
    }

    public function all($p)
    {
        return $this->modelClassCategories::paginate($p);
    }
    public function getAll()
    {
        return $this->modelClassCategories::all();
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
        // Fetch translate IDs by searching in the value (currently commented out)
        // $translateIds = $this->modelClassCategoriesTranslates::where('value', 'like', '%' . $q . '%')
        //     ->pluck('translate_id');

        // Translate IDs using the translate model and checking the title
        $translateIds = $this->modelClassCategoriesTranslates::where('title', 'like', '%' . $q . '%')->orWhere('slug', 'like', '%' . $q . '%')
            ->pluck('blog_category_id');

        // Fetch translations based on translate IDs and locale
        return $this->modelClassCategories::whereIn('id', $translateIds)
            ->paginate($p);
    }
}
