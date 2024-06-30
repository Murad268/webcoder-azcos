<?php

namespace App\Http\Controllers\Admin\BlogTag;

use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;
use App\Repositories\BlogTagRepository;
use App\Repositories\LangRepository;
use App\Services\BlogTagService;
use Illuminate\Http\Request;

class BlogTagController extends Controller
{

    public function __construct(public LangRepository $langRepository, public BlogTagRepository $categoryRepository, public BlogTagService $categoryService)
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
        return view('admin.blogtags.index', compact('lang', 'q', 'categories', 'activeCount'));
    }


    public function create($lang)
    {
        $langs = $this->langRepository->all_active();

        return view('admin.blogtags.create', compact('lang', 'langs'));
    }

    public function store(Request $request, $lang)
    {
        $main_model = $this->categoryRepository->getClassCategories();
        $translate_model = $this->categoryRepository->getClassCategoriesTranslates();
        try {
            $this->categoryService->simple_create($main_model, $translate_model, $request);
            return RouteHelpers::success_create('blog_tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('blog_tag', $e->getMessage());
        }
    }

    public function edit($lang, $id)
    {
        $category = $this->categoryRepository->findWith($id, 'translates');
        $langs = $this->langRepository->all_active();
        return view('admin.blogtags.edit', compact('lang', 'langs', 'category'));
    }

    public function update(Request $request, $lang, $id)
    {
        try {
            $category = $this->categoryRepository->findWith($id, 'translates');
            $translate_model = $this->categoryRepository->getClassCategoriesTranslates();
            $this->categoryService->simple_update($category, $translate_model, $request, $id);
            return RouteHelpers::success_update('blog_tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('blog_tag', $e->getMessage());
        }
    }


    public function delete_selected_categories(Request $request)
    {
        try {
            $models = $this->categoryRepository->findWhereInGet($request->ids);
            $this->categoryService->deleteWhereIn($models);
            return RouteHelpers::success_delete_response('blog_tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('blog_tag', $e->getMessage());
        }
    }


    public function changeStatusTrue($id)
    {
        try {
            $model = $this->categoryRepository->find($id);
            $this->categoryService->changeStatusTrue($model);
            return RouteHelpers::success_update('blog_tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('blog_tag', $e->getMessage());
        }
    }

    public function changeStatusFalse($id)
    {
        try {
            $model = $this->categoryRepository->find($id);
            $this->categoryService->changeStatusFalse($model);
            return RouteHelpers::success_update('blog_tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('blog_tag', $e->getMessage());
        }
    }


    public function changeOrder(Request $request)
    {
        try {
            $this->categoryService->changeOrder($request->all(), $this->categoryRepository);
            return RouteHelpers::success_delete_response('blog_tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('blog_tag', $e->getMessage());
        }
    }


    public function add_images(Request $request, $type, $id)
    {
        try {
            $images_model = $this->categoryRepository->getClassImage();
            $this->categoryService->handleImages($request, $images_model, $id, 'categories', $type);

            return RouteHelpers::success_update('blog_tag');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('blog_tag', $e->getMessage());
        }
    }

    public function delete_image($id)
    {
        try {
            $result = $this->categoryService->deleteImage($id, $this->categoryRepository->getClassImage());

            if ($result['success']) {
                return redirect()->back()->with('success', "şəkil uğurla silindi");
            } else {
                return RouteHelpers::error_delete('blog_tag',  $result['message']);
            }
        } catch (\Exception $e) {
            return RouteHelpers::error_delete('blog_tag',  $e->getMessage());
        }
    }
}
