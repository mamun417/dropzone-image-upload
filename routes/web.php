<?php

use App\Http\Controllers\CropImageController;
use App\Http\Controllers\DataController;
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
    return redirect()->route('data.index');
});

Route::delete('data/image/remove/{id}', [DataController::class, 'imageRemove'])
    ->name('data.image-remove');

Route::resource('data', DataController::class);

Route::get('crop-image-upload', [CropImageController::class, 'index'])->name('crop-image-upload');
Route::post('crop-image-upload ', [CropImageController::class, 'uploadImage']);
