<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistItemController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => 'jwt.auth'], function () {
    // Checklist routes
    Route::get('/checklists', [ChecklistController::class, 'index']);
    Route::post('/checklists', [ChecklistController::class, 'store']);
    Route::delete('/checklists/{checklistId}', [ChecklistController::class, 'destroy']);
    

    // ChecklistItem routes
    Route::get('/checklist/{checklistId}/items', [ChecklistItemController::class, 'index']);
    Route::post('/checklist/{checklistId}/items', [ChecklistItemController::class, 'store']);
    Route::get('/checklist/{checklistId}/item/{checklistItemId}', [ChecklistItemController::class, 'show']);
    Route::put('/checklist/{checklistId}/item/{checklistItemId}', [ChecklistItemController::class, 'update']);
    Route::delete('/checklist/{checklistId}/item/{checklistItemId}', [ChecklistItemController::class, 'destroy']);
    Route::put('/checklist/{checklistId}/item/rename/{checklistItemId}', [ChecklistItemController::class, 'rename']);
});
