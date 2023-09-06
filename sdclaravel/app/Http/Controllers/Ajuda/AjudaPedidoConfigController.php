<?php

namespace App\Http\Controllers\Ajuda;

use App\Http\Controllers\Controller;
use App\Models\Ajuda\AjudaPedidoConfig;
use Illuminate\Http\Request;

class AjudaPedidoConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $permissao_materiais = AjudaPedidoConfig::all();
        return view(
            'ajuda/mah/config',
            [ $permissao_materiais => 'permissao_materiais'],
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
     * @param  \App\Models\Ajuda\AjudaPedidoConfig  $ajudaPedidoConfig
     * @return \Illuminate\Http\Response
     */
    public function show(AjudaPedidoConfig $ajudaPedidoConfig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajuda\AjudaPedidoConfig  $ajudaPedidoConfig
     * @return \Illuminate\Http\Response
     */
    public function edit(AjudaPedidoConfig $ajudaPedidoConfig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajuda\AjudaPedidoConfig  $ajudaPedidoConfig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjudaPedidoConfig $ajudaPedidoConfig)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajuda\AjudaPedidoConfig  $ajudaPedidoConfig
     * @return \Illuminate\Http\Response
     */
    public function destroy(AjudaPedidoConfig $ajudaPedidoConfig)
    {
        //
    }
}
