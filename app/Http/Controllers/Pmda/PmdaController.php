<?php

namespace App\Http\Controllers\Pmda;

use App\Http\Controllers\Controller;
use App\Models\Compdec\Compdec;
use App\Models\Compdec\Prefeitura;
use App\Models\Municipio\Municipio;
use App\Models\Pmda\Pmda;
use App\Models\Pmda\PmdaAnexo;
use App\Models\Pmda\PmdaPmdaComun;
use App\Models\Pmda\PmdaPmdaPonto;
use App\Models\Pmda\PmdaPonto;
use App\Models\Pmda\PmdaRepres;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PmdaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $method = request()->method();
        $active_tab = "";

        //dd(Auth::user()['tipo']);

        if (Auth::user()['tipo'] == "cedec") {
            if ($method == 'GET') {
                return view('ajuda/pmda/index');
            } elseif ($method == 'POST') {

                if (true) {

                    $param = request()->input('txtBusca');

                    $pmdas = DB::table('pip_pmda')
                        ->join('cedec_municipio', 'pip_pmda.municipio_id', '=', 'cedec_municipio.id')
                        ->select('pip_pmda.*', 'cedec_municipio.nome')
                        ->where('cedec_municipio.nome', "LIKE", '%' . $param . '%')
                        ->get();


                    // foreach ($municipios as $key => $municipio) {

                    //     $id_municipio[] = $municipio;
                    // }
                    return view('ajuda/pmda/index', [
                        'pmdas' => $pmdas,
                        'active_tab' => $active_tab,
                    ]);
                }
            }
        } else {

            $pmdas = DB::table('pip_pmda')
                ->join('cedec_municipio', 'pip_pmda.municipio_id', '=', 'cedec_municipio.id')
                ->select('pip_pmda.*', 'cedec_municipio.nome')
                ->where('cedec_municipio.id', "=", Auth::user()['municipio_id'])
                ->get();

            return view('ajuda/pmda/index', [
                'pmdas' => $pmdas,
                'active_tab' => $active_tab,
            ]);
        }
        //return view('ajuda/tdap/pmda/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pmdaSearc = Pmda::where('status', '0')
        ->where('municipio_id', Auth::user()->municipio_id)
        ->count();

        if ($pmdaSearc == 0) {
            $pmda = new Pmda();
            $pmda->data = date('Y-m-d H:i:s');
            $pmda->status = 0;
            $pmda->municipio_id = Auth::user()->municipio_id;
            //$pmda->protocolo = ($pmdaSearc->id+1).str_replace(["-"," "], "", $pmda->data)."0"; 

            $pmda->save();
            return redirect()->route('pmda/edit', [$pmda->id]);
        }else {
            return redirect()->back()->withErrors(['não é possivel criar este PMDA pois já existe processo em EDIÇÂO !']);
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
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pmda\Pmda  $pmda
     * @return \Illuminate\Http\Response
     */
    public function iss(Request $request)
    {

        $request->validate(
            [
                'id' => 'required',
                'cobra_iss' => 'required',
                'num_lei_iss' => 'max:30',
                'aliquota_iss' => 'numeric|between:0,99.99',
            ],
            [
                'id.required' => 'O Campo Id é Obrigatório !',
                'cobra_iss.required' => 'O campo cobra_iss é Obrigatório !',
                'num_lei_iss.max' => 'O campo num_lei_iss Deve ter no máximo 30 caracteres !',
                'aliquota_iss.between' => 'O campo aliquota_iss deve estar no formato decimal',
            ]
        );


        try {

            $iss = Municipio::find($request->id);

            $iss->cobra_iss      = $request->cobra_iss;
            $iss->resp_cob_iss   = $request->resp_cob_iss;
            $iss->num_lei_iss    = $request->num_lei_iss;
            $iss->aliquota_iss   = $request->aliquota_iss;

            $iss->save();
        } catch (\Exception $ex) {
            $ex->getMessage();
        }
        Session::put('active-tab', '#-iss-tab');
        return response()->json(['message' => 'Registro Atualizado com Sucesso', 'active_tab' => '#-iss-tab']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pmda\Pmda  $pmda
     * @return \Illuminate\Http\Response
     */
    public function municipio(Request $request)
    {

        $validador = $request->validate(
            [
                'id' => 'required',
                'nome_prefeito' => 'required|max:70',
                'tel_prefeitura' => 'max:16',
                'fax_prefeitura' => 'max:16',
                'tel_prefeito' => 'max:16',
                'cel_prefeito' => 'max:16',
                'endereco' => 'required|max:109',
                'bairro' => 'max:44',
                'cep' => 'max:10',
                'email_prefeitura' => 'email',
                'populacao' => 'numeric|between:0,999999',
                'pop_rural' => 'numeric|between:0,99999',
                'area' => 'numeric',
            ],
            [
                'id.required' => 'O Campo Id é Obrigatório !',
                'nome_prefeito.required' => 'O campo :attribute deve ter no máximo 70 caracteres',
                'nome_prefeito.max' => 'O campo deve ter no máximo 70 caracteres',
                'cobra_iss.required' => 'O campo cobra_iss é Obrigatório !',
                'tel_prefeitura' => 'O campo deve ter no máximo 16 caracteres',
                'fax_prefeitura' => 'O campo deve ter no máximo 16 caracteres',
                'tel_prefeito' => 'O campo deve ter no máximo 16 caracteres',
                'cel_prefeito' => 'O campo deve ter no máximo 16 caracteres',
                'endereco.required' => 'O campo :attribute é obrigatório !',
                'endereco.max' => 'O campo :attribute deve ter no máximo 109 caracteres !',
                'cep.max' => 'O campo :attribute deve ter no máximo 10 caracteres !',
                'email_prefeitura.email' => 'O campo :attribute deve ser um email valido !',
                'populacao.numeric' => 'O campo :attribute deve ser numeros',
                'pop_rural.numeric' => 'O campo :attribute deve ser numeros',
                'area.max' => 'O campo :attribute deve ser numerico !',
            ]
        );


        try {

            $municipio = Municipio::find($request->id);

            $municipio->nome_prefeito   = $request->nome_prefeito;
            $municipio->tel_prefeitura  = $request->tel_prefeitura;
            $municipio->fax_prefeitura  = $request->fax_prefeitura;
            $municipio->tel_prefeito    = $request->tel_prefeito;
            $municipio->cel_prefeito    = $request->cel_prefeito;
            $municipio->endereco        = $request->endereco;
            $municipio->bairro          = $request->bairro;
            $municipio->cep             = $request->cep;
            $municipio->email_prefeitura = $request->email_prefeitura;
            $municipio->populacao       = $request->populacao;
            $municipio->pop_rural       = $request->pop_rural;
            $municipio->area            = $request->area;


            $municipio->save();
        } catch (\Exception $ex) {
            $ex->getMessage();
        }

        Session::put('active-tab', '#-municipio-tab');
        return response()->json(['message' => 'Registro Atualizado com Sucesso', 'active_tab' => '#-municipio-tab']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pmda\Pmda  $pmda
     * @return \Illuminate\Http\Response
     */
    public function show(Pmda $pmda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pmda\Pmda  $pmda
     * @return \Illuminate\Http\Response
     */
    public function edit(Pmda $pmda)
    {

        $municipio  = Municipio::find($pmda->municipio_id);
        $compdecs     = Compdec::with('equipes')->where('id_municipio', $pmda->municipio_id)->firstOrFail();
        $pontos       = PmdaPmdaPonto::with('ponto')->where('pmda_id', $pmda->id)->get();
        $pontos_sel   = PmdaPonto::orderBy('nome')->pluck('nome', 'id');
        $anexos       = PmdaAnexo::where('pmda_id', $pmda->id)->get();
        $comunidades = PmdaPmdaComun::where('pmda_id', $pmda->id)->get();
        $representantes = PmdaRepres::where('pmda_id', $pmda->id)->get();

        //dd($comunidades);


        return view(
            'ajuda/pmda/edit',
            [
                'municipio' =>  $municipio,
                'compdecs' =>   $compdecs,
                'pontos'    =>   $pontos,
                'pontos_sel' => $pontos_sel,
                'anexos'   => $anexos,
                'pmda' => $pmda,
                'comunidades' => $comunidades,
                'representantes' => $representantes,

                // 'comunidades', $comunidades,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pmda\Pmda  $pmda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pmda $pmda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pmda\Pmda  $pmda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pmda $pmda)
    {
        // $pmda1 = $pmda->find($id);

        // $analise->delete();
    }
}
