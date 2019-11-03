<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'turnos';

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
    protected $fillable = ['dia_da_semana', 'turno', 'professor_id'];

    public function periodo()
    {
        return $this->belongsToMany('App\Periodo', 'periodo_turno');
    }

    public function professor()
    {
        return $this->belongsTo('App\Professor');
    }
}
