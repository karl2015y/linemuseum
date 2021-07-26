<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;

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
    // a0001 總管人員頁
    Route::get('staffs', [StaffController::class, 'StaffsPage'])->name('StaffsPage');
    // a0002 新增總管人員頁
    Route::get('staffs/create', [StaffController::class, 'CreateStaffPage'])->name('CreateStaffPage');
    // a0003 新增總管人員
    Route::post('staffs/create', [StaffController::class, 'CreateStaff'])->name('CreateStaff');
    // a0004 總管人員單頁
    Route::get('staffs/{staff_id}', [StaffController::class, 'StaffPage'])->name('StaffPage');
    // a0005 停用總管人員
    Route::put('staffs/{staff_id}/disable',  [StaffController::class, 'DisableStaff'])->name('DisableStaff');
    // a0006 編輯總管人員頁
    Route::get('staffs/{staff_id}/edit', [StaffController::class, 'EditStaffPage'])->name('EditStaffPage');
    // a0007 修改總管人員資料
    Route::put('staffs/{staff_id}/edit',  [StaffController::class, 'EditStaff'])->name('EditStaff');

});



Route::get('register', [LoginController::class, 'signup']); 
Route::get('login', [LoginController::class, 'authenticate']); 
Route::get('me', [LoginController::class, 'getMyData']); 
Route::get('logout', [LoginController::class, 'logout']); 
