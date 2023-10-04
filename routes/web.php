<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
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

Route::get('/',[HomeController::class,'index']);
Route::get('country-company-data/{id}',[HomeController::class,"getData"]);
Route::get("/admin",[AdminController::class,'login'])->name('login')->middleware('guest');
Route::post('admin/login',[AdminController::class,'customLogin'])->name('admin.login');

Route::middleware("auth")->group(function () {
    Route::get("dashboard",[AdminController::class,'index']);
    Route::post("admin/logout",[AdminController::class,'logout'])->name('admin.signout');
    Route::get('/create/company',[AdminController::class,'create'])->name('crete.company');
    Route::post('/save/company',[AdminController::class,'store_company'])->name('company.save');
    Route::get('/add/country',[AdminController::class,'show_country'])->name('countryLists.show');
    Route::post('/store/country',[AdminController::class,'store_country'])->name('country.save');
    Route::get('/view/parcel-service',[AdminController::class,'country_settings'])->name('countrySettings.show');
    Route::post('/store/parcel-service',[AdminController::class,'countrySettings'])->name('countrySettings.save');
    Route::post('/settings/general',[AdminController::class,'generalSettings'])->name('general_settings');
    Route::get('/settings/security',[AdminController::class,'securitySettings'])->name('security.show');
    Route::post('/save/security',[AdminController::class,'saveSecurity'])->name('security.save');
    Route::get('/edit/company/{id}',[AdminController::class,'edit_company']);
    Route::post('/update/company/{id}',[AdminController::class,'update_company'])->name('company.update');
    Route::get('delete/company/{id}',[AdminController::class,'delete_company'])->name('company.delete');
    Route::get('delete/service/{id}',[AdminController::class,'delete_service'])->name('service.delete');
    Route::get('/check/company/{company_check_id}/{country_id}',[AdminController::class,'check_company'])->name('company.check');
    Route::get('/edit/company/service/{countrySetting_id}',[AdminController::class,'edit_countrySettings'])->name('countrySettings.edit');
    Route::post('/update/countrySettings/{countrySetting_id}',[AdminController::class,'save_countrySettings'])->name('countrySettingsSave');
    Route::get('/edit/country/{id}',[AdminController::class,'edit_country'])->name('edit_country');
    Route::post('/update/country/{id}',[AdminController::class,'updateCountry'])->name('storeCountry');
    Route::get('/edit/security/{id}',[AdminController::class,'editSecurity'])->name('editSecurity');
    Route::post('/update/security/{id}',[AdminController::class,'updateSecurity'])->name('updateSecurity');
    Route::get('delete/security/{id}',[AdminController::class,'delete_security'])->name('security.delete');



    /**
     * 
     * Api Related Controller
     */

     Route::get('/view/api/users',[ApiController::class,'index'])->name('api_users.view');
     Route::post('/create/api/users',[ApiController::class,'create'])->name('api_user.save');
     Route::get('/delete/api/user/{id}',[ApiController::class,'delete'])->name('api_user.delete');
     Route::get('/edit/api/user/{id}',[ApiController::class,'edit'])->name('api_user.edit');
     Route::post('/update/api/user/{id}',[ApiController::class,'update'])->name('api_user.update');

     Route::get('/ip/add',[ApiController::class,'ip_add'])->name('ip.add');
     Route::post('/ip/create',[ApiController::class,'ip_create'])->name('ip.create');
     Route::get('/edit/api/user/ip/{id}',[ApiController::class,'ip_edit'])->name('ip.edit');
     Route::get('/edit/ip/active/{id}',[ApiController::class,'edit_status_active'])->name('ip_check.active');
     Route::get('/edit/ip/disable/{id}',[ApiController::class,'edit_status_disable'])->name('ip_check.disable');
});
