<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// CRUD Route for Product
use App\Http\Controllers\ProductController;
Route::resource('product', ProductController::class);
