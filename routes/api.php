<?php

use App\Http\Controllers\Api\MaterialApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1/materiais')->group(function () {

    Route::get('/lista', [MaterialApiController::class, 'listaMateriais']);

    Route::post('/criar', [MaterialApiController::class, 'criarMaterial']);

    Route::get('/material/{id}', [MaterialApiController::class, 'mostrarMaterialEspecifico']);

    Route::put('/editar/{id}', [MaterialApiController::class, 'editarMaterial']);

    Route::delete('deletar/{id}', [MaterialApiController::class, 'deletarMaterial']);

});
