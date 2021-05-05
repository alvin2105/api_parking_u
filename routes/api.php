<?php

use App\Http\Controllers\ParkirController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::resource('products', ProductController::class);

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    //admin
    Route::post('/parkir', [ParkirController::class, 'store']);
    Route::put('/parkir/{id}', [ParkirController::class, 'update']);
    Route::delete('/parkir/{id}', [ParkirController::class, 'destroy']);
    //user
    Route::get('/parkir', [ParkirController::class, 'index']);
    Route::get('/parkir/{id}', [ParkirController::class, 'show']);
    Route::get('/parkir/search/{nama_parkir}', [ParkirController::class, 'search']);
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    //admin+user
    Route::post('/logout', [AuthController::class, 'logout']);
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
