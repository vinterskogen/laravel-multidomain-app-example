<?php

Route::group([
        'namespace' => 'Site',
        'domain' => '{domain}',
        'middleware' => 'checkDomainIsAllowed',
    ], function() {
        Route::get('/', 'HomeController@index');
    }
);


