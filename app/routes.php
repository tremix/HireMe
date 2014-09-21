<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
/*Route::get('welcome', function()
{
    return View::make('welcome');
});
*/

/*Route::get('welcome', function()
{
    return View::make('welcome')->with('name','Duilio');
});*/

//Redireccionando

/*Route::get('welcome', function()
{
    return Redirect::to('goodbye');
});*/

/*Route::get('hello', function() {
    return "Bienvenidos a Laravel";
});*/

/*Route::get('welcome', function()
{
    return URL::to('welcome');
});*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

//Ruta para categoría(slug) identiicador=1 : candidates/backend-developers/1
Route::get('candidates/{slug}/{id}', ['as' => 'category', 'uses' => 'CandidatesController@category']);

//Ruta para un candidato: duilio-palacios/1
Route::get('{slug}/{id}', ['as' => 'candidate', 'uses' => 'CandidatesController@show']);

//accedo a datos de la web
Route::get('sign-up', ['as' => 'sign_up', 'uses' => 'UsersController@signUp']);

//Envio de datos de formulario
Route::post('sign-up', ['as' => 'register', 'uses' => 'UsersController@register']);