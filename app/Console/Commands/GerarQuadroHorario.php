<?php

namespace App\Console\Commands;

use App\Grade;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GerarQuadroHorario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ia:gerarQuandroHorario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gerando quadros de horarios';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('tempos')->truncate();
        $grade      = Grade::find(1);
        $dados = collect([$grade]);
        $periodos = $grade->periodos;
        $turnos_possiveis  = ["1","2","3"];        
        foreach ($periodos as $periodo) {
            foreach ($turnos_possiveis as $turno_possivel) {
                $turmas = $periodo->turmas()->where('turno', $turno_possivel)->get();
                foreach ($turmas as $turma) {                    
                    foreach ($turma->periodo->grade->materias as $materia) {                        
                        $quadro_horario = $turma->quadrosHorarios->first();
                        dump("qh: ". $quadro_horario->id . " Materia: ". $materia->nome );
                        $quadro_horario->preencher_tempos($materia); 
                    }
                    dump("----------------" );
                }
            }

        }
    }
}
