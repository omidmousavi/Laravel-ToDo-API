<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        "status" => "up",
        "about" => "Laravel ToDo Api",
    ]);
});


Route::apiResource('todo', TodoController::class)->only(['index', 'store', 'update', 'destroy']);
