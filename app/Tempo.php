<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tempo extends Model
{
    

    public function quadroHorario()
    {
        return $this->belongsTo("App\QuadroHorario");
    }

    public function professor()
    {
        return $this->belongsTo("App\Professor");
    }

    public function materia()
    {
        return $this->belongsTo("App\Materia");
    }
}
