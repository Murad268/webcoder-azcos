<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\Email;
use App\Models\Number;
use App\Models\Settings;
use App\Services\Parameters\ParameterService;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public $lang;
    public function __construct(public ParameterService $parameterService) {
        $this->lang = $parameterService->getLang();
    }
    public function index() {
        $lang = $this->lang;
        $emails = Email::where('status', 1)->get();
        $numbers = Number::where('status', 1)->get();
        $addresses = Addresses::where('status', 1)->get();
        $settings = Settings::first();
        return view('client.contact_us.index', compact('lang', 'emails', 'numbers', 'addresses', 'settings'));
    }
}
