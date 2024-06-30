<?php

namespace App\Http\Controllers\Admin\Translates;

use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Translates\CreateTranslateRequest;
use App\Http\Requests\Admin\Translates\UpdateTranslateRequest;
use App\Models\Translates;
use App\Repositories\LangRepository;
use Illuminate\Http\Request;
USE App\Repositories\TranslateRepository;
use App\Services\TranslateService;
use App\Services\Parameters\ParameterService;
use Exception;
use App\Models\TranslatesTranslates;
class TranslatesController extends Controller
{
    public $lang;
    public function __construct(public ParameterService $parameterService, public LangRepository $langRepository, public TranslateRepository $translateRepository, public TranslateService $translateService)
    {
        $this->lang = $this->parameterService->getLang();
    }

public function update_one_translation(Request $request) {
    try {
        // Validate and process the request data
        // Example: $request->validate(['number' => 'required|integer']);

        // Perform the update logic here

        $data = TranslatesTranslates::findOrFail($request->id);
        $data->update(['value' => $request->value]);
        return response()->json(['success' => true, 'message' => $request->all()]);
    } catch (Exception $e) {
        // Handle exceptions and return an error response
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}


    public function index($lang) {
        $current_lag = $this->lang;
    $q = request()->q;
    if($q) {
        $translates = $this->translateRepository->search($q, $lang, 60);
    } else {
        $translates = $this->translateRepository->whereLocale($lang, 60);
    }
    return view('admin.translates.index', compact('q', 'translates', 'lang', 'current_lag'));
}

    public function create($lang) {
        $langs = $this->langRepository->all_active();
        $current_lag = $this->lang;
        return view('admin.translates.create', compact('langs', 'lang', 'current_lag'));
    }
    public function store(Request $request, $lang)
    {

        $translates = $this->translateRepository->getClassTranslates();

        $translates_translates = $this->translateRepository->getClassTranslatesTranslates();
        try {
            $this->translateService->simple_create($translates, $translates_translates, $request);
            return RouteHelpers::success_create('translates');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('translates', $e->getMessage());
        }
    }

    public function edit($lang, $id)
    {
                $current_lag = $this->lang;
        $translate = $this->translateRepository->findWith($id, 'translates');
        $langs = $this->langRepository->all_active();
        return view('admin.translates.edit', compact('lang', 'langs', 'translate', 'current_lag'));
    }

    public function update($lang, Request $request, $id)
    {

        try {
            $translate_translates = $this->translateRepository->getClassTranslatesTranslates();
            $translate = $this->translateRepository->findWith($id, 'translates');
            $this->translateService->simple_update($translate_translates, $translate, $request);
            return RouteHelpers::success_update('translates');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('translates', $e->getMessage());
        }
    }

    public function delete_selected_translates(Request $request)
    {
        try {
            $models = $this->translateRepository->findWhereInGet($request->ids);
            $this->translateService->deleteWhereIn($models);
            return RouteHelpers::success_update_response('translates');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('translates', $e->getMessage());
        }
    }

}
