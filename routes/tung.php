<?php



Route::group(array(), function () {
});


Route::group(array('prefix'=>'quantri','middleware' => ['sentinel', 'authorized', 'xss_protection'], 'namespace' => 'Users'), function () {


	Route::group(['prefix' => 'order'], function () {
        Route::get('import', 'OrderController@import');
        Route::post('import', 'OrderController@excelUpdate');
        Route::post('currency', 'OrderController@currency');
        Route::post('move', 'OrderController@move');
        Route::post('add-stock', 'OrderController@addStock');
    });
	Route::resource('order', 'OrderController');



});


?>