<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function primaryMuscles(){
        return $this->belongsToMany(Muscle::class, 'exercise_primary_muscle');
    }

    public function secondaryMuscles(){
        return $this->belongsToMany(Muscle::class, 'exercise_secondary_muscle');
    }

    public function TrainExercise(){
        return $this->hasOne(Exercise::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
