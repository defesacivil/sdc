<?php

namespace App\Http\Controllers\Drrd;

use App\Models\Drrd\PaeEmpnto;
use App\Models\Drrd\PaeProtocolo;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaeProtocoloController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $notificacao = PaeProtocolo::with(
            'analise',
            'analise.protocolos'
        )
            ->whereRaw("'pae_protocolos.id' = 4")
            ->whereRaw("DATEDIFF('pae_notIficacaos.dt_devolutiva', '" . Carbon::now() . "') <=5")
            ->get();

        //dd($notificacao);

        if ($request->method() == "GET") {

            //$protocolos = PaeProtocolo::paginate(7);
            $protocolos = PaeProtocolo::with(
                [
                    'empreendimento',
                    'empreendimento.empreendedor'
                ]
            )->paginate(7);




            return view(
                'drrd/paebm/protocolo/index',
                [
                    'protocolos' => $protocolos,
                ]
            );
        } elseif ($request->method() == "POST") {


            $protocolos = PaeProtocolo::with(
                [
                    'empreendimento',
                    'empreendimento.empreendedor'
                ]
            )->where('pae_protocolos.num_protocolo', 'LIKE', '%' . $request->get('search') . '%')
                ->paginate(7);

            return view(
                'drrd/paebm/protocolo/index',
                [
                    'protocolos' => $protocolos,
                ]
            );
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

        return view(
            'drrd/paebm/protocolo/create',
            [
                'empntos' => $empntos,
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
            substr(Str::replace(["-", ":"], "", $request->dt_entrada), 0,8) . "-" .
            ($protocolo->latest()->first()->id + 1);

        $protocolo->dt_entrada     = Carbon::parse($request->dt_entrada)->format('Y-m-d');
        $protocolo->user_id        = $request->user_id;
        $protocolo->limite_analise = Carbon::parse(Str::replace("/", "-", $request->limite_analise))->format('Y-m-d');
        $protocolo->ccpae          = $request->ccpae;
        $protocolo->ccpae_venc     = $request->ccpae_venc;
        $protocolo->pae_empnto_id  = $request->pae_empnto_id;
        $protocolo->obs            = $request->obs;

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
            'analises',
            'analises.usuario',
            'analises.notificacoes',
            'analises.notificacoes.usuario',
            'empreendimento',
            'empreendimento.empreendedor',
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

        $protocolo = PaeProtocolo::join('pae_empntos', 'pae_empntos.id', '=', 'pae_protocolos.pae_empnto_id')
                                        ->where('pae_protocolos.id', $paeProtocolo->id)->get()->first();
                                    
        return view(
            'drrd/paebm/protocolo/edit',
            [
                'protocolo' => $protocolo,

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
        //dd($paeProtocolo);

        $request->validate(
            [
                'ccpae' => "nullable|digits_between:1,50",
                'ccpae_venc' => "nullable|date",
                'empnto_search' => "required",
                'pae_empnto_id' => "required|integer",
                'obs' => "required|min:5|max:1000",

            ],
            [
                'ccpae.digits_between' => "O campo CCPAE deve ser somente números !",
                'ccpae_venc.date' => "O campo CCPAE Vencimento deve ser uma Data Válida !",
                'empnto_search.required' => "O campo Empreendimento é obrigatório !",
                'pae_empnto_id.required' => "O campo Id Empreendimento é Obrigatório !",
                'obs.required' => "O campo Observação é Obrigatório !",       
                'obs.max' => "O campo Observação deve ter no máximo 1000 caracteres!",       
                'obs.min' => "O campo Observação deve ter no mínimo 5 caracteres!",

            ]
        );


        $protocolo = PaeProtocolo::find($request->id);


        $protocolo->user_id        = Auth::user()->id;
        $protocolo->ccpae          = $request->ccpae;
        $protocolo->ccpae_venc     = $request->ccpae_venc;
        $protocolo->pae_empnto_id  = $request->pae_empnto_id;
        $protocolo->obs            = $request->obs;

        $protocolo->update();

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
}
