<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\CategoryImage;
use App\Models\CategoryTranslates;
use App\Models\ColorShemes;
use App\Models\ColorShemesImages;
use App\Models\ColorShemesTranslates;

class ColorShemesRepository
{
    protected $modelClassCategories = ColorShemes::class;
    protected $modelClassCategoriesTranslates = ColorShemesTranslates::class;
    protected $modelClassCategoryImage = ColorShemesImages::class;

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

    public function getClassImage()
    {
        return $this->modelClassCategoryImage;
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
        $translateIds = $this->modelClassCategoriesTranslates::whereHas('translate', function ($query) use ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        })
            ->pluck('color_shemes_id');

        // Fetch translations based on translate IDs and locale
        return $this->modelClassCategories::whereIn('id', $translateIds)
            ->paginate($p);
    }


    public function searchAll($q)
    {


        // Translate IDs using the translate model and checking the title
        $translateIds = $this->modelClassCategoriesTranslates::whereHas('translate', function ($query) use ($q) {
            $query->where('title', 'like', '%' . $q . '%')->orWhere('slug', 'like', '%' . $q . '%');
        })
            ->pluck('color_shemes_id');

        // Fetch translations based on translate IDs and locale
        return $this->modelClassCategories::whereIn('id', $translateIds)->where('status', 1)->get();
    }
}
