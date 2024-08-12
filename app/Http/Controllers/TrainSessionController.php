<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\TrainExercise;
use App\Models\TrainSession;
use Illuminate\Http\Request;

class TrainSessionController extends Controller
{
    //

    public function index(Request $request)
    {
        $user_id = $request->user()->id;

        $trainSessions = TrainSession::where('user_id', $user_id)
                        ->orWhereNull('user_id')
                        ->get();

        $exercises = Exercise::where('user_id', $user_id)
                        ->orWhereNull('user_id')
                        ->get();

        return view("trainSession.index", compact('trainSessions', 'exercises') );
    }

    public function create(Request $request)
    {
        $user_id = $request->user()->id;

        $exercises = Exercise::where('user_id', $user_id)
                            ->orWhereNull('user_id')
                            ->get();

        return view('trainSession.create', compact('exercises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'trainedDay' => 'required|date',
            'exercisesCount' => 'required',
            'exercises' => 'required|array',
            'exercises.*' => 'exists:exercises,id',
            'reps' => 'required',
            'reps.*' => 'numeric',
            'series' => 'required',
            'series.*' => 'numeric'
        ]);

        $trainSession = TrainSession::create([
            'name'=> $request->name,
            'trainedDay' => $request->trainedDay
        ]);

        $trainExercises = [];
        for ($i=0; $i < $request->exercisesCount; $i++) { 
            $trainExercise = TrainExercise::create([
                'exercise_id' => $request->exercises[$i],
                'reps' => $request->reps[$i],
                'series' => $request->series[$i],
            ]);

            $trainExercises[] = $trainExercise->id;
        }

        $trainSession->trainedExercises()->attach($trainExercises);

        return redirect()->route('trainSession.index')->with('success','Train session created successfully');

    }

}
