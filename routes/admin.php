<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthenticatedSessionController;
use App\Http\Controllers\Admin\RegisteredUserController;
//////////////////////////////////////////////////////////
// Auth Routes //////////////////////////////////////////
/** BUG => when i register as admin it returns me to user dashboard*/
Route::get('/admin-register', [RegisteredUserController::class, 'create'])
    ->middleware('guest:admin')
    ->name('admin.register');

Route::post('/admin-register', [RegisteredUserController::class, 'store'])
    ->middleware('guest:admin');

Route::get('/admin-login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest:admin')
    ->name('admin.login');

Route::post('/admin-login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest:admin');

Route::post('/admin-logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('admin.logout')
    ->middleware('auth:admin');
////////////////////////////////////////////////////
/// Dashboard Routes //////////////////////////////

Route::middleware('auth:admin')->group(function (){
    Route::get('admin/dashboard', [DashboardController::class, 'create'])
        ->name('admin.dashboard');

    Route::get('admin/dashboard/statistics', [DashboardController::class, 'statistics'])
        ->name('admin.dashboard.statistics');

    Route::get('admin/dashboard/device', [DashboardController::class, 'visited_by_device'])
        ->name('admin.dashboard.device');

    Route::get('admin/dashboard/best-products', [DashboardController::class, 'best_products'])
        ->name('admin.dashboard.best-products');

    Route::get('admin/dashboard/latest-orders', [DashboardController::class, 'latest_orders'])
        ->name('admin.dashboard.latest-orders');

    Route::get('admin/dashboard/order/{order}/{status}', [DashboardController::class, 'update_order'])
        ->name('admin.dashboard.order-update');
});

////////////////////////////////////////////////////
/// Orders Routes /////////////////////////////////

Route::middleware('auth:admin')->group(function (){

    Route::get('admin/orders', [OrdersController::class, 'index'])
        ->name('admin.orders');

    Route::get('admin/orders/get-by-status/{status}', [OrdersController::class, 'get_by_status'])
        ->name('admin.orders.get-by-status');

    Route::get('admin/orders/{order}/{status}', [OrdersController::class, 'order_update'])
        ->name('admin.orders.order-update');

});

////////////////////////////////////////////////////
/// products Routes /////////////////////////////////

Route::middleware('auth:admin')->group(function (){

    Route::get('admin/products', [ProductsController::class, 'index'])
        ->name('admin.products');

    Route::post('admin/products/search', [ProductsController::class, 'search'])
        ->name('admin.products.search');

    Route::get('admin/edit-products/{product}', [ProductsController::class, 'edit_product'])
        ->name('admin.edit-products');

    Route::post('admin/save-edited-product/{product}', [ProductsController::class, 'save_edited_product'])
        ->name('admin.save-edited-product');

    Route::get('admin/delete-product-image/{productImage}', [ProductsController::class, 'delete_product_image'])
        ->name('admin.delete-product-image');

    Route::get('admin/delete-product/{product}', [ProductsController::class, 'delete_product'])
        ->name('admin.delete-product');

});

////////////////////////////////////////////////////
/// category route/////////////////////////////////

Route::middleware('auth:admin')->group(function (){

    Route::get('admin/categories', [CategoriesController::class, 'index'])
        ->name('admin.categories');

    Route::post('admin/categories/search', [CategoriesController::class, 'search'])
        ->name('admin.categories.search');

    Route::get('admin/categories/add', [CategoriesController::class, 'add_category'])
        ->name('admin.categories.add');

    Route::post('admin/categories/save', [CategoriesController::class, 'save_category'])
        ->name('admin.categories.save');

    Route::get('admin/categories/{category}', [CategoriesController::class, 'edit_category'])
        ->name('admin.edit-category');

    Route::post('admin/categories/{category}', [CategoriesController::class, 'save_edited_category'])
        ->name('admin.save-edited-category');

    Route::get('admin/categories/delete/{category}', [CategoriesController::class, 'delete_category'])
        ->name('admin.category.delete');

});

////////////////////////////////////////////////////
///////seller routes ///////////////////////////////
/** Still To See What IS the Website and Certificates ? */
Route::middleware('auth:admin')->group(function (){

    Route::get('admin/sellers', [SellerController::class, 'index'])
        ->name('admin.sellers');

    Route::post('admin/sellers/search', [SellerController::class, 'search'])
        ->name('admin.sellers.search');

});

//////////////////////////////////////////////////////
/// ///customers routes //////////////////////////////

Route::middleware('auth:admin')->group(function (){

    Route::get('admin/customers', [CustomersController::class, 'index'])
        ->name('admin.customers');

    Route::post('admin/customers', [CustomersController::class, 'search'])
        ->name('admin.customers.search');

    Route::get('admin/customers/promote/{user}', [CustomersController::class, 'promote_user_to_admin'])
        ->name('admin.customers.promote');

});


