<?php

namespace App\Http\Controllers\Admin\Lang;;

use App\Helpers\RouteHelpers;
use App\Repositories\LangRepository;
use App\Services\LangService;
use App\Services\Parameters\ParameterService;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Langs\CreateLangRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Langs\UpdateLangRequest;
use App\Models\Lang;

class LangController extends Controller
{
    public $lang;
    public function __construct(public LangRepository $langRepository, public LangService $langService, public ParameterService $parameterService)
    {
        $this->lang = $parameterService->getLang();
    }
    public function index()
    {
        $q = request()->q;
        $main_lang = $this->lang;
        if($q) {
            $langs = $this->langRepository->search($q);
        } else {
            $langs = $this->langRepository->all();
        }
        $activeLangsCount = $this->langRepository->all_active()->count();
        return view('admin.langs.index', compact('langs', 'q', 'activeLangsCount', 'main_lang'));
    }
    public function create()
    {
        $main_lang = $this->lang;
        return view('admin.langs.create', compact('main_lang'));
    }

    public function show()
    {
    }

    public function store(CreateLangRequest $request)
    {

        try {
            $model = $this->langRepository->getModel();

            $this->langService->simple_create($model, $request->all());
            return redirect()->route("admin.lang.index")->with('success', "məlumatlar uğurla əlavə edildi");
        } catch (Exception $e) {
            return redirect()->route("admin.lang.index")->with('error', "məlumatların əlavə edilmə zamanı xəta baş verdi");
        }
    }
    public function edit(Lang $lang)
    {
        $main_lang = $this->lang;
        return view('admin.langs.edit', compact('lang', 'main_lang'));
    }

    public function update(Lang $lang, UpdateLangRequest $request )
    {
        try {


            $this->langService->simple_update($lang, $request->all());
            return RouteHelpers::success_update('lang');
        } catch (\Exception $e) {
            return RouteHelpers::error_cupdate('lang', $e->getMessage());
        }
    }
    public function changeDefault($id)
    {
        try {
            $model = $this->langRepository->find($id);
            $this->langService->changeDefault($model, $this->langRepository->getModel());
            return RouteHelpers::success_update('lang');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('lang', $e->getMessage());
        }
    }

    public function changeStatusTrue($id)
    {
        try {
            $model = $this->langRepository->find($id);
            $this->langService->changeStatusTrue($model);
            return RouteHelpers::success_update('lang');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('lang', $e->getMessage());
        }
    }

    public function changeStatusFalse($id)
    {
        try {
            $model = $this->langRepository->find($id);
            $this->langService->changeStatusFalse($model);
            return RouteHelpers::success_update('lang');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('lang', $e->getMessage());
        }
    }

    public function delete_selected_langs(Request $request)
    {
        try {
            $models = $this->langRepository->findWhereInGet($request->ids);
            $this->langService->deleteWhereIn($models);
            return RouteHelpers::success_update_response('lang');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('lang', $e->getMessage());
        }
    }

    public function changeOrder(Request $request)
    {
        try {
            $this->langService->changeOrder($request->all(), $this->langRepository);
            return RouteHelpers::success_update_response('lang');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('lang', $e->getMessage());
        }
    }
}
