<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;


Route::resource('todos',TodoController::class);

Route::get('/todos', [TodoController::class]
);
