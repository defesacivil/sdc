<?php

namespace App\Http\Controllers\Compdec;

use App\Exports\ExportRat;
use App\Http\Controllers\Controller;
use App\Models\Compdec\Rat;
use App\Models\Compdec\RatAlvo;
use App\Models\Compdec\RatOcorrencia;
use App\Models\Decreto\Cobrade;
use App\Models\Municipio\Municipio;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Session\Session;

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
        $optionCobrade[] = 'Outros ( Discriminar no Histórico )';


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

       
        //dd(session('user')['municipio_id'], $request->user()->can('cedec'));
        if ($request->user()->can('cedec')) { # sem filtro de registros por municipios

            $rats = DB::table('com_rat')
                ->join('cedec_municipio', 'cedec_municipio.id', '=', 'com_rat.municipio_id')
                ->join('users', 'users.id', '=', 'com_rat.operador_id')
                ->join('dec_cobrade', 'dec_cobrade.id', 'com_rat.cobrade_id')
                ->addSelect('com_rat.*')
                ->addSelect('cedec_municipio.nome as nome')
                ->addSelect('users.name as operador_nome')
                ->addSelect('dec_cobrade.descricao as cobrade')
                ->orderBy('com_rat.dt_ocorrencia', 'asc')
                ->where('com_rat.municipio_id', '=', 1)
                ->paginate(10);

            

        } else {
            $rats = DB::table('com_rat')
            ->join('cedec_municipio', 'cedec_municipio.id', '=', 'com_rat.municipio_id')
            ->join('users', 'users.id', '=', 'com_rat.operador_id')
            ->join('dec_cobrade', 'dec_cobrade.id', 'com_rat.cobrade_id')
            ->addSelect('com_rat.*')
            ->addSelect('cedec_municipio.nome as nome')
            ->addSelect('users.name as operador_nome')
            ->addSelect('dec_cobrade.descricao as cobrade')
            ->orderBy('com_rat.dt_ocorrencia', 'asc')
            ->where('com_rat.municipio_id', '=', 1)
            ->paginate(10);
        }

        # chutas intensas 
        $ratChuva = Rat::where('cobrade_id', '=', '26')->count();
        //dd($ratChuva);

        # estiagem 
        $ratSeca = Rat::where('cobrade_id', '=', '31')->count();

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

        if($ratSeca >0 && $rats->total() >0) {
            $percent_seca = number_format(($ratSeca / $rats->total()) * 100, 2);
        }else {
            $percent_seca = 0;
        }

        if($ratChuva >0 && $rats->total() >0) {
            $percent_chuva = number_format(($ratChuva / $rats->total()) * 100, 2);
        }else {
            $percent_chuva = 0;
        }
        //dd($ratSeca, $rats->total());

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
                'chart_ocor_list_ano_corrente' => "[" . $chart_ocor_list_ano_corrente . "]",
                //'chart_ocor_list_total' => "[".$chart_ocor_list_total."]",
                'search' => false,
                'percent_seca' => $percent_seca,
                'percent_chuva' => $percent_chuva,
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

        $request->validate(
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
                "num_ocorrencia.required" => "O Campo :attribute é obrigatório !",
                "num_ocorrencia.numeric" => "Este Campos aceita somente números !",

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

        $rat->save();

        /* img proc_geotermicos */
        $images = $request->file;
        if (isset($images)) {
            foreach ($images as $key => $image) {
                $fileName = $rat->id . "-" . time() . $key . '.' . $image->getClientOriginalExtension();
                $image->storeAs('rat_uploads/' . $rat->id . '/', $fileName, 'public');
            }
        }

        // if(isset($request->anexo)){
        //     $fileName = $rat->id."-".time().'_'.$request->anexo->getClientOriginalName();
        //     $request->file('anexo')->storeAs('uploads', $fileName, 'public');
        // }


        return response()->json([
            'view' => 'show/' . $rat->id,
            'message' => 'Registro Gravado com Sucesso',
            'status' => true
        ]);

        // return redirect('rat')->with('message', 'Registro Gravado com Sucesso ');


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compdec\Rat  $rat
     * @return \Illuminate\Http\Response
     */
    public function show(Rat $rat)
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

        //dd($rat->cobrade);
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

        $files = $request->file('file');

        $request->validate(
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

        $rat->update();

        //dd(isset($files));

        if (isset($files)) {

            foreach ($files as $key => $file) {

                $fileName = $rat->id . "-" . time() . '_' . $file->getClientOriginalName();
                $file->storeAs('rat_uploads/' . $rat->id, $fileName, 'public');
            }
        }
        // return response()->json([
        //     'view' => 'rat/show',
        //     'message' => 'Registro Gravado com Sucesso'
        // ]);
        return response()->json([
            'view' => '../show/' . $rat->id,
            'message' => 'Registro Gravado com Sucesso',
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compdec\Rat  $rat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rat $rat)
    {
        dd($rat);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compdec\Rat  $rat
     * @return \Illuminate\Http\Response
     */
    public function deleteImagem(Request $request)
    {
        if (Storage::delete($request->file)) {
            return response()->json(
                [
                    'id' => $request->id,
                    'result' => true,
                ]
            );
        };
    }



    public function search(Request $request)
    {

        $filter = $request;
        $filter_all = " com_rat.id > 1 ";

        /**
         * 
         *  tratar dos dados sql
         * 
         */

        //dd($filter->ano);
        if ($filter->ano) {
            $filter_all .= ' and year(com_rat.dt_ocorrencia) = "' . $filter->ano . '" ';
        }

        if ($filter->num_ocorrencia) {
            $filter_all .= ' and com_rat.num_ocorrencia = "' . $filter->num_ocorrencia . '" ';
        }

        // municipio
        if ($filter->municipio_id) {
            $filter_all .= ' and com_rat.municipio_id = "' . $filter->municipio_id . '" ';
        }

        // Ocorrencias Associadas
        // if ($filter->ocorr_ass) {
        //     $filter_all .= ' or com_rat.ocorr_ass = '. $filter->ocorr_ass;
        // }

        // data inicial
        if ($filter->data_inicio and is_null($filter->data_final)) {
            $filter_all .= ' and com_rat.dt_ocorrencia >= cast("' . $filter->data_inicio . '" as date) ';
        }

        // data final
        if ($filter->data_final and is_null($filter->data_inicio)) {
            $filter_all .= ' and com_rat.dt_ocorrencia <= "' . $filter->data_final . '" ';
        }

        // data inicial e final
        if ($filter->data_inicio and $filter->data_final) {
            $filter_all .= ' and cast(com_rat.dt_ocorrencia as date) between "' . $filter->data_inicio . '" and "' . $filter->data_final . '" ';
        }

        // endereco
        if ($filter->endereco) {
            $filter_all .= ' and com_rat.endereco like "%' . $filter->endereco . '%" ';
        }

        // historico
        if ($filter->historico) {
            $filter_all .= ' and com_rat.acoes like "%' . $filter->historico . '%" ';
        }

        // ocorrencia_id
        if ($filter->ocorrencia_id) {
            $filter_all .= ' and com_rat.ocorrencia_id = "' . $filter->ocorrencia_id . '" ';
        }

        // alvo_id
        if ($filter->alvo_id) {
            $filter_all .= ' and com_rat.alvo_id = "' . $filter->alvo_id . '" ';
        }

        // cobrade_id
        if ($filter->cobrade_id) {
            $filter_all .= ' and com_rat.cobrade_id = "' . $filter->cobrade_id . '" ';
        }

        // envolvidos
        if ($filter->envolvidos) {
            $filter_all .= ' and com_rat.envolvidos like "%' . $filter->envolvidos . '%" ';
        }

        // nome_operacao
        if ($filter->nome_operacao) {
            $filter_all .= ' and com_rat.nome_operacao like "%' . $filter->nome_operacao . '%" ';
        }

        /* pesquisa sem parametro retorna sem dados**/
        if ($filter_all == ' com_rat.id > "0" ') {
            $rats = array();
        } else {


            // dd($filter_all);

            # chutas intensas 
            $ratChuva = Rat::where('cobrade_id', '=', '26')->count();

            # estiagem 
            $ratSeca = Rat::where('cobrade_id', '=', '31')
                ->whereRaw(DB::raw($filter_all))->count();

            #Qtd por mes Ocorrencias
            $chart_ocor_corrente = Rat::select("cobrade_id", DB::raw("count(*) as cobrade_count"))
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
                ->paginate(10);
            //->get();
            //->toSql();
        }

        return view(
            'compdec/rat/index',
            [
                'rats' => $rats,
                'optionOcorrencia' => self::dataRat()['ratCodOcorrencia'],
                'ratAlvo' => self::dataRat()['ratAlvo'],
                'optionMunicipio' => self::dataRat()['optionMunicipio'],
                'optionCobrade' => self::dataRat()['optionCobrade'],
                'ratChuva' => $ratChuva,
                'ratSeca' => $ratSeca,
                'chart_ocor_list_ano_corrente' => "[" . $chart_ocor_list_ano_corrente . "]",
                'search' => true,
            ]
        );
    }

    /* Todos Relatorios de Atividade */
    public function exportRats(Request $request)
    {
        return Excel::download(new ExportRat, 'Rat_Todos_' . date('d_m_Y_H.i.s') . '.xlsx');
    }
}
