<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muscle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];

    public function exercisesAsPrimary(){
        return $this->belongsToMany(Exercise::class, 'exercise_primary_muscle');
    }

    public function exercisesAsSecondary(){
        return $this->belongsToMany(Exercise::class, 'exercise_secondary_muscle');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
