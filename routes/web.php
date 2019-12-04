<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['prefix' => LaravelLocalization::setLocale()], function(){

    Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function (){

        Route::group(['middleware' => ['auth', 'auto-check-permission']], function (){

            Route::get('/', 'HomeController@index')->name('home');
            //admins routes
            Route::resource('user','UserController');
            //roles routes
            Route::resource('role','RoleController');
            //categories routes
            Route::resource('category','CategoryController');
            //products routes
            Route::resource('product','ProductController');
            //clients routes
            Route::resource('client','ClientController');
            //orders routes
            Route::resource('order','OrderController');
            Route::get('order_create/{id}','OrderController@OrderCreate');
            Route::post('order_create/{id}','OrderController@AddOrder');
            Route::get('order/{order}/products','OrderController@Products')->name('show-products');

        });

    });
});

