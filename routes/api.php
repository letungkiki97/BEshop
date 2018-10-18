<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api', 'middleware' => 'cors'], function ($api) {

    // common
    $api->get('cz_info', 'HomeController@info');
});