<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/books', [BookController::class, 'index'])
        ->middleware('permission:view-books')->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])
        ->middleware('permission:create-books')->name('books.create');
    Route::post('/books', [BookController::class, 'store'])
        ->middleware('permission:create-books')->name('books.store');
    Route::get('/books/{book}', [BookController::class, 'show'])
        ->middleware('permission:view-books')->name('books.show');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])
        ->middleware('permission:edit-books')->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])
        ->middleware('permission:edit-books')->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])
        ->middleware('permission:delete-books')->name('books.destroy');

    Route::get('/users/roles', [UserRoleController::class, 'index'])
        ->middleware('permission:manage-roles')->name('users.roles.index');
    Route::patch('/users/{user}/role', [UserRoleController::class, 'update'])
        ->middleware('permission:manage-roles')->name('users.roles.update');
});

require __DIR__.'/auth.php';
