<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandTranslates;
use App\Models\Category;
use App\Models\CategoryTranslates;
use App\Models\ColorShemes;
use App\Models\ColorShemesTranslates;
use App\Models\Product;
use App\Models\ProductTranslates;
use App\Models\Tags;
use App\Models\TagsTranslates;
use App\Services\Parameters\ParameterService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request, $lang) {
         $color = $request->color;
       $hasColor = $color?1:0;
     
        $tag = $request->tag;
        if ($tag) {
            $tagTranslation = TagsTranslates::where('slug', $tag)->first();
            if ($tagTranslation) {
                $tag = $tagTranslation->translate;

                $products = $tag->products()->paginate(16);
            } else {
                $products = collect(); // Return an empty collection if tag not found
            }
        } else {
            $products = Product::where('status', 1)->orderBy('order')->paginate(16);
        }

        $brand = $request->brand;
        $brands = Category::orderBy('order')->where('status', 1)->get();
        $tags = Tags::orderBy('order')->where('status', 1)->get();
        $check = 1;

        if ($brand) {
            $categoryTranslation = CategoryTranslates::with('translate')->where('slug', $brand)->first();
            if ($categoryTranslation) {
                $category = $categoryTranslation->translate;
                $selected_tone = $request->color;

                if ($selected_tone) {
                    $toneTranslation = ColorShemesTranslates::with('translate')->where('slug', $selected_tone)->first();
                    if ($toneTranslation) {
                        $current_tone = $toneTranslation->translate;
                        // Ensure we get a query builder instance before calling paginate
                        $productsQuery = $current_tone->products()->where('brand_id', $category->id);
                        $check = 0;
                    } else {
                        $productsQuery = $category->colorSchemes();
                    }
                } else {
                    // Ensure we get a query builder instance before calling paginate
                    $productsQuery = $category->colorSchemes();
                }
                $products = $productsQuery->orderBy('order')->paginate(16);
            } else {
                $products = collect(); // Return an empty collection if brand not found
            }
        }

        return view('client.product.index', compact('lang', 'products', 'brands', 'tags', 'check', 'hasColor'));
    }




    public function details($lang, $slug) {

        $product = ProductTranslates::where('slug', $slug)->first()->translate;
     
        $brand_id = $product->brand_id;
        $products = Product::orderBy('order')->where('status', 1)->where('brand_id', $brand_id)->where('id', '!=', $product->id)->inRandomOrder()->paginate(15);
        return view('client.product.details', compact('lang', 'product', 'products'));
    }

    public function increment_views (Request $request) {
        $product = Product::findOrFail($request->product_id);
        $product->increment('views_count');
        return response(['success' => true]);
    }
}
