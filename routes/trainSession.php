<?php

use App\Http\Controllers\TrainSessionController;
use Illuminate\Support\Facades\Route;

Route::get("/trainsession", [TrainSessionController::class,'index'])->name('trainSession.index');
Route::get("/trainsession/create", [TrainSessionController::class,'create'])->name('trainSession.create');
Route::post("/trainsession/create", [TrainSessionController::class,'store'])->name('trainSession.store');