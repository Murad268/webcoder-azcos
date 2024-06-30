<?php
namespace App\Repositories;

use App\Models\Brand;
use App\Models\BrandImage;
use App\Models\BrandTranslates;


class BrandRepository
{
    protected $modelClassBrands = Brand::class;
    protected $modelClassBrandsTranslates = BrandTranslates::class;
    protected $modelClassBrandImage = BrandImage::class;

    public function all_active()
    {
        return $this->modelClassBrands::orderBy('order')->where('status', 1)->get();
    }

    public function all($p)
    {
        return $this->modelClassBrands::orderBy('order')->paginate($p);
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

    public function getClassImage()
    {
        return $this->modelClassBrandImage;
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
        // Fetch translate IDs by searching in the value (currently commented out)
        // $translateIds = $this->modelClassBrandsTranslates::where('value', 'like', '%' . $q . '%')
        //     ->pluck('translate_id');

        // Translate IDs using the translate model and checking the title
        $translateIds = $this->modelClassBrandsTranslates::whereHas('translate', function ($query) use ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        })
            ->pluck('brand_id');

        // Fetch translations based on translate IDs and locale
        return $this->modelClassBrands::whereIn('id', $translateIds)
            ->paginate($p);
    }


    public function searchAll($q)
    {

        $translateIds = $this->modelClassBrandsTranslates::whereHas('translate', function ($query) use ($q) {
            $query->where('title', 'like', '%' . $q . '%')->orWhere('slug', 'like', '%' . $q . '%');
        })
            ->pluck('brand_id');

        // Fetch translations based on translate IDs and locale
        return $this->modelClassBrands::whereIn('id', $translateIds)->where('status', 1)->get();
    }
}
