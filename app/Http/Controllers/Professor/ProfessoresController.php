<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Professor;
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
        return view('professor.professores.create');
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
        
        $requestData = $request->all();
        
        Professor::create($requestData);

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
        $professor = Professor::findOrFail($id);

        return view('professor.professores.edit', compact('professor'));
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
        
        $requestData = $request->all();
        
        $professor = Professor::findOrFail($id);
        $professor->update($requestData);

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
}
