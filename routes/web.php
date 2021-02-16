<?php

use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PictureThumbController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\ChargeController;
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

// Route::get('/', function () {
//     return view('');
// });
Route::get('/charge', [ChargeController::class, 'create'])->name('charge');
Route::post('/charge', [ChargeController::class, 'store'])->name('charge.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [IndexController::class, 'index']);
    Route::resource('/category', CategoryController::class);
    Route::post('/upload', [UploadController::class, 'store']);
    Route::resource('/post', PostController::class);
    Route::get('/thumb', [PictureThumbController::class, 'store'])->name('thumb');
    Route::resource('/card', CardController::class);
});
