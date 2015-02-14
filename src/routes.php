<?php
Route::group(
    array(
        'namespace' => 'TypiCMS\Modules\Dashboard\Http\Controllers',
        'prefix'    => 'admin',
    ),
    function () {
        Route::get('/', array( 'as' => 'dashboard', 'uses' => 'AdminController@index'));
    }
);
