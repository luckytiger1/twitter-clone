<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/tweets', [\App\Http\Controllers\TweetsController::class, 'index'])->name('home');
    Route::post('/tweets', [\App\Http\Controllers\TweetsController::class, 'store']);

    Route::get('/bookmarks', [\App\Http\Controllers\BookmarksController::class, 'index'])->name('bookmarks');

    Route::post('/tweets/{tweet}/like', [\App\Http\Controllers\TweetLikesController::class, 'store']);
    Route::delete('/tweets/{tweet}/like', [\App\Http\Controllers\TweetLikesController::class, 'destroy']);

    Route::post('/tweets/{tweet}/save', [\App\Http\Controllers\TweetBookmarksController::class, 'store'])->name('save');
    Route::delete('/tweets/{tweet}/save', [\App\Http\Controllers\TweetBookmarksController::class, 'destroy'])->name('unsave');

    Route::post('/profiles/{user:username}/follow', [\App\Http\Controllers\FollowsController::class, 'store'])
        ->name('follow');
    Route::get('/profiles/{user:username}/edit', [\App\Http\Controllers\ProfilesController::class, 'edit'])
        ->middleware('can:edit,user');

    Route::patch('/profiles/{user:username}', [\App\Http\Controllers\ProfilesController::class, 'update'])
        ->middleware('can:edit,user');

    Route::get('/explore', [\App\Http\Controllers\ExploreController::class, 'index'])->name('explore');

    Route::post('/comments', [\App\Http\Controllers\CommentController::class, 'store']);
});

Route::get('/profiles/{user:username}', [\App\Http\Controllers\ProfilesController::class, 'show'])
    ->name('profile');


Auth::routes();
