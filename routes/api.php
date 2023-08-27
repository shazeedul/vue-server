<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackFormController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    // feedback form routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/forms', [FeedbackFormController::class, 'index']);
    Route::get('/forms/all', [FeedbackFormController::class, 'allForm']);
    Route::post('/forms', [FeedbackFormController::class, 'store']);
    Route::get('/forms/{link}', [FeedbackFormController::class, 'show']);
    Route::post('/forms/{formId}/submit', [FeedbackFormController::class, 'submit']);
    Route::get('/forms/{formId}/responses', [FeedbackFormController::class, 'responses']);
    Route::get('/forms/{link}/answers', [FeedbackFormController::class, 'answersByUser']);

});

// login & register route
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
