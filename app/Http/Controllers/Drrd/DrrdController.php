<?php

namespace App\Http\Controllers\Drrd;


use App\Models\Drrd\Drrd;
use App\Models\Drrd\PaeEmpnto;
use App\Models\Drrd\PaeNotificacao;
use App\Models\Drrd\PaeProtocolo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DrrdController extends \App\Http\Controllers\Controller
{

    /**
     * Menu Ajuda
     */
    public function menu()
    {

        # acesso externo PAE
        if (auth()->user()->tipo == 'externo') {

            //$totalPaebm = PaeProtocolo::where('id_empdor', '=', auth()->user()->id_empdor)->count();

            $totalPaebm = DB::table('pae_protocolos')
                ->join('pae_empntos', 'pae_empntos.id', '=', 'pae_protocolos.pae_empnto_id')
                ->join('pae_empdors', 'pae_empdors.id', '=', 'pae_empntos.pae_empdor_id')
                ->where('pae_empdors.id', '=', auth()->user()->id_empdor)->count();


            //$notificacoes = PaeNotificacao::where('dt_notificacao', '<=', \Carbon\Carbon::now())->count();

            # notificações vencidas
            $notificacoes = DB::table('pae_protocolos')
                ->join('pae_empntos', 'pae_empntos.id', '=', 'pae_protocolos.pae_empnto_id')
                ->join('pae_empdors', 'pae_empdors.id', '=', 'pae_empntos.pae_empdor_id')
                ->join('pae_analises', 'pae_analises.pae_protocolo_id', '=', 'pae_protocolos.id')
                ->join('pae_notificacaos', 'pae_notificacaos.pae_analise_id', '=', 'pae_analises.id')
                ->where('dt_notificacao', '<=', \Carbon\Carbon::now())
                ->where('pae_empdors.id', '=', auth()->user()->id_empdor)->count();

            //$totPaeProxVenc = PaeProtocolo::where('limite_analise', "<=", \Carbon\Carbon::now()->subDays(10))->count();

            $totPaeProxVenc = DB::table('pae_protocolos')
                ->join('pae_empntos', 'pae_empntos.id', '=', 'pae_protocolos.pae_empnto_id')
                ->join('pae_empdors', 'pae_empdors.id', '=', 'pae_empntos.pae_empdor_id')
                ->where('limite_analise', "<=", \Carbon\Carbon::now()->subDays(10))
                ->where('pae_empdors.id', '=', auth()->user()->id_empdor)->count();


            $totCcpae = DB::table('pae_protocolos')
                ->where('ccpae', '<>', NULL)->count();
        
        # notificações gerais
        } else {

            $totalPaebm = PaeProtocolo::count();

            $notificacoes = PaeNotificacao::where('dt_notificacao', '<=', \Carbon\Carbon::now())->count();

            $totPaeProxVenc = PaeProtocolo::where('limite_analise', "<=", \Carbon\Carbon::now()->subDays(10))->count();

            $totCcpae = PaeProtocolo::where('ccpae', '<>', NULL)->count();
        }

        return view(
            'drrd/index',
            [
                'total_protocolo' => $totalPaebm,
                'notificacoes'    => $notificacoes,
                'totPaeProxVenc'  => $totPaeProxVenc,
                'totCcpae'        => $totCcpae,
            ]
        );
    }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drrd\Drrd  $drrd
     * @return \Illuminate\Http\Response
     */
    public function show(Drrd $drrd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drrd\Drrd  $drrd
     * @return \Illuminate\Http\Response
     */
    public function edit(Drrd $drrd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drrd\Drrd  $drrd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drrd $drrd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drrd\Drrd  $drrd
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drrd $drrd)
    {
        //
    }


    public function acesso()
    {

        return view('login');
    }
}
