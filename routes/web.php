<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/create', function () {
    return Inertia::render('Create');
});

Route::resource('products', 'ProductController');

Route::post('/submit-form', [ProductController::class, 'store']);

Route::get('/categories', [CategoryController::class, 'index']);
//Route::post('/submit-form', 'ProductController@store');