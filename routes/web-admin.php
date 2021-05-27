<?php


/**
 * Admin route here (Backend)
 */

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AuthenticateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    // authenticate
    Route::get('auth/login', [AuthenticateController::class, 'showLoginForm'])
    ->name('admin.login')->middleware('logged-out');
    Route::post('auth/login', [AuthenticateController::class, 'login'])->middleware('logged-out');
    Route::get('auth/forgot-password', [AuthenticateController::class, 'forgotPasswordForm'])->middleware('guest');
    Route::post('auth/forgot-password', [AuthenticateController::class, 'forgotPassword'])->middleware('guest');
    Route::get('auth/reset-password/{token}', [AuthenticateController::class, 'resetPasswordForm'])->middleware('guest');
    Route::put('auth/reset-password', [AuthenticateController::class, 'resetPassword'])->middleware('guest');

    Route::group(['middleware' => 'authenticated-as-admin'], function () {
        Route::get('auth/logout', function () {
            Auth::logout();
            return redirect(route('admin.login'));
        });

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
        })->name('admin.index');


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
});
