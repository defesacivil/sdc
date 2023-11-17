<?php

namespace App\Http\Controllers\Ajuda;

use App\Http\Controllers\Controller;
use App\Models\Ajuda\AjudaEstoque;
use Illuminate\Http\Request;

class AjudaEstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * pagina cadastros Estoque
     *
     * @return \Illuminate\Http\Response
     */
    public function cadastro()
    {
        return view('ajuda/estoque/cadastro');
    }
    /**
     * pagina movimentação Estoque
     *
     * @return \Illuminate\Http\Response
     */
    public function movimentacao()
    {
        return view('ajuda/estoque/movimentacao');
    }
    /**
     * pagina relatorios Estoque
     *
     * @return \Illuminate\Http\Response
     */
    public function relatorio()
    {
        return view('ajuda/estoque/relatorio');
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
     * @param  \App\Models\Ajuda\AjudaEstoque  $ajudaEstoque
     * @return \Illuminate\Http\Response
     */
    public function show(AjudaEstoque $ajudaEstoque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajuda\AjudaEstoque  $ajudaEstoque
     * @return \Illuminate\Http\Response
     */
    public function edit(AjudaEstoque $ajudaEstoque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajuda\AjudaEstoque  $ajudaEstoque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjudaEstoque $ajudaEstoque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajuda\AjudaEstoque  $ajudaEstoque
     * @return \Illuminate\Http\Response
     */
    public function destroy(AjudaEstoque $ajudaEstoque)
    {
        //
    }
}
