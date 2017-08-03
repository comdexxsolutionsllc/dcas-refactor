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

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// TODO:  Create a registration controller
// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('impersonate/{user}', function (User $user) {
    session(['previousLoginId' => auth()->user()->id]);

    \Auth::login($user);

    flash("You have started impersonating " . auth()->user()->name);

    return redirect(route('home'));
})->middleware(['auth', 'admin'])->name('impersonate');

Route::get('impersonate/{user}/fallback', function () {
    \Auth::loginUsingId($id = session()->pull('previousLoginId', 'default'));

    flash("You have stopped impersonating a user.");

    return redirect(route('home'));
})->middleware(['auth'])->name('fallbackOriginalAccount');

// API
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {

    $api->get('test', function () {
        $collection = \Modules\Internal\Models\Ticket::find(1);
        $transformer = new \App\Transformers\TicketTransformer;

        return fractal_item($collection, $transformer)->toArray();
    });

});
