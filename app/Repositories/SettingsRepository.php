<?php

namespace App\Repositories;

use App\Models\Settings;
use App\Models\SettingsImages;
use App\Models\SettingsTranslates;

class SettingsRepository
{
    protected $modelClass = Settings::class;
    protected $modelClassTranslates = SettingsTranslates::class;
    protected $modelClassImage = SettingsImages::class;



    public function get()
    {
        return $this->modelClass::findOrFail(1);
    }
    public function getAll()
    {
        return $this->modelClass::orderBy('order')->get();
    }
    public function getClassCategories()
    {
        return $this->modelClass;
    }

    public function getClassCategoriesTranslates()
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
        // Fetch translate IDs by searching in the value (currently commented out)
        // $translateIds = $this->modelClassTranslates::where('value', 'like', '%' . $q . '%')
        //     ->pluck('translate_id');

        // Translate IDs using the translate model and checking the title
        $translateIds = $this->modelClassTranslates::whereHas('translate', function ($query) use ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        })
            ->pluck('brand_id');

        // Fetch translations based on translate IDs and locale
        return $this->modelClass::whereIn('id', $translateIds)
            ->paginate($p);
    }
}
