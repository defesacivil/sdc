<?php

namespace App\Http\Controllers\Compdec;

use App\Exports\ExportVistoria;
use App\Http\Controllers\Controller;
use App\Models\Compdec\Interdicao;
use App\Models\Compdec\Vistoria;
use App\Models\Municipio\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Config;
use Illuminate\Support\Facades\App;

class VistoriaController extends Controller
{

    public static function dataVistoria()
    {

        $optionMunicipio = Municipio::all()->pluck('nome', 'id');
        $tp_imovel = ['Casa' => 'Casa', 'Apartamento' => 'Apartamento', 'Predio' => 'Predio', 'Galpão' => 'Galpão', 'Lote' => 'Lote', 'Praça' => 'Praça'];

        return [
            'optionMunicipio' => $optionMunicipio,
            //'optionCobrade' => $optionCobrade
            'tp_imovel' => $tp_imovel,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->tipo == 'cedec') {
            $vistorias = DB::table('com_vistorias')
                ->join('cedec_municipio', 'cedec_municipio.id', '=', 'com_vistorias.municipio_id')
                ->select('com_vistorias.*', 'cedec_municipio.nome as municipio')
                ->paginate();
        } else if (Auth::user()->tipo == 'compdec') {
            $vistorias = DB::table('com_vistorias')
                ->join('cedec_municipio', 'cedec_municipio.id', '=', 'com_vistorias.municipio_id')
                ->select('com_vistorias.*', 'cedec_municipio.nome as municipio')
                ->where('com_vistorias.municipio_id', Auth::user()->municipio_id)
                ->paginate();
        }

        //dd($vistorias);

        //dd(Auth::user()->tipo);

        return view(
            'compdec/vistoria/index',
            [
                'vistorias' => $vistorias,
                'optionMunicipio' => self::dataVistoria()['optionMunicipio'],
                'tp_imovel' => self::dataVistoria()['tp_imovel'],
            ]
        );
    }

