<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

// auth routes - user not logged

Route::middleware([CheckIsNotLogged::class])->group(function(){

    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);

});

// app routes - user logged
Route::middleware([CheckIsLogged::class])->group(function(){

    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::post('/newNoteSubmit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    // edit note
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');

    // delete note
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete');

});

