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
    // logout route
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/forms', [FeedbackFormController::class, 'index']);
    Route::post('/forms', [FeedbackFormController::class, 'store']);
});

// login & register route
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


// Route::group(['middleware' => 'auth:api'], function () {
//     Route::post('/forms', 'FeedbackFormController@store'); // Create a feedback form
//     Route::get('/forms', 'FeedbackFormController@index');  // Get all feedback forms for a user
//     Route::get('/forms/{form}', 'FeedbackFormController@show'); // Get a specific feedback form
//     Route::get('/forms/{form}/responses', 'FeedbackFormController@responses'); // Get responses for a form
//     Route::post('/questions', 'QuestionController@store'); // Create a question
//     // ... other routes for updating and deleting forms, questions, and responses
// });

