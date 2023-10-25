<?php

use App\Http\Controllers\Cedec\ApiController;
use App\Models\Drrd\PaeProtocolo;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function(){
    Route::post('login', [\App\Http\Controllers\Auth\Api\LoginController::class, 'login']);  
    Route::get('user', [\App\Http\Controllers\Auth\Api\UserController::class, 'listAll']);  
<<<<<<< HEAD
    Route::get('userex', [\App\Http\Controllers\Auth\Api\UserController::class, 'listCompdec']);  
=======
    Route::post('cpf', [\App\Http\Controllers\Auth\Api\UserController::class, 'updatecpf']);  
>>>>>>> bf734878a76002c4b69be49a8889f0c1ee91d54d
});

