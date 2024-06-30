<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Addresses;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Email;
use App\Models\Lang;
use App\Models\Number;
use App\Models\Settings;
use App\Services\Parameters\ParameterService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $lang;
    public function __construct(public ParameterService $parameterService) {
        $this->lang = $parameterService->getLang();
    }

    public function index($lang = null) {


        $brands = Category::with( 'translates')->where('status', 1)->get();
        $about = About::with( 'translates')->first();
        $emails = Email::where('status', 1)->get();
        $numbers = Number::where('status', 1)->get();
        $addresses = Addresses::with( 'translates')->where('status', 1)->get();
        $blogs = Blog::with('category', 'translates')->where('status', 1)->orderBy('views_count')->paginate(3);
        $lang = $this->lang;

        return view('client.home.index', compact('lang', 'brands', 'about','emails', 'numbers', 'addresses', 'blogs'));
    }
}
