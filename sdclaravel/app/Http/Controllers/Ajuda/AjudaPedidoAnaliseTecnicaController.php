<?php

namespace App\Http\Controllers\Ajuda;

use App\Http\Controllers\Controller;
use App\Models\Ajuda\AjudaPedidoAnaliseTecnica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AjudaPedidoAnaliseTecnicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'opa';//
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
        //dd($request);

        $request->validate(
            [
                'data_parecer' => "required|date",
                'parecer' => "max:255|required",
            ],
            [
                'data_parecer.required' => "O campo :attribute é Obrigatória !",
                'data_entrada.date' => "O campo :attribute deve ser uma Data Válida !",
                'parecer.required' => "O campo :attribute  é Obrigatória !",
                'parecer.max' => "O campo :attribute deve ter no máximo 255 Caracteres!",

            ]
        );


        $parecer = new AjudaPedidoAnaliseTecnica();
        
        $parecer->data_parecer   = $request->data_parecer;
        $parecer->parecer        = $request->parecer;
        $parecer->pedido_id      = $request->pedido_id;
        $parecer->tramit_parecer = $request->tramit_parecer;
        

        $parecer->save();

        return redirect()->back()->with([
            'message' => 'Registro Gravado com Sucesso ',
            'active_tab'=> '#-despachos_analise-tab',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AjudaPedidoAnaliseTecnica  $ajudaPedidoAnaliseTecnica
     * @return \Illuminate\Http\Response
     */
    public function show(AjudaPedidoAnaliseTecnica $ajudaPedidoAnaliseTecnica)
    {
        //Log::channel('usuario')->info('Login de usuario sem Liberação Principal', ['table' => 'users', 'id_usuario' => Auth::user()->id]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AjudaPedidoAnaliseTecnica  $ajudaPedidoAnaliseTecnica
     * @return \Illuminate\Http\Response
     */
    public function edit(AjudaPedidoAnaliseTecnica $ajudaPedidoAnaliseTecnica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AjudaPedidoAnaliseTecnica  $ajudaPedidoAnaliseTecnica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjudaPedidoAnaliseTecnica $ajudaPedidoAnaliseTecnica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AjudaPedidoAnaliseTecnica  $ajudaPedidoAnaliseTecnica
     * @return \Illuminate\Http\Response
     */
    public function destroy(AjudaPedidoAnaliseTecnica $ajudaPedidoAnaliseTecnica, $analise)
    {
       $parecer = AjudaPedidoAnaliseTecnica::find($analise);

       $parecer->delete();

       return redirect('mah/pedido/edit/'.$parecer->pedido_id);
    }
}
