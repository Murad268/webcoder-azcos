<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Facades\TranslateUtility;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogRepository;
use App\Repositories\BlogTagRepository;
use App\Repositories\LangRepository;
use App\Services\BlogService;
use App\Services\Parameters\ParameterService;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function __construct(public ParameterService $parameterService, public LangRepository $langRepository, public BlogRepository $blogRepository, public BlogService $blogService, public BlogCategoryRepository $blogcategoryRepository, public BlogTagRepository $tagRepository)
    {
        $this->lang = $this->parameterService->getLang();
    }
    public function index($lang)
    {


        $q = request()->q;
        if ($q) {
            $products = $this->blogRepository->search($q, $lang, 30);
        } else {
            $products = $this->blogRepository->all(30);
        }
        $activeCount = $this->blogRepository->all_active()->count();
        return view('admin.blogs.index', compact('lang', 'q', 'products', 'activeCount'));
    }


    public function create($lang)
    {

        $tags = $this->tagRepository->all_active();
        $langs = $this->langRepository->all_active();
        $brands = $this->blogcategoryRepository->getAll();
        return view('admin.blogs.create', compact('lang', 'brands', 'langs', 'tags'));
    }

    public function store(Request $request, $lang)
    {

        $main_model = $this->blogRepository->getClassProducts();
        $translate_model = $this->blogRepository->getClassProductsTranslates();
        $images_model = $this->blogRepository->getClassImage();
        try {
            $this->blogService->simple_create($main_model, $translate_model, $images_model, $request);
            return redirect()->route('admin.blogs.index', ['lang' => $lang])->with('success', TranslateUtility::getTranslate('response', 'success_update', $lang));
        } catch (\Exception $e) {
            return redirect()->route('admin.blogs.index', ['lang' => $lang])->with('error', TranslateUtility::getTranslate('response', 'error_update', $lang, $e->getMessage()));
        }
    }

    public function edit($lang, $id )
    {

        $tags = $this->tagRepository->all_active();
        $blog = $this->blogRepository->findWith($id, 'translates');
        $langs = $this->langRepository->all_active();
        $brands = $this->blogcategoryRepository->getAll();
        $selectedTags = $blog->tags->pluck('id')->toArray();

        $main_lang = $lang;
        return view('admin.blogs.edit', compact('main_lang', 'langs', 'brands', 'blog', 'tags', 'selectedTags'));
    }

    public function update(Request $request , $id, $lang)
    {
        try {
            $product = $this->blogRepository->findWith($id, 'translates');

            $translate_model = $this->blogRepository->getClassProductsTranslates();
            $images_model = $this->blogRepository->getClassImage();
            $this->blogService->simple_update($product, $translate_model, $images_model, $request, $id);
            return redirect()->route('admin.blogs.index', ['lang' => $lang])->with('success', TranslateUtility::getTranslate('response', 'success_update', $lang));
            } catch (\Exception $e) {
                return redirect()->route('admin.blogs.index', ['lang' => $lang])->with('error', TranslateUtility::getTranslate('response', 'error_update', $lang, $e->getMessage()));
            }
    }


    public function delete_selected_blogs(Request $request)
    {
        try {
            $models = $this->blogRepository->findWhereInGet($request->ids);
            $this->blogService->deleteWhereIn($models);
            return response(['success' => TranslateUtility::getTranslate('response', 'success_delete', $this->lang)]);
        } catch (\Exception $e) {
            return response(['error' => TranslateUtility::getTranslate('response', 'error_update', $this->lang, $e->getMessage())]);
        }
    }


    public function changeStatusTrue($id)
    {
        try {
            $model = $this->blogRepository->find($id);
            $this->blogService->changeStatusTrue($model);
            return redirect()->back()->with('success', TranslateUtility::getTranslate('response', 'success_update', $this->lang));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', TranslateUtility::getTranslate('response', 'error_update', $this->lang, $e->getMessage()));
        }
    }

    public function changeStatusFalse($id)
    {
        try {
            $model = $this->blogRepository->find($id);
            $this->blogService->changeStatusFalse($model);
            return redirect()->back()->with('success', TranslateUtility::getTranslate('response', 'success_update', $this->lang) );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', TranslateUtility::getTranslate('response', 'error_update', $this->lang, $e->getMessage()));
        }
    }


    public function changeOrder(Request $request)
    {
        try {
            $this->blogService->changeOrder($request->all(), $this->blogRepository);
            return response(['success'=> TranslateUtility::getTranslate('response', 'success_update', $this->lang)]);
        } catch (\Exception $e) {
            return response(['error' => TranslateUtility::getTranslate('response', 'error_update', $this->lang, $e->getMessage())]);
        }
    }


    public function add_images(Request $request, $type, $id)
    {
        try {
            $images_model = $this->blogRepository->getClassImage();
            $this->blogService->handleImages($request, $images_model, $id, 'products', $type);

            return redirect()->back()->with('success', TranslateUtility::getTranslate('response', 'success_update', $this->lang) );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', TranslateUtility::getTranslate('response', 'error_update', $this->lang, $e->getMessage()));
        }
    }




    public function delete_image($id)
    {
        try {
            $result = $this->blogService->deleteImage($id, $this->blogRepository->getClassImage());

            if ($result['success']) {
                return redirect()->back()->with('success',TranslateUtility::getTranslate('response', 'success_delete', $this->lang));
            } else {
                return redirect()->back()->with('error', TranslateUtility::getTranslate('response', 'error_delete', $this->lang, $result['message']));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', TranslateUtility::getTranslate('response', 'error_delete', $this->lang, $result['message']));
        }
    }


}
