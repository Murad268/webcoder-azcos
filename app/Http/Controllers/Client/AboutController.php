<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Team;
use App\Services\Parameters\ParameterService;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public $lang;
    public function __construct(public ParameterService $parameterService) {
        $this->lang = $parameterService->getLang();
    }

    public function index() {
        $lang = $this->lang;
        $about = About::with('translates')->first();
        $team = Team::with('translates')->where('status', 1)->get();
        return view('client.about.index', compact('about', 'lang', 'team'));
    }
}
