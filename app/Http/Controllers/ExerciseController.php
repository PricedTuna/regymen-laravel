<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Muscle;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $exercises = Exercise::where('user_id', $user_id)
                            ->orWhereNull('user_id')
                            ->get();

        $muscles = Muscle::where('user_id', $user_id)
                            ->orWhereNull('user_id')
                            ->get();

        return view('exercise.index', compact('exercises', 'muscles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'primary_muscles' => 'required|array',
            'primary_muscles.*' => 'exists:muscles,id',
            'secondary_muscles' => 'array',
            'secondary_muscles.*' => 'exists:muscles,id',
        ]);

        $exercise = Exercise::create([
            'name' => $validatedData['name'],
        ]);

        if(!empty($validatedData['primary_muscles'])){
            $exercise->primaryMuscles()->attach($validatedData['primary_muscles']);
        }

        if(!empty($validatedData['secondary_muscles'])){
            $exercise->secondaryMuscles()->attach($validatedData['secondary_muscles']);
        }

        return redirect()->route('exercise.index')->with('success','Exercise created successfully');
    }
}
