<?php

namespace App\Http\Controllers\Professor;

use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Materia;
use App\Periodo;
use App\Professor;
use App\Turma;
use App\Turno;
use Illuminate\Http\Request;

class ProfessoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $professores = Professor::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('prioridade', 'LIKE', "%$keyword%")
                ->orWhere('quantidade_aulas', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $professores = Professor::latest()->paginate($perPage);
        }

        return view('professor.professores.index', compact('professores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $materias   = Materia::all();
        $grades     = Grade::all();
        return view('professor.professores.create', compact('materias', 'grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'nome' => 'required',
			'quantidade_aulas' => 'required|min:1',
			'prioridade' => 'required'
		]);
        
        $requestData = $request->all();
        $professor = Professor::create($requestData);
        $professor->materias()->sync($request->materia_id);
        $professor->grades()->sync($request->grade_id);

        return redirect('professores')->with('flash_message', 'Professor added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $professor = Professor::findOrFail($id);

        return view('professor.professores.show', compact('professor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $professor  = Professor::findOrFail($id);
        $materias   = Materia::all();
        $grades     = Grade::all();
        return view('professor.professores.edit', compact('professor', 'materias', 'grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
			'nome' => 'required',
			'quantidade_aulas' => 'required|min:1',
			'prioridade' => 'required'
		]);
        
        $requestData = $request->all();
        
        $professor = Professor::findOrFail($id);
        $professor->update($requestData);
        $professor->materias()->sync($request->materia_id);
        $professor->grades()->sync($request->grade_id);

        return redirect('professores')->with('flash_message', 'Professor updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Professor::destroy($id);

        return redirect('professores')->with('flash_message', 'Professor deleted!');
    }

    public function exibindo_periodos($id, Request $request)
    {
        $professor  = Professor::findOrFail($id);
        
        $periodos   = Periodo::all();
        $turno = 1;
        
        if($request->has('periodo_id')){
            $periodo    = Periodo::findOrFail($request->periodo_id);
            $dias_da_semana = $periodo->turnos()                                        
                                        ->where('turno', $request->turno)
                                        ->where('professor_id', $id)
                                        ->pluck('dia_da_semana');
            $turno = $request->turno;
        }else{
            $periodo    = Periodo::findOrFail($periodos[0]->id);
            $dias_da_semana = $periodo->turnos()                                        
                                        ->where('turno', 1)
                                        ->where('professor_id', $id)
                                        ->pluck('dia_da_semana');
            //dd($dias_da_semana, $periodos[0]->id);
        }        

        return view('professor.professores.adicionar_periodos', compact('professor', 'periodos', 'dias_da_semana', 'turno'));
    }

    public function buscar_professor_periodo(Request $request)
    {
        $professor = Professor::findOrFail($request->professor_id);
        $professor->periodos()
            ->where('periodo_id', $request->periodo_id)
            ->where('turno', $request->turno)
            ->get();           
    }

    public function cadastrar_periodos(Request $request)
    {
        //não vou poder usar o sync
        $professor  = Professor::findOrFail($request->professor_id);
        $periodo    = Periodo::findOrFail($request->periodo_id);        
        $desvicular_turnos = $periodo->turnos()->where("turno", $request->turno)->pluck("turnos.id");
        
        $periodo->turnos()->toggle($desvicular_turnos);        
    
        $turno_id;
        foreach ($request->dia_da_semana as $value) {
            $turno      = Turno::updateOrCreate(
                                        [
                                        "turno" => $request->turno, 
                                        "dia_da_semana" => $value, 
                                        "professor_id" => $professor->id], []);
            $turno->professor()->associate($professor);
            $turno_id[] = $turno->id;
        }
        $periodo->turnos()->syncWithoutDetaching($turno_id);
                        
        return $this->exibindo_periodos($professor->id, $request);
    }
}
