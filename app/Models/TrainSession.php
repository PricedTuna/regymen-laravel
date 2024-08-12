<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainSession extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'trainedDay'];

    public function trainedExercises(){
        return $this->belongsToMany(TrainExercise::class, "train_session_train_exercise");
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
