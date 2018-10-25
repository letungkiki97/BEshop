<?php

Route::pattern('slug', '[a-zA-Z0-9-]+');
Route::pattern('slug2', '[a-z_]+');
Route::pattern('slug3', '[a-z0-9-_]+');
Route::pattern('id', '[0-9]+');

Route::group(array(), function () {
    /******************   APP routes  ********************************/
    Route::get('/','FrontendController@index');
    Route::get('/san-pham','FrontendController@productall');
    Route::get('/lien-he','FrontendController@contact');
    Route::get('/gioi-thieu','FrontendController@introduce');
    Route::get('/blog','FrontendController@blog');
    Route::get('/search','FrontendController@search');


    /******************   san pham  ********************************/
    Route::get('/productcategory/{slug}','FrontendController@productcategory');
    Route::get('/producttype/{id}','FrontendController@producttype');
    Route::get('/san-pham/{slug}','ProductController@show');
});


Route::group(array('middleware' => ['sentinel', 'xss_protection']), function () {
    Route::get('profile', 'AuthController@getProfile');
    Route::get('account', 'AuthController@getAccount');
    Route::put('account/{user}', 'AuthController@postAccount');
});


Route::group(array('prefix'=>'quantri','as' => 'quantri.'), function () {

    Route::get('/', 'Users\DashboardController@index');
    Route::get('home', 'Users\DashboardController@index');
    Route::get('invite/{slug3}', 'AuthController@getSignup');
    Route::post('invite/{slug3}', 'AuthController@postSignup');
//route after user login into system
    Route::get('signin', 'AuthController@getSignin');
    Route::post('signin', 'AuthController@postSignin');
    Route::get('forgot', 'AuthController@getForgotPassword');
    Route::post('password', 'AuthController@postForgotPassword');
    Route::get('reset_password/{token}', 'AuthController@getReset');
    Route::post('reset_password/{token}', 'AuthController@postReset');
    Route::get('logout', 'AuthController@getLogout');
});

Route::group(array('prefix'=>'quantri','middleware' => ['sentinel', 'admin', 'xss_protection'], 'namespace' => 'Users'), function () {

    Route::get('setting', 'SettingsController@index');
    Route::post('setting', 'SettingsController@update');

    Route::get('content_setting', 'SettingsController@getContent');
    Route::post('content_setting', 'SettingsController@postContent');

    Route::resource('image', 'ImageController');

    Route::group(['prefix' => 'banner'], function () {
        Route::post('upload', 'BannerController@upload');
        Route::post('upload-from-url', 'BannerController@uploadFromUrl');
    });
    Route::resource('banner', 'BannerController');

});

Route::group(array('prefix'=>'quantri','middleware' => ['sentinel', 'authorized', 'xss_protection'], 'namespace' => 'Users'), function () {

    // product group

    Route::group(['prefix' => 'product'], function () {
        Route::get('import', 'ProductController@import');
        Route::post('import', 'ProductController@excelUpdate');
        Route::post('upload', 'ProductController@upload');
        Route::post('upload-from-url', 'ProductController@uploadFromUrl');
        Route::post('suggest', 'ProductController@suggest');
        Route::post('sku', 'ProductController@getSKU');
        Route::post('update-status', 'ProductController@updateStatus');
        Route::post('generate-variantions', 'ProductController@generateVariantions');
        Route::post('save-variantions', 'ProductController@saveVariantions');
        Route::post('restore', 'ProductController@restore');
    });
    Route::resource('product', 'ProductController');

    Route::get('deleted_product', 'ProductController@deleted');

    Route::resource('category', 'CategoryController');

});

include_once 'tien.php';
include_once 'quang.php';
include_once 'tung.php';