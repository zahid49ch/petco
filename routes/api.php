<?php

use App\Http\Controllers\ApiControllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Dog;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/allclients', [AuthController::class, 'getAllUsers']);
Route::get('/user/{id}', [AuthController::class, 'getUserById']);

Route::post('/register', [AuthController::class, 'register']);

Route::any('/login',[AuthController::class, 'login']);

Route::Post('/reservation',[AuthController::class, 'createReservation']);
Route::get('/reservation',[AuthController::class, 'allreservation']);

