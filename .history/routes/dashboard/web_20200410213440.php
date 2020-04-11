<?php
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath',]],function()
{
    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){

        Route::get('/','adminController@index')->name('index');
            //user route
        Route::resource('user', 'UserController');
        Route::resource('category', 'CategoryController');
        Route::resource('product', 'ProductController');
        route::get('exemple',function(){
            return view('dashboard.admineLte.exemple');
        });
        });
    });



