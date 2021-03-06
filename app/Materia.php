<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'materias';

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
    protected $fillable = ['nome', 'quantidade_aulas', 'quebrar', 'grade_id'];

    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }
    
    public function professores()
    {
        return $this->belongsToMany('App\Professor', 'professor_materia');
    }    
}
