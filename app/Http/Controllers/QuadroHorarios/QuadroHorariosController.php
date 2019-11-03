<?php

namespace App\Http\Controllers\QuadroHorarios;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\QuadroHorario;
use App\Turma;
use Illuminate\Http\Request;

class QuadroHorariosController extends Controller
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
            $quadrohorarios = QuadroHorario::where('quantidade_tempos', 'LIKE', "%$keyword%")
                ->orWhere('tempo_intervalo', 'LIKE', "%$keyword%")
                ->orWhere('turma_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $quadrohorarios = QuadroHorario::latest()->paginate($perPage);
        }

        return view('quadro-horarios.index', compact('quadrohorarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $turmas = Turma::all();
        return view('quadro-horarios.create', compact('turmas'));
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
			'quantidade_tempos' => 'required',
			'turma_id' => 'required',
			'tempo_intervalo' => 'required'
		]);
        $requestData = $request->all();
        
        QuadroHorario::create($requestData);

        return redirect('quadro-horarios')->with('flash_message', 'QuadroHorario added!');
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
        $quadrohorario = QuadroHorario::findOrFail($id);

        return view('quadro-horarios.show', compact('quadrohorario'));
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
        $quadrohorario = QuadroHorario::findOrFail($id);
        $turmas = Turma::all();
        return view('quadro-horarios.edit', compact('quadrohorario', 'turmas'));
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
			'quantidade_tempos' => 'required',
			'turma_id' => 'required',
			'tempo_intervalo' => 'required'
		]);
        $requestData = $request->all();
        
        $quadrohorario = QuadroHorario::findOrFail($id);
        $quadrohorario->update($requestData);

        return redirect('quadro-horarios')->with('flash_message', 'QuadroHorario updated!');
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
        QuadroHorario::destroy($id);

        return redirect('quadro-horarios')->with('flash_message', 'QuadroHorario deleted!');
    }
}
