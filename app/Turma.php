<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'turmas';

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
    protected $fillable = ['nome', 'periodo_id', 'turno'];

    public function periodo()
    {
        return $this->belongsTo('App\Periodo');
    }

    public function quadrosHorarios()
    {
        return $this->hasMany('App\QuadroHorario');
    }
    
}
