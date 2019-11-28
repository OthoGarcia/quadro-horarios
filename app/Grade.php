<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'grades';
    protected $with = ['periodos'];

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
    protected $fillable = ['nome'];

 
    public function periodos()
    {
        return $this->hasMany('App\Periodo');
    }
    
    public function materias()
    {
        return $this->hasMany('App\Materia');
    }
}
