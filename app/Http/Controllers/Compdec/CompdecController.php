<?php

namespace App\Http\Controllers\Compdec;

use App\Models\Cedec\CedecMeso;
use App\Models\Cedec\CedecMicro;
use App\Models\Compdec\ComAssociacao;
use App\Models\Compdec\Compdec;
use App\Models\Compdec\ComRdc;
use App\Models\Compdec\ComRegiao;
use App\Models\Compdec\ComTerritorio;
use App\Models\Municipio\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CompdecController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->user()->can('cedec')) {
            $method = request()->method();
            $active_tab = "";


            $situacao = DB::table("com_comdec")
                ->select(DB::raw('com_ativa, count(id) as qtd', 'municipio_id'))
                ->where('id_municipio', '!=', '7221')
                ->groupBy("com_ativa")
                ->get();

            if ($method == 'GET') {
                return view('compdec.index', [
                    'ativa' => $situacao[1]->qtd,
                    'inativa' => $situacao[0]->qtd,
                ]);
            } elseif ($method == 'POST') {

                if (true) {

                    $param = request()->input('txtBusca');

                    $municipios = DB::table('com_comdec')
                        ->join('cedec_municipio', 'com_comdec.id_municipio', '=', 'cedec_municipio.id')
                        ->select('com_comdec.*', 'cedec_municipio.nome')
                        ->where('cedec_municipio.nome', "LIKE", '%' . $param . '%')
                        ->get();


                    foreach ($municipios as $key => $municipio) {

                        $id_municipio[] = $municipio;
                    }
                    return view('compdec.index', [
                        'compdecs' => $municipios,
                        'active_tab' => $active_tab,
                        'ativa' => 0,
                        'inativa' => 0,
                    ]);
                }
            }
        }else {
            return view('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // nao existe
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // nao existe
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {

        $active_tab = "";

        $compdec_id_session = isset(Session::get('user')['compdec_id']) ? Session::get('user')['compdec_id'] : null;

        if (!is_null($id)) {
            $compdec_id = $id;
        } else if (!is_null($compdec_id_session)) {
            $compdec_id = $compdec_id_session;
        }

        $compdec      = Compdec::find($compdec_id);
        //$municipio    = Municipio::find($compdec->municipio_id);
        //$regioes      = ComRegiao::orderBy('nome')->pluck('nome', 'id');
        //$associacoes  = ComAssociacao::orderBy('nome')->pluck('nome', 'id');
        //$territorios  = ComTerritorio::orderBy('nome')->pluck('nome', 'id');
        //$microrregiao = CedecMicro::orderBy('nome')->pluck('nome', 'id');
        //$mesorregiao  = CedecMeso::orderBy('nome')->pluck('nome', 'id');


        /* log edit */
        Log::channel('navegacao')->info("Acesso view editar", [
            'table' => $compdec->getTable(),
            'id' => $id,
            'user_id' => Auth::user()->id,
            'host' => request()->getHttpHost(),
        ]);


        dd($compdec);


        return view(
            'compdec.edit',
            [
                'compdec' => $compdec,
                //'regioes' => $regioes,
                //'associacoes' => $associacoes,
                //'territorios' => $territorios,
                //'microrregiao' => $microrregiao,
                //'mesorregiao' => $mesorregiao,
                'active_tab' => $active_tab,

            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        dd($request);


        try {

            $input = $request->all();

            $compdec = Compdec::find($id);

            $compdec->fill($input);

            $compdec->save();
        } catch (\Exception $ex) {
            $ex->getMessage();
        }

        return back()->with('message', 'Registro Atualizado com Sucesso !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * form busca
     */
    public function busca()
    {

        return view('compdec.busca');
    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     * 
     */
    public function processa()
    {
        $compdec = DB::table('com_comdec')
            ->join('cedec_municipio', 'cedec_municipio.id_municipio', '=', 'com_comdec.id_municipio')
            ->select('com_comdec.*', 'cedec_municipio.nome')
            ->where('cedec_municipio.nome', 'like', '%teste%')
            ->get();

        /*Compdec::where(function ($query){
            $query->select('id', 'nome')
                    ->from('cedec_municipio')
                    ->whereColumn('cedec_municipio.id', 'com_comdec.id')
                    ->where('cedec_municipio.nome', 'like', '%teste%');
        });  */

        return view(
            'compdec.busca',
            compact('compdec')
        );
    }

    /**
     *  upload foto prefeito
     * 
     */
    public function upload(Request $request, $id)
    {

        $request->validate(
            [
                'fotoCompdec' => 'required|mimes:png,jpg,jpeg|max:300',
            ],
            [
                'required'  => 'Obrigatório anexar um arquivo !',
                'max'    => 'Arquivo muito grande, Tamanho Máximo permitido : 300kb',
                'mimes' => 'Tipo de Arquivos permitidos : png, jpg, jpeg',
            ]
        );

        $fileName = $request->id . "-" . time() . '.' . $request->file('fotoCompdec')->extension();

        $request->file('fotoCompdec')->storeAs('compdec', $fileName);

        $compdec = Compdec::find($request->id);


        if (Storage::exists('compdec/' . $compdec->fotoCompdec)) {
            Storage::delete('compdec/' . $compdec->fotoCompdec);
        }

        $compdec->fotoCompdec = $fileName;
        $compdec->save();

        return back()
            ->with('message', 'Upload realizado com Sucesso')
            ->with('file', $fileName);
    }


    /**
     * Atualização dados Municipio
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function updateMunicipio(Request $request, $id)
    {


        $request->validate(
            [
                'id'                => 'required', #"7221"
                'prefeito'          => 'required|max:70', #"ANTONHO DA ONCAERR1"
                'tel_prefeito'      => 'required|max:20', #"(45) 94545-4000"
                'cel_prefeito'      => 'required|max:20', #"(00) 98888-8888"
                'email_prefeito'    => 'required|max:110', #"antonio@antonio.com.br"
                'macroregiao'       => 'required|max:200', #"CENTRAL"
                'latitude'          => 'required|max:13', #"1"
                'longitude'         => 'required|max:13', #"2"
                'latitude_dec'      => 'max:20', #"1.5"
                'longitude_dec'     => 'max:20', #"2.5"
                'distancia_bh'      => 'required|max:20', #"20"
                'populacao'         => 'required|max:20', #"10"
                'territorio_desenv' => 'required|max:110', #"Vertentes"
                'area'              => 'required|max:45', #"12"
                'id_meso'           => 'required', #"6"
                'id_micro'          => 'required', #"30"
                'pop_rural'         => 'required|numeric|digits_between:2,10', #"11"
                'qtd_pipa'          => 'required|numeric|max:3', #"1"
                'endereco'          => 'required|max:110', #"AV. AMERICO"
                'bairro'            => 'required|max:45', #"CENTRO"
                'cep'               => 'required|max:45', #"11111-111"
                'email_prefeitura'             => 'required|max:110', #"prefeitura@prefeitura@gmail.com1"
                'fax_prefeitura'               => 'max:20', #"(44) 44444-4444"
                'tel_prefeitura'               => 'required|max:20', #"(33)33333-3333"
                'cobra_iss'         => 'required|max:3', #"NAO"
                'aliquota_iss'      => 'max:5', #"0.00"
                'num_lei_iss'       => 'max:30', #"1998555"
                'resp_cob_iss'      => 'max:15', #null
            ],
            [

                'id.required'           => 'O Campo Id é Obrigatório !',
                'prefeito.required'     => 'O Campo nome do Prefeito é obrigatório',
                'prefeito.max'          => 'O Campo nome do Prefeiro deve ter no máximo 70 caracteres',
                'tel_prefeito.required'     => 'O Campo Telefone é Obrigatório !',
                'tel_prefeito.max'          => 'O Campo Telefone do Prefeito deve ter no máximo 20 caracteres',
                'cel_prefeito.required'     => 'O Campo Celular do Prefeito é Obrigatório',
                'cel_prefeito.max'          => 'O Campo Celular do Prefeito deve ter no máximo 20 Caracteres',
                'email_prefeito.required'   => 'O Campo Email do Prefeito é Obrigatório',
                'email_prefeito.max'        => 'O Campo Email do Prefeito deve ter no máximo 110 Caracteres !',
                'macroregiao.required'  => 'O Campo Macrorregião é Obrigatório !',
                'macroregiao.max'       => 'O Campo Macrorregiao deve ter no máximo 200 Caracteres',
                'latitude.required'     => 'O Campo Latitude é Obrigatório',
                'latitude.max'          => 'O Campo Latitude deve ter no máximo 13 Caracteres',
                'longitude.required'    => 'O Campo Longitude é Obrigatório !',
                'longitude.max'         => 'O Campo Longitude deve ter no máximo 13 Caracteres',
                'latitude_dec'          => 'O Campo Latitude Decimal deve ter no máximo 20 Caracteres',
                'longitude_dec'         => 'O Campo Longitude Decimal deve ter no máximo 20 Catacteres',
                'distancia_bh.required' => 'O Campo Distancia de BH é Obrigatório',
                'distancia_bh.max'      => 'O Campo Distância de BH deve ter no máximo 20 Caracteres',
                'populacao.required'    => 'O Campo População é Obrigatório',
                'populacao.max'         => 'O Campo População deve ter no máximo 20 Caracteres',
                'territorio_desenv.required' => 'O Campo Território de Desenvolvimento é Obrigatório',
                'territorio_desenv.max' => 'O Campo Território de Desenvolvimento deve ter no máximo 110 Caracteres',
                'area.required'         => 'O Campo Área Território é Obrigatório',
                'area.max'              => 'O Campo Área Território deve ter no máximo 45 Caracteres',
                'id_meso.required'      => 'O Campo Mesorregião é Obrigatório',
                'id_micro.required'     => 'O Campo Microrregião é Obrigatório',
                'pop_rural.required'    => 'O Campo População Rural é Obrigatório',
                'pop_rural.numeric'     => 'O Campo População Rural deve ser numérico',
                'pop_rural.digits_between' => 'O Campo População Rural deve ter no máximo 11 Caracteres',
                'qtd_pipa.required'     => 'O Campo Quantidade de Caminhões Pipa é Obrigatório',
                'qtd_pipa.numeric'      => 'O Campo Quantidade de Caminhões Pipa deve ser numérico',
                'qtd_pipa.max'          => 'rO Campo Quantidade de Caminhões Pipa deve ter no máximo 3 Caracteres',
                'endereco.required'     => 'O Campo Endereço é Obrigatório ',
                'endereco.max'          => 'O Campo Endereço deve ter no máximo 110 Caracteres',
                'bairro.required'       => 'O Campo Bairro é Obrigatório',
                'bairro.max'            => 'O Campo Bairro deve ter no máximo 45 Caracteres',
                'cep.required'          => 'O Campo CEP é Obrigatório',
                'cep.max'               => 'O Campo CEP deve ter no máximo 45 Caracteres',
                'email_prefeitura.required'        => 'O Campo Email da Prefeitura é Obrigatório ',
                'email_prefeitura.max'             => 'O Campo Email da Prefeitura deve ter no máximo 110 Caracteres',
                'fax_prefeitura.max'               => 'O Campo Fax deve ter no máximo 20 Caracteres',
                'tel_prefeitura.required'          => 'O Campo Telefone da Prefeitura é Obrigatório',
                'tel_prefeitura.max'               => 'O Campo Telefone da Prefeitura deve ter no máximo 20 Caracteres',
                'cobra_iss.required'    => 'O Campo Cobra ISS é Obrigatório',
                'cobra_iss.max'         => 'O Campo Cobra ISS deve ter no máximo 3 Caracteres',
                'aliquota_iss.digits'   => 'O Campo Aliquita de INSS deve ser Decimal 0.0',
                'aliquota_iss.max'      => 'O Campo Aliquota de ISS dever ter no máximo 5 Caracteres',
                'num_lei_iss.max'       => 'O Campo Número da Lei do ISS deve ter no máximo 30 Caracteres',
                'resp_cob_iss.max'      => 'O Campo de quem é a responsabilidade de recolhimento do ISS deve ter no máximo 15 Caracteres',

            ]
        );

        $municipio = Municipio::find($id);

        $municipio->nome_prefeito = $request->input('prefeito');
        $municipio->tel_prefeito = $request->input('tel_pref');
        $municipio->cel_prefeito = $request->input('cel_pref');
        $municipio->email_prefeito = $request->input('email_pref');
        $municipio->nome = $request->input('nome');
        $municipio->macroregiao = $request->input('macroregiao');
        $municipio->latitude = $request->input('latitude');
        $municipio->longitude = $request->input('longitude');
        $municipio->latitude_dec = $request->input('latitude_dec');
        $municipio->longitude_dec = $request->input('longitude_dec');
        $municipio->distancia_bh = $request->input('distancia_bh');
        $municipio->populacao = $request->input('populacao');
        $municipio->territorio_desenv = $request->input('territorio_desenv');
        $municipio->area = $request->input('area');
        $municipio->id_meso = $request->input('id_meso');
        $municipio->id_micro = $request->input('id_micro');
        $municipio->pop_rural = $request->input('pop_rural');
        $municipio->qtd_pipa = $request->input('qtd_pipa');
        $municipio->endereco = $request->input('endereco');
        $municipio->bairro = $request->input('bairro');
        $municipio->cep = $request->input('cep');
        $municipio->email_prefeitura = $request->input('email_prefeitura');
        $municipio->fax_prefeitura = $request->input('fax_prefeitura');
        $municipio->tel_prefeitura = $request->input('tel_prefeitura');
        $municipio->cobra_iss = $request->input('cobra_iss');
        $municipio->aliquota_iss = $request->input('aliquota_iss');
        $municipio->num_lei_iss = $request->input('num_lei_iss');
        $municipio->resp_cob_iss = $request->input('resp_cob_iss');

        $municipio->update();

        return redirect()->back()->with('message', 'Registro Atualizado com Sucesso');
    }
}
