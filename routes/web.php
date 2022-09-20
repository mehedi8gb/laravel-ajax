<?php

use App\Http\Controllers\crudController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'forceLogin'])->name('login');

Route::prefix('crud')->middleware('auth')->group(function () {
    Route::get('/', [crudController::class, 'index'])->name('crud.index');
    Route::post('/store', [crudController::class, 'store'])->name('crud.store');
    Route::patch('/update/{id}', [crudController::class, 'update'])->name('crud.update');
    Route::get('/data', [crudController::class, 'data'])->name('crud.data');
    Route::delete('/destroy/{id}', [crudController::class, 'destroy'])->name('crud.destroy');
    Route::get('/show/{id}', [crudController::class, 'show'])->name('crud.show');
});




