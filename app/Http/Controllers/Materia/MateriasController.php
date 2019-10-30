<?php

namespace App\Http\Controllers\Materia;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Materia;
use Illuminate\Http\Request;

class MateriasController extends Controller
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
            $materias = Materia::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('quantidade_aulas', 'LIKE', "%$keyword%")
                ->orWhere('quebrar', 'LIKE', "%$keyword%")
                ->orWhere('grade_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $materias = Materia::latest()->paginate($perPage);
        }

        return view('materias.index', compact('materias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('materias.create');
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
			'quebrar' => 'required|lt:quantidade_aulas'
		]);
        $requestData = $request->all();
        
        Materia::create($requestData);

        return redirect('materias')->with('flash_message', 'Materia added!');
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
        $materia = Materia::findOrFail($id);

        return view('materias.show', compact('materia'));
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
        $materia = Materia::findOrFail($id);

        return view('materias.edit', compact('materia'));
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
			'quebrar' => 'required|lt:quantidade_aulas'
		]);
        $requestData = $request->all();
        
        $materia = Materia::findOrFail($id);
        $materia->update($requestData);

        return redirect('materias')->with('flash_message', 'Materia updated!');
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
        Materia::destroy($id);

        return redirect('materias')->with('flash_message', 'Materia deleted!');
    }
}
