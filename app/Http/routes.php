<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('buy', function()
{
    return view('buy');
});

Route::post('buy', function() {
    $billing = App::make('Acme\Billing\BillingInterface');


    $customerId = $billing->charge([
        'email' => Input::get('email'),
        'token' => Input::get('stripe-token')
    ]);

    // ...save customerId in a users database...

    return 'Charge was successful';
});
