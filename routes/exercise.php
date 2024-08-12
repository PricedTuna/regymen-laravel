<?php

use App\Http\Controllers\ExerciseController;
use Illuminate\Support\Facades\Route;

Route::get("/exercise", [ExerciseController::class, 'index'])->name('exercise.index');
Route::post("/exercise/create", [ExerciseController::class, 'store'])->name('exercise.store');