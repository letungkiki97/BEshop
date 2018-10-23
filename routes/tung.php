<?php



    Route::group(array(), function () {
    });


    Route::group(array('prefix'=>'quantri','middleware' => ['sentinel', 'authorized', 'xss_protection'], 'namespace' => 'Users'), function () {


    });





?>