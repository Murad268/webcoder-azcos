<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslates;
use App\Services\Parameters\ParameterService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public $lang;
    public function __construct(public ParameterService $parameterService) {
        $this->lang = $parameterService->getLang();
    }
    public function index() {
        $lang = $this->lang;
        $blogs = Blog::with('category', 'translates')->where('status', 1)->orderBy('views_count')->paginate(9);
        return view('client.blog.index', compact('lang', 'blogs'));
    }
    public function details($lang, $slug) {
        $lang = $this->lang;
        $blogTranslates = BlogTranslates::where('slug', $slug)->first();
        $blog = Blog::with('tags')->where('id', $blogTranslates->blog_id)->first();
        $relatedBlogs = Blog::where('category_id', $blog->category_id)
            ->where('status', 1)
            ->where('id', '!=', $blog->id)
            ->inRandomOrder()
            ->paginate(3);
        return view('client.blog.details', compact('lang', 'blog', 'relatedBlogs'));
    }
    public function increment_views (Request $request) {
        $blog = Blog::findOrFail($request->blog_id);
        $blog->increment('views_count');
        return response(['success' => true]);
    }
}
