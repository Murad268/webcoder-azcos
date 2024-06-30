<?php

namespace App\Http\Controllers\Admin\ColorShemes;

use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Repositories\colorRepository;
use App\Repositories\ColorShemesRepository;
use App\Repositories\LangRepository;
use App\Services\colorService;
use App\Services\ColorShemesService;
use Exception;
use Illuminate\Http\Request;

class ColorShemesController extends Controller
{

    public function __construct(public LangRepository $langRepository, public ColorShemesRepository $colorRepository, public ColorShemesService $colorService)
    {
    }
    public function index($lang)
    {
        $q = request()->q;
        if ($q) {
            $categories = $this->colorRepository->search($q, $lang, 60);
        } else {
            $categories = $this->colorRepository->all(60);
        }
        $activeCount = $this->colorRepository->all_active()->count();
        return view('admin.colors.index', compact('lang', 'q', 'categories', 'activeCount'));
    }


    public function create($lang)
    {
        $langs = $this->langRepository->all_active();

        return view('admin.colors.create', compact('lang', 'langs'));
    }

    public function store(Request $request, $lang)
    {
        $main_model = $this->colorRepository->getClassCategories();
        $translate_model = $this->colorRepository->getClassCategoriesTranslates();
        $images_model = $this->colorRepository->getClassImage();
        try {
            $this->colorService->simple_create($main_model, $translate_model, $images_model, $request);
            return RouteHelpers::success_create('color_schemes');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('color_schemes', $e->getMessage());
        }
    }

    public function edit($lang, $id)
    {
        $category = $this->colorRepository->findWith($id, 'translates');
        $langs = $this->langRepository->all_active();
        return view('admin.colors.edit', compact('lang', 'langs', 'category'));
    }

    public function update(Request $request, $lang, $id)
    {
        try {
            $category = $this->colorRepository->findWith($id, 'translates');
            $translate_model = $this->colorRepository->getClassCategoriesTranslates();
            $images_model = $this->colorRepository->getClassImage();
            $this->colorService->simple_update($category, $translate_model, $images_model, $request, $id);
            return RouteHelpers::success_update('color_schemes');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('color_schemes', $e->getMessage());
        }
    }


    public function delete_selected_colors(Request $request)
    {
        try {
            $models = $this->colorRepository->findWhereInGet($request->ids);
            $this->colorService->deleteWhereIn($models);
            return RouteHelpers::success_update_response('color_schemes');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('color_schemes', $e->getMessage());
        }
    }


    public function changeStatusTrue($id)
    {
        try {
            $model = $this->colorRepository->find($id);
            $this->colorService->changeStatusTrue($model);
            return RouteHelpers::success_update('color_schemes');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('color_schemes', $e->getMessage());
        }
    }

    public function changeStatusFalse($id)
    {
        try {
            $model = $this->colorRepository->find($id);
            $this->colorService->changeStatusFalse($model);
            return RouteHelpers::success_update('color_schemes');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('color_schemes', $e->getMessage());
        }
    }


    public function changeOrder(Request $request)
    {
        try {
            $this->colorService->changeOrder($request->all(), $this->colorRepository);
            return RouteHelpers::success_update_response('color_schemes');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('color_schemes', $e->getMessage());
        }
    }


    public function add_images(Request $request, $type, $id)
    {
        try {
            $images_model = $this->colorRepository->getClassImage();
            $this->colorService->handleImages($request, $images_model, $id, 'categories', $type);

            return RouteHelpers::success_create('color_schemes');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('color_schemes', $e->getMessage());
        }
    }

    public function delete_image($id)
    {
        try {
            $result = $this->colorService->deleteImage($id, $this->colorRepository->getClassImage());

            if ($result['success']) {
                return RouteHelpers::success_delete('color_schemes');
            } else {
                return RouteHelpers::error_delete('color_schemes',  $result['message']);
            }
        } catch (\Exception $e) {
            return RouteHelpers::error_delete('color_schemes',  $e->getMessage());
        }
    }
}
