<?php

Route::group([
        'namespace' => 'MasterAdmin',
        'domain' => '{masterAdminDomain}',
    ], function () {
        Route::get('/', 'HomeController@index');
    }
);


