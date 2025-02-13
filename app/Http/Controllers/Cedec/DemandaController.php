<?php

namespace App\Http\Controllers\Cedec;

use App\Http\Controllers\Controller;
use App\Models\Cedec\Demanda;
use Illuminate\Http\Request;

class DemandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $catCollectcat = collect();

        $categorias = $catCollectcat->put('1', 'Cidade Administrativa');

        return view(
            'cedec.demanda.index',
            [
                'categorias' => $categorias,
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

        $servicos = [

            'SDC - Cadastro'     => 'SDC - Cadastro',
            'Sei - permissão'    => 'Sei - permissão',
            'Sei - Cadastro'     => 'Sei - Cadastro',
            'Impressora sem Toner'     => 'Trocar Tonner de Impressora',
            'Acesso Caixa Email' => 'Acesso do Email da Caixa Administrativa',
        ];

        $email_adm = [

            'defesacivil@defesacivil.mg.gov.br' => 'DefesaCivil',
            'sdb@defesacivil.mg.gov.br'         => 'DSB' ,
            'splan@defesacivil.mg.gov.br'       => 'SPLAN' ,
            'apdc@defesacivil.mg.gov.br'        => 'APDC' ,
        ];

        $secao = [

            'STO'    => 'STO - Superintendencia Técnico Operacional',
            'DPLAN'  => 'DPLAN - Diretoria de Planejamento',
            'SPLAN'  => 'SPLAN - Superintendencia de Planejamento',
            'SADM'   => 'SADM - Superintendencia Administativa',
            'DRRD'   => 'DRRD - Diretoria de Redução Risco de Desastre',
            'DRD'    => 'DRD - Diretoria de Resposta a Desastre',
            'DEPDC'  => 'DEPDC - Diretoria de Ensino',
            'DSB'    => 'DSB - Diretoria de Segurança de Barragens',
            'NAR'    => 'NAR - Núcleo de Apoio as Regionais',
            'CINDEC' => 'CINDEC - Centro de Inteligência em Defesa Civil',
            'GMG'    => 'GMG - Gabinete Militar do Governador',
        ];

        return view(
            'cedec.demanda.create',
            [
                'servicos'  => $servicos,
                'secao'     => $secao,
                'email_adm' => $email_adm,
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
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cedec\Demanda  $demanda
     * @return \Illuminate\Http\Response
     */
    public function show(Demanda $demanda)
    {
        dd($demanda);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cedec\Demanda  $demanda
     * @return \Illuminate\Http\Response
     */
    public function edit(Demanda $demanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cedec\Demanda  $demanda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demanda $demanda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cedec\Demanda  $demanda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demanda $demanda)
    {
        //
    }
}
