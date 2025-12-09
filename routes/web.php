<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('home');

Route::resource('/produto', ProdutoController::class)->$_SESSION (''),
    return view ('layout.app');    
;

Route::resource('/cliente', ClientesController::class);

