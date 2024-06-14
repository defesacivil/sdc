<?php

namespace App\Http\Controllers\Drrd;


use App\Models\Compdec\ComRegiao;
use App\Models\Drrd\PaeCoord;
use App\Models\Drrd\PaeEmpdor;
use App\Models\Drrd\PaeEmpnto;
use App\Models\Municipio\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaeEmpntoController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->method() == "GET") {

            if(auth()->user()->tipo == 'externo'){

                $empntos = PaeEmpnto::with('municipio')
                                        ->where('pae_empdor_id', '=', Auth::user()->id_empdor)
                                        ->paginate(7);

            }else {
                $empntos = PaeEmpnto::with('municipio')->paginate(7);
            }

            return view(
                'drrd/paebm/empnto/index',
                [
                    'empntos' => $empntos,
                ]
            );
        } elseif ($request->method() == "POST") {

            if(auth()->user()->tipo == 'externo'){

                $empntos = PaeEmpnto::with('municipio')
                ->with('empreendedor')
                ->where('pae_empntos.nome', 'LIKE', '%' . $request->get('search') . '%')
                ->where('pae_empdor_id', '=', Auth::user()->id_empdor)
                ->paginate(7);


            }else {

            $empntos = PaeEmpnto::with('municipio')
                ->with('empreendedor')
                ->where('pae_empntos.nome', 'LIKE', '%' . $request->get('search') . '%')
                ->paginate(7);

            }

            return view(
                'drrd/paebm/empnto/index',
                [
                    'empntos' => $empntos,
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

        $empdors = PaeEmpdor::all()->pluck('id', 'nome');


        $m_construcao = [
            'ESTRUTURA DE CONTENÇÃO À JUSANTE' => 'ESTRUTURA DE CONTENÇÃO À JUSANTE',
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
            'drrd/paebm/empnto/create',
            [
                'empdors' => $empdors,
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
        $request->validate(
            [
                'nome'               => "required|max:110",
                'empdor_search'      => "required|max:110",
                'pae_empdor_id'      => "required|integer",
                'municipio_search'   => "required|max:110",
                'municipio_id'       => "required|integer",
                'regiao_search'      => "required|max:70",
                'regiao_id'          => "required|integer",
                'm_construcao'       => "required|max:50",
                'material'           => "required|max:50",
                'finalidade'         => "required|max:50",
                'volume'             => "required|max:50",
                'pop_zas'            => "required|max:50",
                'orgao_fisc'         => "required|max:50",
                // 'coordenador_search' => "required|max:70",
                // 'pae_coordenador_id' => "required|integer",
                'coordenador'        => "max:110",
                'tel_coordenador'    => "max:20",
                'mina'               => "max:100",
                'coordenador_sub'        => "max:110",
                'tel_coordenador_sub'    => "max:20",
                'email_coord_sub'        => "max:120",
            ],
            [
                'id.required' => 'O campo Id não está presente',
                'nome.required' => 'O campo  é Obrigatório !',
                'nome.max' => 'O campo Nome suporta no máximo 110 caracteres !',
                'pae_empdor_id' => 'O campo Empreendendor é Obrigatório',
                'empdor_search' => "O campo Empreendendor é Obrigatório",
                'municipio_id.required' => "O campo Municipio não pode ficar em Branco",
                'regiao_id.required' => "O campo Região é Obrigatório !",
                'm_construcao.required' => "O campos Metodo de construção é obrigatorio !",
                'm_construcao.max' => "O campo Metodo de Construção ",
                'material.required' => "O campo Material da Barragem é Obrigatório",
                'material.max' => "O campo Material da Barragem suporta no máximo 50 caracteres !",
                'finalidade.required' => "O campo Finalidade é obrigatório !",
                'finalidade.max' => "O campo Finalidade suporta no máximo 50 caracteres !",
                'volume.required' => "O campo Volume é obrigatório !",
                'volume.max' => "O campo Volume suporta no máximo 50 caracteres !",
                'pop_zas.required' => "O campo População da ZAS é obrigatório !",
                'pop_zas.max' => "O campo População da ZAZ suporta no máximo 50 caracteres !",
                'orgao_fisc.required' => "O campo Órgão Fiscalizador é obrigatório !",
                'orgao_fisc.max' => "O campo Órgão Fiscalizador suporta no máximo 50 caracteres !",
                // 'pae_coordenador_id.required' => "O campo Coordenador é obrigatório !",
                // 'pae_coordenador_id.integer' => "O campo Coordenador aceita somente números !",
                'coordenador' => "O campo Coordenador suporta no máximo 110 caracteres!",
                'tel_coordenador' => "O campo Telefone do Coordenador suporta no máximo 20 caracteres!",
                'mina.max' => "O campo Nome da Mina deve ter no máximo 100 Caracteres !",
                'coordenador_sub.max' => "O campo Coordenador Suporta no máximo 110 caracteres!",
                'tel_coordenador_sub.max' => "O campo Telefone do Coordenador Suporta no máximo 20 caracteres !",
                'email_coord_sub'        => "O campo Coordenador Suporta no máximo 120 caracteres!",

            ]
        );


        $empnto = new PaeEmpnto;
        $empnto->nome               = $request->nome;
        $empnto->municipio_id       = $request->municipio_id;
        $empnto->regiao_id          = $request->regiao_id;
        $empnto->m_construcao       = $request->m_construcao;
        $empnto->material           = $request->material;
        $empnto->finalidade         = $request->finalidade;
        $empnto->volume             = $request->volume;
        $empnto->pop_zas            = $request->pop_zas;
        $empnto->orgao_fisc         = $request->orgao_fisc;
        $empnto->coordenador        = $request->coordenador;
        $empnto->tel_coordenador    = $request->tel_coordenador;
        // $empnto->pae_coordenador_id = $request->pae_coordenador_id;
        $empnto->pae_empdor_id      = $request->pae_empdor_id;
        $empnto->mina               = $request->mina;
        $empnto->email_coord        = $request->email_coord;

        $empnto->coordenador_sub        = $request->coordenador_sub;
        $empnto->tel_coordenador_sub    = $request->tel_coordenador_sub;
        $empnto->email_coord_sub        = $request->email_coord_sub;


        $empnto->save();

        return redirect('pae/empnto')->with('message', 'Registro Gravado com Sucesso ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drrd\PaeEmpnto  $paeEmpnto
     * @return \Illuminate\Http\Response
     */
    public function show(PaeEmpnto $paeEmpnto)
    {
        return view(
            'drrd/paebm/empnto/show',
            [
                'empnto' => $paeEmpnto,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drrd\PaeEmpnto  $paeEmpnto
     * @return \Illuminate\Http\Response
     */
    public function edit(PaeEmpnto $paeEmpnto)
    {

        $m_construcao = [
            'ESTRUTURA DE CONTENÇÃO À JUSANTE' => 'ESTRUTURA DE CONTENÇÃO À JUSANTE',
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

        //dd($paeEmpnto);

        return view(
            'drrd/paebm/empnto/edit',
            [
                'empnto' => $paeEmpnto,
                'm_construcao' => $m_construcao,
                'material' => $material,
                'orgao_fisc' => $orgao_fisc,
                'finalidade' => $finalidade,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drrd\PaeEmpnto  $paeEmpnto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaeEmpnto $paeEmpnto)
    {
        //dd($request);
        $request->validate(
            [
                'id'                 => "required|integer",
                'nome'               => "required|max:110",
                'empdor_search'      => "required|max:110",
                'pae_empdor_id'      => "required|integer",
                'municipio_search'   => "required|max:110",
                'municipio_id'       => "required|integer",
                'regiao_search'      => "required|max:70",
                'regiao_id'          => "required|integer",
                'm_construcao'       => "required|max:50",
                'material'           => "required|max:50",
                'finalidade'         => "required|max:50",
                'volume'             => "required|max:50",
                'pop_zas'            => "required|max:50",
                'orgao_fisc'         => "required|max:50",
                // 'coordenador_search' => "required|max:70",
                // 'pae_coordenador_id' => "required|integer",
                'coordenador'        => "required|max:110",
                'tel_coordenador'    => "max:20",
                'email_coord'        => "max:120",
                'coordenador_sub'        => "max:110",
                'tel_coordenador_sub'    => "max:20",
                'email_coord_sub'        => "max:120",
                'mina'               => "max:100",

            ],
            [
                'id.required' => 'O campo Id não está presente',
                'nome.required' => 'O campo  é Obrigatório !',
                'nome.max' => 'O campo Nome suporta no máximo 110 caracteres !',
                'municipio_id.required' => "O campo Municipio não pode ficar em Branco",
                'regiao_id.required' => "O campo Região é Obrigatério !",
                'm_construcao.required' => "O campos Metodo de construção é obrigatorio !",
                'm_construcao.max' => "O campo Metodo de Construção ",
                'material.required' => "O campo Material da Barragem é Obrigatório",
                'material.max' => "O campo Material da Barragem suporta no máximo 50 caracteres !",
                'finalidade.required' => "O campo Finalidade é obrigatório !",
                'finalidade.max' => "O campo Finalidade suporta no máximo 50 caracteres !",
                'volume.required' => "O campo Volume é obrigatório !",
                'volume.max' => "O campo Volume suporta no máximo 50 caracteres !",
                'pop_zas.required' => "O campo População da ZAS é obrigatório !",
                'pop_zas.max' => "O campo População da ZAZ suporta no máximo 50 caracteres !",
                'orgao_fisc.required' => "O campo Órgão Fiscalizador é obrigatório !",
                'orgao_fisc.max' => "O campo Órgão Fiscalizador suporta no máximo 50 caracteres !",
                // 'pae_coordenador_id.required' => "O campo Coordenador é obrigatório !",
                // 'pae_coordenador_id.integer' => "O campo Coordenador aceita somente números !",
                'coordenador.required' => "O campo Coordenador é obrigatório !",
                'coordenador.max' => "O campo Coordenador Suporta no máximo 110 caracteres!",
                'tel_coordenador.max' => "O campo Telefone do Coordenador Suporta no máximo 20 caracteres !",
                'mina.max' => "O campo Nome da Mina deve ter no máximo 100 Caracteres !",
                'coordenador_sub.max' => "O campo Coordenador Suporta no máximo 110 caracteres!",
                'tel_coordenador_sub.max' => "O campo Telefone do Coordenador Suporta no máximo 20 caracteres !",
                'email_coord_sub'        => "O campo Coordenador Suporta no máximo 120 caracteres!",


            ]
        );

        $empnto = PaeEmpnto::find($request->id);
        $empnto->nome               = $request->nome;
        $empnto->pae_empdor_id      = $request->pae_empdor_id;
        $empnto->municipio_id       = $request->municipio_id;
        $empnto->regiao_id          = $request->regiao_id;
        $empnto->m_construcao       = $request->m_construcao;
        $empnto->material           = $request->material;
        $empnto->finalidade         = $request->finalidade;
        $empnto->volume             = $request->volume;
        $empnto->pop_zas            = $request->pop_zas;
        $empnto->orgao_fisc         = $request->orgao_fisc;
        $empnto->coordenador        = $request->coordenador;
        $empnto->tel_coordenador    = $request->tel_coordenador;
        //$empnto->pae_coordenador_id = $request->pae_coordenador_id;
        $empnto->mina               = $request->mina;
        $empnto->email_coord        = $request->email_coord;

        $empnto->coordenador_sub        = $request->coordenador_sub;
        $empnto->tel_coordenador_sub    = $request->tel_coordenador_sub;
        $empnto->email_coord_sub        = $request->email_coord_sub;
        $empnto->user_update        = Auth::user()->name;

        $empnto->update();
        //    
        //dd($request->close);

        # fechar janela
        if (!is_null($request->close)) {
            return redirect('pae/empnto')
                ->with('message', 'Registro Atualizado com Sucesso ')
                ->with('closew', 'closew');
        } else {
            return redirect('pae/empnto/edit/' . $request->id)
                ->with('message', 'Registro Atualizado com Sucesso ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drrd\PaeEmpnto  $paeEmpnto
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaeEmpnto $paeEmpnto)
    {
        //
    }

    /* Municipio Autocomplete */
    public function municipio_autocomplete(Request $request)
    {
        $data = Municipio::select("nome as value", "id")
            ->where('nome', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }

    /* Regiao Autocomplete */
    public function regiao_autocomplete(Request $request)
    {
        $data1 = ComRegiao::select("nome as value", "id")
            ->where('nome', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data1);
    }

    /* Empreendedor Autocomplete */
    public function empdor_autocomplete(Request $request)
    {
        $data = PaeEmpdor::select("nome as value", "id")
            ->where('nome', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }

    /* Coordenador Autocomplete */
    public function coord_autocomplete(Request $request)
    {
        $data = PaeCoord::select("nome as value", "id")
            ->where('nome', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }

    /* Empreendimento Autocomplete */
    public function empnto_autocomplete(Request $request)
    {
        $data = PaeEmpnto::select("pae_empntos.nome as value", "pae_empntos.id", "pae_empdors.nome as empdor")
            ->join("pae_empdors", "pae_empntos.pae_empdor_id", "=", "pae_empdors.id")
            ->where('pae_empntos.nome', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }


    /* listagem */
    public function listagem(Request $request)
    {
        dd(Auth::user());

        $empntos = PaeEmpnto::where($request->id);
    
        return view('drrd/paebm/empnto/listagem',
    [
        'empntos' => $empntos,
    ]
    );

    }

    
}
