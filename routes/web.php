<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UserController::class, 'index'])->name('home'); {
    return view('welcome');
};

Route::get('/', function () {
    return view('welcome');
});

Route::get('produto', function () {
    return view('produtos.index');
});

Route::get('cliente', function () {
    return view('cliente.index');
});




