<?php

use App\Http\Controllers\CitizenController;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/', function () use ($router) {
    $data = [
        'name' => config('app.name'),
        'version' => config('app.version'),
        'framework' => $router->app->version(),
        'environment' => config('app.env'),
        'debug_mode' => config('app.debug'),
        'timestamp' => Carbon::now()->toDateTimeString(),
        'timezone' => config('app.timezone'),
    ];

    return response()->json($data, Response::HTTP_OK);
});

$router->get('/authors', 'CitizenController@index');
$router->get('/authors/{author}', 'CitizenController@show');

// $router->get('/authors', 'Author\CitizenController@index');
// $router->post('/authors', 'Author\CitizenController@store');
// $router->get('/authors/{author}', 'Author\CitizenController@show');
// $router->put('/authors/{author}', 'Author\CitizenController@update');
// $router->patch('/authors/{author}', 'Author\CitizenController@update');
// $router->delete('/authors/{author}', 'Author\CitizenController@destroy');