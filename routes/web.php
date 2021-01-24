<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('list', [\App\Http\Controllers\DropzoneController::class, 'list'])->name('list');
Route::get('add', [\App\Http\Controllers\DropzoneController::class, 'add'])->name('add');
Route::post('upload', [\App\Http\Controllers\DropzoneController::class, 'upload'])->name('upload');
