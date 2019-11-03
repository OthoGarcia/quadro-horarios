<?php

namespace App\Http\Controllers\Turmas;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Periodo;
use App\Turma;
use Illuminate\Http\Request;

class TurmasController extends Controller
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
            $turmas = Turma::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('periodo_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $turmas = Turma::latest()->paginate($perPage);
        }

        return view('turmas.index', compact('turmas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $periodos = Periodo::all();
        return view('turmas.create', compact('periodos'));
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
			'nome' => 'required'
		]);
        $requestData = $request->all();
        
        Turma::create($requestData);

        return redirect('turmas')->with('flash_message', 'Turma added!');
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
        $turma = Turma::findOrFail($id);

        return view('turmas.show', compact('turma'));
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
        $turma = Turma::findOrFail($id);
        $periodos = Periodo::all();
        return view('turmas.edit', compact('turma', 'periodos'));
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
			'nome' => 'required'
		]);
        $requestData = $request->all();
        
        $turma = Turma::findOrFail($id);
        $turma->update($requestData);

        return redirect('turmas')->with('flash_message', 'Turma updated!');
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
        Turma::destroy($id);

        return redirect('turmas')->with('flash_message', 'Turma deleted!');
    }
}
