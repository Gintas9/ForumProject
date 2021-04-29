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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware'=>['auth']],function(){
//Cia rasosi visi raoutai

    Route::get('/superuser', [App\Http\Controllers\SuperUserController::class, 'superScreen'])->name('superuser');
    Route::post('/superuser/theme/{theme}', [App\Http\Controllers\SuperUserController::class, 'tblock'])->name('superusertid');
    Route::post('/superuser/user/{user}', [App\Http\Controllers\SuperUserController::class, 'ublock'])->name('superuseruid');

    //Route::post('/superuser', function (Request $request){}, [App\Http\Controllers\SuperUserController::class, 'tblock'])->name('super.tblock');
    Route::resource('themes','App\Http\Controllers\ThemeController');
   // Route::resource('supers','App\Http\Controllers\SuperUserController');
    Route::resource('posts','App\Http\Controllers\PostController');
    Route::resource('mods','App\Http\Controllers\ModsController');
    Route::resource('comments','App\Http\Controllers\CommentController');





//


});
//

