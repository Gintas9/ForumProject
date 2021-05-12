<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
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



//php artisan route:list

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//

//Auth::routes();

//
//Auth::routes();

Route::get('/home', [App\Http\Controllers\PagesController::class, 'gotoMainPage'])->name('home');

Route::group(['middleware'=>['auth']],function(){
//Cia rasosi visi raoutai

    Route::get('/superuser', [App\Http\Controllers\SuperUserController::class, 'superScreen'])->name('superuser');
    Route::post('/superuser/theme/{theme}', [App\Http\Controllers\SuperUserController::class, 'tblock'])->name('superusertid');
    Route::post('/superuser/user/{user}', [App\Http\Controllers\SuperUserController::class, 'ublock'])->name('superuseruid');

    Route::post('/theme/follower/create/{theme}', [App\Http\Controllers\FollowerController::class, 'MakeFollower'])->name('makeFollower');
    Route::delete('/theme/follower/delete/{theme}', [App\Http\Controllers\FollowerController::class, 'DeleteFollower'])->name('deleteFollower');
    //Route::post('/superuser', function (Request $request){}, [App\Http\Controllers\SuperUserController::class, 'tblock'])->name('super.tblock');
    Route::resource('themes','App\Http\Controllers\ThemeController');
   // Route::resource('supers','App\Http\Controllers\SuperUserController');
    Route::resource('posts','App\Http\Controllers\PostController');
    Route::resource('mods','App\Http\Controllers\ModsController');
    Route::resource('comments','App\Http\Controllers\CommentController');
    Route::resource('profiles','App\Http\Controllers\ProfileController');
    //Route::resource('likedposts','App\Http\Controllers\LikedPostController');
    Route::resource('likedcomments', 'App\Http\Controllers\LikedCommentController');

    Route::post('/post/newlike/{post}', [App\Http\Controllers\LikedPostController::class, 'store'])->name('likePost');
    Route::delete('/post/unlike/{post}', [App\Http\Controllers\LikedPostController::class, 'destroy'])->name('unlikePost');

    Route::post('/post/newlikehome/{post}', [App\Http\Controllers\LikedPostController::class, 'storehome'])->name('likePostHome');
    Route::delete('/post/unlikehome/{post}', [App\Http\Controllers\LikedPostController::class, 'destroyhome'])->name('unlikePostHome');


    Route::post('/comment/newlike/{post}/{comment}', [App\Http\Controllers\LikedCommentController::class, 'store'])->name('likeComment');
    Route::delete('/comment/unlike/{post}/{comment}', [App\Http\Controllers\LikedCommentController::class, 'destroy'])->name('unlikeComment');
    Route::post('/comment/newlikeshow/{post}/{comment}', [App\Http\Controllers\LikedCommentController::class, 'storeshow'])->name('likeCommentshow');
    Route::delete('/comment/unlikeshow/{post}/{comment}', [App\Http\Controllers\LikedCommentController::class, 'destroyshow'])->name('unlikeCommentshow');
    Route::get('/profiles/notifications/{user}', [App\Http\Controllers\ProfileController::class, 'shownotif'])->name('notifications');
    Route::get('/risingpost', [App\Http\Controllers\PostController::class, 'risingPost'])->name('risingpost');







//


});
//

