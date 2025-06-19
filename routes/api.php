<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Commune;

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

Route::get('/api/communes-by-region/{region}', function ($region) {
    return Commune::where('region_id', $region)->orderBy('name')->get(['id', 'name']);
});

