<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\ColorShemes;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\LangRepository;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct(public BrandRepository $brandRepository, public LangRepository $langRepository, public CategoryRepository $categoryRepository, public CategoryService $categoryService)
    {
    }
    public function index($lang)
    {
        $q = request()->q;
        if ($q) {
            $categories = $this->categoryRepository->search($q, $lang, 60);
        } else {
            $categories = $this->categoryRepository->all(60);
        }
        $activeCount = $this->categoryRepository->all_active()->count();
        return view('admin.categories.index', compact('lang', 'q', 'categories', 'activeCount'));
    }


    public function create($lang)
    {
        $colors = ColorShemes::all();

        $langMain = $lang;
        $langs = $this->langRepository->all_active();
        $productTypes = $this->brandRepository->all(100);
        return view('admin.categories.create', compact('langMain', 'langs', 'productTypes', 'colors'));
    }

    public function store(Request $request, $lang)
    {
        $main_model = $this->categoryRepository->getClassCategories();
        $translate_model = $this->categoryRepository->getClassCategoriesTranslates();
        $images_model = $this->categoryRepository->getClassImage();
        try {
            $this->categoryService->simple_create($main_model, $translate_model, $images_model, $request);
            return RouteHelpers::success_create('categories');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('categories', $e->getMessage());
        }
    }

    public function edit($lang, $id)
    {
        $colors = ColorShemes::all();

        $productTypes = $this->brandRepository->all(100);
        $category = $this->categoryRepository->findWith($id, 'translates');
        $langs = $this->langRepository->all_active();
        $selectedTypes = $category->product_types->pluck('id')->toArray();
        $selectedColors = $category->colorSchemes->pluck('id')->toArray();
        $langMain = $lang;
        return view('admin.categories.edit', compact('langMain', 'langs', 'category', 'productTypes', 'selectedTypes', 'colors', 'selectedColors'));
    }

    public function update(Request $request, $lang, $id)
    {
        try {
            $category = $this->categoryRepository->findWith($id, 'translates');
            $translate_model = $this->categoryRepository->getClassCategoriesTranslates();
            $images_model = $this->categoryRepository->getClassImage();
            $this->categoryService->simple_update($category, $translate_model, $images_model, $request, $id);
            return RouteHelpers::success_update('categories');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('categories', $e->getMessage());
        }
    }


    public function delete_selected_categories(Request $request)
    {
        try {
            $models = $this->categoryRepository->findWhereInGet($request->ids);
            $this->categoryService->deleteWhereIn($models);
            return RouteHelpers::success_update_response('categories');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('categories', $e->getMessage());
        }
    }


    public function changeStatusTrue($id)
    {
        try {
            $model = $this->categoryRepository->find($id);
            $this->categoryService->changeStatusTrue($model);
            return RouteHelpers::success_update('categories');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('categories', $e->getMessage());
        }
    }

    public function changeStatusFalse($id)
    {
        try {
            $model = $this->categoryRepository->find($id);
            $this->categoryService->changeStatusFalse($model);
            return RouteHelpers::success_update('categories');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('categories', $e->getMessage());
        }
    }


    public function changeOrder(Request $request)
    {
        try {
            $this->categoryService->changeOrder($request->all(), $this->categoryRepository);
            return RouteHelpers::success_update_response('categories');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('categories', $e->getMessage());
        }
    }

    public function add_images(Request $request, $type, $id)
    {
        try {
            $images_model = $this->categoryRepository->getClassImage();
            $this->categoryService->handleImages($request, $images_model, $id, 'categories', $type);

            return RouteHelpers::success_create('brands');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('brands', $e->getMessage());
        }
    }

    public function delete_image($id)
    {
        try {
            $result = $this->categoryService->deleteImage($id, $this->categoryRepository->getClassImage());

            if ($result['success']) {
                return RouteHelpers::success_delete('categories');
            } else {
                return RouteHelpers::error_delete('categories',  $result['message']);
            }
        } catch (\Exception $e) {
            return RouteHelpers::error_delete('categories',  $e->getMessage());
        }
    }

}
