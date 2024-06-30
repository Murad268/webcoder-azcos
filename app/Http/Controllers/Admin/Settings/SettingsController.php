<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Facades\TranslateUtility;
use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;
use App\Repositories\LangRepository;
use App\Repositories\SettingsRepository;
use App\Services\Parameters\ParameterService;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public $lang;
    public function __construct(public LangRepository $langRepository, public SettingsRepository $settingsRepository, public SettingsService $settingsService, public ParameterService $parameterService)
    {
        $this->lang = $this->parameterService->getLang();
    }
    public function index(){

    }
    public function edit($lang)
    {

        $langs = $this->langRepository->all_active();
        $settings = $this->settingsRepository->get();
        return view('admin.settings.edit', compact('lang', "settings", 'langs'));
    }


    public function update(Request $request, $lang, $id)
    {
     
        try {
            $brand = $this->settingsRepository->findWith($id, 'translates');
            $translate_model = $this->settingsRepository->getClassCategoriesTranslates();
            $images_model = $this->settingsRepository->getClassImage();

            $this->settingsService->simple_update($brand, $translate_model, $images_model, $request, $id);
             return redirect()->route("admin.settings.edit", ['lang' => $lang, 'setting' => $id])->with('success',TranslateUtility::getTranslate('response', 'success_update', TranslateUtility::getLang()));
        } catch (Exception $e) {
            return redirect()->route("admin.settings.edit", ['lang' => $lang, 'setting' => $id])->with('error', TranslateUtility::getTranslate('response', 'error_update', TranslateUtility::getLang(), $e->getMessage()));
        }
    }


    public function add_images(Request $request, $type, $id)
    {
        $lang = $this->lang;
        try {
            $images_model = $this->settingsRepository->getClassImage();
            $this->settingsService->handleImages($request, $images_model, $id, 'settings', $type);
            return redirect()->route("admin.settings.edit", ['lang' => $lang, 'setting' => $id])->with('success',TranslateUtility::getTranslate('response', 'success_update', $lang));
        } catch (\Exception $e) {
            return redirect()->route("admin.settings.edit", ['lang' => $lang, 'setting' => $id])->with('error', TranslateUtility::getTranslate('response', 'error_update', $lang, $e->getMessage()));
        }
    }

    public function delete_image($id)
    {
        try {
            $result = $this->settingsService->deleteImage($id, $this->settingsRepository->getClassImage());

            if ($result['success']) {
                return redirect()->back()->with('success', TranslateUtility::getTranslate('response', 'success_delete', $this->lang));
            } else {
                return redirect()->back()->with('error', TranslateUtility::getTranslate('response', 'error_delete', $this->lang, $result['message']));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
