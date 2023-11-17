<?php

namespace App\Http\Controllers\Tdap;

use App\Http\Controllers\Controller;
use App\Models\Tdap\Tdap;
use Illuminate\Http\Request;

class TdapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ajuda/tdap/index');
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
     * @param  \App\Models\Tdap\Tdap  $tdap
     * @return \Illuminate\Http\Response
     */
    public function show(Tdap $tdap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tdap\Tdap  $tdap
     * @return \Illuminate\Http\Response
     */
    public function edit(Tdap $tdap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tdap\Tdap  $tdap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tdap $tdap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tdap\Tdap  $tdap
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tdap $tdap)
    {
        //
    }
}
