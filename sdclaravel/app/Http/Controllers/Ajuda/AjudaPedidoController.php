<?php

namespace App\Http\Controllers\Ajuda;

use App\Http\Controllers\Controller;
use App\Models\Ajuda\AjudaPedido;
use App\Models\Ajuda\AjudaPedidoAnaliseTecnica;
use App\Models\Ajuda\AjudaPedidoAnexo;
use App\Models\Ajuda\AjudaPedidoItens;
use App\Models\Compdec\Compdec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AjudaPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ajuda/mah/index');
    }


    /**
     * Display a listing of the resource compdec.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_compdec()
    {

        $municipio_id = isset(Session::get('user')['municipio_id']) ? Session::get('user')['municipio_id'] : null;

        $pedidos_compdec = AjudaPedido::with('municipio')
            ->where('aju_pedido_pedidos.municipio_id', '=', $municipio_id)
            ->get();


        return view(
            'ajuda/mah/index',
            [
                'pedidos_compdec' => $pedidos_compdec,
            ]
        );
    }


    /**
     * Display a listing of the resource. index processos busca
     *
     * @return \Illuminate\Http\Response
     */
    public function busca()
    {

        $method = request()->method();
        $active_tab = "";

        if ($method == 'GET') {
            return view('ajuda/mah/busca');
        } elseif ($method == 'POST') {

            if (true) {

                $param = request()->input('txtBusca');



                $pedidos = DB::table('aju_pedido_pedidos')
                    ->join('cedec_municipio', 'cedec_municipio.id', '=', 'aju_pedido_pedidos.municipio_id')
                    ->join('dec_cobrade', 'dec_cobrade.id', '=', 'aju_pedido_pedidos.cobrade_id')
                    ->select('aju_pedido_pedidos.*', 'cedec_municipio.nome as municipio', 'dec_cobrade.descricao as descricao_cobrade')
                    ->where('cedec_municipio.nome', "LIKE", '%' . $param . '%')
                    ->get();

                return view('ajuda/mah/busca', [
                    'pedidos' => $pedidos,
                    'active_tab' => $active_tab,
                ]);
            }
        }
        $pedidos = AjudaPedido::find();


        return view(
            'ajuda/mah/busca',
            [
                $pedidos => 'mahs',
            ]
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
     * @param  \App\Models\Ajuda\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(AjudaPedido $pedido)
    {
        return view('ajuda/mah/show');
    }

    /**
     * Print the specified resource.
     *
     * @param  \App\Models\Ajuda\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function print(AjudaPedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajuda\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(AjudaPedido $pedido)
    {
        $active_tab = "";

        $materiais_list = [
            ["material" => ["id" => "01", "name" => 'CESTA BASICA']],
            ["material" => ["id" => "02", "name" => 'COLCHAO']],
            ["material" => ["id" => "03", "name" => 'KIT HIGIENE']],
            ["material" => ["id" => "04", "name" => 'KIT LIMPEZA']],

        ];
        $pluck = collect($materiais_list)->pluck('material');

        $secao_parecer_list = [
            'Analise Dlog' => 'Analise Dlog',
            'COLCHAO'      => 'COLCHAO',
            'KIT HIGIENE'  => 'KIT HIGIENE',
            'KIT LIMPEZA'  => 'KIT LIMPEZA'
        ];
        //$secao_parecer_pluck = collect($secao_parecer_list)->pluck(())

        $materiais = AjudaPedidoItens::where('pedido_id', $pedido->id)->get();

        //dd($materiais);

        //$documentos = AjudaPedidoAnexo::All()->where('pedido_id', $pedido->id);
        $documentos = Storage::allFiles('pedido/' . $pedido->id);

        //dd($documentos);

        $despachos = AjudaPedidoAnaliseTecnica::where('pedido_id', $pedido->id)->get();

        //dd($despachos);

        return view(
            'ajuda/mah/edit',
            [
                'pedido' => $pedido,
                'active_tab' => $active_tab,
                'documentos' => $documentos,
                'despachos' => $despachos,
                'materiais_list' => $pluck,
                'materiais' => $materiais,
                'secao_tramitar' => $secao_parecer_list,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajuda\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjudaPedido $pedido)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajuda\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, AjudaPedido $pedido)
    {

        $file = $request->file('anexoDoc');

        $fileName = $request->id . "-pedid-" . time() . '_.' . $file->getClientOriginalExtension();


        $file->storeAs('pedido/' . $request->id, $fileName, 'public');

        return response()->json([
            'message' => 'Registro Gravado com Sucesso',
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajuda\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(AjudaPedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compdec\Pedido  $rat
     * @return \Illuminate\Http\Response
     */
    public function deletedoc(Request $request)
    {

        //dd($request);
        Storage::delete('pedido/' . $request->id . "/" . $request->file);

        return response()->json([
            'message' => 'Registro Gravado com Sucesso',
            'status' => true
        ]);
    }
}
