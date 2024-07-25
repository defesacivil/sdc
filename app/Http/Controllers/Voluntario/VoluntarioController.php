<?php

namespace App\Http\Controllers\Voluntario;

use Illuminate\Http\Request;
use App\Models\Cedec\Profissao;
use App\Models\Municipio\Municipio;
use App\Http\Controllers\Controller;
use App\Models\Municipio\Regiao;
use App\Models\Voluntario\Voluntario;
use Illuminate\Support\Facades\DB;

class VoluntarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $profissaos = Profissao::all()->pluck('nome', 'id');
        $municipios = Municipio::all()->pluck('nome', 'id');
        $reg_mun = DB::table('cedec_municipio')
        ->join('cedec_rpm_mun', 'cedec_municipio.id', '=', 'cedec_rpm_mun.id_municipio')
        ->select('cedec_municipio.id', 'cedec_rpm_mun.id_rpm')->get();


        return view("cedec.voluntario.index", [

            'profissaos' => $profissaos,
            'municipios' => $municipios,
            'reg_mun'    => $reg_mun,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $request->validate(
            [
                'nome'         => 'required|max:110',
                'cpf'          => 'required|max:15',
                'ci'           => 'max:15',
                'profissao'    => 'max:50',
                'atividade'    => 'max:50',
                'email'        => 'email|required|max:110',
                'municipio_id' => 'required|integer',
                'regiao_id'    => 'required',
            ],
            [
                'nome.required'  => 'Campo Nome é de preenchimento Obrigatório !',
                'nome.max'  => 'Campo Nome deve ter no máximo 110 Caracteres !',
                'cpf.required'  => 'Campo CPF é de preenchimento Obrigatório !',
                'cpf.max'  => 'Campo CPF deve ter no máximo 15 Caracteres !',
                'ci.max'  => 'Campo C.I deve ter no máximo 15 Caracteres !',
                'profissao.max'  => 'Campo Profissão deve ter no máximo 50 Caracteres !',
                'atividade.max'  => 'Campo Atividade deve ter no máximo 50 Caracteres !',
                'email.required'  => 'Campo E-mail é de preenchimento Obrigatório !',
                'email.max'  => 'Campo E-mail deve ter no máximo 110 Caracteres !',
                'email.email'  => 'Campo E-mail deve ter um e-mail válido !',
                'municipio_id.required'  => 'Campo Município é de preenchimento Obrigatório !',
                'municipio_id.integer'  => 'Campo Município deve ter valor numérico !',
                'regiao_id.required'  => 'Campo Interno Região de DC é de preenchimento Obrigatório !',

            ]
        );

            $voluntario = new Voluntario();

            $voluntario->nome         = $request->nome;
            $voluntario->cpf          = $request->cpf;
            $voluntario->ci           = $request->ci;
            $voluntario->profissao    = $request->profissao;
            $voluntario->atividade    = $request->atividade;
            $voluntario->email        = $request->email;
            $voluntario->municipio_id = $request->municipio_id;
            $voluntario->regiao_id    = $request->regiao_id;

            dd($voluntario->save());


        return redirect('voluntariado')->with('message', 'Registro gravado com Sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voluntario\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function show(Voluntario $voluntario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voluntario\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function edit(Voluntario $voluntario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voluntario\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voluntario $voluntario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voluntario\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voluntario $voluntario)
    {
        //
    }
}
