<?php

use App\Http\Controllers\Admin\RegionController;
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


Route::prefix('admin')->group(function () {
    Route::prefix('regions')->controller(RegionController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::get('/edit/{region_id}', 'edit');
        Route::post('/update/{region_id}', 'update');
        Route::delete('/delete/{region_id}', 'delete');
    });
});
