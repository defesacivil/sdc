<?php

namespace App\Http\Controllers\Voluntario;

use Illuminate\Http\Request;
use App\Models\Cedec\Profissao;
use App\Models\Municipio\Municipio;
use App\Http\Controllers\Controller;
use App\Models\Cedec\CedecRdc;
use App\Models\Cedec\Telefone;
use App\Models\Municipio\Regiao;
use App\Models\Voluntario\Voluntario;
use Exception;
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
        $municipios = Municipio::all(['nome', 'id'])->pluck('nome', 'id');
        $total = Voluntario::all()->count();
        $municipio = Voluntario::all()->groupBy('municipio_id')->count();
        $regiao = Voluntario::all()->groupBy('regiao_id')->count();


        # qtd por municipio
        $tot_municipios = DB::table("cedec_voluntario")
            ->join("cedec_municipio", "cedec_municipio.id", "=", "cedec_voluntario.municipio_id")
            ->select("cedec_municipio.nome as municipio", "cedec_voluntario.regiao_id as regiao", DB::raw("count(cedec_voluntario.municipio_id) as total"))
            ->groupBy('cedec_voluntario.municipio_id')
            ->orderBy('cedec_municipio.nome')
            ->get();

        # qtd por região
        $tot_regiaos = DB::table("cedec_voluntario")
            ->join("cedec_rpm_mun", "cedec_rpm_mun.id_municipio", "=", "cedec_voluntario.municipio_id")
            ->select("cedec_rpm_mun.id_rpm as regiao", DB::raw("count(cedec_voluntario.regiao_id) as total"))
            ->groupBy('cedec_voluntario.regiao_id')->get();

        # atividades

        $tot_atividades = DB::table("cedec_voluntario")
        ->join("cedec_profissaos", "cedec_profissaos.id", "=", "cedec_voluntario.profissao")
        ->select("cedec_voluntario.atividade", "cedec_profissaos.nome as profissao", "cedec_profissaos.id as profissao_id", DB::raw("count(cedec_voluntario.atividade) as total"))
        ->groupBy('cedec_voluntario.atividade')->get();

        return view("cedec.voluntario.index", [

            'profissaos' => $profissaos,
            'municipios' => $municipios,
            'total'      => $total,
            'municipio'      => $municipio,
            'regiao'      => $regiao,
            'tot_municipios' => $tot_municipios,
            'tot_regiaos' => $tot_regiaos,
            'tot_atividades' => $tot_atividades,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $profissaos = Profissao::all()->pluck('nome', 'id');
        $municipios = Municipio::all(['nome', 'id'])->pluck('nome', 'id');

        return view("cedec.voluntario.create", [

            'profissaos' => $profissaos,
            'municipios' => $municipios,

        ]);
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
                'disp_viagem'  => 'integer|max:1'
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

            ]
        );

        $voluntario = new Voluntario();

        $regiao_id = CedecRdc::select('id_rpm')->where('id_municipio', '=', $request->municipio_id)->first();

        $voluntario->nome         = $request->nome;
        $voluntario->cpf          = $request->cpf;
        $voluntario->ci           = $request->ci;
        $voluntario->profissao    = $request->profissao;
        $voluntario->atividade    = $request->atividade;
        $voluntario->email        = $request->email;
        $voluntario->municipio_id = $request->municipio_id;
        $voluntario->regiao_id    = $regiao_id['id_rpm'];
        $voluntario->disp_viagem  = $request->disp_viagem;
        $voluntario->status       = 1;

        try {
            $voluntario->save();


            foreach ($request->telefones as $key => $telefone) {

                $tel = new Telefone();
                $tel->model_type = "App\\Model\\Voluntario";
                $tel->model_id   = $voluntario->id;
                $tel->telefone   = $telefone;
                $tel->whatsapp   = $request->sel_zap[$key];

                $tel->save();
            }
        } catch (\Illuminate\Database\QueryException $e) {

            //dd($e);
            return redirect('gade')->withErrors(['message' => 'O CPF já está em nossa base de Dados !']);
        }


        return redirect('gade')->with('message', 'Registro gravado com Sucesso');
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


    public function profissao($field)
    {
      
        $dados = DB::table('cedec_voluntario')
        ->join('cedec_profissaos', 'cedec_profissaos.id', '=', 'cedec_voluntario.profissao')
        ->select('cedec_voluntario.nome', 'cedec_voluntario.email', 'cedec_profissaos.nome as profissao')
        ->where('cedec_voluntario.profissao', '=', $field)->get();

        //dd($dados);
        
        return view('cedec.voluntario.listagem.profissao',[

            'dados' => $dados,
        ]
        );


    }
}
