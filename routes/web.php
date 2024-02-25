<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



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
})->name('home');

Route::resource('products', 'ProductController');

Route::post('/submit-form', [ProductController::class, 'store']);

Route::get('/products', [ProductController::class, 'index']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::group(['middleware' => ['auth','isAdmin']], function () {

    Route::get('/create', function () {
        return Inertia::render('Create');
    })->name('create');
 
 });

 Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

//Route::post('/submit-form', 'ProductController@store');
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
