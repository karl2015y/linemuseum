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
use App\Http\Controllers\MuseumAdminController;
use App\Http\Controllers\ShopAdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberVoucherController;


// 中間界
use App\Http\Middleware\CheckMuseumIsLogin;
use App\Http\Middleware\CheckShopIsLogin;
use App\Http\Middleware\CheckAdminIsLogin;
use App\Http\Middleware\CheckMemberIsLogin;
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

// 總管後台 - 總管人員模組
Route::middleware(CheckAdminIsLogin::class)->prefix('admin')->group(function () {
    Route::get('/setting', [SettingController::class, 'setConfigPage'])->name('setConfigPage');
    Route::post('/setting', [SettingController::class, 'setConfig'])->name('setConfig');

    // 館舍登入頁
    Route::get('/login', [SettingController::class, 'LoginPage'])->name('AdminLoginPage');
    // 登入驗證
    Route::post('/login', [SettingController::class, 'Login'])->name('AdminLogin');

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
// 館舍後台 MuseumAdminController
Route::middleware(CheckMuseumIsLogin::class)->prefix('museum')->group(function () {
    // f0001 館舍登入頁
    Route::get('/login', [MuseumAdminController::class, 'LoginPage'])->name('MuseumLoginPage');
    // f0002 登入驗證
    Route::post('/login', [MuseumAdminController::class, 'Login'])->name('MuseumLogin');
    // f0003 館舍資料單頁
    Route::get('/', [MuseumAdminController::class, 'MuseumDatasPage'])->name('MuseumDatasPage');
    // f0004 館舍下商家列表
    Route::get('/shops', [MuseumAdminController::class, 'MuseumShopsPage'])->name('MuseumShopsPage');
    // f0005 商家資料單頁
    Route::get('/shops/{shop_id}', [MuseumAdminController::class, 'MuseumShopDatasPage'])->name('MuseumShopDatasPage');
    // f0006 商家消費紀錄列表
    Route::get('/shops/{shop_id}/history', [MuseumAdminController::class, 'MuseumShopHistoryPage'])->name('MuseumShopHistoryPage');
});
// 商家後台 ShopAdminController
Route::middleware(CheckShopIsLogin::class)->prefix('shop')->group(function () {
    // g0001 商家登入頁
    Route::get('/login', [ShopAdminController::class, 'LoginPage'])->name('ShopLoginPage');
    // g0002 登入驗證
    Route::post('/login', [ShopAdminController::class, 'Login'])->name('ShopLogin');
    // g0003 商家資料單頁
    Route::get('/', [ShopAdminController::class, 'ShopDatasPage'])->name('ShopDatasPage');
    // g0004 商家消費紀錄列表
    Route::get('/history', [ShopAdminController::class, 'ShopHistoryPage'])->name('ShopHistoryPage');
    // g0005 商家給消費點頁
    Route::get('/givepoint', [ShopAdminController::class, 'ShopGivePointPage'])->name('ShopGivePointPage');
    // g0006 商家給消費點
    Route::post('/givepoint', [ShopAdminController::class, 'ShopGivePoint'])->name('ShopGivePoint');
});
// 民眾端 MemberController
Route::middleware(CheckMemberIsLogin::class)->prefix('member')->group(function () {
       // h0001 民眾登入頁
    Route::get('/login', [MemberController::class, 'MemberLoginPage'])->name('MemberLoginPage');
    // h0002 登入驗證
    Route::post('/login', [MemberController::class, 'MemberLogin'])->name('MemberLogin');
    // h0003 忘記密碼頁
    Route::get('/forgetpass', [MemberController::class, 'MemberForgetPassPage'])->name('MemberForgetPassPage');
    // h0004 忘記密碼
    Route::post('/forgetpass', [MemberController::class, 'MemberForgetPass'])->name('MemberForgetPass');
    // h0005 註冊頁
    Route::get('/register', [MemberController::class, 'MemberRegisterPage'])->name('MemberRegisterPage');
    // h0006 註冊
    Route::post('/register', [MemberController::class, 'MemberRegister'])->name('MemberRegister');
    // i0001 我的點數頁
    Route::get('/mypoint', [MemberController::class, 'MemberPointPage'])->name('MemberPointPage');
    // i0002 我的點數頁-消費點紀錄
    Route::get('/mypoint/payhistory', [MemberController::class, 'MemberPayHistoryPage'])->name('MemberPayHistoryPage');
    // i0003 我的點數頁-知識點紀錄
    Route::get('/mypoint/KAhistory', [MemberController::class, 'MemberKAHistoryPage'])->name('MemberKAHistoryPage');
    // i0004 我的帳號頁
    Route::get('/myaccount', [MemberController::class, 'MemberAccountPage'])->name('MemberAccountPage');
    // i0005 編輯我的帳號頁
    Route::get('/myaccount/edit', [MemberController::class, 'EditMemberAccountPage'])->name('EditMemberAccountPage');
    // i0007 編輯我的帳號頁
    Route::put('/myaccount/edit', [MemberController::class, 'EditMemberAccount'])->name('EditMemberAccount');

    Route::prefix('voucherstore')->group(function () {
        // i0008 兌換券商店列表頁
        Route::get('/', [MemberController::class, 'VouchersStorePage'])->name('VouchersStorePage');
        // i0009 兌換券商店單頁
        Route::get('/{voucher_id}', [MemberController::class, 'VoucherStorePage'])->name('VoucherStorePage');
        // i0010 購買兌換券
        Route::post('/{voucher_id}/buy', [MemberController::class, 'BuyVoucher'])->name('BuyVoucher');
    });

    Route::prefix('myvoucher')->group(function () {
    // i0011 我的兌換券頁
    Route::get('/', [MemberVoucherController::class, 'MemberVouchersPage'])->name('MemberVouchersPage');
    // i0012 我的已兌換兌換券列表頁
    Route::get('/used', [MemberVoucherController::class, 'MemberUsedVouchersPage'])->name('MemberUsedVouchersPage');
    // i0013 我的已過期兌換券列表頁
    Route::get('/passed', [MemberVoucherController::class, 'MemberPassedVouchersPage'])->name('MemberPassedVouchersPage');
    // i0014 我的未兌換兌換券列表頁
    Route::get('/cancel', [MemberVoucherController::class, 'MemberCanUseVouchersPage'])->name('MemberCanUseVouchersPage');
    // i0015 我的兌換券詳細資料頁
    Route::get('/{voucher_record_id}', [MemberVoucherController::class, 'MemberVoucherPage'])->name('MemberVoucherPage');
    // i0016 兌換對換券頁
    Route::get('/{voucher_record_id}/useVoucher', [MemberVoucherController::class, 'MemberUseVoucherPage'])->name('MemberUseVoucherPage');
    // i0017 兌換對換券
    Route::post('/{voucher_record_id}/useVoucher', [MemberVoucherController::class, 'MemberUseVoucher'])->name('MemberUseVoucher');
    });

});

// Qrcode
Route::get('point/{uuid}', [PointController::class, 'getPoint'])->name('QrcodeGetPoint');


 // 民眾驗證信箱
 Route::get('/verify/{member_id}/{created_at}', [MemberController::class, 'MemberVerifyMail'])->name('MemberVerifyMail');
 // 重設密碼
 Route::get('/resetpw/{member_id}/{created_at}', [MemberController::class, 'MemberResetPasswordPage'])->name('MemberResetPasswordPage');
 Route::post('/resetpw/{member_id}/{created_at}', [MemberController::class, 'MemberResetPassword'])->name('MemberResetPassword');

Route::get('register', [LoginController::class, 'signup']);
Route::get('login', [LoginController::class, 'authenticate']);
Route::get('me', [LoginController::class, 'getMyData']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
