<?php
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath',]],function()
{
     Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function()
   // Route::group(['prefix'=>'dashboard','middleware'=>['auth']],function()
    {

        Route::get('/','adminController@index')->name('index');
            //user route
        Route::resource('user', 'UserController');
            //category route
        Route::resource('category', 'CategoryController');
            //Product route
        Route::resource('product', 'ProductController');
            //Client route
        Route::resource('client', 'ClientController');
        Route::resource('Client.order', 'Client\OrderControler');
        });
    });



