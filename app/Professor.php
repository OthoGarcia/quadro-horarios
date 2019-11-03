<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'professores';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'prioridade', 'quantidade_aulas'];

    public function materias()
    {
        return $this->belongsToMany('App\Materia', 'professor_materia');
    }    

    public function grades()
    {
        return $this->belongsToMany('App\Grade', 'professor_grade');
    }
    public function turnos()
    {
        return $this->hasMany('App\Turno');
    }
    
}
