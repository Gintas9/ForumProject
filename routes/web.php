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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/home', 'PagesController@gotoMainPage');
Route::get('/home', [App\Http\Controllers\PagesController::class, 'gotoMainPage'])->name('home');
Route::group(['middleware'=>['auth']],function(){
//Cia rasosi visi raoutai


    Route::resource('themes','App\Http\Controllers\ThemeController');
    Route::resource('posts','App\Http\Controllers\PostController');
    Route::resource('mods','App\Http\Controllers\ModsController');





//


});
//

