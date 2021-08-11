<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AlterEnvController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/admin')->group(function(){
    // Admin Login
    Route::match(['get', 'post'], '/login', 'AdminLoginController@adminLogin')->name('adminLogin');

    Route::group(['middleware' => 'admin'], function(){
        // Admin Dashboard
        Route::get('/dashboard', 'AdminLoginController@dashboard')->name('adminDashboard');
        // Admin Profile
        Route::get('/profile', 'AdminProfileController@profile')->name('profile');
        // Admin Profile Update
        Route::post('/profile/update/{id}', 'AdminProfileController@profileUpdate')->name('profileUpdate');
        // Admin Password Change
        Route::match(['get', 'post'], '/changePassword/', 'AdminProfileController@changePassword')->name('changePassword');
        // Admin Check Password
        Route::post('/profile/check_password', 'AdminProfileController@checkPassword')->name('checkUserPassword');
        //Admin Theme Settings
        Route::match(['get', 'post'], '/theme/setting', 'AdminProfileController@themeSetting')->name('themeSetting');
        //Admin Mail Settings
        Route::match(['get', 'post'], '/mail/setting', 'AlterEnvController@caller')->name('mailSetting');

        // Category
        Route::get('/category/view', 'CategoryController@index')->name('category.index');
        Route::match(['get', 'post'], '/category/get', 'CategoryController@get')->name('category.get');
        Route::post('/category/store', 'CategoryController@store')->name('category.store');
        Route::post('/category/destroy', 'CategoryController@destroy')->name('category.destroy');

        // Brand
        Route::get('/brand/view', 'BrandController@index')->name('brand.index');
        Route::match(['get', 'post'], '/brand/get', 'BrandController@get')->name('brand.get');
        Route::post('/brand/store', 'BrandController@store')->name('brand.store');
        Route::post('brand/destroy', 'BrandController@destroy')->name('brand.destroy');

        //unit
        Route::get('/unit/view', 'UnitController@index')->name('unit.index');
        Route::match(['get', 'post'], '/unit/get', 'UnitController@get')->name('unit.get');
        Route::post('/unit/store', 'UnitController@store')->name('unit.store');
        Route::post('/unit/destroy', 'UnitController@destroy')->name('unit.destroy');

        // Ware House
        Route::get('/warehouse/view', 'WareHouseController@index')->name('wareHouse.index');
        Route::match(['get', 'post'], '/warehouse/get', 'WareHouseController@get')->name('wareHouse.get');
        Route::post('/warehouse/store', 'WareHouseController@store')->name('wareHouse.store');
        Route::post('/warehouse/destroy', 'WareHouseController@destroy')->name('wareHouse.destroy');

        //Product
        Route::get('/product/view', 'ProductController@index')->name('product.index');
        Route::get('/product/get/', 'ProductController@get')->name('product.get');
        Route::get('/product/get/{id}', 'ProductController@get')->name('product.edit');
        Route::post('/product/destroy', 'ProductController@destroy')->name('product.destroy');
        Route::get('/product/add', 'ProductController@add')->name('product.add');
        Route::post('/product/store', 'ProductController@store')->name('product.store');

        //Product Attribute
        Route::get('/product/{id}/view', 'ProductAttributeController@index')->name('product.attr.index');
        Route::match(['get', 'post'], '/product/{id}/get', 'ProductAttributeController@get')->name('product.attr.get');
        Route::post('/product/attributes/store', 'ProductAttributeController@store')->name('product.attr.store');
        Route::post('/product/attribute/destroy', 'ProductAttributeController@destroy')->name('product.attr.destroy');
    });

    // Admin Logout
    Route::get('/logout', 'AdminLoginController@adminLogout')->name('adminLogout');

    Route::get('/qwe', 'AdminProfileController@qwe')->name('qwe');

    // Forget Password
    Route::match(['get', 'post'], '/forget-password', 'AdminLoginController@forgetPassword')->name('forgetPassword');

});
