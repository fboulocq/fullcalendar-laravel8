<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('evento.index');
})->middleware('auth');

Auth::routes();


Route::group(['middleware' => ['auth']], function(){

Route::get('/evento', [EventoController::class, 'index'])->name('evento.index');
Route::post('/evento/listado', [EventoController::class, 'show'])->name('evento.show');
Route::post('/evento/crear', [EventoController::class, 'store'])->name('evento.store');
Route::post('/evento/editar/{id}', [EventoController::class, 'edit'])->name('evento.edit');
Route::post('/evento/actualizar/{evento}', [EventoController::class, 'update'])->name('evento.update');
Route::post('/evento/borrar/{id}', [EventoController::class, 'destroy'])->name('evento.destroy');

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
