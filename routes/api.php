<?php

use App\Http\Controllers\Cedec\ApiController;
use App\Models\Drrd\PaeProtocolo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

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

    Route::post('cisterna/sinc', [\App\Http\Controllers\Auth\Api\CisternaController::class, 'processar']);  

    //Route::post('cpf', [\App\Http\Controllers\Auth\Api\UserController::class, 'cpf']);  

    Route::get('user', [\App\Http\Controllers\Auth\Api\UserController::class, 'listAll']);  
    Route::get('userex', [\App\Http\Controllers\Auth\Api\UserController::class, 'listCompdec']);  
    
    Route::post('update', [\App\Http\Controllers\Auth\Api\UserController::class, 'update']);  
    
});

# rat
Route::get('pubrat', [\App\Http\Controllers\Compdec\RatController::class, 'apiAllDataRat']);  

# vistoria
Route::get('pubvistoria', [\App\Http\Controllers\Compdec\VistoriaController::class, 'apiAllDataVistoria']);  


# updates
Route::get('/bot/getupdates', function() {
    $updates = Telegram::getUpdates();
    return (json_encode($updates));
});


# bot
Route::get('/bot/resetsenha', [\App\Http\Controllers\Cedec\BotTelegramController::class, 'index']);  

