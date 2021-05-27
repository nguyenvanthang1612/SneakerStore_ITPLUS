<?php
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AuthenticateController as AdminAuthenticateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Web\AuthenticateController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\WebCategoryController;
use App\Http\Controllers\Web\WebIndexController;
use App\Http\Controllers\Web\RegisterController;
use App\Http\Controllers\Web\WebProductController;

use App\Http\Controllers\Web\WebUserAddressController;

use App\Http\Middleware\Admin\CheckUser;

use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;
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

/**
 * Frontend routes here
 */
Route::group(['prefix' => '/'], function () {

    Route::get('/', [WebIndexController::class, 'index']);
    //index - register - edit
    Route::get('user/index-page/{id}',[WebIndexController::class,'mainUserIndex']);

    Route::get('user/edit-page/{id}', [WebIndexController::class,'edit']);
    Route::put('user/edit-page/{id}', [WebIndexController::class,'update']);

    Route::get('user/address-edit-page/{id}', [WebIndexController::class,'addressEdit']);
    Route::put('user/address-edit-page/{id}', [WebIndexController::class,'addressUpdate']);
    //Cart
    Route::get('/addCart/{id}', [CartController::class,'addCart']);
    Route::get('deleteItemCart/{id}', [CartController::class,'deleteItemCart']);
    //Category
    Route::get('categories/{id}/shop-list', [WebCategoryController::class,'index']);
    //Product
    Route::get('products/{id}/item', [WebProductController::class, 'itemIndex'])->name('product-item');
    Route::get('products/categories/{id}/list', [WebProductController::class, 'listIndex'])->name('product-categories-list');
    // authenticate
    Route::get('/login', [AuthenticateController::class, 'showLoginForm']);
    Route::post('/login', [AuthenticateController::class, 'login'])->name('user.login');
    Route::get('register', [AuthenticateController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthenticateController::class, 'register'])->name('register');

    Route::get('/logout', function() {
        Auth::logout();
        return redirect('/');
    });

});
/**
 * Admin route here (Backend)
 */
Route::group(['prefix' => 'admin'], function () {
    // authenticate
    Route::get('auth/login', [AdminAuthenticateController::class, 'showLoginForm'])
    ->name('admin.login')->middleware('CheckLogout');
    Route::post('auth/login', [AdminAuthenticateController::class, 'login']);
    Route::get('auth/logout', function() {
        Auth::logout();
        return redirect(route('admin.login'));
    })->middleware('CheckUser');

    //dashboard
    Route::get('/', function () {
        $orders = DB::table('orders')->count();
        $totalPrice = DB::table('orders')->sum('price');
        $clientAccount = DB::table('users')->where('role', 3)->count();
        return view('backend.index', [
            'orders' => $orders,
            'totalPrice' => $totalPrice,
            'clientAccount' => $clientAccount
        ]);
    })->name('admin.index')->middleware('CheckUser');


    // account
    Route::get('account/admin_management', [AccountController::class, 'adminIndex'])->middleware('CheckPermission');
    Route::get('account/client_management', [AccountController::class, 'clientIndex']);
    Route::get('account/create_account', [AccountController::class, 'showCreateAccountForm'])->middleware('CheckPermission');
    Route::post('account/create_account', [AccountController::class, 'createAccountAdmin']);
    Route::put('account/admin_management', [AccountController::class, 'upload']);
    Route::get('account/edit', [AccountController::class, 'edit']);
    Route::put('account/edit/{id}', [AccountController::class, 'update']);
    Route::delete('account/delete/{id}', [AccountController::class, 'destroy']);
    Route::get('account/change-password', [AccountController::class, 'showChangePasswordForm']);
    Route::put('account/change-password/{id}', [AccountController::class, 'changePassword']);

    //category
    Route::get('categories', [CategoryController::class, 'index']);

    //product
    Route::get('product', [ProductController::class, 'allIndex'])->name('product.index');
    Route::get('product/man', [ProductController::class, 'manIndex']);
    Route::get('product/woman', [ProductController::class, 'womanIndex']);
    Route::get('product/kid', [ProductController::class, 'kidIndex']);
    Route::get('product/create', [ProductController::class, 'create']);
    Route::post('product', [ProductController::class, 'store']);
    Route::put('product', [ProductController::class, 'upload']);
    Route::get('product/{id}/edit', [ProductController::class, 'edit']);
    Route::put('product/{id}', [ProductController::class, 'update']);
    Route::delete('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    // search
    Route::post('product/search', [ProductController::class, 'searchAll']);
    Route::post('product/search/man', [ProductController::class, 'searchMan']);
    Route::post('product/search/woman', [ProductController::class, 'searchWoman']);
    Route::post('product/search/kid', [ProductController::class, 'searchKid']);

    //order
    Route::get('order', [OrderController::class, 'index']);
    Route::get('order/{id}/detail', [OrderController::class, 'show']);

});
