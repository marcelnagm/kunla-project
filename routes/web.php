<?php

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Router;
use App\Models\State;

/** @var \Laravel\Lumen\Routing\Router $router */
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It is a breeze. Simply tell Lumen the URIs it should respond to
  | and give it the Closure to call when that URI is requested.
  |
 */

Route::group(['middleware' => ['auth']], function () {
//    Route::resource('user', 'UserController', ['except' => ['show']]);
//    Route::post('/user/push', 'UserController@checkPushNotificationId');
//
//    Route::name('admin.')->group(function () {
//        Route::get('syncV1UsersToAuth0', 'SettingsController@syncV1UsersToAuth0')->name('syncV1UsersToAuth0');
//        Route::get('dontsyncV1UsersToAuth0', 'SettingsController@dontsyncV1UsersToAuth0')->name('dontsyncV1UsersToAuth0');
//        Route::resource('restaurants', 'RestorantController');
//        Route::put('restaurants_app_update/{restaurant}', 'RestorantController@updateApps')->name('restaurant.updateApps');
//    });
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/', ['middleware' => 'auth', function (Request $request) {
        return State::find(1);
        //
    }]);
