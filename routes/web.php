<?php

use Illuminate\Support\Facades\Artisan;
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

Route::get('optimize', function() {
    Artisan::call('optimize');
});

// frontend

Route::get('/', 'Frontend\HomeController@index')->name('home');

Route::prefix('cleaning-materials')->group(function() {
    Route::get('/{slug}','Frontend\MainController@index');
    Route::get('cleaning-materials/{slug}','Frontend\MainController@categoryItems');
});

Route::prefix('food-and-beverage')->group(function() {
    Route::get('/{slug}','Frontend\MainController@index');
    Route::get('cleaning-materials/{slug}','Frontend\MainController@categoryItems');
});

Route::prefix('laboratory-equipment-and-supplies')->group(function() {
    Route::get('/{slug}','Frontend\MainController@index');
    Route::get('cleaning-materials/{slug}','Frontend\MainController@categoryItems');
});

Route::prefix('sports-and-games')->group(function() {
    Route::get('/{slug}','Frontend\MainController@index');
    Route::get('cleaning-materials/{slug}','Frontend\MainController@categoryItems');
});

Route::prefix('others')->group(function() {
    Route::get('/{slug}','Frontend\MainController@index');
    Route::get('cleaning-materials/{slug}','Frontend\MainController@categoryItems');
});

Route::prefix('item-details')->group(function() {
    Route::get('/{slug}','Frontend\MainController@detail');
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
        Route::get('edit/{id}', 'Backend\ItemController@edit')->name('edit_item');
        Route::put('update/{id}', 'Backend\ItemController@update')->name('update_item');
        Route::delete('delete/{id}', 'Backend\ItemController@delete')->name('delete_item');
        Route::get('categories', 'Backend\ItemController@categories')->name('item_categories');
    });

    Route::prefix('gallery')->group(function() {
        Route::get('list', 'Backend\GalleryController@index')->name('gallery');
        Route::get('list/{id}', 'Backend\GalleryController@filteredItems')->name('filtered_gallery');
        // Route::post('add', 'Backend\GalleryController@add')->name('add_gallery');
        // Route::put('update/{id}', 'Backend\GalleryController@update')->name('update_gallery');
        Route::delete('delete/{id}', 'Backend\GalleryController@delete')->name('delete_gallery');
        Route::post('/changeImage/{id}', 'Backend\GalleryController@editImage')->name('edit_gallery');
        // Route::get('categories', 'Backend\GalleryController@categories')->name('gallery_categories');
    });


    Route::prefix('news')->group(function() {
        Route::get('list', 'Backend\NewsController@index')->name('news');
        Route::post('add', 'Backend\NewsController@add')->name('add_news');
        Route::get('edit/{id}', 'Backend\NewsController@edit')->name('edit_news');
        Route::post('/changeImage/{id}', 'Backend\NewsController@editImage')->name('edit_image');
        Route::put('update/{id}', 'Backend\NewsController@update')->name('update_news');
        Route::delete('delete/{id}', 'Backend\NewsController@delete')->name('delete_news');
        Route::get('categories', 'Backend\NewsController@categories')->name('news_categories');
    });
});
