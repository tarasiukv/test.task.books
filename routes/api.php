<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\PublisherController;
use Illuminate\Support\Facades\Route;

Route::resource('books', BookController::class);
Route::resource('authors', AuthorController::class);
Route::resource('publishers', PublisherController::class);