    public function menu()
    {

        $total_vistoria = 0;
        $vistoria = 0;
        $total_interdicoes = 0;
        $total_publica = 0;

        /* compdec */
        if (Auth::user()->tipo == 'compdec') {
            $vistorias = Vistoria::groupBy('tp_imovel')
                ->selectRaw('count(id) as total, tp_imovel')
                ->where('municipio_id', '=', Auth::user()->municipio_id)
                ->get();


            /* total de intericoes */
            $total_interdicoes = Interdicao::selectRaw('count(municipio_id) as total_interdicoes')
                ->where('municipio_id', '=', Auth::user()->municipio_id)
                ->get();

            /* total de publicacoes */
            $total_publica = Interdicao::selectRaw('count(publicacao) as total_publica')
                ->where('publicacao', '=', '1')
                ->where('municipio_id', '=', Auth::user()->municipio_id)
                ->get();

            /** cedec todos registros / */
        } else if (Auth::user()->tipo == 'cedec') {
            $vistorias = Vistoria::groupBy('tp_imovel')
                ->selectRaw('count(id) as total, tp_imovel')
                ->get();

            /* total de intericoes */
            $total_interdicoes = Interdicao::selectRaw('count(municipio_id) as total_interdicoes')->get();

            /* total de publicacoes */
            $total_publica = Interdicao::selectRaw('count(publicacao) as total_publica')
                ->where('publicacao', '=', '1')
                ->get();
        }

        return view(
            'compdec/vistoria/menu',
            [
                'vistorias' => $vistorias,
                'total_vistoria' => $total_vistoria,
                'total_interdicoes' => $total_interdicoes,
                'total_publica' => $total_publica,
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

        $optionMunicipio = Municipio::all()->pluck('nome', 'id');

        return view(
            'compdec/vistoria/create',
            [
                'municipio_id' => Auth::user()->municipio_id,
                'optionMunicipio' => $optionMunicipio,
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


        $val = Validator::make(
            $request->all(),
            [
                "dt_vistoria"   => "required|date",
                "tp_ocorrencia" => "required|max:50",
                "tp_imovel"     => "required|max:15",
                "prop"          => "required|max:70",
                "cel"           => "required|max:15",
                "num_morador"   => "required|max:4",
                "municipio_id"  => "required:integer",
                "idosos"        => "max:2",
                "criancas"      => "max:2",
                "pess_dif_loc"  => "max:2",
                "endereco"      => "max:110",
                "bairro"        => "max:50",
                "municipio"     => "max:70",
                "cep"           => "max:11",
                "latitude"      => "max:10",
                "longitude"     => "max:10",
                "abast_agua"    => "max:9",
                "sist_drenag"   => "max:15",
                "nr_moradias"   => "max:4",
            ],
            [
                "dt_vistoria.required"  => "O Campo :attribute é obrigatório !",
                "dt_vistoria.date"      => "O Campo :attribute deve ser uma data válida !",

                "tp_ocorrencia.required" => "O Campo :attribute é obrigatório !",
                "tp_ocorrencia.max"     => "O Campo :attribute deve ter no máximo de 50 caracteres !",

                "tp_imovel.required" => "O Campo :attribute é obrigatório !",
                "tp_imovel.max"     => "O Campo :attribute deve ter no máximo de 15 caracteres !",

                "prop.required" => "O Campo :attribute é obrigatório !",
                "prop.max"     => "O Campo :attribute deve ter no máximo de 70 caracteres !",

                "cel.required" => "O Campo :attribute é obrigatório !",
                "cel.max"     => "O Campo :attribute deve ter no máximo de 15 caracteres !",

                "cel.required" => "O Campo :attribute é obrigatório !",
                "cel.max"     => "O Campo :attribute deve ter no máximo de 4 caracteres !",

                "idosos"        => "O campo :attribute deve ter no máximo 2 Caracteres",
                "criancas"      => "O campo :attribute deve ter no máximo 2 Caracteres",
                "pess_dif_loc"  => "O campo :attribute deve ter no máximo 2 Caracteres",
                "endereco"      => "O campo :attribute deve ter no máximo 110 Caracteres",
                "bairro"        => "O campo :attribute deve ter no máximo 50 Caracteres",
                "municipio"     => "O campo :attribute deve ter no máximo 70 Caracteres",
                "cep"           => "O campo :attribute deve ter no máximo 11 Caracteres",
                "latitude"      => "O campo :attribute deve ter no máximo 10 Caracteres",
                "longitude"     => "O campo :attribute deve ter no máximo 10 Caracteres",
                "abast_agua"    => "O campo :attribute deve ter no máximo 9 Caracteres",
                "sist_drenag"   => "O campo :attribute deve ter no máximo 15 Caracteres",
                "nr_moradias"   => "O campo :attribute deve ter no máximo 4 Caracteres",
                "municipio_id"  => "O Campo Município é obrigatório",
            ]
        );

        # numero quantidade de vistorias que o municipio tem
        $num_vistoria = (Vistoria::where('municipio_id',  $request->municipio_id)->count() + 1);

        $vistoria = new Vistoria;


        # municipio dono da vistoria
        $vistoria->municipio_id_dono = Auth::user()->municipio_id;
        # municipio onde aconteceu a vistoria
        $vistoria->municipio_id  = $request->municipio_id;
        $vistoria->numero  = $num_vistoria;
        $vistoria->dt_vistoria  = $request->dt_vistoria;
        $vistoria->tp_ocorrencia = $request->tp_ocorrencia;
        $vistoria->tp_imovel    = $request->tp_imovel;
        $vistoria->prop         = $request->prop;
        $vistoria->cel          = $request->cel;
        $vistoria->num_morador  = $request->num_morador;
        $vistoria->idosos       = $request->idosos;
        $vistoria->criancas     = $request->criancas;
        $vistoria->pess_dif_loc = $request->pess_dif_loc;
        $vistoria->endereco     = $request->endereco;
        $vistoria->bairro       = $request->bairro;
        $vistoria->cep          = $request->cep;
        $vistoria->latitude     = $request->latitude;
        $vistoria->longitude    = $request->longitude;
        $vistoria->abast_agua   = $request->abast_agua;
        $vistoria->sist_drenag  = $request->sist_drenag;
        $vistoria->nr_moradias  = $request->nr_moradias;
        $vistoria->operador_id  = auth()->user()->id;

        $vistoria->ck_esgo_sant_canalizado         = isset($request->ck_esgo_sant_canalizado)         ? $request->ck_esgo_sant_canalizado        : 0;
        $vistoria->ck_esgo_sant_fossa_similar      = isset($request->ck_esgo_sant_fossa_similar)      ? $request->ck_esgo_sant_fossa_similar     : 0;
        $vistoria->ck_esgo_sant_superficie         = isset($request->ck_esgo_sant_superficie)         ? $request->ck_esgo_sant_superficie        : 0;
        $vistoria->ck_sis_viar_acesso_estrada      = isset($request->ck_sis_viar_acesso_estrada)      ? $request->ck_sis_viar_acesso_estrada     : 0;
        $vistoria->ck_sis_viar_acesso_av_rua       = isset($request->ck_sis_viar_acesso_av_rua)       ? $request->ck_sis_viar_acesso_av_rua      : 0;
        $vistoria->ck_sis_viar_acesso_beco_viela   = isset($request->ck_sis_viar_acesso_beco_viela)   ? $request->ck_sis_viar_acesso_beco_viela  : 0;
        $vistoria->ck_sis_viar_acesso_trilhas      = isset($request->ck_sis_viar_acesso_trilhas)      ? $request->ck_sis_viar_acesso_trilhas     : 0;
        $vistoria->ck_tp_revest_via_asfaldo        = isset($request->ck_tp_revest_via_asfaldo)        ? $request->ck_tp_revest_via_asfaldo       : 0;
        $vistoria->ck_tp_revest_via_parale_pedra   = isset($request->ck_tp_revest_via_parale_pedra)   ? $request->ck_tp_revest_via_parale_pedra  : 0;
        $vistoria->ck_tp_revest_via_n_asfalto      = isset($request->ck_tp_revest_via_n_asfalto)      ? $request->ck_tp_revest_via_n_asfalto     : 0;
        $vistoria->ck_cond_acesso_veicular         = isset($request->ck_cond_acesso_veicular)         ? $request->ck_cond_acesso_veicular        : 0;
        $vistoria->ck_cond_acesso_veicular4x4      = isset($request->ck_cond_acesso_veicular4x4)      ? $request->ck_cond_acesso_veicular4x4     : 0;
        $vistoria->ck_cond_acesso_a_pe             = isset($request->ck_cond_acesso_a_pe)             ? $request->ck_cond_acesso_a_pe            : 0;
        $vistoria->ck_dist_encosta_menor_2_m       = isset($request->ck_dist_encosta_menor_2_m)       ? $request->ck_dist_encosta_menor_2_m      : 0;
        $vistoria->ck_dist_encosta_2_4_m           = isset($request->ck_dist_encosta_2_4_m)           ? $request->ck_dist_encosta_2_4_m          : 0;
        $vistoria->ck_dist_encosta_4_6_m           = isset($request->ck_dist_encosta_4_6_m)           ? $request->ck_dist_encosta_4_6_m          : 0;
        $vistoria->ck_dist_encosta_maior_6_m       = isset($request->ck_dist_encosta_maior_6_m)       ? $request->ck_dist_encosta_maior_6_m      : 0;
        $vistoria->ck_mat_constr_alvenaria         = isset($request->ck_mat_constr_alvenaria)         ? $request->ck_mat_constr_alvenaria        : 0;
        $vistoria->ck_mat_constr_madeira           = isset($request->ck_mat_constr_madeira)           ? $request->ck_mat_constr_madeira          : 0;
        $vistoria->ck_mat_constr_mist_plas_mad_lata = isset($request->ck_mat_constr_mist_plas_mad_lata) ? $request->ck_mat_constr_mist_plas_mad_lata : 0;
        $vistoria->ck_cons_estr_baixa              = isset($request->ck_cons_estr_baixa)              ? $request->ck_cons_estr_baixa             : 0;
        $vistoria->ck_cons_estr_media              = isset($request->ck_cons_estr_media)              ? $request->ck_cons_estr_media             : 0;
        $vistoria->ck_cons_estr_alta               = isset($request->ck_cons_estr_alta)               ? $request->ck_cons_estr_alta              : 0;
        $vistoria->ck_el_str_trinc_pilar           = isset($request->ck_el_str_trinc_pilar)           ? $request->ck_el_str_trinc_pilar          : 0;
        $vistoria->ck_el_str_trinc_viga            = isset($request->ck_el_str_trinc_viga)           ? $request->ck_el_str_trinc_viga            : 0;
        $vistoria->ck_el_str_trinc_lage            = isset($request->ck_el_str_trinc_lage)            ? $request->ck_el_str_trinc_lage           : 0;
        $vistoria->ck_el_str_incl_muro             = isset($request->ck_el_str_incl_muro)             ? $request->ck_el_str_incl_muro            : 0;
        $vistoria->ck_el_str_mur_pared_def         = isset($request->ck_el_str_mur_pared_def)         ? $request->ck_el_str_mur_pared_def        : 0;
        $vistoria->ck_el_str_cic_desliza           = isset($request->ck_el_str_cic_desliza)           ? $request->ck_el_str_cic_desliza          : 0;
        $vistoria->ck_el_str_degr_abat             = isset($request->ck_el_str_degr_abat)             ? $request->ck_el_str_degr_abat            : 0;
        $vistoria->ck_el_str_incl_arv              = isset($request->ck_el_str_incl_arv)              ? $request->ck_el_str_incl_arv             : 0;
        $vistoria->ck_el_str_incl_poste            = isset($request->ck_el_str_incl_poste)            ? $request->ck_el_str_incl_poste           : 0;
        $vistoria->ck_el_constr_trinc_parede       = isset($request->ck_el_constr_trinc_parede)       ? $request->ck_el_constr_trinc_parede      : 0;
        $vistoria->ck_el_constr_trinc_piso          = isset($request->ck_el_constr_trinc_piso)          ? $request->ck_el_constr_trinc_piso         : 0;
        $vistoria->ck_el_constr_trinc_muro         = isset($request->ck_el_constr_trinc_muro)         ? $request->ck_el_constr_trinc_muro        : 0;
        $vistoria->ck_ag_pot_lixo_entulho          = isset($request->ck_ag_pot_lixo_entulho)          ? $request->ck_ag_pot_lixo_entulho         : 0;
        $vistoria->ck_ag_pot_aterr_bot_fora        = isset($request->ck_ag_pot_aterr_bot_fora)        ? $request->ck_ag_pot_aterr_bot_fora       : 0;
        $vistoria->ck_ag_pot_veg_inadeq            = isset($request->ck_ag_pot_veg_inadeq)            ? $request->ck_ag_pot_veg_inadeq           : 0;
        $vistoria->ck_ag_pot_cort_vert             = isset($request->ck_ag_pot_cort_vert)             ? $request->ck_ag_pot_cort_vert            : 0;
        $vistoria->ck_ag_pot_tubl_romp             = isset($request->ck_ag_pot_tubl_romp)             ? $request->ck_ag_pot_tubl_romp            : 0;
        $vistoria->ck_ag_pot_conc_flux_superfic    = isset($request->ck_ag_pot_conc_flux_superfic)    ? $request->ck_ag_pot_conc_flux_superfic   : 0;
        $vistoria->ck_proc_geo_desliza             = isset($request->ck_proc_geo_desliza)             ? $request->ck_proc_geo_desliza            : 0;
        $vistoria->ck_proc_geo_qued_rolam_bloc     = isset($request->ck_proc_geo_qued_rolam_bloc)     ? $request->ck_proc_geo_qued_rolam_bloc    : 0;
        $vistoria->ck_proc_geo_inundac             = isset($request->ck_proc_geo_inundac)             ? $request->ck_proc_geo_inundac            : 0;
        $vistoria->ck_vuln_baixa                   = isset($request->ck_vuln_baixa)                   ? $request->ck_vuln_baixa                  : 0;
        $vistoria->ck_vuln_media                   = isset($request->ck_vuln_media)                   ? $request->ck_vuln_media                  : 0;
        $vistoria->ck_vuln_alta                    = isset($request->ck_vuln_alta)                    ? $request->ck_vuln_alta                   : 0;
        $vistoria->ck_vuln_muito_alta              = isset($request->ck_vuln_muito_alta)              ? $request->ck_vuln_muito_alta             : 0;
        $vistoria->ck_clas_risc_baixa              = isset($request->ck_clas_risc_baixa)              ? $request->ck_clas_risc_baixa             : 0;
        $vistoria->ck_clas_risc_media              = isset($request->ck_clas_risc_media)              ? $request->ck_clas_risc_media             : 0;
        $vistoria->ck_clas_risc_alta               = isset($request->ck_clas_risc_alta)               ? $request->ck_clas_risc_alta              : 0;
        $vistoria->ck_clas_risc_muito_alta         = isset($request->ck_clas_risc_muito_alta)         ? $request->ck_clas_risc_muito_alta        : 0;

        if ($val->fails()) {
            return response()->json([
                'error' => $val->errors(),
            ]);
        } else {

            if ($vistoria->save()) {


                /* img el estr prefix=8caract*/
                $files_el_estrs = $request->img_ck_el_str_;
                if (isset($files_el_estrs)) {
                    foreach ($files_el_estrs as $key => $files_el_estr) {
                        $fileName = 'el_estr_' . $vistoria->id . "-" . time() . $key . '.' . $files_el_estr->getClientOriginalExtension();
                        $files_el_estr->storeAs('file_vistoria/' . $vistoria->id . '/', $fileName, 'public');
                    }
                }

                /* img el construtivos */
                $files_el_cons = $request->img_ck_el_constr;
                if (isset($files_el_cons)) {
                    foreach ($files_el_cons as $key => $files_el_con) {
                        $fileName = 'el_constr_' . $vistoria->id . "-" . time() . $key . '.' . $files_el_con->getClientOriginalExtension();
                        $files_el_con->storeAs('file_vistoria/' . $vistoria->id . '/', $fileName, 'public');
                    }
                }

                /* img ag potenc */
                $files_ag_potens = $request->img_ck_ag_pote;
                if (isset($files_ag_potens)) {
                    foreach ($files_ag_potens as $key => $files_ag_pote) {
                        $fileName = 'ag_pote_' . $vistoria->id . "-" . time() . $key . '.' . $files_ag_pote->getClientOriginalExtension();
                        $files_ag_pote->storeAs('file_vistoria/' . $vistoria->id . '/', $fileName, 'public');
                    }
                }

                /* img proc_geotermicos */
                $files_proc_geos = $request->img_ck_proc_geo;
                if (isset($files_proc_geos)) {
                    foreach ($files_proc_geos as $key => $files_proc_geo) {
                        $fileName = 'proc_ge_' . $vistoria->id . "-" . time() . $key . '.' . $files_proc_geo->getClientOriginalExtension();
                        $files_proc_geo->storeAs('file_vistoria/' . $vistoria->id . '/', $fileName, 'public');
                    }
                }

                if ($vistoria->ck_clas_risc_muito_alta == 1) {

                    // gerar interdicao
                    $num_interdicao = Interdicao::where('municipio_id', $vistoria->municipio_id)->count();

                    $interdicao = new Interdicao();
                    $interdicao->numero = ($num_interdicao + 1);
                    $interdicao->ids_vistoria = $vistoria->id;
                    $interdicao->municipio_id = $vistoria->municipio_id;
                    $interdicao->endereco = $vistoria->endereco;
                    $interdicao->bairro = $vistoria->bairro;
                    $interdicao->cep =  $vistoria->cep;
                    $interdicao->dt_registro = date('Y-m-d H:i:s');

                    $interdicao->save();


                    //return redirect('interdicao/show/'.$interdicao->ids_vistoria)->with('message', 'Registro Gravado com Sucesso ');
                    return response()->json([
                        'view' => '/interdicao/show/' . $vistoria->id,
                        'message' => 'Registro Gravado com Sucesso',
                        'status' => true
                    ]);
                } else {

                    return response()->json([
                        'view' => 'show/' . $vistoria->id,
                        'message' => 'Registro Gravado com Sucesso',
                        'status' => true
                    ]);
                }
            } else {

                return response()->json([
                    'error' => $val->errors(),
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compdec\Vistoria  $vistoria
     * @return \Illuminate\Http\Response
     */
    public function show(Vistoria $vistoria, Request $request)
    {

        //dd($vistoria->municipio);
        if ($vistoria->ck_clas_risc_muito_alta == 1) {
            $interdicao = Interdicao::where('ids_vistoria', $vistoria->id)->first();
        } else {
            $interdicao = false;
        }

        // Imagens elementos estruturais
        $img_el_estrs = [];

        $scan = Storage::allFiles('vistoria_foto/' . $vistoria->id);
        foreach ($scan as $file) {
            if (substr(basename($file), 0, 8) == 'el_estr_') {
                $img_el_estrs[] = $file;
            }
        }

        // Imagens elementos Construtivos
        $img_el_constrs = [];
        $scan = Storage::allFiles('vistoria_foto/' . $vistoria->id);
        foreach ($scan as $file) {
            if (substr(basename($file), 0, 8) == 'el_constr_') {
                $img_el_constrs[] = $file;
            }
        }
        // Imagens agentes potencializadoress
        $img_ag_potens = [];
        $scan = Storage::allFiles('vistoria_foto/' . $vistoria->id);


        foreach ($scan as $file) {
            if (substr(basename($file), 0, 8) == 'ag_pote_') {
                $img_ag_potens[] = $file;
            }
        }

        //dd($img_ag_potens);

        // Imagens processos geotecnicos
        $img_proc_geos = [];
        $scan = Storage::allFiles('vistoria_foto/' . $vistoria->id);
        foreach ($scan as $file) {
            if (substr(basename($file), 0, 8) == 'proc_ge_') {
                $img_proc_geos[] = $file;
            }
        }

        return view(
            'compdec/vistoria/show',
            [
                'vistoria' => $vistoria,
                'interdicao' => $interdicao,
                'img_el_estrs' => $img_el_estrs,
                'img_el_constrs' => $img_el_constrs,
                'img_ag_potens' => $img_ag_potens,
                'img_proc_geos' => $img_proc_geos,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compdec\Vistoria  $vistoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Vistoria $vistoria)
    {
        return view(
            'compdec/vistoria/edit',
            [
                'vistoria' => $vistoria,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compdec\Vistoria  $vistoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vistoria $vistoria)
    {
        $request->validate(
            [
                "dt_vistoria"   => "required|date",
                "tp_ocorrencia" => "required|max:50",
                "tp_imovel"     => "required|max:15",
                "prop"          => "required|max:70",
                "cel"           => "required|max:15",
                "num_morador"   => "required|max:4",

                "idosos"        => "max:2",
                "criancas"      => "max:2",
                "pess_dif_loc"  => "max:2",
                "endereco"      => "max:110",
                "bairro"        => "max:50",
                "nom_municipio"     => "max:70",
                "cep"           => "max:11",
                "latitude"      => "max:10",
                "longitude"     => "max:10",
                "abast_agua"    => "max:9",
                "sist_drenag"   => "max:15",
                "nr_moradias"   => "max:4",
            ],
            [
                "dt_vistoria.required"  => "O Campo :attribute é obrigatório !",
                "dt_vistoria.date"      => "O Campo :attribute deve ser uma data válida !",

                "tp_ocorrencia.required" => "O Campo :attribute é obrigatório !",
                "tp_ocorrencia.max"     => "O Campo :attribute deve ter no máximo de 50 caracteres !",

                "tp_imovel.required" => "O Campo :attribute é obrigatório !",
                "tp_imovel.max"     => "O Campo :attribute deve ter no máximo de 15 caracteres !",

                "prop.required" => "O Campo :attribute é obrigatório !",
                "prop.max"     => "O Campo :attribute deve ter no máximo de 70 caracteres !",

                "cel.required" => "O Campo :attribute é obrigatório !",
                "cel.max"     => "O Campo :attribute deve ter no máximo de 15 caracteres !",

                "cel.required" => "O Campo :attribute é obrigatório !",
                "cel.max"     => "O Campo :attribute deve ter no máximo de 4 caracteres !",

                "idosos"        => "O campo :attribute deve ter no máximo 2 Caracteres",
                "criancas"      => "O campo :attribute deve ter no máximo 2 Caracteres",
                "pess_dif_loc"  => "O campo :attribute deve ter no máximo 2 Caracteres",
                "endereco"      => "O campo :attribute deve ter no máximo 110 Caracteres",
                "bairro"        => "O campo :attribute deve ter no máximo 50 Caracteres",
                "nom_municipio"     => "O campo :attribute deve ter no máximo 70 Caracteres",
                "cep"           => "O campo :attribute deve ter no máximo 11 Caracteres",
                "latitude"      => "O campo :attribute deve ter no máximo 10 Caracteres",
                "longitude"     => "O campo :attribute deve ter no máximo 10 Caracteres",
                "abast_agua"    => "O campo :attribute deve ter no máximo 9 Caracteres",
                "sist_drenag"   => "O campo :attribute deve ter no máximo 15 Caracteres",
                "nr_moradias"   => "O campo :attribute deve ter no máximo 4 Caracteres",
            ]
        );

        $vistoria = Vistoria::find($request->id);

        $vistoria->municipio_id  = $request->municipio_id;
        $vistoria->numero  = $request->numero;
        $vistoria->dt_vistoria  = $request->dt_vistoria;
        $vistoria->tp_ocorrencia = $request->tp_ocorrencia;
        $vistoria->tp_imovel    = $request->tp_imovel;
        $vistoria->prop         = $request->prop;
        $vistoria->cel          = $request->cel;
        $vistoria->num_morador  = $request->num_morador;
        $vistoria->idosos       = $request->idosos;
        $vistoria->criancas     = $request->criancas;
        $vistoria->pess_dif_loc = $request->pess_dif_loc;
        $vistoria->endereco     = $request->endereco;
        $vistoria->bairro       = $request->bairro;
        $vistoria->nom_municipio    = $request->nom_municipio;
        $vistoria->cep          = $request->cep;
        $vistoria->latitude     = $request->latitude;
        $vistoria->longitude    = $request->longitude;
        $vistoria->abast_agua   = $request->abast_agua;
        $vistoria->sist_drenag  = $request->sist_drenag;
        $vistoria->nr_moradias  = $request->nr_moradias;

        $vistoria->ck_esgo_sant_canalizado         = isset($request->ck_esgo_sant_canalizado)         ? $request->ck_esgo_sant_canalizado        : 0;
        $vistoria->ck_esgo_sant_fossa_similar      = isset($request->ck_esgo_sant_fossa_similar)      ? $request->ck_esgo_sant_fossa_similar     : 0;
        $vistoria->ck_esgo_sant_superficie         = isset($request->ck_esgo_sant_superficie)         ? $request->ck_esgo_sant_superficie        : 0;
        $vistoria->ck_sis_viar_acesso_estrada      = isset($request->ck_sis_viar_acesso_estrada)      ? $request->ck_sis_viar_acesso_estrada     : 0;
        $vistoria->ck_sis_viar_acesso_av_rua       = isset($request->ck_sis_viar_acesso_av_rua)       ? $request->ck_sis_viar_acesso_av_rua      : 0;
        $vistoria->ck_sis_viar_acesso_beco_viela   = isset($request->ck_sis_viar_acesso_beco_viela)   ? $request->ck_sis_viar_acesso_beco_viela  : 0;
        $vistoria->ck_sis_viar_acesso_trilhas      = isset($request->ck_sis_viar_acesso_trilhas)      ? $request->ck_sis_viar_acesso_trilhas     : 0;
        $vistoria->ck_tp_revest_via_asfaldo        = isset($request->ck_tp_revest_via_asfaldo)        ? $request->ck_tp_revest_via_asfaldo       : 0;
        $vistoria->ck_tp_revest_via_parale_pedra   = isset($request->ck_tp_revest_via_parale_pedra)   ? $request->ck_tp_revest_via_parale_pedra  : 0;
        $vistoria->ck_tp_revest_via_n_asfalto      = isset($request->ck_tp_revest_via_n_asfalto)      ? $request->ck_tp_revest_via_n_asfalto     : 0;
        $vistoria->ck_cond_acesso_veicular         = isset($request->ck_cond_acesso_veicular)         ? $request->ck_cond_acesso_veicular        : 0;
        $vistoria->ck_cond_acesso_veicular4x4      = isset($request->ck_cond_acesso_veicular4x4)      ? $request->ck_cond_acesso_veicular4x4     : 0;
        $vistoria->ck_cond_acesso_veicula2_rodas   = isset($request->ck_cond_acesso_veicula2_rodas)   ? $request->ck_cond_acesso_veicula2_rodas  : 0;
        $vistoria->ck_cond_acesso_a_pe             = isset($request->ck_cond_acesso_a_pe)             ? $request->ck_cond_acesso_a_pe            : 0;
        $vistoria->ck_dist_encosta_menor_2_m       = isset($request->ck_dist_encosta_menor_2_m)       ? $request->ck_dist_encosta_menor_2_m      : 0;
        $vistoria->ck_dist_encosta_2_4_m           = isset($request->ck_dist_encosta_2_4_m)           ? $request->ck_dist_encosta_2_4_m          : 0;
        $vistoria->ck_dist_encosta_4_6_m           = isset($request->ck_dist_encosta_4_6_m)           ? $request->ck_dist_encosta_4_6_m          : 0;
        $vistoria->ck_dist_encosta_maior_6_m       = isset($request->ck_dist_encosta_maior_6_m)       ? $request->ck_dist_encosta_maior_6_m      : 0;
        $vistoria->ck_mat_constr_alvenaria         = isset($request->ck_mat_constr_alvenaria)         ? $request->ck_mat_constr_alvenaria        : 0;
        $vistoria->ck_mat_constr_madeira           = isset($request->ck_mat_constr_madeira)           ? $request->ck_mat_constr_madeira          : 0;
        $vistoria->ck_mat_constr_mist_plas_mad_lata = isset($request->ck_mat_constr_mist_plas_mad_lata) ? $request->ck_mat_constr_mist_plas_mad_lata : 0;
        $vistoria->ck_cons_estr_baixa              = isset($request->ck_cons_estr_baixa)              ? $request->ck_cons_estr_baixa             : 0;
        $vistoria->ck_cons_estr_media              = isset($request->ck_cons_estr_media)              ? $request->ck_cons_estr_media             : 0;
        $vistoria->ck_cons_estr_alta               = isset($request->ck_cons_estr_alta)               ? $request->ck_cons_estr_alta              : 0;
        $vistoria->ck_el_str_trinc_pilar           = isset($request->ck_el_str_trinc_pilar)           ? $request->ck_el_str_trinc_pilar          : 0;
        $vistoria->ck_el_str_trinc_viga            = isset($request->ck_el_str_trinc_viga)            ? $request->ck_el_str_trinc_viga           : 0;
        $vistoria->ck_el_str_trinc_lage            = isset($request->ck_el_str_trinc_lage)            ? $request->ck_el_str_trinc_lage           : 0;
        $vistoria->ck_el_str_incl_muro             = isset($request->ck_el_str_incl_muro)             ? $request->ck_el_str_incl_muro            : 0;
        $vistoria->ck_el_str_mur_pared_def         = isset($request->ck_el_str_mur_pared_def)         ? $request->ck_el_str_mur_pared_def        : 0;
        $vistoria->ck_el_str_cic_desliza           = isset($request->ck_el_str_cic_desliza)           ? $request->ck_el_str_cic_desliza          : 0;
        $vistoria->ck_el_str_degr_abat             = isset($request->ck_el_str_degr_abat)             ? $request->ck_el_str_degr_abat            : 0;
        $vistoria->ck_el_str_incl_arv              = isset($request->ck_el_str_incl_arv)              ? $request->ck_el_str_incl_arv             : 0;
        $vistoria->ck_el_str_incl_poste            = isset($request->ck_el_str_incl_poste)            ? $request->ck_el_str_incl_poste           : 0;
        $vistoria->ck_el_constr_trinc_parede       = isset($request->ck_el_constr_trinc_parede)       ? $request->ck_el_constr_trinc_parede      : 0;
        $vistoria->ck_el_constr_trinc_piso         = isset($request->ck_el_constr_trinc_piso)         ? $request->ck_el_constr_trinc_piso        : 0;
        $vistoria->ck_el_constr_trinc_muro         = isset($request->ck_el_constr_trinc_muro)         ? $request->ck_el_constr_trinc_muro        : 0;
        $vistoria->ck_ag_pot_lixo_entulho          = isset($request->ck_ag_pot_lixo_entulho)          ? $request->ck_ag_pot_lixo_entulho         : 0;
        $vistoria->ck_ag_pot_aterr_bot_fora        = isset($request->ck_ag_pot_aterr_bot_fora)        ? $request->ck_ag_pot_aterr_bot_fora       : 0;
        $vistoria->ck_ag_pot_veg_inadeq            = isset($request->ck_ag_pot_veg_inadeq)            ? $request->ck_ag_pot_veg_inadeq           : 0;
        $vistoria->ck_ag_pot_cort_vert             = isset($request->ck_ag_pot_cort_vert)             ? $request->ck_ag_pot_cort_vert            : 0;
        $vistoria->ck_ag_pot_tubl_romp             = isset($request->ck_ag_pot_tubl_romp)             ? $request->ck_ag_pot_tubl_romp            : 0;
        $vistoria->ck_ag_pot_conc_flux_superfic    = isset($request->ck_ag_pot_conc_flux_superfic)    ? $request->ck_ag_pot_conc_flux_superfic   : 0;
        $vistoria->ck_proc_geo_desliza             = isset($request->ck_proc_geo_desliza)             ? $request->ck_proc_geo_desliza            : 0;
        $vistoria->ck_proc_geo_qued_rolam_bloc     = isset($request->ck_proc_geo_qued_rolam_bloc)     ? $request->ck_proc_geo_qued_rolam_bloc    : 0;
        $vistoria->ck_proc_geo_inundac             = isset($request->ck_proc_geo_inundac)             ? $request->ck_proc_geo_inundac            : 0;
        $vistoria->ck_vuln_baixa                   = isset($request->ck_vuln_baixa)                   ? $request->ck_vuln_baixa                  : 0;
        $vistoria->ck_vuln_media                   = isset($request->ck_vuln_media)                   ? $request->ck_vuln_media                  : 0;
        $vistoria->ck_vuln_alta                    = isset($request->ck_vuln_alta)                    ? $request->ck_vuln_alta                   : 0;
        $vistoria->ck_vuln_muito_alta              = isset($request->ck_vuln_muito_alta)              ? $request->ck_vuln_muito_alta             : 0;
        $vistoria->ck_clas_risc_baixa              = isset($request->ck_clas_risc_baixa)              ? $request->ck_clas_risc_baixa             : 0;
        $vistoria->ck_clas_risc_media              = isset($request->ck_clas_risc_media)              ? $request->ck_clas_risc_media             : 0;
        $vistoria->ck_clas_risc_alta               = isset($request->ck_clas_risc_alta)               ? $request->ck_clas_risc_alta              : 0;
        $vistoria->ck_clas_risc_muito_alta         = isset($request->ck_clas_risc_muito_alta)         ? $request->ck_clas_risc_muito_alta        : 0;


        $vistoria->save();

        // if(isset($request->anexo)){
        //     $fileName = $rat->id."-".time().'_'.$request->anexo->getClientOriginalName();
        //     $request->file('anexo')->storeAs('uploads', $fileName, 'public');
        // }

        $existeLaudo = Interdicao::where('ids_vistoria', $request->id)->count();

        //dd($existeLaudo, $request);

        if ($vistoria->ck_vuln_muito_alta  == 1 || $vistoria->ck_clas_risc_muito_alta == 1 && ($existeLaudo == 0)) {

            // gerar interdica
            $num_interdicao = Interdicao::where('municipio_id', Auth::user()->municipio_id)->count();

            $interdicao = new Interdicao();
            $interdicao->numero = ($num_interdicao + 1);
            $interdicao->ids_vistoria = $vistoria->id;
            $interdicao->municipio_id = $vistoria->municipio_id;
            $interdicao->endereco = $vistoria->endereco;
            $interdicao->bairro = $vistoria->bairro;
            $interdicao->cep =  $vistoria->cep;
            $interdicao->dt_registro = date('Y-m-d H:i:s');

            $interdicao->save();

            return redirect('interdicao/show/' . $interdicao->ids_vistoria)->with('message', 'Registro Gravado com Sucesso ');
        } else {

            return redirect('vistoria/show/' . $vistoria->id)->with('message', 'Registro Gravado com Sucesso ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compdec\Vistoria  $vistoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vistoria $vistoria)
    {
        //
    }


    public function search(Request $request)
    {

        $filter = $request;
        $filter_all = " com_vistorias.id > 0 ";

        /**
         * 
         *  tratar dos dados sql
         * 
         */

        //dd($filter->ano);
        if ($filter->ano) {
            $filter_all .= ' and year(com_vistorias.dt_vistoria) = "' . $filter->ano . '" ';
        }

        if ($filter->numero) {
            $filter_all .= ' and com_vistorias.numero = "' . $filter->numero . '" ';
        }

        // municipio
        if ($filter->municipio_id) {
            $filter_all .= ' and com_vistorias.municipio_id = "' . $filter->municipio_id . '" ';
        }

        // data inicial
        if ($filter->data_inicio and is_null($filter->data_final)) {
            $filter_all .= ' and com_vistorias.dt_vistoria >= cast("' . $filter->data_inicio . '" as date) ';
        }

        // data final
        if ($filter->data_final and is_null($filter->data_inicio)) {
            $filter_all .= ' and com_vistorias.dt_vistoria <= "' . $filter->data_final . '" ';
        }

        // data inicial e final
        if ($filter->data_inicio and $filter->data_final) {
            $filter_all .= ' and cast(com_vistorias.dt_vistoria as date) between "' . $filter->data_inicio . '" and "' . $filter->data_final . '" ';
        }

        // Tipo Imóvel
        if ($filter->tp_imovel) {
            $filter_all .= ' and com_vistorias.tp_imovel like "%' . $filter->tp_imovel . '%" ';
        }

        // endereco
        if ($filter->endereco) {
            $filter_all .= ' and com_vistorias.endereco like "%' . $filter->endereco . '%" ';
        }

        // // historico
        // if ($filter->historico) {
        //     $filter_all .= ' and com_vistorias.acoes like "%' . $filter->historico . '%" ';
        // }


        // Vistorias com Interdição 
        // if ($filter->interdicao) {
        //     $filter_all .= ' and com_rat.alvo_id = "' . $filter->alvo_id . '" ';
        // }


        /* pesquisa sem parametro retorna sem dados**/
        if ($filter_all == ' com_vistorias.id > "0" ') {
            $rats = array();
        } else {

            if (Auth::user()->tipo == 'cedec') {
                $vistorias = DB::table('com_vistorias')
                    ->whereRaw(DB::raw($filter_all))
                    ->join('cedec_municipio', 'cedec_municipio.id', '=', 'com_vistorias.municipio_id')
                    ->join('users', 'users.id', '=', 'com_vistorias.operador_id')
                    ->addSelect('com_vistorias.*')
                    ->addSelect('cedec_municipio.nome as municipio')
                    ->addSelect('users.name as operador_nome')
                    ->orderBy('com_vistorias.dt_vistoria', 'asc')
                    ->paginate(10);
                //->get();
                //->toSql();
            } else if (Auth::user()->tipo == 'compdec') {
                $vistorias = DB::table('com_vistorias')
                    ->whereRaw(DB::raw($filter_all))
                    ->join('cedec_municipio', 'cedec_municipio.id', '=', 'com_vistorias.municipio_id')
                    ->join('users', 'users.id', '=', 'com_vistorias.operador_id')
                    ->addSelect('com_vistorias.*')
                    ->addSelect('cedec_municipio.nome as municipio')
                    ->addSelect('users.name as operador_nome')
                    ->orderBy('com_vistorias.dt_vistoria', 'asc')
                    ->where('com_vistorias.municipio_id', Auth::user()->municipio_id)
                    ->paginate(10);
                //->get();
                //->toSql();
            }
        }

        //$vistorias
        /* municipios */

        //dd($vistorias);


        return view(
            'compdec/vistoria/index',
            [
                'vistorias' => $vistorias,
                'optionMunicipio' => self::dataVistoria()['optionMunicipio'],
                //'optionCobrade' => self::dataRat()['optionCobrade'],
                'tp_imovel' => self::dataVistoria()['tp_imovel'],
            ]
        );
    }

    /* Todos Relatorios de Vistorias */
    public function exportVistoria(Request $request)
    {
        return Excel::download(new ExportVistoria, 'Vistoria_registros' . date('d_m_Y_H.i.s') . '.xlsx');
    }
}
