<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuadroHorario extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quadro_horarios';

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
    protected $fillable = ['quantidade_tempos', 'tempo_intervalo', 'turma_id'];

    public function turma()
    {
        return $this->belongsTo('App\Turma');
    }
    
}
