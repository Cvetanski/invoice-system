<?php

use App\Http\Controllers\Invoice\InvoiceController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('invoice')->group(function (){
    Route::get('/', [InvoiceController::class, 'index']);
    Route::put('/approve/{id}', [InvoiceController::class, 'approve']);
    Route::put('reject/{id}', [InvoiceController::class, 'reject']);
});
