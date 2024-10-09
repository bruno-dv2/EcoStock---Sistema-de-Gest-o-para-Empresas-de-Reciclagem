<?php

use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::prefix('materiais')->group(function () {

    Route::get('/lista', [MaterialController::class, 'listaMateriais'])->name('materiais.lista');

    Route::get('/formulario', [MaterialController::class, 'exibirFormulario'])->name('materiais.formulario');

    Route::post('/', [MaterialController::class, 'salvarMaterial'])->name('materiais.salvar');

    Route::get('/editar/{id}', [MaterialController::class, 'editarMaterial'])->name('materiais.editar');

    Route::put('/atualizar/{id}', [MaterialController::class, 'atualizarMaterial'])->name('materiais.atualizar');

    Route::delete('/deletar/{id}', [MaterialController::class, 'deletarMaterial'])->name('materiais.deletar');

});
