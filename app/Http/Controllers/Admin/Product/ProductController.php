<?php

namespace App\Http\Controllers\Admin\Product;
use App\Services\Parameters\ParameterService;
use App\Helpers\RouteHelpers;
use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ColorShemesRepository;
use App\Repositories\LangRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TagRepository;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;


class productController extends Controller
{
     public $lang;

    public function __construct(public ParameterService $parameterService, public LangRepository $langRepository, public ProductRepository $productRepository, public ProductService $productService, public CategoryRepository $brandRepository, public ColorShemesRepository $colorShemesRepository, public TagRepository $tagRepository)
    {
             $this->lang = $parameterService->getLang();
    }
   public function index($lang)
    {
        $q = request()->q;
        $page = request()->get('page', 1); // Get the current page from the request, default to 1
   
        if ($q) {
            $products = $this->productRepository->search($q, $lang, 60);
        } else {
            $products = $this->productRepository->all(60);
        }
        $lang = $this->lang;
        $activeCount = $this->productRepository->all_active()->count();
        return view('admin.products.index', compact('lang', 'q', 'products', 'activeCount', 'page'));
    }



    public function create($lang)
    {
         $current_lang = $this->lang;
       
        $colors = $this->colorShemesRepository->all_active();
        $tags = $this->tagRepository->all_active();
        $langs = $this->langRepository->all_active();
        $brands = $this->brandRepository->getAll();
        return view('admin.products.create', compact('lang', 'brands', 'langs', 'colors', 'tags', 'current_lang'));
    }

    public function store(Request $request, $lang)
    {

        $main_model = $this->productRepository->getClassProducts();
        $translate_model = $this->productRepository->getClassProductsTranslates();
        $images_model = $this->productRepository->getClassImage();
        try {
            $this->productService->simple_create($main_model, $translate_model, $images_model, $request);
            return RouteHelpers::success_create('products');
        } catch (\Exception $e) {
            return RouteHelpers::error_create('products', $e->getMessage());
        }
    }

    public function edit($lang, $id)
    {
        $page = request()->get('page', 1);
        $current_lang = $this->lang;
        $tags = $this->tagRepository->all_active();
        $colors = $this->colorShemesRepository->all_active();
        $product = $this->productRepository->findWith($id, 'translates');
        $langs = $this->langRepository->all_active();
        $brands = $this->brandRepository->getAll();
        $selectedColors = $product->colorSchemes->pluck('id')->toArray();
        $selectedTags = $product->tags->pluck('id')->toArray();
        return view('admin.products.edit', compact('lang', 'langs', 'brands', 'product', 'colors', 'selectedColors', 'tags', 'selectedTags', 'current_lang'));
    }
    public function update(Request $request, $lang, $id)
    {

        $page = $request->get('page', 1); // Get the current page from the request, default to 1
   
        try {
            $product = $this->productRepository->findWith($id, 'translates');
            $translate_model = $this->productRepository->getClassProductsTranslates();
            $images_model = $this->productRepository->getClassImage();

            $this->productService->simple_update($product, $translate_model, $images_model, $request, $id);

            return RouteHelpers::success_update('products', $page);
        } catch (\Exception $e) {
            return RouteHelpers::error_update('products', $e->getMessage(), $page);
        }
    }


    public function delete_selected_products(Request $request)
    {
        try {
            $models = $this->productRepository->findWhereInGet($request->ids);
            $this->productService->deleteWhereIn($models);
            return RouteHelpers::success_update_response('products');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('products', $e->getMessage());
        }
    }


    public function changeStatusTrue($id)
    {
        $page = request()->get('page', 1);
        try {
            $model = $this->productRepository->find($id);
            $this->productService->changeStatusTrue($model);
            return RouteHelpers::success_update('products', $page);
        } catch (\Exception $e) {
            return RouteHelpers::error_update('products', $e->getMessage(), $page);
        }
    }

    public function changeStatusFalse($id)
    {
        $page = request()->get('page', 1);
        try {
            $model = $this->productRepository->find($id);
            $this->productService->changeStatusFalse($model);
            return RouteHelpers::success_update('products', $page);
        } catch (\Exception $e) {
            return RouteHelpers::error_update('products', $e->getMessage(), $page);
        }
    }


    public function changeOrder(Request $request)
    {
        try {
            $this->productService->changeOrder($request->all(), $this->productRepository);
            return RouteHelpers::success_update_response('products');
        } catch (\Exception $e) {
            return RouteHelpers::error_delete_response('products', $e->getMessage());
        }
    }


    public function add_images(Request $request, $type, $id)
    {
        $page = request()->get('page');
       
        try {
            $images_model = $this->productRepository->getClassImage();
            $this->productService->handleImages($request, $images_model, $id, 'products', $type);

            return RouteHelpers::success_create('products', $page);
        } catch (\Exception $e) {
            return RouteHelpers::error_create('products', $e->getMessage(), $page);
        }
    }
    public function set_as_main_image($type, $id, $product_id)
    {
$page = request()->get('page', 1);
        try {
            $images_model = $this->productRepository->getClassImage();
            $this->productService->set_as_main_image($images_model, $id, $type, $product_id);

            return RouteHelpers::success_update('products', $page);
        } catch (\Exception $e) {
            return RouteHelpers::error_update('products', $e->getMessage(), $page);
        }
    }


    public function delete_image($id)
    {
        $page = request()->get('page', 1);
        try {
            $result = $this->productService->deleteImage($id, $this->productRepository->getClassImage());
            if ($result['success']) {
                return RouteHelpers::success_delete('products', $page);
            } else {
                return RouteHelpers::error_delete('products',  $result['message'], $page);
            }
        } catch (\Exception $e) {
            return RouteHelpers::error_delete('blog_category',  $e->getMessage(), $page);
        }
    }


}
