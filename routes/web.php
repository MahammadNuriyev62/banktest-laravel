<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\QuestionController;
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

// Home Page
Route::get('/', function (){
    return redirect('/questions');
});

// All Questions
Route::get('/questions', [QuestionController::class, 'index']);

// Show Create Form
Route::get('/questions/create', [QuestionController::class, 'create']);

// Store Question Data
Route::post('/questions', [QuestionController::class, 'store']);

// Show Edit Form
Route::get('/questions/{question}/edit', [QuestionController::class, 'edit']);

// Update Question
Route::put('/questions/{question}', [QuestionController::class, 'update']);

// Delete Question
Route::delete('/questions/{question}', [QuestionController::class, 'destroy']);

// Single Question
Route::get('/questions/{question}', [QuestionController::class, 'show']);

// About us
Route::get('/about', [GeneralController::class, 'about']);

