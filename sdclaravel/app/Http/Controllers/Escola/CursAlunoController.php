<?php

namespace App\Http\Controllers\Escola;

use App\Http\Controllers\Controller;
use App\Models\Escola\CursAluno;
use Illuminate\Http\Request;

class CursAlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = CursAluno::paginate(15);
        return view('escola/curso/aluno/index',
            [ 'alunos' => $alunos],
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Escola\CursAluno  $cursAluno
     * @return \Illuminate\Http\Response
     */
    public function show(CursAluno $cursAluno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Escola\CursAluno  $cursAluno
     * @return \Illuminate\Http\Response
     */
    public function edit(CursAluno $cursAluno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Escola\CursAluno  $cursAluno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CursAluno $cursAluno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Escola\CursAluno  $cursAluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(CursAluno $cursAluno)
    {
        //
    }
}
