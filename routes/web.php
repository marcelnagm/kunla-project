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
$router->post('/candidate/search', 'CandidateControler@search');
$router->post('/candidate/{id}', 'CandidateControler@show');
$router->post('/candidate/{id}/publish', 'CandidateControler@publish');
$router->put('/candidate/{id}/update', 'CandidateControler@update');
$router->delete('/candidate/{id}', 'CandidateControler@destroy');
        
    

});

$router->get('/', 'HomeControler@index');
$router->get('/search', 'HomeControler@index_search');
$router->get('/detail/{gid}', 'HomeControler@detail');


$router->get('/state', function () use ($router) {
    return State::all();
});
