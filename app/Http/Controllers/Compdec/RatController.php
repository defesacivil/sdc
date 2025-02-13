<?php

namespace App\Http\Controllers\Compdec;

use App\Exports\ExportRat;
use App\Http\Controllers\Controller;
use App\Models\Compdec\Rat;
use App\Models\Compdec\RatAlvo;
use App\Models\Compdec\RatOcorrencia;
use App\Models\Decreto\Cobrade;
use App\Models\Municipio\Municipio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;


class RatController extends Controller
{

    public static function dataRat()
    {
        /* Cod ocorrencia */
        $ratCodOcorrencia = RatOcorrencia::select(
            DB::raw("CONCAT(cod,' - ',descricao) as descricao_full"),
            'id'
        )
            ->orderBy('descricao')
            ->pluck('descricao_full', 'id');

        /* alvo */
        $ratAlvo = RatAlvo::orderBy('alvo')->pluck('alvo', 'id');
        /* municipios */
        $optionMunicipio = Municipio::all()->pluck('nome', 'id');

        /* cobrade */
        $cobradeCollection = collect();
        $cobrades = Cobrade::all();
        foreach ($cobrades as $key => $cobrade) {
            $optionCobrade = $cobradeCollection->put($cobrade->id, $cobrade->codigo . "-" . $cobrade->descricao);
        }

        //$optionCobrade[] = "teste";

        return [
            'ratCodOcorrencia' => $ratCodOcorrencia,
            'ratAlvo' => $ratAlvo,
            'optionMunicipio' => $optionMunicipio,
            'optionCobrade' => $optionCobrade
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //Gate::inspect();
        # acesso ao RAT
        Log::channel('navegacao')->info("Acesso", [
            'view' => 'index',
            'modulo' => 'RAT',
            'user_id' => Auth::user()->id,
            'hostname' => request()->getClientIp(),
            'campos' => $request->all(),
        ]);

        $filter = $request->except('_token');


        $porRegiao       = ['file' => [['total' => 0, 'id_rpm' => 0]]];
        $porOcorrencia15 = ['file' => [['qtd15' => 0, 'ocorrencia' => 0, 'descricao' => 0]]];
        $porOcorrencia   = ['file' => [['qtd'   => 0, 'ocorrencia' => 0, 'descricao' => 0]]];
        $porMes          = ['file' => [['total' => 0, 'month' => 0, 'year' => 0]]];

        $porRegiao = ['file' => ['total' => 0, 'id_rpm' => 0]];
        $porOcorrencia15 = ['file' => ['qtd15' => 0, 'ocorrencia' => 0, 'descricao' => 0]];
        $porOcorrencia   = ['file' => ['qtd'   => 0, 'ocorrencia' => 0, 'descricao' => 0]];
        $porMes          = ['file' => ['total' => 0, 'month' => 0, 'year' => 0]];
        $ratChuva = 0;
        $ratSeca = 0;
        $percent_seca = 0;
        $percent_chuva = 0;
        //$percent_chuva_intensa =0;


        $filter_all = " com_rat.id > 1 ";

        $cedec_redec = $request->user()->hasRole(['cedec', 'redec']);

        //$municipio_id = isset(session('user')['municipio_id']) ? session('user')['municipio_id'] : Auth::user()->municipio_id;



        /**
         * Usuario CEDEC e REDEC
         */
        if ($cedec_redec) {

            if (isset($filter['municipio_id'])) {
                $filter_all .= ' and com_rat.municipio_id = "' . $filter['municipio_id'] . '" ';
            }
        }

        # ano
        if (isset($filter['ano'])) {
            $filter_all .= ' and year(com_rat.dt_ocorrencia) = "' . $filter['ano'] . '" ';
        }

        # numero da ocorrencia
        if (isset($filter['num_ocorrencia'])) {
            $filter_all .= ' and com_rat.num_ocorrencia = "' . $filter['num_ocorrencia'] . '" ';
        }

        // data inicial
        if (isset($filter['data_inicio']) and is_null($filter['data_final'])) {
            $filter_all .= ' and com_rat.dt_ocorrencia >= cast("' . $filter['data_inicio'] . '" as date) ';
        }

        // data final
        if (isset($filter['data_final']) and is_null($filter['data_inicio'])) {
            $filter_all .= ' and com_rat.dt_ocorrencia <= "' . $filter['data_final'] . '" ';
        }

        // data inicial e final
        if (isset($filter['data_inicio']) and $filter['data_final']) {
            $filter_all .= ' and cast(com_rat.dt_ocorrencia as date) between "' . $filter['data_inicio'] . '" and "' . $filter['data_final'] . '" ';
        }

        // endereco
        if (isset($filter['endereco'])) {
            $filter_all .= ' and com_rat.endereco like "%' . $filter['endereco'] . '%" ';
        }

        // historico
        if (isset($filter['historico'])) {
            $filter_all .= ' and com_rat.acoes like "%' . $filter['historico'] . '%" ';
        }

        // ocorrencia_id
        if (isset($filter['ocorrencia_id'])) {
            $filter_all .= ' and com_rat.ocorrencia_id = "' . $filter['ocorrencia_id'] . '" ';
        }

        // alvo_id
        if (isset($filter['alvo_id'])) {
            $filter_all .= ' and com_rat.alvo_id = "' . $filter['alvo_id'] . '" ';
        }

        // cobrade_id
        if (isset($filter['cobrade_id'])) {
            $filter_all .= ' and com_rat.cobrade_id = "' . $filter['cobrade_id'] . '" ';
        }

        // envolvidos
        if (isset($filter['envolvidos'])) {
            $filter_all .= ' and com_rat.envolvidos like "%' . $filter['envolvidos'] . '%" ';
        }

        // nome_operacao
        if (isset($filter['nome_operacao'])) {
            $filter_all .= ' and com_rat.nome_operacao like "%' . $filter['nome_operacao'] . '%" ';
        }


        $sem_filtros = true;

        /* verifica sem filtros */
        foreach ($filter as $key => $campo) {

            if ($key != '_token') {
                if (!is_null($campo)) {
                    $sem_filtros = false;
                    continue;
                }
            }
        }

        //var_dump($filter_all, $filter);
        //var_dump($request->method(), $filter_all, Auth::user()->municipio_id);

        if ($sem_filtros) {
            $rats = array();
        } else {

            # get index
            if ($request->method() == 'GET') {

                if ($cedec_redec) {

                    $rats = DB::table('com_rat')
                        ->whereRaw(DB::raw($filter_all))
                        ->join('cedec_municipio', 'cedec_municipio.id', '=', 'com_rat.municipio_id')
                        ->join('users', 'users.id', '=', 'com_rat.operador_id')
                        ->join('dec_cobrade', 'dec_cobrade.id', 'com_rat.cobrade_id')
                        ->addSelect('com_rat.*')
                        ->addSelect('cedec_municipio.nome as nome')
                        ->addSelect('users.name as operador_nome')
                        ->addSelect('dec_cobrade.descricao as cobrade')
                        ->orderBy('com_rat.dt_ocorrencia', 'asc')
                        ->paginate(30);


                    # COMPDEC
                } else {

                    $rats = DB::table('com_rat')
                        ->whereRaw(DB::raw($filter_all))
                        ->join('cedec_municipio', 'cedec_municipio.id', '=', 'com_rat.municipio_id')
                        ->join('users', 'users.id', '=', 'com_rat.operador_id')
                        ->join('dec_cobrade', 'dec_cobrade.id', 'com_rat.cobrade_id')
                        ->addSelect('com_rat.*')
                        ->addSelect('cedec_municipio.nome as nome')
                        ->addSelect('users.name as operador_nome')
                        ->addSelect('dec_cobrade.descricao as cobrade')
                        ->where('com_rat.municipio_id',  '=', Auth::user()->municipio_id)
                        ->orderBy('com_rat.dt_ocorrencia', 'asc')
                        ->paginate(30);
                }

                # POST Buscar
            } elseif ($request->method() == 'POST') {


                if ($cedec_redec) {

                    $rats = DB::table('com_rat')
                        ->whereRaw(DB::raw($filter_all))
                        ->join('cedec_municipio', 'cedec_municipio.id', '=', 'com_rat.municipio_id')
                        ->join('users', 'users.id', '=', 'com_rat.operador_id')
                        ->join('dec_cobrade', 'dec_cobrade.id', 'com_rat.cobrade_id')
                        ->addSelect('com_rat.*')
                        ->addSelect('cedec_municipio.nome as nome')
                        ->addSelect('users.name as operador_nome')
                        ->addSelect('dec_cobrade.descricao as cobrade')
                        ->orderBy('com_rat.dt_ocorrencia', 'asc')
                        ->paginate(30);
                } else {

                    $rats = DB::table('com_rat')
                        ->whereRaw(DB::raw($filter_all))
                        ->join('cedec_municipio', 'cedec_municipio.id', '=', 'com_rat.municipio_id')
                        ->join('users', 'users.id', '=', 'com_rat.operador_id')
                        ->join('dec_cobrade', 'dec_cobrade.id', 'com_rat.cobrade_id')
                        ->addSelect('com_rat.*')
                        ->addSelect('cedec_municipio.nome as nome')
                        ->addSelect('users.name as operador_nome')
                        ->addSelect('dec_cobrade.descricao as cobrade')
                        ->where('com_rat.municipio_id',  '=', Auth::user()->municipio_id)
                        ->orderBy('com_rat.dt_ocorrencia', 'asc')
                        ->paginate(30);
                }
            }
        }

        #Qtd por mes Ocorrencias
        $chart_ocor_corrente = Rat::select("cobrade_id", DB::raw("count(*) as cobrade_count"))
            ->groupBy('cobrade_id')
            ->get()->toArray();


        #Qtd por Tipo de desastre Chuva/Seca
        $chart_ocor_list_total = Rat::select("cobrade_id", DB::raw("count(*) as cobrade_count"))
            ->whereIn('cobrade_id', ['26', '31'])
            ->groupBy('cobrade_id')
            ->get()->toArray();

        $chart_ocorrencias_array = $chart_ocor_corrente;
        $chart_ocor_list_ano_corrente = "'";

        foreach ($chart_ocorrencias_array as $key => $val) {
            if (array_key_last($chart_ocorrencias_array) == $key) {
                $chart_ocor_list_ano_corrente .= $val['cobrade_count'] . "'";
            } else {
                $chart_ocor_list_ano_corrente .= $val['cobrade_count'] . "','";
            }
        }





        ##### Somente para usuário CEDEC ######

        if ($request->user()->can('cedec')) {

            # numeros por ocorrencia ATE 15
            $porOcorrencia15['file'] = Rat::select(DB::raw("count(com_rat.ocorrencia_id) as qtd15"))
                ->join('com_rat_ocorrencia', 'com_rat.ocorrencia_id', 'com_rat_ocorrencia.id')
                ->addSelect('com_rat_ocorrencia.cod')
                ->addSelect('com_rat_ocorrencia.descricao')
                ->addSelect('com_rat_ocorrencia.alias')
                ->where('com_rat.municipio_id', "!=", '7221')
                ->having('qtd15', '<=', '15')
                ->groupBy('com_rat.ocorrencia_id', 'com_rat_ocorrencia.cod', 'com_rat_ocorrencia.descricao', 'com_rat_ocorrencia.alias')
                ->orderBy('qtd15')
                ->get()
                ->toArray();

            # numeros por ocorrencia ACIMA DE 15
            $porOcorrencia['file'] = Rat::select(DB::raw("count(com_rat.ocorrencia_id) as qtd"))
                ->join('com_rat_ocorrencia', 'com_rat.ocorrencia_id', 'com_rat_ocorrencia.id')
                ->addSelect('com_rat_ocorrencia.cod')
                ->addSelect('com_rat_ocorrencia.descricao')
                ->addSelect('com_rat_ocorrencia.alias')
                ->where('com_rat.municipio_id', "!=", '7221')
                ->having('qtd', '>', '15')
                ->groupBy('com_rat.ocorrencia_id', 'com_rat_ocorrencia.cod', 'com_rat_ocorrencia.descricao', 'com_rat_ocorrencia.alias')
                ->orderBy('qtd')
                ->get()
                ->toArray();

            # numeros por regiao
            $porRegiao['file'] = Rat::select(DB::raw("count(com_rat.id) as total"))
                ->join('cedec_municipio', 'com_rat.municipio_id', 'cedec_municipio.id')
                ->join('cedec_rpm_mun', 'com_rat.municipio_id', 'cedec_rpm_mun.id_municipio')
                ->addSelect('cedec_rpm_mun.id_rpm')
                ->where('cedec_municipio.id', "!=", '7221')
                ->groupBy('cedec_rpm_mun.id_rpm')
                ->get()
                ->toArray();


            # numeros por Mes
            $porMes['file'] = Rat::select(DB::raw("count(com_rat.id) as total, MONTH(com_rat.dt_ocorrencia) month, DATE_FORMAT(com_rat.dt_ocorrencia, '%M') as mes"))
                ->where('com_rat.municipio_id', "!=", '7221')
                ->whereYear('com_rat.dt_ocorrencia', '=', 2023)
                ->groupBy('month', 'mes')
                ->orderBy('month')
                ->get()
                ->toArray();

            //dd($porMes);


            # chuvas 
            $ratChuva = Rat::where('cobrade_id', '=', '26')->count();

            # chuvas intensas 
            //$ratChuvaIntensa = Rat::where('cobrade_id', '=', '26')->count();

            # estiagem 
            $ratSeca = Rat::where('cobrade_id', '=', '31')->count();

            # perc. chuvas intensas
            // if ($ratChuvaIntensa > 0 && $rats->total() > 0) {
            //     $percent_chuva_intensa = number_format(($ratChuvaIntensa / $rats->total()) * 100, 2);
            // } else {
            //     $percent_chuva_intensa = 0;
            // }


            //dd($ratSeca);


            if ($ratSeca > 0 && count($rats) > 0) {
                $percent_seca = number_format(($ratSeca / $rats->total()) * 100, 2);
            } else {
                $percent_seca = 0;
            }

            if ($ratChuva > 0 && count($rats) > 0) {
                $percent_chuva = number_format(($ratChuva / $rats->total()) * 100, 2);
            } else {
                $percent_chuva = 0;
            }
        }

        return view(
            'compdec/rat/index',
            [
                'rats' => $rats,
                'optionOcorrencia' => self::dataRat()['ratCodOcorrencia'],
                'ratAlvo' => self::dataRat()['ratAlvo'],
                'optionMunicipio' => self::dataRat()['optionMunicipio'],
                'optionCobrade' => self::dataRat()['optionCobrade'],
                'ratSeca'   => $ratSeca,
                'ratChuva'   => $ratChuva,
                //'ratChuvasIntensas'   => $ratChuvaIntensa,
                'chart_ocor_list_ano_corrente' => "[" . $chart_ocor_list_ano_corrente . "]",
                //'chart_ocor_list_total' => "[".$chart_ocor_list_total."]",
                'search' => false,
                'percent_seca' => $percent_seca,
                'percent_chuva' => $percent_chuva,
                //'percent_chuva_intensa' => $percent_chuva_intensa,
                'porRegiao' => $porRegiao,
                'porOcorrencia15' => $porOcorrencia15,
                'porOcorrencia' => $porOcorrencia,
                'porMes'        => $porMes,
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

        # acesso ao RAT
        Log::channel('navegacao')->info("Acesso", [
            'view' => 'create',
            'modulo' => 'RAT',
            'user_id' => Auth::user()->id,
            'hostname' => request()->getClientIp(),
        ]);

        /* Numero da sequencia */
        $numero = Rat::all()->count() + 1;
        /* gerar sequencia */
        $seq = geraNumSeq($numero, 7);

        return view(
            'compdec/rat/create',
            [
                'numero' => $seq,
                'optionOcorrencia' => self::dataRat()['ratCodOcorrencia'],
                'ratAlvo' => self::dataRat()['ratAlvo'],
                'optionMunicipio' => self::dataRat()['optionMunicipio'],
                'optionCobrade' => self::dataRat()['optionCobrade'],
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

        # acesso ao RAT
        Log::channel('navegacao')->info("Acesso", [
            'view' => 'store',
            'modulo' => 'RAT',
            'user_id' => Auth::user()->id,
            'hostname' => request()->getClientIp(),
        ]);

        $val = Validator::make(
            $request->all(),
            [
                "num_ocorrencia" => "required|numeric",
                "dt_ocorrencia" => "required|date",
                "municipio_id"  => "required|numeric",
                "ocorrencia_id" => "required|numeric",
                "operador_id"   => "required|numeric",
                "alvo_id"       => "required|numeric",
                "cobrade_id"    => "required|numeric",
                "envolvidos"    => "max:255",
                "nome_operacao" => "max:110",
                "cep"           => "max:9",
                "endereco"      => "max:100",
                "numero"        => "max:10",
                "bairro"        => "max:50",
                "estado"        => "max:20",
                "referencia"    => "max:100",
                "acoes"         => 'max:65535',

            ],
            [
                "num_ocorrencia.required" => "O Campo NÚMERO DA OCORRENCIA é obrigatório !",
                "num_ocorrencia.numeric" => "Este Campos aceita somente números !",

                "dt_ocorrencia.required" => "O Campo DATA DA OCORRÊNCIA é obrigatório !",
                "dt_ocorrencia.date" => "Data da Ocorrência Inválida !",

                "municipio_id.required" => "O Campo MUNICÍPIO é obrigatório !",
                "municipio_id.numeric" => "Este Campos aceita somente números !",

                "ocorrencia_id.required" => "O Campo CÓDIGO OCORRENCIA é obrigatório !",
                "ocorrencia_id.numeric" => "Este Campos aceita somente números",

                "operador_id.required" => "O Campo :attribute é obrigatório !",
                "operador_id.numeric" => "Este Campos aceita somente números",

                "alvo_id.required" => "O Campo ALVO é obrigatório !",
                "alvo_id.numeric" => "Este Campos aceita somente números !",

                "cobrade_id.required" => "O Campo CÓDIGO COBRADE é obrigatório !",
                "cobrade_id.numeric" => "O Campo CÓDIGO COBRADE SÓ aceita números !",

                "envolvidos.max" => "O campo ENVOLVIDOS aceita no máximo 255 caracteres !",
                "nome_operacao.required" => "O Campo NOME DA OPERAÇÃO é obrigatório !",
                "nome_operacao.max" => "O campo NOME DA OPERAÇÃO aceita no máximo 110 caracteres !",
                "cep.max" => "O campo CEP aceita no máximo 9 caracteres !",
                "endereco.max" => "O campo ENDEREÇO aceita no máximo 100 caracteres !",
                "numero.max" => "O campo NÚMERO DO ENDEREÇO aceita no máximo 10 caracteres !",
                "bairro.max" => "O campo BAIRRO aceita no máximo 50 caracteres !",
                "estado.max" => "O campo ESTADO aceita no máximo 20 caracteres !",
                "referencia.max" => "O campo REFERÊNCIA aceita no máximo 100 caracteres !",
                "acoes.max" => 'O campo TEXTO DA OCORRENCIA aceita no máximo 65530 caracteres !',


            ]
        );

        $rat = new Rat;

        $rat->num_ocorrencia = $request->num_ocorrencia;
        $rat->dt_ocorrencia = $request->dt_ocorrencia;
        $rat->municipio_id  = $request->municipio_id;
        $rat->ocorrencia_id = $request->ocorrencia_id;
        $rat->operador_id   = $request->operador_id;
        $rat->alvo_id       = $request->alvo_id;
        $rat->cobrade_id    = $request->cobrade_id;
        $rat->envolvidos    = $request->envolvidos;
        $rat->nome_operacao = $request->nome_operacao;
        $rat->cep           = $request->cep;
        $rat->endereco      = $request->endereco;
        $rat->numero        = $request->numero;
        $rat->bairro        = $request->bairro;
        $rat->estado        = $request->estado;
        $rat->referencia    = $request->referencia;
        $rat->acoes         = $request->acoes;

        if ($val->fails()) {
            return response()->json([
                'error' => $val->errors(),
                'keys' => $val->errors()->keys(),
            ]);
        } else {
            $rat->save();
            /* img */
            $images = $request->file;
            if (isset($images)) {
                foreach ($images as $key => $image) {
                    $fileName = $rat->id . "-" . time() . $key . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('rat_uploads/' . $rat->id . '/', $fileName, 'public');
                }
            }


            return response()->json([
                'view' => 'show/' . $rat->id,
                //'message' => 'Registro Gravado com Sucesso',
                'status' => true
            ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compdec\Rat  $rat
     * @return \Illuminate\Http\Response
     */
    public function show(Rat $rat)
    {
        # acesso ao RAT
        Log::channel('navegacao')->info("Acesso", [
            'view' => 'show',
            'modulo' => 'RAT',
            'user_id' => Auth::user()->id,
            'hostname' => request()->getClientIp(),
            'id' => $rat->id,
        ]);

        # ler todos arquivos da pasta rat_upload
        $all_rat_files = Storage::files('rat_uploads/' . $rat->id, true);

        //dd($all_rat_files);

        $files = null;

        /* verifica quais arquivos é da ocorrencia */
        if ($all_rat_files) {
            foreach ($all_rat_files as $key => $file) {
                if (substr(basename($file), 0, (strpos(basename($file), "-") - 0)) == $rat->id) {
                    $files[] = $file;
                }
            }
        }



        return view(
            'compdec/rat/show',
            [
                'rat' => $rat,
                'files' => $files,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compdec\Rat  $rat
     * @return \Illuminate\Http\Response
     */
    public function edit(Rat $rat)
    {

        # acesso ao RAT
        Log::channel('navegacao')->info("Acesso", [
            'view' => 'edit',
            'modulo' => 'RAT',
            'user_id' => Auth::user()->id,
            'hostname' => request()->getClientIp(),
            'id' => $rat->id,
        ]);

        # ler todos arquivos da pasta rat_upload
        $all_rat_files = Storage::files('rat_uploads/' . $rat->id, true);

        $files = null;

        /* verifica quais arquivos é da ocorrencia */
        if ($all_rat_files) {
            foreach ($all_rat_files as $key => $file) {
                $files[] = $file;
            }
        }

        /* verifica o total de arquivos para controle */
        $total_rat_files = ($files ? count($files) : 0);

        return view(
            'compdec/rat/edit',
            [
                'rat' => $rat,
                'optionOcorrencia' => self::dataRat()['ratCodOcorrencia'],
                'ratAlvo' => self::dataRat()['ratAlvo'],
                'optionMunicipio' => self::dataRat()['optionMunicipio'],
                'optionCobrade' => self::dataRat()['optionCobrade'],
                'files' => $files,
                'total_rat_files' => $total_rat_files,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compdec\Rat  $rat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rat $rat)
    {

        # update ao RAT
        Log::channel('navegacao')->info("Acesso", [
            'view' => 'update',
            'modulo' => 'RAT',
            'user_id' => Auth::user()->id,
            'hostname' => request()->getClientIp(),
            'old' => $rat,
            'new' => $request,
        ]);

        $files = $request->file('file');

        $val = Validator::make(
            $request->all(),
            [
                "dt_ocorrencia" => "required|date",
                "municipio_id"  => "required|numeric",
                "ocorrencia_id" => "required|numeric",
                "operador_id"   => "required|numeric",
                "alvo_id"       => "required|numeric",
                "cobrade_id"    => "required|numeric",
                "envolvidos"    => "max:255",
                "nome_operacao" => "max:110",
                "cep"           => "max:9",
                "endereco"      => "max:100",
                "numero"        => "max:10",
                "bairro"        => "max:50",
                "estado"        => "max:20",
                "referencia"    => "max:100",
                "acoes"         => 'max:65535',

            ],
            [

                "dt_ocorrencia.required" => "O Campo :attribute é obrigatório !",
                "dt_ocorrencia.date" => "Data da Ocorrência Inválida !",

                "municipio_id.required" => "O Campo :attribute é obrigatório !",
                "municipio_id.numeric" => "Este Campos aceita somente números !",

                "ocorrencia_id.required" => "O Campo :attribute é obrigatório !",
                "ocorrencia_id.numeric" => "Este Campos aceita somente números",

                "operador_id.required" => "O Campo :attribute é obrigatório !",
                "operador_id.numeric" => "Este Campos aceita somente números",

                "alvo_id.required" => "O Campo :attribute é obrigatório !",
                "alvo_id.numeric" => "Este Campos aceita somente números !",

                "cobrade_id.required" => "O Campo :attribute é obrigatório !",
                "cobrade_id.numeric" => "Este Campos aceita somente números !",

                "envolvidos.max" => "O campo :field aceita no máximo 255 caracteres !",
                "nome_operacao.required" => "O Campo :attribute é obrigatório !",
                "nome_operacao.max" => "O campo :field aceita no máximo 110 caracteres !",
                "cep.max" => "O campo :field aceita no máximo 9 caracteres !",
                "endereco.max" => "O campo :field aceita no máximo 100 caracteres !",
                "numero.max" => "O campo :field aceita no máximo 10 caracteres !",
                "bairro.max" => "O campo :field aceita no máximo 50 caracteres !",
                "estado.max" => "O campo :field aceita no máximo 20 caracteres !",
                "referencia.max" => "O campo :field aceita no máximo 100 caracteres !",
                "acoes.max" => 'O campo :field aceita no máximo 65530 caracteres !',


            ]
        );


        $rat->dt_ocorrencia = $request->dt_ocorrencia;
        $rat->municipio_id  = $request->municipio_id;
        $rat->ocorrencia_id = $request->ocorrencia_id;
        $rat->operador_id   = $request->operador_id;
        $rat->alvo_id       = $request->alvo_id;
        $rat->cobrade_id    = $request->cobrade_id;
        $rat->envolvidos    = $request->envolvidos;
        $rat->nome_operacao = $request->nome_operacao;
        $rat->cep           = $request->cep;
        $rat->endereco      = $request->endereco;
        $rat->numero        = $request->numero;
        $rat->bairro        = $request->bairro;
        $rat->estado        = $request->estado;
        $rat->referencia    = $request->referencia;
        $rat->acoes         = $request->acoes;


        if ($val->fails()) {
            return response()->json([
                'error' => $val->errors(),
            ]);
        } else {
            $rat->update();

            if (isset($files)) {
                foreach ($files as $key => $file) {
                    $fileName = $rat->id . "-" . time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('rat_uploads/' . $rat->id, $fileName, 'public');
                }
            }

            return response()->json([
                'view' => '../show/' . $rat->id,
                'message' => 'Registro Gravado com Sucesso',
                'status' => true,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compdec\Rat  $rat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rat $rat)
    {

        # update ao RAT
        Log::channel('navegacao')->info("Acesso", [
            'view' => 'destroy',
            'modulo' => 'RAT',
            'user_id' => Auth::user()->id,
            'hostname' => request()->getClientIp(),
            'id' => $rat->id,
        ]);

        try {

            $rat->delete();
            Storage::disk('public')->deleteDirectory('rat_uploads/' . $rat->id);

            return back()->with(['message' => 'Registro Deletado Com Sucesso !',
                'status' => true,
            ]);

        } catch (\Exception $e) {

            return response()->json(['message' => 'Ocorreu um erro ao deletar o usuário.'], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compdec\Rat  $rat
     * @return \Illuminate\Http\Response
     */
    public function deleteImagem(Request $request)
    {
        # delete imagem ao RAT
        Log::channel('navegacao')->info("Acesso", [
            'view' => 'deleteImagem',
            'modulo' => 'RAT',
            'user_id' => Auth::user()->id,
            'hostname' => request()->getClientIp(),
            'id' => $request->id,
            'file' => $request->file,
        ]);

        if (Storage::delete($request->file)) {
            return response()->json(
                [
                    'id' => $request->id,
                    'result' => true,
                ]
            );
        };
    }






    public function config()
    {

        $municipio_id = isset(session('user')['municipio_id']);

        return view('compdec/rat/config');
    }

    /* Todos Relatorios de Atividade */
    public function exportRats(Request $request)
    {
        # delete imagem ao RAT
        Log::channel('navegacao')->info("Acesso", [
            'view' => 'exportRats',
            'modulo' => 'RAT',
            'user_id' => Auth::user()->id,
            'hostname' => request()->getClientIp(),
            'export' => 'excel todos Registros',
        ]);

        return Excel::download(new ExportRat, 'Rat_Todos_' . date('d_m_Y_H.i.s') . '.xlsx');
    }


    /**
     * PDF impressao
     */
    public function RatPdfPrint(Rat $rat)
    {

        # ler todos arquivos da pasta rat_upload
        $all_rat_files = Storage::files('rat_uploads/' . $rat->id, true);

        //dd($all_rat_files);

        $files = null;

        /* verifica quais arquivos é da ocorrencia */
        if ($all_rat_files) {
            foreach ($all_rat_files as $key => $file) {
                if (substr(basename($file), 0, (strpos(basename($file), "-") - 0)) == $rat->id) {
                    $files[] = $file;
                }
            }
        }

        Pdf::setOption([
            'debugCss' => true,
        ]);

        $pdf = Pdf::loadView('compdec/rat/show', [
            'rat' => $rat,
            'files' => $files,
            'pdf' => true,
        ])->setPaper('a4');

        $name_pdf = 'Rat_' . Str::slug($rat->municipio['nome']) . date('ymdHis') . '.pdf';

        return $pdf->stream($name_pdf);
    }


    /**
     * Listagem Geral dos RAT´s
     *
     * Campos
     * 
     * id 
     *
     * 
     */
    public function apiAllDataRat()
    {

        $rats = DB::table('com_rat')
            ->join('cedec_municipio', 'cedec_municipio.id', '=', 'com_rat.municipio_id')
            ->join('users', 'users.id', '=', 'com_rat.operador_id')
            ->join('dec_cobrade', 'dec_cobrade.id', 'com_rat.cobrade_id')
            ->addSelect('com_rat.num_ocorrencia')
            ->addSelect('com_rat.dt_ocorrencia')
            ->addSelect('com_rat.municipio_id')
            ->addSelect('com_rat.operador_id')
            ->addSelect('com_rat.ocorrencia_id')
            ->addSelect('com_rat.alvo_id')
            ->addSelect('com_rat.cobrade_id')
            ->addSelect('com_rat.lugar_descricao')
            ->addSelect('com_rat.envolvidos')
            ->addSelect('com_rat.nome_operacao')
            ->addSelect('com_rat.endereco')
            ->addSelect('com_rat.numero')
            ->addSelect('com_rat.bairro')
            ->addSelect('com_rat.estado')
            ->addSelect('com_rat.referencia')
            ->addSelect('com_rat.cep')
            ->addSelect('cedec_municipio.nome as nome')
            ->addSelect('cedec_municipio.CodmunDv')
            ->addSelect('users.name as operador_nome')
            ->addSelect('dec_cobrade.descricao as cobrade')
            ->orderBy('com_rat.dt_ocorrencia', 'asc')
            ->get();
        //->where('operador_id', '=', Auth::user()->id)
        // ->paginate(10);


        return response()->json(
            [
                'rat' => $rats,
            ],
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
}
