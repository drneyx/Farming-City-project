<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// frontend
Route::get('/', function() {
    return redirect('/home');
});
Route::get('/home', 'Frontend\HomeController@index')->name('home');

Route::prefix('cleaning-materials')->group(function() {
    Route::get('/{slug}','Frontend\MainController@index');
    Route::get('cleaning-materials/{slug}','Frontend\MainController@categoryItems');
});

// backend

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function() {
    Route::get('main-categories', 'Backend\CategoryController@mainCategories');
    Route::prefix('categories')->group(function() {
        Route::get('list', 'Backend\CategoryController@index')->name('category');
        Route::post('add', 'Backend\CategoryController@add')->name('add_category');
        Route::put('update/{id}', 'Backend\CategoryController@update')->name('update_category');
        Route::delete('delete/{id}', 'Backend\CategoryController@delete')->name('delete_category');
        Route::get('items/{id}', 'Backend\CategoryController@items')->name('category_items');
    });

    Route::prefix('items')->group(function() {
        Route::get('list', 'Backend\ItemController@index')->name('item');
        Route::post('add', 'Backend\ItemController@add')->name('add_item');
        Route::put('update/{id}', 'Backend\ItemController@update')->name('update_item');
        Route::delete('delete/{id}', 'Backend\ItemController@delete')->name('delete_item');
        Route::get('categories', 'Backend\ItemController@categories')->name('item_categories');
    });

    Route::prefix('gallery')->group(function() {
        Route::get('list', 'Backend\GalleryController@index')->name('gallery');
        Route::get('list/{id}', 'Backend\GalleryController@filteredItems')->name('filtered_gallery');
        // Route::post('add', 'Backend\GalleryController@add')->name('add_gallery');
        // Route::put('update/{id}', 'Backend\GalleryController@update')->name('update_gallery');
        // Route::delete('delete/{id}', 'Backend\GalleryController@delete')->name('delete_gallery');
        // Route::get('categories', 'Backend\GalleryController@categories')->name('gallery_categories');
    });


    Route::prefix('news')->group(function() {
        Route::get('list', 'Backend\NewsController@index')->name('news');
        Route::post('add', 'Backend\NewsController@add')->name('add_news');
        Route::put('update/{id}', 'Backend\NewsController@update')->name('update_news');
        Route::delete('delete/{id}', 'Backend\NewsController@delete')->name('delete_news');
        Route::get('categories', 'Backend\NewsController@categories')->name('news_categories');
    });
});
