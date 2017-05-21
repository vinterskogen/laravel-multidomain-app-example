<?php

Route::group([
        'namespace' => 'Admin',
        'domain' => '{domain}',
        'prefix' => '/manager',
        'middleware' => 'checkDomainIsAllowed',
    ], function () {
        Route::get('/', 'HomeController@index');
    }
);
