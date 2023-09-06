<?php

namespace App\Http\Controllers\Drd;

use App\Http\Controllers\Controller;
use App\Models\Drd\Diario;
use Illuminate\Http\Request;

class DiarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diarios = Diario::paginate(15);
        return view('drd/plantao/diario/index',
                    [
                        'diarios' => $diarios,                    
                    ]);
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
     * @param  \App\Models\Drd\Diario  $diario
     * @return \Illuminate\Http\Response
     */
    public function show(Diario $diario)
    {

        return view('drd/plantao/diario/show',
                    [
                       'diario' => $diario, 
                    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drd\Diario  $diario
     * @return \Illuminate\Http\Response
     */
    public function edit(Diario $diario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drd\Diario  $diario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diario $diario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drd\Diario  $diario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diario $diario)
    {
        //
    }
}
