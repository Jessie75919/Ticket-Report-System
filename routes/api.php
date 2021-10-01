<?php

use App\Http\Controllers\API\BugController;
use App\Http\Controllers\API\UserController;
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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', [UserController::class, 'info']);
    Route::get('/bugs', [BugController::class, 'get']);
    Route::patch('/bugs/{bug}', [BugController::class, 'update'])
        ->middleware('can:update,bug');
    Route::patch('/bugs/{bug}/mark', [BugController::class, 'mark'])
        ->middleware('can:mark,bug');
    Route::delete('/bugs/{bug}', [BugController::class, 'delete'])
        ->middleware('can:delete,bug');
});

