<?php

namespace App\Http\Controllers\Periodo;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Periodo;
use Illuminate\Http\Request;

class PeriodosController extends Controller
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
            $periodos = Periodo::where('nome', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $periodos = Periodo::latest()->paginate($perPage);
        }

        return view('periodos.index', compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('periodos.create');
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
        
        Periodo::create($requestData);

        return redirect('periodos')->with('flash_message', 'Periodo added!');
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
        $periodo = Periodo::findOrFail($id);

        return view('periodos.show', compact('periodo'));
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
        $periodo = Periodo::findOrFail($id);

        return view('periodos.edit', compact('periodo'));
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
        
        $periodo = Periodo::findOrFail($id);
        $periodo->update($requestData);

        return redirect('periodos')->with('flash_message', 'Periodo updated!');
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
        Periodo::destroy($id);

        return redirect('periodos')->with('flash_message', 'Periodo deleted!');
    }
}
