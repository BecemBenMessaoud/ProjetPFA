<?php

use App\Http\Controllers\User\ArticleController;
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
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'regions'], function () {
        Route::get('/', ['App\Http\Controllers\Admin\RegionController', 'index']);
        Route::get('/create', ['App\Http\Controllers\Admin\RegionController', 'create']);
        Route::post('/store', ['App\Http\Controllers\Admin\RegionController', 'store']);
        Route::get('/edit/{region_id}', ['App\Http\Controllers\Admin\RegionController', 'edit']);
        Route::post('/update/{region_id}', ['App\Http\Controllers\Admin\RegionController', 'update']);
        Route::delete('/delete/{region_id}', ['App\Http\Controllers\Admin\RegionController', 'delete']);
    });
});


Route::group(['prefix' => 'user'], function () {

    Route::group(['prefix' => 'article'], function () {
        Route::post('/', [ArticleController::class, 'create']);
        Route::delete('/{article_id}', [ArticleController::class, 'delete']);
    });

    Route::group(['prefix' => 'demand'], function () {
        // demand routes
    });


});
