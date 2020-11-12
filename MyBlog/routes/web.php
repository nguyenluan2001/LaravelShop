<?php

use App\District;
use App\Districts;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Province;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/admin', function () {
    return view('welcome');
});

Auth::routes();

Route::get('admin/home', [AdminDashboardController::class, 'index'])->name('admin.home');

Route::prefix('admin')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('show', [UserController::class, 'show'])->name('user.show');
        Route::get('logout', [UserController::class, 'logout'])->name('logout');
        Route::get('edit/{id}',[UserController::class,'edit'])->name('user.edit');
        Route::post('edit_process/{id}',[UserController::class,'edit_process'])->name('user.edit_process');
        Route::get('delete/{id}',[UserController::class,'delete'])->name('user.delete');

    });
    Route::prefix('page')->group(function(){
        Route::get('show',[AdminPageController::class,'show'])->name('admin.page.show');
        Route::get('add',function(){
            return view('admin/page/add-page');
        })->name('admin.page.add');
        Route::post('add',[AdminPageController::class,'add_process'])->name('admin.page.add_process');
        Route::get('detail/{id}',[AdminPageController::class,'detail'])->name('admin.page.detail');
        Route::get('edit/{id}',[AdminPageController::class,'edit'])->name('admin.page.edit');
        Route::post('edit_process/{id}',[AdminPageController::class,'edit_process'])->name('admin.page.edit_process');
        Route::get('delete/{id}',[AdminPageController::class,'delete'])->name('admin.page.delete');
    });
    Route::prefix('post')->group(function(){
        Route::get('cat/add',[AdminPostController::class,'cat_add'])->name('admin.post.cat.add');
        Route::post('cat/add_process',[AdminPostController::class,'cat_add_process'])->name('admin.post.cat.add_process');
        Route::get('add',[AdminPostController::class,'post_add'])->name('admin.post.add');
        Route::post('add',[AdminPostController::class,'post_add_process'])->name('admin.post.add_process');
        Route::get('show',[AdminPostController::class,'post_show'])->name('admin.post.show');
        Route::get('detail/{id}',[AdminPostController::class,'post_detail'])->name('admin.post.detail');
        Route::get('edit/{id}',[AdminPostController::class,'post_edit'])->name('admin.post.edit');
        Route::post('edit_process/{id}',[AdminPostController::class,'post_edit_process'])->name('admin.post.edit_process');
        Route::get('delete/{id}',[AdminPostController::class,'post_delete'])->name('admin.post.delete');

        Route::post('subcat_process',[AdminPostController::class,'subcat_process'])->name('admin.post.subcat_process');
        Route::post('action',[AdminPostController::class,'action'])->name('admin.post.action');
        Route::post('search',[AdminPostController::class,'search'])->name('admin.post.search');
        Route::get('post_by_cat/{cat_id}',[AdminPostController::class,'post_by_cat'])->name('admin.post.post_by_cat');
        Route::get('post_by_subcat/{cat_id}/{sub_cat_id}',[AdminPostController::class,'post_by_sub_cat'])->name('admin.post.post_by_subcat');
        Route::get('cat/delete/{id}',[AdminPostController::class,'cat_delete'])->name('admin.post.cat.delete');
        Route::get('cat/edit/{id}',[AdminPostController::class,'cat_edit'])->name('admin.post.cat.edit');
        Route::post('cat/edit_process/{id}',[AdminPostController::class,'cat_edit_process'])->name('admin.post.cat.edit_process');
        Route::get('subcat/delete/{id}',[AdminPostController::class,'subcat_delete'])->name('admin.post.subcat.delete');
        Route::get('subcat/edit/{id}',[AdminPostController::class,'subcat_edit'])->name('admin.post.subcat.edit');
        Route::post('subcat/edit_process/{id}',[AdminPostController::class,'subcat_edit_process'])->name('admin.post.subcat.edit_process');

    });
    Route::prefix('product')->group(function(){
        Route::get('show',[AdminProductController::class,'show'])->name('admin.product.show');
        Route::get('add',[AdminProductController::class,'add'])->name('admin.product.add');
        Route::post('add_process',[AdminProductController::class,'add_process'])->name('admin.product.add_process');
        Route::get('edit/{id}',[AdminProductController::class,'edit'])->name('admin.product.edit');
        Route::post('edit_process/{id}',[AdminProductController::class,'edit_process'])->name('admin.product.edit_process');
        Route::get('delete/{id}',[AdminProductController::class,'delete'])->name('admin.product.delete');
        Route::get('cat/add',[AdminProductController::class,'cat_add'])->name('admin.product.cat.add');
        Route::post('cat/add_process',[AdminProductController::class,'cat_add_process'])->name('admin.product.cat.add_process');
        Route::get('cat/delete/{cat_id}',[AdminProductController::class,'cat_delete'])->name('admin.product.cat.delete');
        Route::get('cat/edit/{cat_id}',[AdminProductController::class,'cat_edit'])->name('admin.product.cat.edit');
        Route::post('cat/edit_process/{cat_id}',[AdminProductController::class,'cat_edit_process'])->name('admin.product.cat.edit_process');
        Route::get('subcat/delete/{subcat_id}',[AdminProductController::class,'subcat_delete'])->name('admin.product.subcat.delete');
        Route::get('subcat/edit/{subcat_id}',[AdminProductController::class,'subcat_edit'])->name('admin.product.subcat.edit');
        Route::post('subcat/edit_process/{subcat_id}',[AdminProductController::class,'subcat_edit_process'])->name('admin.product.subcat.edit_process');
        Route::post('add/product_subcat_ajax',[AdminProductController::class,'product_subcat_ajax']);
        Route::get('product_by_subcat/{cat_id}/{subcat_id}',[AdminProductController::class,'product_by_subcat'])->name('admin.product.product_by_subcat');
    
    });
    Route::prefix('order')->group(function(){
        Route::get('show',[AdminOrderController::class,'show'])->name('admin.order.show');
        Route::get('detail/{id}',[AdminOrderController::class,'detail'])->name('admin.order.detail');
        Route::get('delete/{id}',[AdminOrderController::class,'delete'])->name('admin.order.delete');
        Route::post('update_status/{id}',[AdminOrderController::class,'update_status'])->name('admin.order.update_status');
        Route::get('search',[AdminOrderController::class,'search'])->name('admin.order.search');
        Route::get('list_success_order',[AdminOrderController::class,'list_success_order'])->name('admin.order.list_success_order');
        Route::get('list_process_order',[AdminOrderController::class,'list_process_order'])->name('admin.order.list_process_order');
        Route::post('action',[AdminOrderController::class,'action'])->name('admin.order.action');

    });
});

