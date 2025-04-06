<?php

use App\Http\Controllers\API\ProblemController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\RegionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('regions',RegionController::class);
Route::apiResource('projects',ProjectController::class);
Route::apiResource('problems',ProblemController::class)->only([
    'index','store','update','destroy'
]);

Route::put('/problems/updateVisible/{problem}',[ProblemController::class,'updateVisible']);
Route::get('/problems/search',[ProblemController::class,'search']);


