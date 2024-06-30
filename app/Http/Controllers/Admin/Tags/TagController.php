<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;
use App\Repositories\LangRepository;
use App\Repositories\TagRepository;
use App\Services\TagService;
use Illuminate\Http\Request;
use Exception;
class TagController extends Controller
{

    public function __construct(public LangRepository $langRepository, public TagRepository $tagRepository, public TagService $tagService)
    {
    }
    public function index($lang)
    {
        $q = request()->q;
        if ($q) {
            $categories = $this->tagRepository->search($q, $lang, 60);
        } else {
            $categories = $this->tagRepository->all(60);
        }
        $activeCount = $this->tagRepository->all_active()->count();
        return view('admin.tags.index', compact('lang', 'q', 'categories', 'activeCount'));
    }


    public function create($lang)
    {
        $langs = $this->langRepository->all_active();

        return view('admin.tags.create', compact('lang', 'langs'));
    }

    public function store(Request $request, $lang)
    {
        $main_model = $this->tagRepository->getClassCategories();
        $translate_model = $this->tagRepository->getClassCategoriesTranslates();
        try {
            $this->tagService->simple_create($main_model, $translate_model, $request);
            return RouteHelpers::success_create('tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('tag', $e->getMessage());
        }
    }

    public function edit($lang, $id)
    {
        $category = $this->tagRepository->findWith($id, 'translates');
        $langs = $this->langRepository->all_active();
        return view('admin.tags.edit', compact('lang', 'langs', 'category'));
    }

    public function update(Request $request, $lang, $id)
    {
        try {
            $category = $this->tagRepository->findWith($id, 'translates');
            $translate_model = $this->tagRepository->getClassCategoriesTranslates();
            $this->tagService->simple_update($category, $translate_model, $request, $id);
            return RouteHelpers::success_update('tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('tag', $e->getMessage());
        }
    }


    public function delete_selected_categories(Request $request)
    {
        try {
            $models = $this->tagRepository->findWhereInGet($request->ids);
            $this->tagService->deleteWhereIn($models);
            return RouteHelpers::success_update_response('tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('tag', $e->getMessage());
        }
    }


    public function changeStatusTrue($id)
    {
        try {
            $model = $this->tagRepository->find($id);
            $this->tagService->changeStatusTrue($model);
            return RouteHelpers::success_update('tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('tag', $e->getMessage());
        }
    }

    public function changeStatusFalse($id)
    {
        try {
            $model = $this->tagRepository->find($id);
            $this->tagService->changeStatusFalse($model);
            return RouteHelpers::success_update('tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('tag', $e->getMessage());
        }
    }


    public function changeOrder(Request $request)
    {
        try {
            $this->tagService->changeOrder($request->all(), $this->tagRepository);
            return RouteHelpers::success_update_response('tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('tag', $e->getMessage());
        }
    }


    public function add_images(Request $request, $type, $id)
    {
        try {
            $images_model = $this->tagRepository->getClassImage();
            $this->tagService->handleImages($request, $images_model, $id, 'categories', $type);

            return RouteHelpers::success_create('tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('tag', $e->getMessage());
        }
    }

    public function delete_image($id)
    {
        try {
            $result = $this->tagService->deleteImage($id, $this->tagRepository->getClassImage());

            if ($result['success']) {
                return RouteHelpers::success_delete('tag');
            } else {
                return RouteHelpers::error_delete('tag',  $result['message']);
            }
        } catch (\Exception $e) {
            return RouteHelpers::error_delete('tag',  $e->getMessage());
        }
    }

}
