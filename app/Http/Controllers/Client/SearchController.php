<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\BrandTranslates;
use App\Models\ColorShemesTranslates;
use App\Models\Product;
use App\Repositories\BlogRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ColorShemesRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function __construct(
        public ProductRepository $productRepository,
        public ColorShemesRepository $colorShemesRepository,
        public BrandRepository $brandRepository,
        public CategoryRepository $categoryRepository,
        public BlogRepository $blogRepository,
    ) {}

    public function index($lang) {
        $q = request('s');
        $perPage = 10; // Number of items per page

        $products = $this->productRepository->searchAll($q)->map(function($item) {
            $item->type = 'product';
            return $item;
        });
        $colors = $this->colorShemesRepository->searchAll($q)->map(function($item) {
            $item->type = 'color';
            return $item;
        });
 
        $brands = $this->brandRepository->searchAll($q)->map(function($item) {
            $item->type = 'brand';
            return $item;
        });

        $categories = $this->categoryRepository->searchAll($q)->map(function($item) {
            $item->type = 'category';
            return $item;
        });

        $blogs = $this->blogRepository->searchAll($q)->map(function($item) {
            $item->type = 'blog';
            return $item;
        });

        // Merge all results into a single collection
        $allResults = $products->merge($colors)->merge($brands)->merge($categories)->merge($blogs);

        // Paginate the merged collection
        $paginatedResults = $this->paginate($allResults, $perPage);


        return view('client.result.index', compact('lang', 'paginatedResults', 'q'));
    }

    protected function paginate(Collection $items, $perPage)
    {
        $page = request()->get('page', 1);
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            $items->slice($offset, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    public function showHairColors($lang, $slug) {
        $perPage = 10; // Number of items per page
        $type = BrandTranslates::where('slug', $slug)->first()->translate;
        $hairColors = Product::withCount('colorSchemes')
            ->having('color_schemes_count', '>', 0)
            ->get()
            ->map(function($item) {
                $item->type = 'blog';
                return $item;
            });

        // Paginate the collection
        $q = $type->getWithLocale($lang)->title;;
        $paginatedResults = $this->paginate($hairColors, $perPage);

        return view('client.result.index', compact('lang', 'paginatedResults', 'q'));
    }

    public function showColors($lang, $slug=null) {
        $perPage = 10; // Number of items per page

        $color = $this->colorShemesRepository->searchAll($slug)->first();
        if($color->products) {
            $products = $color->products->map(function($item) {
                $item->type = 'color';
                return $item;
            });
        }
        

        // Paginate the collection
        $paginatedResults = $this->paginate($products, $perPage);
        $q = $color->getWithLocale($lang)->title;
        return view('client.result.index', compact('lang', 'paginatedResults', 'q'));
    }
}

