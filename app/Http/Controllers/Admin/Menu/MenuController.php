<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;
use App\Repositories\LangRepository;
use App\Repositories\MenuRepository;
use App\Services\MenuService;
use Illuminate\Http\Request;
use App\Services\Parameters\ParameterService;

class MenuController extends Controller
{

    public $lang;
    public function __construct(public ParameterService $parameterService, public LangRepository $langRepository, public MenuRepository $menuRepository, public MenuService $menuService)
    {
        $this->lang = $parameterService->getLang();
    }
    public function index($lang)
    {

        $lang = $this->lang;
        $q = request()->q;
        if ($q) {
            $menus = $this->menuRepository->search($q, $lang, 6000);
        } else {
            $menus = $this->menuRepository->all(6000);
        }

        return view('admin.menu.index', compact('lang', 'q', 'menus'));
    }


    public function create($lang)
    {
        $langs = $this->langRepository->all_active();
        $current_lang = $this->lang;
       
        return view('admin.menu.create', compact('lang', 'langs', 'current_lang'));
    }

    public function store(Request $request, $lang)
    {
        $main_model = $this->menuRepository->getClassCategories();
        $translate_model = $this->menuRepository->getClassCategoriesTranslates();

        try {
            $this->menuService->simple_create($main_model, $translate_model, $request);
            return RouteHelpers::success_create('menu');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('menu', $e->getMessage());
        }
    }

    public function edit($lang, $id)
    {
              $current_lang = $this->lang;
        $menu = $this->menuRepository->findWith($id, 'translates');
        $langs = $this->langRepository->all_active();
        return view('admin.menu.edit', compact('lang', 'langs', 'menu', 'current_lang'));
    }

    public function update(Request $request, $lang, $id)
    {
        try {
            $brand = $this->menuRepository->findWith($id, 'translates');
            $translate_model = $this->menuRepository->getClassCategoriesTranslates();
            $this->menuService->simple_update($brand, $translate_model,  $request, $id);
            return RouteHelpers::success_update('menu');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('menu', $e->getMessage());
        }
    }


    public function delete_selected_menu_items(Request $request)
    {
        try {
            $models = $this->menuRepository->findWhereInGet($request->ids);

            $this->menuService->deleteWhereIn($models);
            return RouteHelpers::success_update_response('menu');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('menu', $e->getMessage());
        }
    }









}
