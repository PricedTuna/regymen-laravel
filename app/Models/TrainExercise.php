<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainExercise extends Model
{
    use HasFactory;

    protected $fillable = ['exercise_id', 'reps', 'series'];

    public function exercise(){
        return $this->belongsTo(Exercise::class);
    }

    public function trainSessions(){
        return $this->belongsToMany(TrainSession::class, 'train_session_train_exercise');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
