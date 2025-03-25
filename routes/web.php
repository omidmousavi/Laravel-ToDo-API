<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::apiResource('todo', TodoController::class)->only(['index', 'store', 'update', 'destroy']);
