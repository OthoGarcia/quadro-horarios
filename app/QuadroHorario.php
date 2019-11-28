<?php

namespace App;

use Carbon\Carbon;
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

    public function composicao()
    {
        return $this->belongsTo('App\Composicao');

    }

    public function tempos()
    {
        return $this->hasMany("App\Tempo");
    }

    public function preencher_tempos($materia)
    {   
        
        $professor = $this->buscar_professor($materia);
        if(!$professor){            
            return false;            
        }
        $quantidade_aulas_dia = $materia->quantidade_aulas % $materia->quebrar;        
        $dia_da_semana = null;
        $aulas_dia = 0;
        $hora = null;
        $tentativa = 0;
        for ($aula=0; $aula < $materia->quantidade_aulas; $aula++) { 
            $aulas_dia++;
            if (!$dia_da_semana) {
                if($professor->turnos){
                    $dia_da_semana = $professor->turnos->random()->dia_da_semana;
                }
            }
            while (!$hora) {
                $dia_da_semana = $professor->turnos->random()->dia_da_semana;
                $hora = $this->tempo_disponivel($dia_da_semana);
                $tentativa++;
                if($tentativa == 20){
                    return false;
                }
            }            

            $tempo = new Tempo();
            $tempo->quadroHorario()->associate($this);
            $tempo->hora_inicio     = $hora->format("H:i");
            $tempo->hora_final      = $hora->addMinutes(50)->format("H:i");
            $tempo->dia_da_semana = $dia_da_semana;
            $tempo->professor()->associate($professor);
            $tempo->materia()->associate($materia);
            $tempo->save();
            if($quantidade_aulas_dia == $aulas_dia){
                $dia_da_semana = null;
                $aulas_dia = 0;
            }
            $hora = null;
        }
    }

    public function buscar_professor(Materia $materia)
    {
        $turnos = $this
                    ->turma
                    ->periodo
                    ->turnos()
                    ->leftJoin('professores as p','p.id', "turnos.professor_id")
                    ->leftJoin('professor_materia as pm','p.id', "pm.professor_id")
                    ->where('pm.materia_id',$materia->id)
                    ->get();      
        if($turnos->count() > 0){
            return $turnos->random()->professor;        
        }else{           
            return null;
        }   
    }

    private function tempo_disponivel($dia_da_semana)
    {
        $this->refresh();
        $hora = Carbon::now();
        $hora->hour(7)->minute(0)->second(0);        
        if($this->tempos->where("dia_da_semana", $dia_da_semana)->count() > 0){
            $tempos = 0;
            $tempos_preenchidos = $this->tempos()->where("dia_da_semana", $dia_da_semana)->get();            
            while ($tempos < 6) {          
                if(!$tempos_preenchidos->pluck('hora_inicio')->contains($hora->format("H:i:s"))){                
                    return $hora;
                }
                $tempos++;
                $hora->addMinutes(50);
            }            
            return null;
        } else {
            return $hora;
        }
    }
    
    
}
