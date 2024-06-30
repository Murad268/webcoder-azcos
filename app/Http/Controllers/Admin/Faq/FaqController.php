<?php

namespace App\Http\Controllers\Admin\Faq;

use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;
use App\Repositories\FaqRepository;
use App\Repositories\LangRepository;
use App\Services\FaqService;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function __construct(public LangRepository $langRepository, public FaqRepository $faqRepository, public FaqService $faqService)
    {
    }
    public function index($lang)
    {
        $q = request()->q;
        if ($q) {
            $categories = $this->faqRepository->search($q, $lang, 99960);
        } else {
            $categories = $this->faqRepository->all(6990);
        }

        $activeCount = $this->faqRepository->all_active()->count();
        return view('admin.faq.index', compact('lang', 'q', 'categories', 'activeCount'));
    }


    public function create($lang)
    {
        $langs = $this->langRepository->all_active();

        return view('admin.faq.create', compact('lang', 'langs'));
    }

    public function store(Request $request, $lang)
    {
        $main_model = $this->faqRepository->getClassCategories();
        $translate_model = $this->faqRepository->getClassCategoriesTranslates();
        try {
            $this->faqService->simple_create($main_model, $translate_model, $request);
            return RouteHelpers::success_create('faq');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('faq', $e->getMessage());
        }
    }

    public function edit($lang, $id)
    {
        $category = $this->faqRepository->findWith($id, 'translates');
        $langs = $this->langRepository->all_active();
        $main_lang = $lang;
        return view('admin.faq.edit', compact('main_lang', 'langs', 'category'));
    }

    public function update(Request $request, $lang, $id)
    {
        try {
            $category = $this->faqRepository->findWith($id, 'translates');
            $translate_model = $this->faqRepository->getClassCategoriesTranslates();
            $this->faqService->simple_update($category, $translate_model, $request, $id);
            return RouteHelpers::success_update('faq');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('faq', $e->getMessage());
        }
    }


    public function delete_selected_faqs(Request $request)
    {
        try {
            $models = $this->faqRepository->findWhereInGet($request->ids);
            $this->faqService->deleteWhereIn($models);
            return RouteHelpers::success_update_response('faq');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('faq', $e->getMessage());
        }
    }


    public function changeStatusTrue($id)
    {
        try {
            $model = $this->faqRepository->find($id);
            $this->faqService->changeStatusTrue($model);
            return RouteHelpers::success_update('faq');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('faq', $e->getMessage());
        }
    }

    public function changeStatusFalse($id)
    {
        try {
            $model = $this->faqRepository->find($id);
            $this->faqService->changeStatusFalse($model);
            return RouteHelpers::success_update('faq');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('faq', $e->getMessage());
        }
    }


    public function changeOrder(Request $request)
    {
        try {
            $this->faqService->changeOrder($request->all(), $this->faqRepository);
            return RouteHelpers::success_update_response('faq');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('faq', $e->getMessage());
        }
    }


    public function add_images(Request $request, $type, $id)
    {
        try {
            $images_model = $this->faqRepository->getClassImage();
            $this->faqService->handleImages($request, $images_model, $id, 'categories', $type);

            return RouteHelpers::success_create('faq');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('faq', $e->getMessage());
        }
    }

    public function delete_image($id)
    {
        try {
            $result = $this->faqService->deleteImage($id, $this->faqRepository->getClassImage());

            if ($result['success']) {
                return RouteHelpers::success_delete('faq');
            } else {
                return RouteHelpers::error_delete('faq',  $result['message']);
            }
        } catch (\Exception $e) {
            return RouteHelpers::error_delete('faq',  $e->getMessage());
        }
    }

}
