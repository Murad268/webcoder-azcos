<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\MenuTranslates;

class MenuRepository
{
    protected $modelClassBrands = Menu::class;
    protected $modelClassBrandsTranslates = MenuTranslates::class;



    public function all($p)
    {
        return $this->modelClassBrands::paginate($p);
    }
    public function getAll()
    {
        return $this->modelClassBrands::orderBy('order')->get();
    }
    public function getClassCategories()
    {
        return $this->modelClassBrands;
    }

    public function getClassCategoriesTranslates()
    {
        return $this->modelClassBrandsTranslates;
    }



    public function findWhereInGet(array $data)
    {
        return $this->modelClassBrands::whereIn('id', $data)->get();
    }

    public function find($id)
    {
        return $this->modelClassBrands::findOrFail($id);
    }

    public function findWith($id, $translates)
    {
        return $this->modelClassBrands::with($translates)->findOrFail($id);
    }

    public function search($q, $lang, $p)
    {
        // Translate IDs using the translate model and checking the title
        $translateIds = $this->modelClassBrandsTranslates::where('slug', 'like', '%' . $q . '%')
            ->pluck('menu_id');

        // Fetch translations based on translate IDs and locale
        return $this->modelClassBrands::whereIn('id', $translateIds)
            ->orWhere('code', 'like', '%' . $q . '%')
            ->paginate($p);
    }

}
