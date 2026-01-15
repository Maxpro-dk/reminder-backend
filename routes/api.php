<?php

use App\Http\Controllers\Api\StatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\TaskController;

Route::apiResource('tasks', TaskController::class);
Route::apiResource('statuses', StatusController::class)->only(['index', 'show']);

