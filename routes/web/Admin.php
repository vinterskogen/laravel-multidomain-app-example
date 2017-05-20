<?php

Route::group([
        'namespace' => 'Admin',
        'domain' => '{domain}',
        'prefix' => '/manager',
    ], function() {
        Route::get('/', 'HomeController@index');
    }
);
