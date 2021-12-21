<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('check.api.cedentials')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['namespace' => 'Api'], function (){
	Route::post('login', 'AuthController@login');
});


Route::group(['namespace' => 'Api'], function (){
	Route::post('new-contact','ContactsController@store');
	Route::post('logout', 'AuthController@logout');
	Route::post('refresh', 'AuthController@refresh');
	Route::post('me', 'AuthController@me');
});


Route::get('test', function (){
    echo request('hub_challenge');
    
    $input = json_decode(file_get_contents('php://input'), true);
    error_log(print_r($input, true));
});
