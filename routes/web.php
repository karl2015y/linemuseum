<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\MuseumController;
use App\Http\Controllers\ShopController;

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

Route::get('/', function () {
    return view('welcome');
});

// 總管後台 - 總管人員模組
Route::prefix('admin')->group(function () {
    // StaffController
    Route::prefix('staffs')->group(function () {
        // a0001 總管人員頁
        Route::get('/', [StaffController::class, 'StaffsPage'])->name('StaffsPage');
        // a0002 新增總管人員頁
        Route::get('/create', [StaffController::class, 'CreateStaffPage'])->name('CreateStaffPage');
        // a0003 新增總管人員
        Route::post('/create', [StaffController::class, 'CreateStaff'])->name('CreateStaff');
        // a0004 總管人員單頁
        Route::get('/{staff_id}', [StaffController::class, 'StaffPage'])->name('StaffPage');
        // a0005 停用總管人員
        Route::put('/{staff_id}/disable',  [StaffController::class, 'DisableStaff'])->name('DisableStaff');
        // a0006 編輯總管人員頁
        Route::get('/{staff_id}/edit', [StaffController::class, 'EditStaffPage'])->name('EditStaffPage');
        // a0007 修改總管人員資料
        Route::put('/{staff_id}/edit',  [StaffController::class, 'EditStaff'])->name('EditStaff');
    });
    // MuseumController
    Route::prefix('museums')->group(function () {
        // e0001 館舍列表頁
        Route::get('/', [MuseumController::class, 'MuseumsPage'])->name('MuseumsPage');
        // e0002 新增館舍頁
        Route::get('/create', [MuseumController::class, 'CreateMuseumPage'])->name('CreateMuseumPage');
        // e0003 新增館舍
        Route::post('/create', [MuseumController::class, 'CreateMuseum'])->name('CreateMuseum');
        // e0004 館舍單頁
        Route::get('/{museum_id}', [MuseumController::class, 'MuseumPage'])->name('MuseumPage');
        // e0005 封存館舍
        Route::put('/{museum_id}/disable',  [MuseumController::class, 'DisableMuseum'])->name('DisableMuseum');
        // e0006 刪除館舍
        Route::delete('/{museum_id}/delete', [MuseumController::class, 'DeleteMuseum'])->name('DeleteMuseum');
        // e0007 編輯館舍頁
        Route::get('/{museum_id}/edit', [MuseumController::class, 'EditMuseumPage'])->name('EditMuseumPage');
        // e0008 編輯館舍
        Route::put('/{museum_id}/edit',  [MuseumController::class, 'EditMuseum'])->name('EditMuseum');

        // ShopController
        Route::prefix('/{museum_id}/shops')->group(function () {
            // e1001 商家列表頁
            Route::get('/', [ShopController::class, 'ShopsPage'])->name('ShopsPage');
            // e1002 新增商家頁
            Route::get('/create', [ShopController::class, 'CreateShopPage'])->name('CreateShopPage');
            // e1003 新增商家
            Route::post('/create', [ShopController::class, 'CreateShop'])->name('CreateShop');
            // e1004 商家單頁
            Route::get('/{shop_id}', [ShopController::class, 'ShopPage'])->name('ShopPage');
            // e1005 封存商家
            Route::put('/{shop_id}/disable',  [ShopController::class, 'DisableShop'])->name('DisableShop');
            // e1006 刪除商家
            Route::delete('/{shop_id}/delete', [ShopController::class, 'DeleteShop'])->name('DeleteShop');
            // e1007 編輯商家頁
            Route::get('/{shop_id}/edit', [ShopController::class, 'EditShopPage'])->name('EditShopPage');
            // e1008 編輯商家
            Route::put('/{shop_id}/edit',  [ShopController::class, 'EditShop'])->name('EditShop');
        });
        
    });



});



Route::get('register', [LoginController::class, 'signup']); 
Route::get('login', [LoginController::class, 'authenticate']); 
Route::get('me', [LoginController::class, 'getMyData']); 
Route::get('logout', [LoginController::class, 'logout']); 
