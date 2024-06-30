<?php

use App\Http\Controllers\Admin\About\AboutController;
use App\Http\Controllers\Admin\Categories\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Lang\LangController;
use App\Http\Controllers\Admin\Translates\TranslatesController;
use App\Http\Controllers\Admin\Brands\BrandController;
use App\Http\Controllers\Admin\ColorShemes\ColorShemesController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Number\NumberController;
use App\Http\Controllers\Admin\Email\EmailController;
use App\Http\Controllers\Admin\Addresses\AddressController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
USE App\Http\Controllers\Admin\Socials\SocialController;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Admin\Tags\TagController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\AboutController as ClientAboutController;
use App\Http\Controllers\Admin\Team\TeamController;
use App\Http\Controllers\Admin\Menu\MenuController;
use App\Http\Controllers\Admin\BlogCategory\BlogCategoryController;
USE App\Http\Controllers\Admin\BlogTag\BlogTagController;
use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Admin\Faq\FaqController;
use App\Http\Controllers\Client\BlogController as ClientBlogController;
use App\Http\Controllers\Client\BrandController as ClientBrandController;
use App\Http\Controllers\Client\ContactUsController;
use App\Http\Controllers\Client\FaqController as ClientFaqController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\SearchController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['customAuth'])->group(function () {
    Route::get('/admin1', [AuthController::class, 'index'])->name('admin.auth.index');
    Route::post('/admin/log', [AuthController::class, 'login'])->name('admin.auth.login');
});
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.auth.logout');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('{lang?}/dashboard', [DashboardController::class, 'index'])->name('index');


    Route::resource('/lang', LangController::class);
    Route::get('lang/change_default/{id}', [LangController::class, 'changeDefault'])->name('lang.changeDefault');
    Route::get('lang/change_status_true/{id}', [LangController::class, 'changeStatusTrue'])->name('lang.changeStatusTrue');
    Route::get('lang/change_status_false/{id}', [LangController::class, 'changeStatusFalse'])->name('lang.changeStatusFalse');



    Route::resource('/{lang?}/translates', TranslatesController::class);



    Route::resource('/{lang?}/categories', CategoryController::class);
    Route::get('categories/change_status_true/{id}', [CategoryController::class, 'changeStatusTrue'])->name('categories.changeStatusTrue');
    Route::get('categories/change_status_false/{id}', [CategoryController::class, 'changeStatusFalse'])->name('categories.changeStatusFalse');
    Route::post('categories/add_images/{type}/{id}', [CategoryController::class, 'add_images'])->name('categories.add_images');
    Route::get('categories/delete_image/{id}', [CategoryController::class, 'delete_image'])->name('categories.delete_image');


    Route::resource('/{lang?}/color_schemes', ColorShemesController::class);
    Route::get('color_schemes/change_status_true/{id}', [ColorShemesController::class, 'changeStatusTrue'])->name('color_schemes.changeStatusTrue');
    Route::get('color_schemes/change_status_false/{id}', [ColorShemesController::class, 'changeStatusFalse'])->name('color_schemes.changeStatusFalse');
    Route::post('color_schemes/add_images/{type}/{id}', [ColorShemesController::class, 'add_images'])->name('color_schemes.add_images');
    Route::get('color_schemes/delete_image/{id}', [ColorShemesController::class, 'delete_image'])->name('color_schemes.delete_image');




    Route::resource('/{lang?}/brands', BrandController::class);
    Route::get('brands/change_status_true/{id}', [BrandController::class, 'changeStatusTrue'])->name('brands.changeStatusTrue');
    Route::get('brands/change_status_false/{id}', [BrandController::class, 'changeStatusFalse'])->name('brands.changeStatusFalse');
    Route::post('brands/add_images/{type}/{id}', [BrandController::class, 'add_images'])->name('brands.add_images');
    Route::get('brand/delete_image/{id}', [BrandController::class, 'delete_image'])->name('brands.delete_image');






    Route::resource('/{lang?}/products', ProductController::class);
    Route::get('products/change_status_true/{id}', [ProductController::class, 'changeStatusTrue'])->name('products.changeStatusTrue');
    Route::get('products/change_status_false/{id}', [ProductController::class, 'changeStatusFalse'])->name('products.changeStatusFalse');
    Route::post('products/add_images/{type}/{id}', [ProductController::class, 'add_images'])->name('products.add_images');
    Route::get('products/set_as_main_image/{type}/{id}/{product_id}', [ProductController::class, 'set_as_main_image'])->name('products.set_as_main_image');
    Route::get('products/delete_image/{id}', [ProductController::class, 'delete_image'])->name('products.delete_image');



    Route::resource('/{lang?}/about', AboutController::class);
    Route::post('about/add_images/{type}/{id}', [AboutController::class, 'add_images'])->name('about.add_images');
    Route::get('about/delete_image/{id}', [AboutController::class, 'delete_image'])->name('about.delete_image');





    Route::resource('/{lang?}/number', NumberController::class);
    Route::get('number/change_status_true/{id}', [NumberController::class, 'changeStatusTrue'])->name('number.changeStatusTrue');
    Route::get('number/change_status_false/{id}', [NumberController::class, 'changeStatusFalse'])->name('number.changeStatusFalse');


    Route::resource('/{lang?}/email', EmailController::class);
    Route::get('email/change_status_true/{id}', [EmailController::class, 'changeStatusTrue'])->name('email.changeStatusTrue');
    Route::get('email/change_status_false/{id}', [EmailController::class, 'changeStatusFalse'])->name('email.changeStatusFalse');





    Route::resource('/{lang?}/address', AddressController::class);
    Route::get('address/change_status_true/{id}', [AddressController::class, 'changeStatusTrue'])->name('address.changeStatusTrue');
    Route::get('address/change_status_false/{id}', [AddressController::class, 'changeStatusFalse'])->name('address.changeStatusFalse');
    Route::post('address/add_images/{type}/{id}', [AddressController::class, 'add_images'])->name('address.add_images');
    Route::get('address/delete_image/{id}', [AddressController::class, 'delete_image'])->name('address.delete_image');


    Route::resource('/{lang?}/socials', SocialController::class);



    Route::resource('/{lang?}/settings', SettingsController::class);
    Route::post('settings/add_images/{type}/{id}', [SettingsController::class, 'add_images'])->name('settings.add_images');
    Route::get('settings/delete_image/{id}', [SettingsController::class, 'delete_image'])->name('settings.delete_image');



    Route::resource('/{lang?}/tag', TagController::class);
    Route::get('tag/change_status_true/{id}', [TagController::class, 'changeStatusTrue'])->name('tag.changeStatusTrue');
    Route::get('tag/change_status_false/{id}', [TagController::class, 'changeStatusFalse'])->name('tag.changeStatusFalse');
    Route::post('tag/add_images/{type}/{id}', [TagController::class, 'add_images'])->name('tag.add_images');
    Route::get('tag/delete_image/{id}', [TagController::class, 'delete_image'])->name('tag.delete_image');










    Route::resource('/{lang?}/team', TeamController::class);
    Route::get('team/change_status_true/{id}', [TeamController::class, 'changeStatusTrue'])->name('team.changeStatusTrue');
    Route::get('team/change_status_false/{id}', [TeamController::class, 'changeStatusFalse'])->name('team.changeStatusFalse');
    Route::post('team/add_images/{type}/{id}', [TeamController::class, 'add_images'])->name('team.add_images');
    Route::get('team/delete_image/{id}', [TeamController::class, 'delete_image'])->name('team.delete_image');







    Route::resource('/{lang?}/menu', MenuController::class);


    Route::resource('/{lang?}/blog_category', BlogCategoryController::class);
    Route::get('blog_category/change_status_true/{id}', [BlogCategoryController::class, 'changeStatusTrue'])->name('blog_category.changeStatusTrue');
    Route::get('blog_category/change_status_false/{id}', [BlogCategoryController::class, 'changeStatusFalse'])->name('blog_category.changeStatusFalse');



    Route::resource('/{lang?}/blog_tag', BlogTagController::class);
    Route::get('blog_tag/change_status_true/{id}', [BlogTagController::class, 'changeStatusTrue'])->name('blog_tag.changeStatusTrue');
    Route::get('blog_tag/change_status_false/{id}', [BlogTagController::class, 'changeStatusFalse'])->name('blog_tag.changeStatusFalse');
    Route::post('blog_tag/add_images/{type}/{id}', [BlogTagController::class, 'add_images'])->name('blog_tag.add_images');
    Route::get('blog_tag/delete_image/{id}', [BlogTagController::class, 'delete_image'])->name('blog_tag.delete_image');









    Route::resource('/{lang?}/blogs', BlogController::class);
    Route::get('blogs/change_status_true/{id}', [BlogController::class, 'changeStatusTrue'])->name('blogs.changeStatusTrue');
    Route::get('blogs/change_status_false/{id}', [BlogController::class, 'changeStatusFalse'])->name('blogs.changeStatusFalse');
    Route::post('blogs/add_images/{type}/{id}', [BlogController::class, 'add_images'])->name('blogs.add_images');
    Route::get('blogs/delete_image/{id}', [BlogController::class, 'delete_image'])->name('blogs.delete_image');





    Route::resource('/{lang?}/faq', FaqController::class);
    Route::get('faq/change_status_true/{id}', [FaqController::class, 'changeStatusTrue'])->name('faq.changeStatusTrue');
    Route::get('faq/change_status_false/{id}', [FaqController::class, 'changeStatusFalse'])->name('faq.changeStatusFalse');
    Route::post('faq/add_images/{type}/{id}', [FaqController::class, 'add_images'])->name('faq.add_images');
    Route::get('faq/delete_image/{id}', [FaqController::class, 'delete_image'])->name('faq.delete_image');
});




