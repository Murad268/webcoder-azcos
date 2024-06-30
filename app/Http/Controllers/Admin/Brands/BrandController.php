<?php

namespace App\Http\Controllers\Admin\Brands;

use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;

use App\Models\ColorShemes;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\LangRepository;
use App\Services\BrandService;
use Exception;
use Illuminate\Http\Request;
use App\Services\Parameters\ParameterService;

class BrandController extends Controller
{
    public $lang;
    public function __construct( public ParameterService $parameterService, public LangRepository $langRepository, public BrandRepository $brandRepository, public BrandService $brandService, public CategoryRepository $categoryRepository)
    {
        $this->lang = $parameterService->getLang();
    }
    public function index($lang)
    {
        $current_lang = $this->lang;
        $q = request()->q;
        if ($q) {
            $brands = $this->brandRepository->search($q, $lang, 60);
        } else {
            $brands = $this->brandRepository->all(60);
        }
        $activeCount = $this->brandRepository->all_active()->count();
        return view('admin.brands.index', compact('lang', 'q', 'brands', 'activeCount', 'current_lang'));
    }


    public function create($lang)
    {
        $current_lang = $this->lang;
        $langs = $this->langRepository->all_active();
        $categories = $this->categoryRepository->getAll();
        return view('admin.brands.create', compact('lang', 'langs', 'categories', 'current_lang'));
    }

    public function store(Request $request, $lang)
    {
        $main_model = $this->brandRepository->getClassCategories();
        $translate_model = $this->brandRepository->getClassCategoriesTranslates();
        $images_model = $this->brandRepository->getClassImage();
        try {
            $this->brandService->simple_create($main_model, $translate_model, $images_model, $request);
            return RouteHelpers::success_create('brands');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('brands', $e->getMessage());
        }
    }

    public function edit($lang, $id)
    {
        $current_lang = $this->lang;
        $categories = $this->categoryRepository->getAll();
        $brand = $this->brandRepository->findWith($id, 'category');
        $langs = $this->langRepository->all_active();

        return view('admin.brands.edit', compact('lang', 'langs', 'brand', 'categories', 'current_lang'));
    }

    public function update(Request $request, $lang, $id)
    {
        try {
            $brand = $this->brandRepository->findWith($id, 'translates');
            $translate_model = $this->brandRepository->getClassCategoriesTranslates();
            $images_model = $this->brandRepository->getClassImage();
            $this->brandService->simple_update($brand, $translate_model, $images_model, $request, $id);
            return RouteHelpers::success_update('brands');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('brands', $e->getMessage());
        }
    }


    public function delete_selected_brands(Request $request)
    {
        try {
            $models = $this->brandRepository->findWhereInGet($request->ids);

            $this->brandService->deleteWhereIn($models);
            return RouteHelpers::success_update_response('brands');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('brands', $e->getMessage());
        }
    }


    public function changeStatusTrue($id)
    {
        try {
            $model = $this->brandRepository->find($id);
            $this->brandService->changeStatusTrue($model);
            return RouteHelpers::success_update('brands');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('brands', $e->getMessage());
        }
    }

    public function changeStatusFalse($id)
    {
        try {
            $model = $this->brandRepository->find($id);
            $this->brandService->changeStatusFalse($model);
            return RouteHelpers::success_update('brands');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('brands', $e->getMessage());
        }
    }


    public function changeOrder(Request $request)
    {
        try {
            $this->brandService->changeOrder($request->all(), $this->brandRepository);
            return RouteHelpers::success_update_response('brands');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('brands', $e->getMessage());
        }
    }

    public function add_images(Request $request, $type, $id)
    {
        try {
            $images_model = $this->brandRepository->getClassImage();
            $this->brandService->handleImages($request, $images_model, $id, 'brands', $type);

            return RouteHelpers::success_create('brands');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('brands', $e->getMessage());
        }
    }

    public function delete_image($id)
    {
        try {
            $result = $this->brandService->deleteImage($id, $this->brandRepository->getClassImage());

            if ($result['success']) {
                return RouteHelpers::success_delete('brands');
            } else {
                return RouteHelpers::error_delete('brands',  $result['message']);
            }
        } catch (\Exception $e) {
            return RouteHelpers::error_delete('brands',  $e->getMessage());
        }
    }

}
