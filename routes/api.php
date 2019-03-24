<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});
Route::middleware('api')->group(function() {
	Route::get('/me', function(Request $request){
		// return 'jaro'; 
		$data = $request->all();
		$me = 'jaro';
		$users ='';
		return response()
		->json(['users'=> App\User::all(), 'data'=> $request->all()]);
	});
	Route::post('/users/create', function (Request $request)
	{
		$data = $request->all();
		$user = 'kkk';
		//$data['password'] = bcrypt($data['password']);

		//$user = App\User::create($data);
		return response()->json(['users' => App\User::all(), 'created' => $user]);
	});
	Route::post('/todo', function(){

	});
});

Route::get('/users', function ()
{
	return response()->json(App\User::all());
});


