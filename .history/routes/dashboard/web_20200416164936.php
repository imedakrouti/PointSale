<?php
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath',]],function()
{
    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){

        Route::get('/','adminController@index')->name('index');
            //user route
        Route::resource('user', 'UserController');
            //category route
        Route::resource('category', 'CategoryController');
        Route::resource('product', 'ProductController');
        Route::resource('client', 'ClientController');
        });
    });



