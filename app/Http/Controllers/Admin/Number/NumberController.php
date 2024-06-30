<?php

namespace App\Http\Controllers\Admin\Number;

use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;
use App\Models\Number;
use App\Repositories\NumberRepository;
use App\Services\NumberService;
use Illuminate\Http\Request;

class NumberController extends Controller
{
    public function __construct(public NumberRepository $numberRepository, public NumberService $numberService)
    {
    }
    public function index($lang)
    {
        $q = request()->q;
        if($q) {
            $numbers = $this->numberRepository->search($q);
        } else {
            $numbers = $this->numberRepository->all();
        }
        $activenumbersCount = $this->numberRepository->all_active()->count();
        return view('admin.numbers.index', compact('numbers', 'q', 'activenumbersCount','lang'));
    }
    public function create($lang)
    {

        return view('admin.numbers.create', compact('lang'));
    }

    public function show()
    {
    }

    public function store(Request $request, $lang)
    {
        try {
            $model = $this->numberRepository->getModel();

            $this->numberService->simple_create($model, $request->all());
            return RouteHelpers::success_create('number');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('number', $e->getMessage());
        }
    }
        public function edit($lang, $id)
    {
        $number = $this->numberRepository->find($id);
        return view('admin.numbers.edit', compact('number', 'lang'));
    }

    public function update($lang, $id, Request $request )
    {
        try {
            $number = $this->numberRepository->find($id);

            $this->numberService->simple_update($number, $request->all());
            return RouteHelpers::success_update('number');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('number', $e->getMessage());
        }
    }


    public function changeStatusTrue($id)
    {
        try {
            $model = $this->numberRepository->find($id);
            $this->numberService->changeStatusTrue($model);
            return RouteHelpers::success_update('number');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('number', $e->getMessage());
        }
    }

    public function changeStatusFalse($id)
    {
        try {
            $model = $this->numberRepository->find($id);
            $this->numberService->changeStatusFalse($model);
            return RouteHelpers::success_update('number');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('number', $e->getMessage());
        }
    }

    public function delete_selected_numbers(Request $request)
    {
        try {
            $models = $this->numberRepository->findWhereInGet($request->ids);
            $this->numberService->deleteWhereIn($models);
            return RouteHelpers::success_update_response('number');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('number', $e->getMessage());
        }
    }

    public function changeOrder(Request $request)
    {
        try {
            $this->numberService->changeOrder($request->all(), $this->numberRepository);
            return RouteHelpers::success_update_response('number');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('number', $e->getMessage());
        }
    }
}
