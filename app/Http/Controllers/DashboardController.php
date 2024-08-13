<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrainExercise;
use App\Models\TrainSession;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user()->id;

        $trainSessions = TrainSession::where('user_id', $user_id)
                        ->orWhereNull('user_id')
                        ->with( 'trainedExercises.exercise.primaryMuscles',
                                'trainedExercises.exercise.secondaryMuscles')
                        ->get();

        $exercises = TrainSession::where('user_id', $user_id)
                    ->orWhereNull('user_id')
                    ->with('trainedExercises.exercise')
                    ->get()
                    ->pluck('trainedExercises.*.exercise')
                    ->flatten();

        return view('dashboard', compact('trainSessions', 'exercises'));
    }
}
