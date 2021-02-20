<?php
/*
 * @Description:
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2020-09-20 13:10:43
 */

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CollectController;
use App\Http\Controllers\Api\FeedController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\IndexSwiperController;
use App\Http\Controllers\Api\LikeCommentController;
use App\Http\Controllers\Api\LikePostController;
use App\Http\Controllers\Api\MyCollectionController;
use App\Http\Controllers\Api\MyCommentController;
use App\Http\Controllers\Api\MyLikeController;
use App\Http\Controllers\Api\MyShareController;
use App\Http\Controllers\Api\PostCommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RecommendController;
use App\Http\Controllers\Api\UnreadFeedCountController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\UserRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/auth', [AuthController::class, 'store']);
Route::middleware('auth:api')->group(function () {
    Route::get('/swipers', [IndexSwiperController::class, 'index']);
    Route::get('/recommend', [RecommendController::class, 'index']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::resource('posts.comments', PostCommentController::class)->shallow()->middleware('word.filter');
    Route::get('/user', [UserProfileController::class, 'index']);
    Route::put('/user', [UserProfileController::class, 'update']);

    Route::get('/my/history', [HistoryController::class, 'index']);
    Route::get('/my/comment', [MyCommentController::class, 'index']);
    Route::get('/my/like', [MyLikeController::class, 'index']);
    Route::get('/my/collection', [MyCollectionController::class, 'index']);
    Route::get('/my/share', [MyShareController::class, 'index'])->middleware('extra.data');
    Route::post('/post/{post}/like', [LikePostController::class, 'store']);
    Route::post('/post/{post}/collect', [CollectController::class, 'store']);
    Route::post('/comment/{comment}/like', [LikeCommentController::class, 'store']);
    Route::post('/upload', [UploadController::class, 'store']);

    Route::post('/post', [PostController::class, 'store'])->middleware('word.filter');
    Route::delete('/post/{post}', [PostController::class, 'destroy']);
    Route::get('/feed', [FeedController::class, 'index']);
    Route::get('/feed/unread', [UnreadFeedCountController::class, 'index']);
    Route::get('/role', [UserRoleController::class, 'index']);
});
