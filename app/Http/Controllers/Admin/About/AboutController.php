<?php

namespace App\Http\Controllers\Admin\About;

use App\Facades\TranslateUtility;
use App\Http\Controllers\Controller;
use App\Repositories\AboutRepository;
use App\Repositories\LangRepository;
use App\Services\AboutService;
use App\Services\Parameters\ParameterService;
use Exception;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public $lang;
    public function __construct(public LangRepository $langRepository, public AboutRepository $aboutRepository, public AboutService $aboutService, public ParameterService $parameterService)
    {
        $this->lang = $this->parameterService->getLang();
    }
    public function index(){

    }
    public function edit($lang)
    {

        $langs = $this->langRepository->all_active();
        $about = $this->aboutRepository->get();
        return view('admin.about.edit', compact('lang', "about", 'langs'));
    }


    public function update(Request $request, $lang, $id)
    {
        try {
            $brand = $this->aboutRepository->findWith($id, 'translates');
            $translate_model = $this->aboutRepository->getClassCategoriesTranslates();
            $images_model = $this->aboutRepository->getClassImage();

            $this->aboutService->simple_update($brand, $translate_model, $images_model, $request, $id);
            return redirect()->route("admin.about.edit", ['lang' => $lang, 'about' => $id])->with('success',TranslateUtility::getTranslate('response', 'success_update', $lang));
        } catch (Exception $e) {
            return redirect()->route("admin.about.edit", ['lang' => $lang, 'about' => $id])->with('error', TranslateUtility::getTranslate('response', 'error_update', $lang, $e->getMessage()));
        }
    }


    public function add_images(Request $request, $type, $id)
    {

        try {
            $images_model = $this->aboutRepository->getClassImage();
            $this->aboutService->handleImages($request, $images_model, $id, 'about', $type);

            return redirect()->back()->with('success',TranslateUtility::getTranslate('response', 'success_create', $this->lang));
        } catch (Exception $e) {
            return response(['success' => false, TranslateUtility::getTranslate('response', 'error_create', $this->lang, $e->getMessage())]);
        }
    }

    public function delete_image($id)
    {
        try {
            $result = $this->aboutService->deleteImage($id, $this->aboutRepository->getClassImage());

            if ($result['success']) {
                return redirect()->back()->with('success', TranslateUtility::getTranslate('response', 'success_delete', $this->lang));
            } else {
                return redirect()->back()->with('error', TranslateUtility::getTranslate('response', 'error_delete', $this->lang, $result['message']));
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