$aboutSlug = \App\Facades\MenuListUtility::getMenuSlug('about');
$homeSlug = \App\Facades\MenuListUtility::getMenuSlug('home');
$contactSlug = \App\Facades\MenuListUtility::getMenuSlug('contact');
$faqSlug = \App\Facades\MenuListUtility::getMenuSlug('faq');
$blogSlug = \App\Facades\MenuListUtility::getMenuSlug('blogs');
$productSlug = \App\Facades\MenuListUtility::getMenuSlug('products');
$brandSlug = \App\Facades\MenuListUtility::getMenuSlug('brands');
$searchSlug = \App\Facades\MenuListUtility::getMenuSlug('search');
$searchColorSlug = \App\Facades\MenuListUtility::getMenuSlug('colors');
Route::group(['prefix' => '', 'as' => 'front.'], function () use ($aboutSlug, $homeSlug, $contactSlug, $faqSlug, $blogSlug,$productSlug, $brandSlug, $searchSlug, $searchColorSlug ) {
    Route::get('{lang?}/'.$homeSlug, [HomeController::class, 'index'])->name('index');
    Route::get('{lang?}/' . $aboutSlug, [ClientAboutController::class, 'index'])->name('about.index');
    Route::get('{lang?}/'.$blogSlug, [ClientBlogController::class, 'index'])->name('blog.index');
    Route::get('{lang?}/'.$blogSlug.'/{slug}', [ClientBlogController::class, 'details'])->name('blogs.details');
    Route::get('{lang?}/'.$brandSlug.'/{slug}', [ClientBrandController::class, 'details'])->name('brand.details');
    Route::get('{lang?}/'.$contactSlug, [ContactUsController::class, 'index'])->name('contact.index');
    Route::get('{lang?}/'.$faqSlug, [ClientFaqController::class, 'index'])->name('faq.index');
    Route::get('{lang?}/'.$productSlug, [ClientProductController::class, 'index'])->name('product.index');
    Route::get('{lang?}/'.$productSlug.'/{slug}', [ClientProductController::class, 'details'])->name('product.details');
    Route::get('{lang?}/'.$searchSlug, [SearchController::class, 'index'])->name('site.search');
    Route::get('{lang?}/'.$searchSlug.'/{slug}', [SearchController::class, 'showHairColors'])->name('site.showHairColors');
    Route::get('{lang?}/'.$searchColorSlug.'/{slug?}', [SearchController::class, 'showColors'])->name('site.showColors');
});

