<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Models\Config\Config;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('config.index');
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
     * @param  \App\Models\Config\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit(Config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Config $config)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        //
    }


    /**
     * Configurações
     */

    public function config()
    {
        return view('config.config.index');
    }

    /**
     * Configurações
     */

    public function info()
    {
        return phpinfo();
    }

    public function listDb()
    {

        $qBuildTable = DB::select('SELECT TABLE_NAME, TABLE_COMMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = "dbsdc"');

        $tables = [];
        foreach ($qBuildTable as $table) {
            $tables[] = $table;
        }

        return view(
            'config.config.listdb',
            [
                'tables' => $tables,
            ]
        );
    }


    public function listFields($nameTable)
    {

        $qBuildFields = DB::select("SELECT table_name, column_name, COLUMN_TYPE, column_comment 
                                    FROM information_schema.columns
                                    WHERE TABLE_SCHEMA = 'dbsdc'
                                    AND table_name = ".$nameTable."
                                    ORDER BY table_name, column_name");

        $fields = [];

        foreach ($qBuildFields as $field) {
            $fields[] = $field;
        }

        return $fields;
    }
}
