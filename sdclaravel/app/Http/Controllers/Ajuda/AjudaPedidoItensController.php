<?php

namespace App\Http\Controllers\Ajuda;

use App\Http\Controllers\Controller;
use App\Models\Ajuda\AjudaPedidoItens;
use Illuminate\Http\Request;

class AjudaPedidoItensController extends Controller
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

        $itens = new AjudaPedidoItens();
        $itens->codigo               = $request->codigo;
        $itens->descricao_item       = $request->descricao_item;
        $itens->qtd                  = $request->qtd;
        $itens->familia_at           = $request->familia_at;
        $itens->pedido_id            = $request->pedido_id;
        $itens->tp_item              = $request->tp_item;


        //dd($itens->save());

        return $itens->save();



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ajuda\PedidoItens  $pedidoItens
     * @return \Illuminate\Http\Response
     */
    public function show(AjudaPedidoItens $pedidoItens)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajuda\PedidoItens  $pedidoItens
     * @return \Illuminate\Http\Response
     */
    public function edit(AjudaPedidoItens $pedidoItens)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajuda\PedidoItens  $pedidoItens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjudaPedidoItens $pedidoItens)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajuda\PedidoItens  $pedidoItens
     * @return \Illuminate\Http\Response
     */
    public function destroy(AjudaPedidoItens $pedidoItens)
    {
        //
    }
}
