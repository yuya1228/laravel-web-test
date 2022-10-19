<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;


Route::get('/', [TodoController::class, 'index'])->name('todo.index');

Route::post('/create',[TodoController::class,'create'])->name('todo.create');

Route::post('/update',[TodoController::class,'update'])->name('todo.update');

Route::delete('/delete/{id}',[TodoController::class,'destroy'])->name('todo.destroy');


