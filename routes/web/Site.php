<?php

Route::group([
        'namespace' => 'Site',
        'domain' => '{domain}',
    ], function() {
        Route::get('/', 'HomeController@index');
    }
);


