<?php

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Router;
use App\Models\State;
use App\Models\Candidate;

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

$router->group(['middleware' => ['auth']], function ($router) {

$router->post('/candidate', 'CandidateControler@index');
$router->post('/candidate/store/', 'CandidateControler@store');
$router->post('/candidate/{id}', 'CandidateControler@show');
$router->delete('/candidate/{id}', 'CandidateControler@destroy');
        
    

});

$router->get('/', function () use ($router) {
    return $router->app->version();
});
