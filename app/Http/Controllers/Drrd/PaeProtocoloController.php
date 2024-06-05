<?php

namespace App\Http\Controllers\Drrd;

use App\Models\Drrd\PaeEmpnto;
use App\Models\Drrd\PaeProtocolo;
use App\Models\Drrd\PaeTramitprot;
use App\Models\User;
use App\Models\Usuario\RoleDem;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PaeProtocoloController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //dd(!auth()->user()->can('paeusuario'));

        if (!auth()->user()->can('paeusuario')) {
            return $this->minerar($request);
        } else {
            /*bloquear acesso do empreendedor */

            $notificacao = PaeProtocolo::with(
                'analise',
                'analise.protocolos'
            )
                ->whereRaw("'pae_protocolos.id' = 4")
                ->whereRaw("DATEDIFF('pae_notIficacaos.dt_devolutiva', '" . Carbon::now() . "') <=5")
                ->get();

            # acesso via index
            if ($request->method() == "GET") {



                # acesso externo PAE
                if ($request->user()->can('externo')) {

                    $protocolos = PaeProtocolo::with(
                        'empreendimento',
                        'empreendimento.empreendedor',
                        'analises',
                        'analises.notificacoes'
                    )
                        ->whereRaw('pae_empdor_id', '=', Auth::user()->id_empdor)
                        ->paginate(30);

                    # acesso                                                        
                } else {

                    $protocolos = PaeProtocolo::with(
                        'empreendimento',
                        'empreendimento.empreendedor',
                        'analises',
                        'analises.notificacoes'
                    )->paginate(30);
                }

                // $protocolos = DB::table('pae_protocolos')
                //     ->join('pae_empntos', 'pae_empntos.id', '=', 'pae_protocolos.pae_empnto_id')
                //     ->join('pae_empdors', 'pae_empdors.id', '=', 'pae_empntos.pae_empdor_id')
                //     ->join('users', 'users.id', '=', 'pae_protocolos.user_id')
                //     ->join('pae_analises', 'pae_analises.pae_protocolo_id','=', 'pae_protocolos.id') 
                //     ->where('pae_protocolos.num_protocolo', 'LIKE', '%' . $request->get('search') . '%')
                //     ->addSelect('pae_protocolos.*')
                //     ->addSelect('pae_empntos.nome as empreendimento')
                //     ->addSelect('users.name')
                //     ->addSelect('pae_analises.*')
                //     ->addSelect('pae_empdors.nome as empreendedor')

                //     ->paginate(50);




                //dd($protocolos);

                return view(
                    'drrd/paebm/protocolo/index',
                    [
                        'protocolos' => $protocolos,
                        //'tramits' => $tramits,
                    ]
                );

                # busca de registro 
            } elseif ($request->method() == "POST") {

                if (($request->get('search') != "") && ($request->get('dtInicio') == "") && ($request->get('dtFinal') == "")) {

                    $protocolos = PaeProtocolo::with([
                        'empreendimento',
                        'empreendimento.empreendedor',
                        'analises',
                        'analises.notificacoes'
                    ])
                        ->orWhere('num_protocolo', 'LIKE', '%' . $request->get('search') . '%')
                        ->orWhereRelation('empreendimento', 'nome', 'LIKE', '%' . $request->get('search') . '%')
                        ->paginate(30);
                } elseif (($request->get('search') == "") && ($request->get('dtInicio') != "") && ($request->get('dtFinal') != "")) {

                    $protocolos = PaeProtocolo::with([
                        'empreendimento',
                        'empreendimento.empreendedor',
                        'analises',
                        'analises.notificacoes'
                    ])
                        ->orWhereBetween('dt_entrada', [$request->get('dtInicio'),  $request->get('dtFinal')])
                        ->paginate(30);;
                }

                return view(
                    'drrd/paebm/protocolo/index',
                    [
                        'protocolos' => $protocolos,
                    ]
                );
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empntos = PaeEmpnto::all();

        $sit_mancha = $finalidade  = [
            'EM ANÁLISE' => 'EM ANÁLISE',
            'APROVADA' => 'APROVADA',
            'REPROVADA' => 'REPROVADA',
        ];

        $m_construcao = [
            'CONCRETO - ECJ' => 'CONCRETO - ECJ',
            'ETAPA ÚNICA - ATERRO COMPACTADO' => 'ETAPA ÚNICA - ATERRO COMPACTADO',
            'JUSANTE' => 'JUSANTE',
            'LINHA DE CENTRO' => 'LINHA DE CENTRO',
            'MONTANTE' => 'MONTANTE',
            'ENRONCAMENTO' => 'ENRONCAMENTO',
            'CONCRETO' => 'CONCRETO',
        ];

        $material = [
            'ÁGUA'              => 'ÁGUA',
            'REJEITO'           => 'REJEITO',
            'SEDIMENTO'         => 'SEDIMENTO',
            'RESÍDUO INDUSTRIAL' => 'RESÍDUO INDUSTRIAL',
        ];
        $orgao_fisc = [
            'ANM' => 'ANM',
            'ANEEL' => 'ANEEL',
            'IGAM' => 'IGAM',
            'FEAM' => 'FEAM',
        ];
        $finalidade  = [
            'INDUSTRIA' => 'INDUSTRIA',
            'MINERAÇÃO' => 'MINERAÇÃO',
        ];

        return view(
            'drrd/paebm/protocolo/create',
            [
                'empntos' => $empntos,
                'sit_mancha' => $sit_mancha,
                'm_construcao' => $m_construcao,
                'material' => $material,
                'orgao_fisc' => $orgao_fisc,
                'finalidade' => $finalidade,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request, Carbon::parse($request->limite_analise)->format('Y-m-d'));

        $request->validate(
            [
                'dt_entrada' => "required|date",
                'user_id' => "required|integer",
                'limite_analise' => "required",
                'ccpae' => "nullable|digits_between:1,50",
                'ccpae_venc' => "nullable|date",
                'empnto_search' => "required",
                'pae_empnto_id' => "required|integer",
                /*'obs' => "required|min:5|max:1000",*/
                'sei' => "max:150",

            ],
            [
                'dt_entrada.required' => "O campo Data de Entrada é Obrigatório !",
                'dt_entrada.date' => "O campo Data de Entrada deve ser uma Data válida !",
                'user_id' => "O campo Usuario é Obrigatório !",
                'limite_analise.required' => "O campo Data Limite é Obrigatório !",
                //'limite_analise.data' => "O campo Data de Limite deve ser uma Data válida !",
                'ccpae.digits_between' => "O campo CCPAE deve ser somente números !",
                'ccpae_venc.date' => "O campo CCPAE Vencimento deve ser uma Data Válida !",
                'empnto_search.required' => "O campo Empreendimento é obrigatório !",
                'pae_empnto_id.required' => "O campo Id Empreendimento é Obrigatório !",
                /*'obs.required' => "O campo Observação é Obrigatório !",       
                'obs.max' => "O campo Observação deve ter no máximo 1000 caracteres!",       
                'obs.min' => "O campo Observação deve ter no mínimo 5 caracteres!",       */
                'sei.max' => "O campo Observação deve ter no máximo 150 caracteres!",

            ]
        );



        $protocolo = new PaeProtocolo;
        $empdor = PaeEmpnto::with(['empreendedor'])->where('id', '=', $request->pae_empnto_id)->get();


        /*
            id_empreendedor-
            id_empreendimento-
            num_aleatorio_ate_999-
            data_entrada-
            (id_protocolo+1)

        */
        $protocolo->num_protocolo  = $empdor[0]->empreendedor->id . "-" .
            $request->pae_empnto_id . "-" .
            rand(0, 999) . "-" .
            substr(Str::replace(["-", ":"], "", $request->dt_entrada), 0, 8) . "-" .
            ($protocolo->latest()->first()->id + 1);

        $protocolo->dt_entrada     = Carbon::parse($request->dt_entrada)->format('Y-m-d');
        $protocolo->user_id        = $request->user_id;
        $protocolo->limite_analise = Carbon::parse(Str::replace("/", "-", $request->limite_analise))->format('Y-m-d');
        $protocolo->ccpae          = $request->ccpae;
        $protocolo->ccpae_venc     = $request->ccpae_venc;
        $protocolo->pae_empnto_id  = $request->pae_empnto_id;
        $protocolo->obs            = $request->obs;
        $protocolo->sei            = $request->sei;
        $protocolo->sit_mancha     = $request->sit_mancha;

        $protocolo->save();

        return redirect('pae/protocolo')->with('message', 'Registro Gravado com Sucesso ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drrd\PaeProtocolo  $paeProtocolo
     * @return \Illuminate\Http\Response
     */
    public function show(PaeProtocolo $paeProtocolo)
    {


        // $protocolos = DB::table('pae_protocolos')
        // ->join('users', 'users.id', '=', 'pae_protocolos.user_id')
        // ->join('pae_analises', 'pae_analises.pae_protocolo_id', '=', 'pae_protocolos.id')
        // ->select('users.name', 'users.id as usuario_id','pae_analises.user_id as analise_user_id')
        // ->get();

        $protocolos = PaeProtocolo::with([
            'usuario',
            'empreendimento',
            'empreendimento.empreendedor',
            'analises',
            'analises.usuario',
            'analises.notificacoes',
            'analises.notificacoes.usuario',
        ])->where('pae_protocolos.id', '=', $paeProtocolo->id)
            ->get();


        return view(
            'drrd/paebm/protocolo/show',
            [
                'protocolos' => $protocolos,

            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drrd\PaeProtocolo  $paeProtocolo
     * @return \Illuminate\Http\Response
     */
    public function edit(PaeProtocolo $paeProtocolo)
    {
        $sit_mancha = [
            'EM ANÁLISE' => 'EM ANÁLISE',
            'APROVADA' => 'APROVADA',
            'REPROVADA' => 'REPROVADA',
        ];

        $protocolo = DB::table('pae_protocolos')
            ->join('pae_empntos', 'pae_empntos.id', '=', 'pae_protocolos.pae_empnto_id')
            ->select('pae_protocolos.*', 'pae_empntos.nome')
            ->where('pae_protocolos.id', $paeProtocolo->id)
            ->get();

        //dd($protocolo);

        return view(
            'drrd/paebm/protocolo/edit',
            [
                'protocolo' => $protocolo[0],
                'sit_mancha' => $sit_mancha,

            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drrd\PaeProtocolo  $paeProtocolo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaeProtocolo $paeProtocolo)
    {

        $request->validate(
            [
                'ccpae' => "nullable|digits_between:1,50",
                'ccpae_venc' => "nullable|date",
                'empnto_search' => "required",
                'pae_empnto_id' => "required|integer",
                'obs' => "required|min:5|max:1000",
                'sei' => "max:150",

            ],
            [
                'ccpae.digits_between' => "O campo CCPAE deve ser somente números !",
                'ccpae_venc.date' => "O campo CCPAE Vencimento deve ser uma Data Válida !",
                'empnto_search.required' => "O campo Empreendimento é obrigatório !",
                'pae_empnto_id.required' => "O campo Id Empreendimento é Obrigatório !",
                'obs.required' => "O campo Observação é Obrigatório !",
                'obs.max' => "O campo Observação deve ter no máximo 1000 caracteres!",
                'obs.min' => "O campo Observação deve ter no mínimo 5 caracteres!",
                'sei.max' => "O campo Observação deve ter no máximo 150 caracteres!",
            ]
        );


        $protocolo = PaeProtocolo::find($request->id);

        $oldValue = $protocolo;

        $protocolo->user_id        = Auth::user()->id;
        $protocolo->ccpae          = $request->ccpae;
        $protocolo->ccpae_venc     = $request->ccpae_venc;
        $protocolo->pae_empnto_id  = $request->pae_empnto_id;
        $protocolo->obs            = $request->obs;
        $protocolo->sei            = $request->sei;
        $protocolo->sit_mancha     = $request->sit_mancha;
        $protocolo->user_update    = Auth::user()->name;

        $protocolo->update();

        //dd(",",$oldValue );

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/updatePaeBM.log'),
        ])->info('Update {"Usuário:"' . Auth()->user()->name . '"campo:"}');

        return redirect('pae/protocolo')->with('message', 'Registro Atualizado com Sucesso ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drrd\PaeProtocolo  $paeProtocolo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaeProtocolo $paeProtocolo)
    {
        //
    }


    /**
     * Atribuir processo para Analista
     */
    public function atribuir(Request $request)
    {


        // $lista_analista = User::pluck('name', 'name');

        $lista_analista = User::permission('paeadmin')->pluck('name', 'id');

        dd($request->analista);

        # get 
        if ($request->method() == "GET") {

            return view(
                'drrd/paebm/protocolo/atribuir',
                [
                    'protocolo_id' => $request->id,
                    'lista_analista'  => $lista_analista,
                ]

            );

            # post
        } elseif ($request->method() == "POST") {



            $prot = PaeProtocolo::find($request->id);

            $prot->analista = $request->analista;

            $prot->save();

            return redirect()->action(['App\Http\Controllers\Drrd\PaeProtocoloController', 'index']);
        }
    }


    /**
     * Display a listing of the resource.
     * @param Pagina especifica do acesso do empreendedor
     * @return \Illuminate\Http\Response
     */
    public function minerar(Request $request)
    {



        $notificacao = PaeProtocolo::with(
            'analise',
            'analise.protocolos'
        )
            //->whereRaw("'pae_protocolos.id' = 4")
            ->whereRaw("DATEDIFF('pae_notIficacaos.dt_devolutiva', '" . Carbon::now() . "') <=5")
            ->get();

        # acesso via index
        if ($request->method() == "GET") {

            //dd('get', Auth::user()->id_empdor);
            $protocolos = PaeProtocolo::with(
                'empreendimento',
                'empreendimento.empreendedor',
                'analises',
                'analises.notificacoes'
            )
                ->orWhereRelation('empreendimento', 'nome', 'LIKE', '%' . $request->get('search') . '%')
                ->whereRelation('empreendimento.empreendedor', 'pae_empdor_id', '=', Auth::user()->id_empdor)
                ->paginate(30);




            # busca de registro 
        } elseif ($request->method() == "POST") {

            if (($request->get('search') != "") && ($request->get('dtInicio') == "") && ($request->get('dtFinal') == "")) {

                $protocolos = PaeProtocolo::with([
                    'empreendimento',
                    'empreendimento.empreendedor',
                    'analises',
                    'analises.notificacoes'
                ])
                    ->orWhere('num_protocolo', 'LIKE', '%' . $request->get('search') . '%')
                    ->orWhereRelation('empreendimento', 'nome', 'LIKE', '%' . $request->get('search') . '%')
                    ->whereRelation('empreendimento.empreendedor', 'pae_empdor_id', '=', Auth::user()->id_empdor)
                    ->paginate(30);;
            } elseif (($request->get('search') == "") && ($request->get('dtInicio') != "") && ($request->get('dtFinal') != "")) {

                $protocolos = PaeProtocolo::with([
                    'empreendimento',
                    'empreendimento.empreendedor',
                    'analises',
                    'analises.notificacoes'
                ])
                    ->orWhereBetween('dt_entrada', [$request->get('dtInicio'),  $request->get('dtFinal')])
                    ->whereRelation('empreendimento.empreendedor', 'pae_empdor_id', '=', Auth::user()->id_empdor)
                    ->paginate(30);
            } else {

                $protocolos = PaeProtocolo::with([
                    'empreendimento',
                    'empreendimento.empreendedor',
                    'analises',
                    'analises.notificacoes'
                ])
                    ->whereRelation('empreendimento.empreendedor', 'pae_empdor_id', '=', Auth::user()->id_empdor)
                    ->paginate(30);
            }
        }

        return view(
            'drrd/paebm/protocolo/minerar',
            [
                'protocolos' => $protocolos,
            ]
        );
    }


    # visualização dos usuarios externos
    public function user(Request $request)
    {


        if (Auth::user()->hasRole('paeusuario')) {

            //dd($request->all());
            if ($request->method() == "GET") {
                $usuarios = DB::table('users')
                    ->where("tipo", "=", "externo")
                    ->join("pae_empdors", "users.id_empdor", "=", "pae_empdors.id")
                    ->select("users.*", "pae_empdors.nome as empreendedor")
                    ->get();
            } else {

                $usuarios = DB::table('users')
                    ->where("tipo", "=", "externo")
                    ->where("users.name", 'LIKE', '%' . $request->get('pesquisa') . '%')
                    ->join("pae_empdors", "users.id_empdor", "=", "pae_empdors.id")
                    ->select("users.*", "pae_empdors.nome as empreendedor")
                    ->get();
            }

            //dd($usuarios);

            return view(
                'drrd/paebm/users/usuario',
                [
                    'usuarios' => $usuarios,
                ]
            );
        } else {
            return redirect()->back();
        }
    }
}
