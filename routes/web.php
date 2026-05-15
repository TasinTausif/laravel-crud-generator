<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// CRUD Route for Foods
use App\Http\Controllers\FoodsController;
Route::resource('foods', FoodsController::class)->parameters(['foods' => 'foods']);