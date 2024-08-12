<?php

use App\Http\Controllers\MuscleController;
use Illuminate\Support\Facades\Route;

Route::get("/muscle", [MuscleController::class, 'index'])->name('muscle.index');
Route::post("/muscle/create", [MuscleController::class, 'store'])->name('muscle.store');