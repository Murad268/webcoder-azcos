<?php

namespace App\Http\Controllers\Admin\Email;

use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;
use App\Repositories\EmailRepository;
use App\Services\EmailService;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function __construct(public EmailRepository $emailRepository, public EmailService $emailService)
    {
    }
    public function index($lang)
    {
        $q = request()->q;
        if($q) {
            $emails = $this->emailRepository->search($q);
        } else {
            $emails = $this->emailRepository->all();
        }
        $activeemailsCount = $this->emailRepository->all_active()->count();
        return view('admin.emails.index', compact('emails', 'q', 'activeemailsCount','lang'));
    }
    public function create($lang)
    {

        return view('admin.emails.create', compact('lang'));
    }

    public function show()
    {
    }

    public function store(Request $request, $lang)
    {
        try {
            $model = $this->emailRepository->getModel();

            $this->emailService->simple_create($model, $request->all());
            return RouteHelpers::success_create('email');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('email', $e->getMessage());
        }
    }
    public function edit($lang, $id)
    {
        $number = $this->emailRepository->find($id);
        return view('admin.emails.edit', compact('number', 'lang'));
    }

    public function update($lang, $id, Request $request )
    {
        try {
            $number = $this->emailRepository->find($id);

            $this->emailService->simple_update($number, $request->all());
            return RouteHelpers::success_update('email');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('email', $e->getMessage());
        }
    }


    public function changeStatusTrue($id)
    {
        try {
            $model = $this->emailRepository->find($id);
            $this->emailService->changeStatusTrue($model);
            return RouteHelpers::success_update('email');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('email', $e->getMessage());
        }
    }

    public function changeStatusFalse($id)
    {
        try {
            $model = $this->emailRepository->find($id);
            $this->emailService->changeStatusFalse($model);
            return RouteHelpers::success_update('email');
        } catch (\Exception $e) {
            return RouteHelpers::error_update('email', $e->getMessage());
        }
    }

    public function delete_selected_emails(Request $request)
    {
        try {
            $models = $this->emailRepository->findWhereInGet($request->ids);
            $this->emailService->deleteWhereIn($models);
            return RouteHelpers::success_update_response('email');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('email', $e->getMessage());
        }
    }

    public function changeOrder(Request $request)
    {
        try {
            $this->emailService->changeOrder($request->all(), $this->emailRepository);
            return RouteHelpers::success_update_response('email');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('email', $e->getMessage());
        }
    }
}
