<?php

namespace App\Http\Controllers\Ajuda;

use App\Http\Controllers\Controller;
use App\Models\Ajuda\Cisterna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CisternaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dados = Cisterna::all();
        return view('ajuda/cisterna/index',
                    [
                        'dados'=> $dados,
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
     * @param  \App\Models\Ajuda\Cisterna  $cisterna
     * @return \Illuminate\Http\Response
     */
    public function show(Cisterna $cisterna)
    {

        $dados = DB::table("sinc_cisterna")
                ->join("cedec_municipio", "sinc_cisterna.municipio", "=", "cedec_municipio.Codmundv")
                ->select("sinc_cisterna.*", "cedec_municipio.nome as municipio")
                ->first();


        $cpf = str_replace([".","-"], "", $cisterna->cpf );

        $images = Storage::files('cisterna/'.$cpf, true);

               return view('ajuda/cisterna/view',
        [
            'cisterna' => $dados,
            'images' => $images,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajuda\Cisterna  $cisterna
     * @return \Illuminate\Http\Response
     */
    public function edit(Cisterna $cisterna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajuda\Cisterna  $cisterna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cisterna $cisterna)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajuda\Cisterna  $cisterna
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cisterna $cisterna)
    {
        //
    }
}
