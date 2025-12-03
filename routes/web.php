<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('home');

Route::get('/produto', [ProdutoController::class, 'index']);

// Route::get('cliente',[ClientesController::class, 'index'], function () {
//     return view('cliente.index');
// });