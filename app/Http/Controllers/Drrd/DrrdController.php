<?php

namespace App\Http\Controllers\Drrd;


use App\Models\Drrd\Drrd;
use App\Models\Drrd\PaeEmpnto;
use App\Models\Drrd\PaeNotificacao;
use App\Models\Drrd\PaeProtocolo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


        $totalPaebm = PaeProtocolo::count();

        $notificacoes = PaeNotificacao::where('dt_notificacao', '<=', \Carbon\Carbon::now())->count();

        $totPaeProxVenc = PaeProtocolo::where('limite_analise', "<=", \Carbon\Carbon::now()->subDays(10))->count();

        return view('drrd/index',
                [
                    'total_protocolo' => $totalPaebm,
                    'notificacoes'  => $notificacoes,
                    'totPaeProxVenc' => $totPaeProxVenc,
                ]);
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


    public function acesso(){

        return view('login');
    }


    
}
