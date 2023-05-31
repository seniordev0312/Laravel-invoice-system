<?php
/**
 * Route admin
 */
Route::group(
    [
        'prefix' => SC_ADMIN_PREFIX.'/checkip',
        'middleware' => SC_ADMIN_MIDDLEWARE,
        'namespace' => 'App\Plugins\Other\CheckIP\Admin',
    ], 
    function () {
        Route::get('/', 'AdminController@index')
        ->name('admin_checkip.index');
        Route::get('create', function () {
            return redirect()->route('admin_checkip.index');
        });
        Route::post('/create', 'AdminController@postCreate')->name('admin_checkip.create');
        Route::get('/edit/{id}', 'AdminController@edit')->name('admin_checkip.edit');
        Route::post('/edit/{id}', 'AdminController@postEdit')->name('admin_checkip.edit');
        Route::post('/delete', 'AdminController@deleteList')->name('admin_checkip.delete');
    }
);