Route::get('/',[MainController::class,'index'])->name('home');
Route::get('products/{cat_id}/{subcat_id})',[ProductController::class,'list_products_by_cat_subcat'])->name('products');
Route::get('products_by_cat/{cat_id})',[ProductController::class,'list_products_by_cat'])->name('products_by_cat');
Route::get('product/detail/{id}',[ProductController::class,'product_detail'])->name('product.detail');
Route::get('product/search',[ProductController::class,'product_search'])->name('product.search');
Route::get('product/{cat_id}/{subcat_id}/filter/',[ProductController::class,'product_filter'])->name('product.filter');
Route::get('cart/add/{id}',[CartController::class,'add'])->name('cart.add');
Route::post('cart/add/{id}',[CartController::class,'add_more_1'])->name('cart.add');
Route::get('cart/show',[CartController::class,'show'])->name('cart.show');
Route::post('cart/qty_ajax',[CartController::class,'qty_ajax']);
Route::get('cart/delete/{rowId?}',[CartController::class,'delete'])->name('cart.delete');
Route::get('cart/checkout',[CartController::class,'checkout'])->name('cart.checkout');
Route::post('cart/district_ajax',[CartController::class,'district_ajax']);
Route::post('cart/ward_ajax',[CartController::class,'ward_ajax']);
Route::post('cart/checkout_process',[CartController::class,'checkout_process'])->name('cart.checkout_process');
Route::get('cart/pay_success/{code}',[CartController::class,'pay_success'])->name('pay_success');


Route::get('page/{id}',[PageController::class,'introduce'])->name('page');
Route::get('blog',[BlogController::class,'list_posts'])->name('blog');
Route::get('blog/{id}',[BlogController::class,'detail'])->name('blog.detail');

