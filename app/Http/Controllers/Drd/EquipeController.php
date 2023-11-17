<?php

namespace App\Http\Controllers\Drd;

use App\Http\Controllers\Controller;
use App\Models\Drd\Equipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipeController extends Controller
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

        if ($method == 'GET') {
            return view('drd/equipe/index');
        } elseif ($method == 'POST') {

            if (true) {

                $param = request()->input('txtBusca');

                $equipe = DB::table('equ_reg_dsp')
                    ->join('equ_reg_dsp_local_atividade', 'equ_reg_dsp.id', '=', 'equ_reg_dsp_local_atividade.dsp_id')
                    ->join('equ_reg_dsp_cobrade', 'equ_reg_dsp.id', '=', 'equ_reg_dsp_cobrade.dsp_id')
                    ->join('cedec_municipio', 'equ_reg_dsp_local_atividade.municipio_id', '=', 'cedec_municipio.id')
                    ->select('equ_reg_dsp.*', 'equ_reg_dsp_local_atividade.municipio_id')
                    ->where('cedec_municipio.nome', "LIKE", '%' . $param . '%')
                    ->get();

                return view('drd/dsp/index', [
                    'dsps' => $equipe,
                    'active_tab' => $active_tab,
                ]);
            }
        }
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
     * @param  \App\Models\Drd\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function show(Equipe $equipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drd\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipe $equipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drd\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipe $equipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drd\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipe $equipe)
    {
        //
    }
}
