<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Services\Parameters\ParameterService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public $lang;
    public function __construct(public ParameterService $parameterService) {
        $this->lang = $parameterService->getLang();
    }

    public function index() {
        $lang = $this->lang;
        $faq = Faq::where('status', 1)->get();
        return view('client.faq.index', compact('lang', 'faq'));
    }
}
