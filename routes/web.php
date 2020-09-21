<?php

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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Auth::routes();
Route::group(['namespace' => 'Frontend'],function (){
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('home', 'HomeController@index');

    Route::get('tra-cuu-van-don', 'HomeController@search')->name('search');

    Route::group(['middleware' => 'auth'],function (){
        Route::get('profile', 'HomeController@profile')->name('profile');

        Route::get('tao-don', 'HomeController@createBill')->name('createBill');
        Route::post('tao-don', 'HomeController@saveBill');

        Route::get('ds-don', 'HomeController@listBill')->name('listBill');
        Route::get('getDistrict', 'HomeController@getDistrict')->name('getDistrict');
        Route::get('getWard', 'HomeController@getWard')->name('getWard');
        Route::get('delete-bill/{id}', 'BillController@delete')->name('bill.delete');
        Route::get('seller-rate/{id}/{star}', 'BillController@sellerRate');
        Route::get('customer-rate/{id}/{star}', 'BillController@customerRate');

    });

});

Route::group(['prefix'=>'admin','namespace' => 'Backend','middleware' => ['auth','check_role']],function (){
    Route::get('/', 'HomeController@index')->name('home');
    Route::group(['prefix'=>'bill'],function (){
        Route::get('/', 'BillController@index')->name('admin.bill.index');

        Route::get('view/{id}', 'BillController@view')->name('admin.bill.view');
        Route::get('status/{id}/{status}', 'BillController@status')->name('admin.bill.status');
        Route::post('update/{id}', 'BillController@update')->name('admin.bill.update');

    });
    Route::group(['prefix'=>'staff'],function (){
        Route::get('/', 'UserController@staffList')->name('admin.staff.staffList');
    });
    Route::group(['prefix'=>'city'],function (){
        Route::get('/', 'CityController@staffList')->name('admin.city.index');
    });
    Route::group(['prefix'=>'user'],function (){
        Route::get('/', 'UserController@index')->name('admin.user.index');
        Route::get('seller', 'UserController@seller')->name('admin.user.seller');
        Route::get('create', 'UserController@create')->name('admin.user.create');
        Route::get('profile/{id}', 'UserController@profile')->name('admin.user.profile');
        Route::get('delete/{id}', 'UserController@delete')->name('admin.user.delete');

        Route::post('create', 'UserController@postCreate')->name('admin.user.postCreate');
        Route::post('update/{id}', 'UserController@postUpdate')->name('admin.user.postUpdate');
        Route::post('update-password/{id}', 'UserController@updatePassword')->name('admin.user.updatePassword');
        Route::post('update-avatar/{id}', 'UserController@updateAvatar')->name('admin.user.updateAvatar');
    });
    Route::group(['prefix'=>'province'],function (){
        Route::get('/', 'ProvinceController@index')->name('admin.province.index');
        Route::get('edit/{id}', 'ProvinceController@edit')->name('admin.province.edit');
        Route::get('delete/{id}', 'ProvinceController@delete')->name('admin.province.delete');

        Route::get('district', 'ProvinceController@district')->name('admin.province.district');
        Route::get('district-edit/{id}', 'ProvinceController@districtEdit')->name('admin.district.edit');
        Route::get('district-delete/{id}', 'ProvinceController@districtDelete')->name('admin.district.delete');

        Route::get('ward', 'ProvinceController@ward')->name('admin.province.ward');
        Route::get('ward-edit/{id}', 'ProvinceController@wardEdit')->name('admin.ward.edit');
        Route::get('ward-delete/{id}', 'ProvinceController@wardDelete')->name('admin.ward.delete');

        Route::post('create', 'ProvinceController@create')->name('admin.province.create');
        Route::post('district-create', 'ProvinceController@districtCreate')->name('admin.district.create');
        Route::post('ward-create', 'ProvinceController@wardCreate')->name('admin.ward.create');

        Route::post('update/{id}', 'ProvinceController@update')->name('admin.province.update');
        Route::post('district-update/{id}', 'ProvinceController@districtUpdate')->name('admin.district.update');
        Route::post('ward-update/{id}', 'ProvinceController@wardUpdate')->name('admin.ward.update');


    });
    Route::group(['prefix'=>'report'],function (){
        Route::get('/', 'ReportController@index')->name('admin.report.index');
        Route::get('location', 'ReportController@location')->name('admin.report.location');

    });
});
