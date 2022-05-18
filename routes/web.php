<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CropImageController;

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

Route::post('/imagen', [CropImageController::class, 'uploadCropImage']);
Route::get('/', [CropImageController::class, 'inicio']);
Route::get('ruleta/{id}', [CropImageController::class, 'integrantes']);
Route::get('/grupos', [CropImageController::class, 'grupos']);
Route::post('/grupos', [CropImageController::class, 'gruposcrear']);
Route::get('/agregaintegrantes/{id}', [CropImageController::class, 'index']);


