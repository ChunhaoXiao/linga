<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\CardFileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PictureThumbController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SensitiveWordController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\ShareController;
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

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/category', CategoryController::class);
    Route::post('/upload', [UploadController::class, 'store']);
    Route::resource('/post', PostController::class);
    //Route::get('/thumb', [PictureThumbController::class, 'store'])->name('thumb');
    Route::resource('/card', CardController::class);
    Route::resource('/cardfile', CardFileController::class);
    Route::get('/config', [ConfigController::class, 'create'])->name('config.create');
    Route::put('/config', [ConfigController::class, 'update'])->name('config.update');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/words', SensitiveWordController::class);
    Route::resource('/comments', CommentController::class);
});

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.showlogin');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');

Route::get('/share', [ShareController::class, 'create']);

Route::post('/upload', function () {
    $f = request()->filepond->store('shares');

    return response()->json(['f' => $f]);
});
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
