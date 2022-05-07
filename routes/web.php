<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\User\ArticleController;
use App\Http\Controllers\User\DemandController;
use Illuminate\Support\Facades\Auth;
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


Route::prefix('admin')->group(function () {
    Route::prefix('regions')->controller(RegionController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::get('/edit/{region_id}', 'edit');
        Route::post('/update/{region_id}', 'update');
        Route::delete('/delete/{region_id}', 'delete');
    });

    Route::prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::delete('/delete/{category_id}', 'delete');
        Route::get('/edit/{category_id}', 'edit');
        Route::post('/store', 'store');
        Route::post('/update/{category_id}', 'update');

    });

    Route::prefix('admins')->controller(AdminController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::delete('/delete/{admin_id}', 'delete');
        Route::get('/edit/{admin_id}', 'edit');
        Route::post('/store', 'store');
        Route::post('/update/{admin_id}', 'update');

    });

});

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::prefix('articles')->controller(ArticleController::class)->group(function () {
        Route::get('/', 'index');
        Route::delete('/delete/{article_id}', 'delete');
        Route::get('/edit/{article_id}', 'edit');
        Route::post('/store', 'store');
        Route::post('/update/{article_id}', 'update');
        Route::post('/picture/{article_id}', 'addPicture');
        Route::delete('/picture/{picture_id}', 'deletePicture');
        Route::get('/{article_id}/pictures', 'pictures');
        Route::get('/given', 'given');
        Route::get('/available', 'available');

    });


});
Route::prefix('user')->group(function () {
    Route::prefix('demands')->controller(DemandController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/store/{article_id}', 'store'); // OK
        Route::get('/edit/{demand_id}', 'edit');
        Route::post('/update/{demand_id}', 'update');
        Route::delete('/delete/{demand_id}', 'delete'); //ok
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
