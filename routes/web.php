<?php

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

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('impersonate/{user}', function (User $user) {
    session(['previousLoginId' => auth()->user()->id]);

    \Auth::login($user);

    flash("You have started impersonating ".auth()->user()->name);

    return redirect(route('home'));
})->middleware(['auth', 'admin'])->name('impersonate');

Route::get('impersonate/{user}/fallback', function () {
    \Auth::loginUsingId($id = session()->pull('previousLoginId', 'default'));

    flash("You have stopped impersonating a user.");

    return redirect(route('home'));
})->middleware(['auth'])->name('fallbackOriginalAccount');