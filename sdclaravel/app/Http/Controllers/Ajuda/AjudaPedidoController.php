<?php

namespace App\Http\Controllers\Ajuda;

use App\Http\Controllers\Controller;
use App\Models\Ajuda\AjudaPedido;
use App\Models\Ajuda\AjudaPedidoAnaliseTecnica;
use App\Models\Ajuda\AjudaPedidoAnexo;
use App\Models\Ajuda\AjudaPedidoItens;
use App\Models\Cedec\CedecRdc;
use App\Models\Compdec\Compdec;
use App\Models\Compdec\CompdecEquipe;
use App\Models\Decreto\Cobrade;
use App\Models\Municipio\Municipio;
use App\Models\Municipio\Regiao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

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


    public static function data()
    {

        // /* municipios */
        // $optionMunicipio = Municipio::all()->pluck('nome', 'id');

        /* cobrade */
        $cobradeCollection = collect();
        $cobrades = Cobrade::all();
        foreach ($cobrades as $key => $cobrade) {
            $optionCobrade = $cobradeCollection->put($cobrade->id, $cobrade->codigo . "-" . $cobrade->descricao);
        }
        $optionCobrade[] = 'Outros ( Discriminar no Histórico )';


        return [
            // 'optionMunicipio' => $optionMunicipio,
            'optionCobrade' => $optionCobrade
        ];
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

        $compdec = Compdec::where('id_municipio', "=", Session::get('user')['municipio_id'])->first();

        //dd($compdec->equipes);

        $coordenador = "";

        foreach ($compdec->equipes as $key => $value) {
            

            if (strtolower($value['nome']) == 'coordenador') {
                $coordenador = $value;
            }

            //dd($coordenador);

            //$id_municipio = Session::get('user')['municipio_id'];

            //$cobrade_id_municipio = Session::get('user')['municipio_id'];

            //$compdec_id = Session::get('user')['compdec_id'];

            //$municipio = Municipio::find($id_municipio);

            //$regiaos = Regiao::orderBy('nome')->pluck('nome', 'id');

            $cobrades = Cobrade::select(
                DB::raw("CONCAT(codigo,' - ',descricao) as descricao_full"),
                'id'
            )
            ->orderBy('descricao')
            ->pluck('descricao_full', 'id');

            $coordenador = CompdecEquipe::where(['id_municipio' => $compdec->id_municipio])
                ->where(['funcao' => 'Coordenador'])->first();

            $active_tab = "";

            $materiais_list = [
                ["material" => ["id" => "01", "name" => 'CESTA BASICA']],
                ["material" => ["id" => "02", "name" => 'COLCHAO']],
                ["material" => ["id" => "03", "name" => 'KIT HIGIENE']],
                ["material" => ["id" => "04", "name" => 'KIT LIMPEZA']],

            ];
            $pluck = collect($materiais_list)->pluck('material');


            return view(
                'ajuda/mah/create',
                [
                    // 'municipio'   => $municipio,
                    // 'regiaos'     => $regiaos,
                    'coordenador' => $coordenador,
                    'cobrades'    => $cobrades,
                    'materiais_list' => $pluck,
                    'compdec' => $compdec,
                ]
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val = Validator::make(
            $request->all(),
            [
                "cobrade_id" => "required|numeric",
                "pop_atendida" => "required|numeric",
                "esforcos_realizados" => "required|max:1000",
                "municipio_id" => "required|integer",
            ],
            [
                "cobrade_id.required" => "O Campo COBRADE é Obrigatório !",
                "op_atendida.required" => "O Campo POPULAÇÃO ATENDIDA é Obrigatório !",
                "esforcos_realizados.required" => "O Campo ESFORÇOS REALIZADOS é Obrigatório !",
            ]
        );

        $pedido = new AjudaPedido();

        $pedido->cobrade_id         = $request->cobrade_id;
        $pedido->pop_atendida       = $request->pop_atendida;
        $pedido->decreto_se_ecp_vig = $request->decreto_se_ecp_vig;
        $pedido->numero_decreto     = $request->numero_decreto;
        $pedido->tipo_decreto       = $request->tipo_decreto;
        $pedido->data_vigencia      = $request->data_vigencia;
        $pedido->esforcos_realizados= $request->esforcos_realizados;
        $pedido->municipio_id       = $request->municipio_id;
        $pedido->regiao_id          = $request->regiao_id;
        $pedido->data_entrada_sistema= $request->data_entrada_sistema;
        $pedido->nome_coordenador   = $request->nome_coordenador;
        $pedido->tel_coordenador    = $request->tel_coordenador;
        $pedido->cel_coordenador    = $request->cel_coordenador;
        $pedido->email_coordenador  = $request->email_coordenador;
        $pedido->nome_prefeito      = $request->nome_prefeito;
        $pedido->tel_prefeito       = $request->tel_prefeito;
        $pedido->cel_prefeito       = $request->cel_prefeito;
        $pedido->email_prefeito     = $request->email_prefeito;
        $pedido->ano                = \Carbon\Carbon::parse($request->data_entrada_sistema)->year;

        if ($val->fails()) {
            return redirect()->back()->withErrors([
                'error' => $val->errors()->all(),
            ])->withInput($request->all());
        } else {
            $pedido->save();

            return redirect()->route('pedido/edit',[$pedido->id])->with([
                'message' => 'Registro Gravado com Sucesso, Favor Adicionar os Materiais e Anexar Documentos se necessário !',
                'active_tab' => '#-material_pedido-tab',
            ]);
        }
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


        /* despacho */
        $status = 0;

        if ($status == 0) { # 0 Edição Compdec
        } elseif ($status == 1) { # 1 Analise DLOG
        } elseif ($status == 2) { # 2 Analise Diretor DLOG.
        } elseif ($status == 3) { # 3 Aprovado
        } elseif ($status == 4) { # 4 Aguardando Disponibilidade Mat.
        } elseif ($status == 5) { # 5 Aguardando Retirada Mat.
        } elseif ($status == 6) { # 6 Atendido
        } elseif ($status == 7) { # 7 Cancelado
        } elseif ($status == 8) { # 8 Pedido Reprovado
        } elseif ($status == 9) { # 9 Processo Finalizado
        }

        $secao_parecer_list = [
            'Analise Dlog' => 'Analise Dlog',
            'COLCHAO'      => 'COLCHAO',
            'KIT HIGIENE'  => 'KIT HIGIENE',
            'KIT LIMPEZA'  => 'KIT LIMPEZA'
        ];
        //$secao_parecer_pluck = collect($secao_parecer_list)->pluck(())

        $materiais = AjudaPedidoItens::where('pedido_id', $pedido->id)->get();

        $documentos = Storage::allFiles('pedido/' . $pedido->id);

        $despachos = AjudaPedidoAnaliseTecnica::where('pedido_id', $pedido->id)->get();

        //$rdc = CedecRdc::all();

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
                //'optionMunicipio' => self::data()['optionMunicipio'],
                'optionCobrade' => self::data()['optionCobrade'],
                //'rdc' => $rdc,
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

        $pedido->cobrade_id         = $request->cobrade_id;
        $pedido->pop_atendida       = $request->pop_atendida;
        $pedido->decreto_se_ecp_vig = $request->decreto_se_ecp_vig;
        $pedido->numero_decreto     = $request->numero_decreto;
        $pedido->tipo_decreto       = $request->tipo_decreto;
        $pedido->data_vigencia      = $request->data_vigencia;
        $pedido->esforcos_realizados = $request->esforcos_realizados;


        $pedido->update();

        return redirect()->back()->with([
            'message' => 'Registro atualizado com Sucesso',
            'active_tab' => '#-dados_pedidos-tab',
        ]);
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

        $request->validate(
            [
                'anexoDoc' => 'required|mimes:pdf|max:2000',
            ],
            [
                'required'  => 'Obrigatório anexar um arquivo !',
                'max'    => 'Arquivo muito grande, Tamanho Máximo permitido : 2Mb',
                'mimes' => 'Tipo de Arquivos permitidos : pdf',
            ]
        );

        $file = $request->file('anexoDoc');

        $fileName = $request->pedido_id . "-pedid-" . time() . '_.' . $file->getClientOriginalExtension();

        $file->storeAs('pedido/' . $request->pedido_id, $fileName, 'public');

        return redirect()->back()->with([
            'message' => 'Arquivo Enviado com sucesso !',
            'active_tab' => '#-documentos-tab',
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
    public function deletedoc($id, $nome_file)
    {

        if (Storage::delete('pedido/' . $id . "/" . $nome_file)) {

            return redirect()->back()->with([
                'message' => 'Arquivo Apagado com Sucesso',
                'active_tab' => '#-documentos-tab',
            ]);
        } else {
            return redirect()->back()->with([
                'error' => 'Ocorreu um erro ao remover o arquivo',
                'active_tab' => '#-documentos-tab',
            ]);
        }
    }


    /* download de anexo do pedido */
    public function download($id, $nome_file)
    {

        return Storage::download('pedido/37/' . $nome_file);
    }

    /*
        mudança de status do pedido
    */

    public function status(AjudaPedido $pedido, $status)
    {

        # 0 Edição Compdec
        # 1 Analise DLOG
        # 2 Analise Diretor DLOG.
        # 3 Aprovado
        # 4 Aguardando Disponibilidade Mat.
        # 5 Aguardando Retirada Mat.
        # 6 Atendido
        # 7 Cancelado
        # 8 Pedido Reprovado
        # 9 Processo Finalizado

        $tramit = "";

        switch ($status) {
            case '0':
                $tramit = 'edicao_compdec';
                break;
            case '1':
                $tramit = 'analise_dlog';
                break;
            case '2':
                $tramit = 'analise_coord';
                break;
            case '3':
                $tramit = 'aprovado';
                break;
            case '4':
                $tramit = 'aguard_disp';
                break;
            case '5':
                $tramit = 'aguard_ret';
                break;
            case '6':
                $tramit = 'atendido';
                break;
            case '7':
                $tramit = 'cancelado';
                break;

            default:
                $tramit = 'Código Inválido';
                break;
        }

        $pedido->status = $status;
        $pedido->tramit = $tramit;

        $pedido->save();

        return redirect('mah_compdec')->with([
            'message' => "Pedido Enviado para Análise !",
            'active_tab' => "#-dados-pedidos-tab",
        ]);
    }
}
