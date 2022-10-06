<?php

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


Auth::routes([ 'register'=> false ]);

//Rotte protette
Route::middleware('auth')
->namespace('Admin')
->name('admin.')
->prefix('admin')
->group(function () {
    Route::get('/', 'HomeController@Index')->name('home');

    Route::resource('posts', 'PostController');

    Route::get('/{any}',function(){
        abort('404');
    })->where('any', '.*');
});

//specifico che tutte le rotte non protette e quindi
// quelle che non passano da admin saranno gestite in questo modo:
Route::get('/{any?}', function () {
    return view('guest.home');
})->where('any', '.*');