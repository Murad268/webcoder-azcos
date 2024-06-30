<?php

use App\Http\Controllers\Admin\Categories\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Lang\LangController;
use App\Http\Controllers\Admin\Translates\TranslatesController;
use App\Http\Controllers\Admin\Brands\BrandController;
use App\Http\Controllers\Admin\ColorShemes\ColorShemesController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Number\NumberController;
use App\Http\Controllers\Admin\Email\EmailController;
use App\Http\Controllers\Admin\Addresses\AddressController;
use App\Http\Controllers\Admin\Tags\TagController;
use App\Http\Controllers\Admin\Team\TeamController;
use App\Http\Controllers\Admin\Menu\MenuController;
use App\Http\Controllers\Admin\BlogCategory\BlogCategoryController;
use App\Http\Controllers\Admin\BlogTag\BlogTagController;
use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Admin\Faq\FaqController;
use App\Http\Controllers\Client\ContactFormApiController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\BlogController as ClientBlogController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('/lang', LangController::class);
    Route::get('lang/change_default/{id}', [LangController::class, 'changeDefault'])->name('lang.changeDefault');
    Route::post('lang/delete_selected_langs', [LangController::class, 'delete_selected_langs'])->name('lang.delete_selected_langs');
    Route::post('lang/changeOrder', [LangController::class, 'changeOrder'])->name('lang.changeOrder');



    Route::post('translates/delete_selected_translates', [TranslatesController::class, 'delete_selected_translates'])->name('translates.delete_selected_translates');
    Route::post('translates/update_one_translation', [TranslatesController::class, 'update_one_translation'])->name('translates.update_one_translation');


    Route::post('categories/delete_selected_categories', [CategoryController::class, 'delete_selected_categories'])->name('categories.delete_selected_categories');
    Route::post('categories/changeOrder', [CategoryController::class, 'changeOrder'])->name('categories.changeOrder');


    Route::post('brands/delete_selected_brands', [BrandController::class, 'delete_selected_brands'])->name('brands.delete_selected_brands');
    Route::post('brands/changeOrder', [BrandController::class, 'changeOrder'])->name('brands.changeOrder');



    Route::post('products/delete_selected_products', [ProductController::class, 'delete_selected_products'])->name('products.delete_selected_products');
    Route::post('products/changeOrder', [ProductController::class, 'changeOrder'])->name('products.changeOrder');
 


    Route::post('color_shemes/delete_selected_products', [ColorShemesController::class, 'delete_selected_colors'])->name('color_shemes.delete_selected_colors');
    Route::post('color_shemes/changeOrder', [ColorShemesController::class, 'changeOrder'])->name('color_shemes.changeOrder');


    Route::get('number/change_default/{id}', [NumberController::class, 'changeDefault'])->name('number.changeDefault');
    Route::post('number/delete_selected_numbers', [NumberController::class, 'delete_selected_numbers'])->name('number.delete_selected_numbers');
    Route::post('number/changeOrder', [NumberController::class, 'changeOrder'])->name('number.changeOrder');



    Route::get('email/change_default/{id}', [EmailController::class, 'changeDefault'])->name('email.changeDefault');
    Route::post('email/delete_selected_emails', [EmailController::class, 'delete_selected_emails'])->name('email.delete_selected_emails');
    Route::post('email/changeOrder', [EmailController::class, 'changeOrder'])->name('email.changeOrder');




    Route::post('address/delete_selected_addresses', [AddressController::class, 'delete_selected_addresses'])->name('address.delete_selected_addresses');
    Route::post('address/changeOrder', [AddressController::class, 'changeOrder'])->name('address.changeOrder');



    Route::post('tag/delete_selected_categories', [TagController::class, 'delete_selected_categories'])->name('tag.delete_selected_categories');
    Route::post('tag/changeOrder', [TagController::class, 'changeOrder'])->name('tag.changeOrder');



    Route::post('team/delete_selected_teams', [TeamController::class, 'delete_selected_teams'])->name('team.delete_selected_teams');
    Route::post('team/changeOrder', [TeamController::class, 'changeOrder'])->name('team.changeOrder');



    Route::post('menu/delete_selected_menu_items', [MenuController::class, 'delete_selected_menu_items'])->name('menu.delete_selected_menu_items');



    Route::post('blog_category/delete_selected_categories', [BlogCategoryController::class, 'delete_selected_categories'])->name('blog_category.delete_selected_categories');


    Route::post('blog_tag/delete_selected_categories', [BlogTagController::class, 'delete_selected_categories'])->name('blog_tag.delete_selected_categories');
    Route::post('blog_tag/changeOrder', [BlogTagController::class, 'changeOrder'])->name('blog_tag.changeOrder');



    Route::post('blogs/delete_selected_blogs', [BlogController::class, 'delete_selected_blogs'])->name('blogs.delete_selected_blogs');
    Route::post('blogs/changeOrder', [BlogController::class, 'changeOrder'])->name('blogs.changeOrder');



    Route::post('faq/delete_selected_faqs', [FaqController::class, 'delete_selected_faqs'])->name('faq.delete_selected_faqs');
    Route::post('faq/changeOrder', [FaqController::class, 'changeOrder'])->name('faq.changeOrder');
});
    Route::post('send-contact-form', [ContactFormApiController::class, 'send'])->name('send.contact_form');
    Route::post('products/increment_views', [ClientProductController::class, 'increment_views'])->name('products.increment_views');
    Route::post('blog/increment_views', [ClientBlogController::class, 'increment_views'])->name('blog.increment_views');