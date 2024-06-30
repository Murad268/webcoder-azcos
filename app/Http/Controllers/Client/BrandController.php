<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CategoryTranslates;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function details($lang, $slug) {
        $brand  = CategoryTranslates::with('translate')->where('slug', $slug)->first()->translate;
        $products = $brand->products()->with('translates')->orderBy('views_count')->where('status', 1)->paginate(4);
        return view('client.brand.details', compact('lang', 'brand', 'products'));
    }
}
