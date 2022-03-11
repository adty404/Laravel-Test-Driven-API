<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

Route::get('todo-list', [TodoListController::class,'index'])->name('todo-list.index');

Route::get('todo-list/{id}', [TodoListController::class,'show'])->name('todo-list.show');
