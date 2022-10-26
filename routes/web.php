<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;


Route::get('/home', [TodoController::class, 'index'])->name('todo.index');
Route::post('/create',[TodoController::class,'create'])->name('todo.create');
Route::post('/update',[TodoController::class,'update'])->name('todo.update');
Route::delete('/delete/{id}',[TodoController::class,'destroy'])->name('todo.destroy');
Route::get('/search',[TodoController::class,'search'])->name('todo.search');
Route::get('/search/create',[TodoController::class,'find'])->name('todo.find');
Route::get('/home', [TodoController::class, 'index'])->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
