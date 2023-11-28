<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\NoteController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});


 
Route::post('note/store', [NoteController::class, 'store']);
Route::post('notes', [NoteController::class, 'index']);
Route::get('note/{$id}', [NoteController::class, 'edit']);
Route::patch('note/{$id}', [NoteController::class, 'update']);
Route::delete('note/{$id}', [NoteController::class, 'delete']);