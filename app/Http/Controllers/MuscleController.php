<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Muscle;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MuscleController extends Controller
{
    //

    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $muscles = Muscle::where('user_id', $user_id)
                            ->orWhereNull('user_id')
                            ->get();

        return view('muscle.index', compact('muscles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'color' => 'required|min:3'
        ]);

        $muscle = new Muscle;
        $muscle->name = $request->name;
        $muscle->color = $request->color;
        $muscle->user_id = $request->user()->id;
        $muscle->save();
        
        return redirect()->route('dashboard')->with('success','Muscle created');
    }
}
