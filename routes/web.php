<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\MuseumController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\KnowledgeActivityController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\SettingController;
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
    Route::get('/setting', [SettingController::class, 'setConfigPage'])->name('setConfigPage');
    Route::post('/setting', [SettingController::class, 'setConfig'])->name('setConfig');

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

    // PointController
    Route::prefix('members')->group(function () {
        // c0001 民眾給點列表頁
        Route::get('/', [PointController::class, 'giveMemberPointPage'])->name('giveMemberPointPage');
        Route::get('/{member_id}', [PointController::class, 'memberPointHistoryPage'])->name('memberPointHistoryPage');
        Route::post('/{member_id}', [PointController::class, 'memberGivePoint'])->name('memberGivePoint');
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
        // TODO e0006 刪除館舍
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
            // TODO e1009 消費紀錄列表頁 
            Route::get('/{shop_id}/history', [ShopController::class, 'ShopsHistoryPage'])->name('ShopsHistoryPage');
        });
        // KnowledgeActivityController
        Route::prefix('/{museum_id}/kas')->group(function () {
            // e1001 知識點活動列表頁
            Route::get('/', [KnowledgeActivityController::class, 'KnowledgeActivitiesPage'])->name('KnowledgeActivitiesPage');
            // e1002 新增知識點活動頁
            Route::get('/create', [KnowledgeActivityController::class, 'CreateKnowledgeActivityPage'])->name('CreateKnowledgeActivityPage');
            // e1003 新增知識點活動
            Route::post('/create', [KnowledgeActivityController::class, 'CreateKnowledgeActivity'])->name('CreateKnowledgeActivity');
            // e1004 知識點活動單頁
            Route::get('/{ka_id}', [KnowledgeActivityController::class, 'KnowledgeActivityPage'])->name('KnowledgeActivityPage');
            // e1005 封存知識點活動
            Route::put('/{ka_id}/disable',  [KnowledgeActivityController::class, 'DisableKnowledgeActivity'])->name('DisableKnowledgeActivity');
            // e1006 刪除知識點活動
            Route::delete('/{ka_id}/delete', [KnowledgeActivityController::class, 'DeleteKnowledgeActivity'])->name('DeleteKnowledgeActivity');
            // e1007 編輯知識點活動頁
            Route::get('/{ka_id}/edit', [KnowledgeActivityController::class, 'EditKnowledgeActivityPage'])->name('EditKnowledgeActivityPage');
            // e1008 編輯知識點活動
            Route::put('/{ka_id}/edit',  [KnowledgeActivityController::class, 'EditKnowledgeActivity'])->name('EditKnowledgeActivity');
            // TODO e1009 知識點紀錄列表頁 
            Route::get('/{ka_id}/history', [KnowledgeActivityController::class, 'KnowledgeActivityHistoryPage'])->name('KnowledgeActivityHistoryPage');

        });
    });
    // VoucherController
    Route::prefix('vouchers')->group(function () {
        // b0001 兌換券列表頁
        Route::get('/', [VoucherController::class, 'VouchersPage'])->name('VouchersPage');
        // b0002 新增兌換券頁
        Route::get('/create', [VoucherController::class, 'CreateVoucherPage'])->name('CreateVoucherPage');
        // b0003 新增兌換券
        Route::post('/create', [VoucherController::class, 'CreateVoucher'])->name('CreateVoucher');
        // b0003.5 新增兌換券圖片
        Route::get('/{voucher_id}/pics', [VoucherController::class, 'CreateVoucherPicsPage'])->name('CreateVoucherPicsPage');
        // b0004 新增兌換券的購買方式頁
        Route::get('/{voucher_id}/buyway/create', [VoucherController::class, 'CreateBuyVoucherWayPage'])->name('CreateBuyVoucherWayPage');
        // b0005 新增兌換券的購買方式
        Route::post('/{voucher_id}/buyway/create', [VoucherController::class, 'CreateBuyVoucherWay'])->name('CreateBuyVoucherWay');
        // b0006 刪除兌換券的購買方式
        Route::delete('/{voucher_id}/buyway/{voucher_way_id}/delete', [VoucherController::class, 'DeleteBuyVoucherWay'])->name('DeleteBuyVoucherWay');
        // b0007 兌換券單頁
        Route::get('/{voucher_id}', [VoucherController::class, 'VucherPage'])->name('VucherPage');
        // b0008 封存兌換券
        Route::put('/{voucher_id}/disable',  [VoucherController::class, 'DisableVucher'])->name('DisableVucher');
        // b0009 刪除兌換券
        Route::delete('/{voucher_id}/delete', [VoucherController::class, 'DeleteVucher'])->name('DeleteVucher');
    });
    // CropController
    Route::prefix('pics')->group(function () {
        Route::get('/',  [CropController::class, 'home'])->name('picuploadPage');
        Route::post('upload',  [CropController::class, 'postUpload'])->name('picupload');
        Route::post('crop',  [CropController::class, 'postCrop'])->name('piccrop');
    });
    // DataController
    Route::prefix('datas')->group(function () {
        // d0001 民眾基本列表頁
        Route::get('/members',  [DataController::class, 'MembersPage'])->name('MembersPage');
        // d0002 匯出民眾基本列表
        Route::get('/members/export',  [DataController::class, 'MembersExport'])->name('MembersExport');
        // d0003 兌換券記錄列表頁
        Route::get('/vouchers',  [DataController::class, 'VouchersHistoryPage'])->name('VouchersHistoryPage');
        // d0004 匯出兌換券記錄列表
        Route::get('/vouchers/export',  [DataController::class, 'VouchersHistoryExport'])->name('VouchersHistoryExport');
        // d0005 消耗點數發放列表頁
        Route::get('/paypoint',  [DataController::class, 'PayPointHistoryPage'])->name('PayPointHistoryPage');
        // d0006 匯出消耗點數發放列表
        Route::get('/paypoint/export',  [DataController::class, 'PayPointHistoryExport'])->name('PayPointHistoryExport');
        // d0007 知識點數發放列表頁
        Route::get('/knowledgepoint',  [DataController::class, 'KnowledgePointHistoryPage'])->name('KnowledgePointHistoryPage');
        // d0008 匯出知識點數發放列表
        Route::get('/knowledgepoint/export',  [DataController::class, 'KnowledgePointHistoryExport'])->name('KnowledgePointHistoryExport');
    });
});


Route::get('point/{uuid}', [PointController::class, 'getPoint'])->name('QrcodeGetPoint');;

Route::get('register', [LoginController::class, 'signup']);
Route::get('login', [LoginController::class, 'authenticate']);
Route::get('me', [LoginController::class, 'getMyData']);
Route::get('logout', [LoginController::class, 'logout']);
