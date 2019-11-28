<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'periodos';
    protected $with = ['turnos', 'turmas'];

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
    protected $fillable = ['nome', 'grade_id'];

    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }

    public function turnos()
    {
        return $this->belongsToMany('App\Turno', 'periodo_turno');
    }
    
    public function turmas()
    {
        return $this->hasMany('App\Turma');
    }
    
}
