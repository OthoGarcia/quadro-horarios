<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Composicao extends Model
{
    protected $table = "composicoes";

    public function quadro_horarios()
    {
        return $this->hasMany("App\QuadroHorario");
    }
}
