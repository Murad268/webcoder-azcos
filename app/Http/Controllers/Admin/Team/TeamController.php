<?php

namespace App\Http\Controllers\Admin\Team;

use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;
use App\Repositories\TeamRepository;
use App\Repositories\LangRepository;
use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function __construct(public LangRepository $langRepository, public TeamRepository $teamRepository, public TeamService $teamService)
    {
    }
    public function index($lang)
    {

        $q = request()->q;
        if ($q) {
            $teams = $this->teamRepository->search($q, $lang, 60);
        } else {
            $teams = $this->teamRepository->all(6000);
        }
        $activeCount = $this->teamRepository->all_active()->count();
        return view('admin.teams.index', compact('lang', 'q', 'teams', 'activeCount'));
    }


    public function create($lang)
    {
        $langMain = $lang;
        $langs = $this->langRepository->all_active();
        return view('admin.teams.create', compact('langMain', 'langs'));
    }

    public function store(Request $request, $lang)
    {
        $main_model = $this->teamRepository->getClassCategories();
        $translate_model = $this->teamRepository->getClassCategoriesTranslates();
        $images_model = $this->teamRepository->getClassImage();
        try {
            $this->teamService->simple_create($main_model, $translate_model, $images_model, $request);
            return RouteHelpers::success_create('team');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('team', $e->getMessage());
        }
    }

    public function edit($lang, $id)
    {
        $team = $this->teamRepository->findWith($id, 'translates');
        $langs = $this->langRepository->all_active();
        $selectedtypes = $team->product_types->pluck('id')->toArray();
        $langMain = $lang;
        return view('admin.teams.edit', compact('langMain', 'langs', 'team', 'selectedtypes'));
    }

    public function update(Request $request, $lang, $id)
    {
        try {
            $team = $this->teamRepository->findWith($id, 'translates');
            $translate_model = $this->teamRepository->getClassCategoriesTranslates();
            $images_model = $this->teamRepository->getClassImage();
            $this->teamService->simple_update($team, $translate_model, $images_model, $request, $id);
            return RouteHelpers::success_update('team');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('team', $e->getMessage());
        }
    }


    public function delete_selected_teams(Request $request)
    {
        try {
            $models = $this->teamRepository->findWhereInGet($request->ids);
            $this->teamService->deleteWhereIn($models);
            return RouteHelpers::success_update_response('team');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('team', $e->getMessage());
        }
    }


    public function changeStatusTrue($id)
    {
        try {
            $model = $this->teamRepository->find($id);
            $this->teamService->changeStatusTrue($model);
            return RouteHelpers::success_update('team');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('team', $e->getMessage());
        }
    }

    public function changeStatusFalse($id)
    {
        try {
            $model = $this->teamRepository->find($id);
            $this->teamService->changeStatusFalse($model);
            return RouteHelpers::success_update('team');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('team', $e->getMessage());
        }
    }


    public function changeOrder(Request $request)
    {
        try {
            $this->teamService->changeOrder($request->all(), $this->teamRepository);
            return RouteHelpers::success_update_response('team');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('team', $e->getMessage());
        }
    }


    public function add_images(Request $request, $type, $id)
    {
        try {
            $images_model = $this->teamRepository->getClassImage();
            $this->teamService->handleImages($request, $images_model, $id, 'teams', $type);

            return RouteHelpers::success_create('team');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('team', $e->getMessage());
        }
    }

    public function delete_image($id)
    {
        try {
            $result = $this->teamService->deleteImage($id, $this->teamRepository->getClassImage());

            if ($result['success']) {
                return RouteHelpers::success_delete('team');
            } else {
                return RouteHelpers::error_delete('team',  $result['message']);
            }
        } catch (\Exception $e) {
            return RouteHelpers::error_delete('team',  $e->getMessage());
        }
    }

}
