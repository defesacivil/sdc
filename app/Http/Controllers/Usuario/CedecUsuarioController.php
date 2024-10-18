<?php

namespace App\Http\Controllers\Usuario;

use App\Models\Estoque\AjuDeposito;
use App\Models\Cedec\CedecFuncionario;
use App\Models\Cedec\CedecUsuario;
use App\Models\Municipio\Municipio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class CedecUsuarioController extends \App\Http\Controllers\Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        /* cadastro usuario  */

        if ($request->ajax()) {
            $data = CedecUsuario::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . url('usuario/edit') . '" class="edit btn btn-primary btn-sm">Editar</a>&nbsp';
                    $btn .= '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('usuario.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipios = Municipio::all();

        return view(
            'usuario/create',
            [
                'municipios' => $municipios 
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
    
 //       dd($request);

        $user = new User();

        Log::error($request);
        dd($request);

        $request->validate(
            [
                "name"      => "required|max:70",
                "email"     => "required|max:110",
                "cpf"       => "required|max:", 
                "selTipo"   => "required|string|max:10",
                "municipio" => "required|numeric",
                "selsubTipo" => "required|string|max:10",
            ],
            [
                "name.required"       => "O Campo name é Obrigatório",
                "name.max"            => "O Campo :attribute deve ter 70 Caracteres no máximo",
                "email.required"      => "O Campo :attribute  é Obrigatório",
                "email.max"           => "O Campo :attribute deve ter 110 Caracteres no máximo",
                "cpf.required"        => "O Campo :attribute  é Obrigatório", 
                "cpf.max"             => "O Campo :attribute deve ter 15 Caracteres no máximo", 
                "selTipo.required"    => "O Campo :attribute  é Obrigatório",
                "selTipo.string"      => "O Campo :attribute deve ser um texto",
                "selTipo.max"         => "O Campo :attribute deve ter 10 Caracteres no máximo",
                "municipio.required"  => "O Campo :attribute  é Obrigatório",
                "municipio.numeric"   => "O Campo :attribute deve ser númerico",
                "selsubTipo.required" => "O Campo :attribute  é Obrigatório",
                "selsubTipo.string"   => "O Campo :attribute deve ser um texto",
                "selsubTipo.max"      => "O Campo :attribute deve ter 10 Caracteres no máximo",
        ]
    );

                $user->name       = $request->name;
                $user->email      = $request->email;
                $user->cpf        = $request->cpf;
                $user->selTipo    = $request->selTipo;
                $user->municipio  = $request->municipio;
                $user->selsubTipo = $request->selsubTipo;
                $user->password   = '$2a$12$KrZRc7.nY.fFrrJy9TptOexgkAWyiDcg7oXMsTi9H/NdQjejyCTqC';

                $user->save();


                return redirect('usuario/create')->with('message', 'Registro Gravado com Sucesso ');

        }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CedecUsuario  $cedecUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(CedecUsuario $cedecUsuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CedecUsuario  $cedecUsuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cedecUsuario = CedecUsuario::find($id);
        $depositos = AjuDeposito::all();
        $funcionarios = CedecFuncionario::all();

        $deposito = $depositos->pluck('nome', 'id');
        $funcionario = $funcionarios->pluck('nome', 'id');
        return view('usuario/edit', [
            'cedecusuario' => $cedecUsuario,
            'deposito' => $deposito,
            'funcionario' => $funcionario,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CedecUsuario  $cedecUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CedecUsuario $cedecUsuario)
    {
        $request->has('situacao')        ? $request['situacao']        = 1 : $request['situacao']       = 0;
        $request->has('situacao')        ? $request['situacao']        = 1 : $request['situacao']       = 0;
        $request->has('it_m_deposito')   ? $request['it_m_deposito']   = 1 : $request['it_m_deposito']  = 0;
        $request->has('it_m_pipa')       ? $request['it_m_pipa']       = 1 : $request['it_m_pipa']      = 0;
        $request->has('it_m_cce')        ? $request['it_m_cce']        = 1 : $request['it_m_cce']       = 0;
        $request->has('it_m_decretacao') ? $request['it_m_decretacao'] = 1 : $request['it_m_decretacao'] = 0;
        $request->has('it_m_comdec')     ? $request['it_m_comdec']     = 1 : $request['it_m_comdec']    = 0;
        $request->has('it_m_apoio')      ? $request['it_m_apoio']      = 1 : $request['it_m_apoio']     = 0;
        $request->has('it_m_poco')       ? $request['it_m_poco']       = 1 : $request['it_m_poco']      = 0;
        $request->has('it_m_escola')     ? $request['it_m_escola']     = 1 : $request['it_m_escola']    = 0;
        $request->has('cedec_admin')     ? $request['cedec_admin']     = 1 : $request['cedec_admin']    = 0;

        try {



            $input = $request->all();

            $cedec_usuario = CedecUsuario::find($input['id']);

            $cedec_usuario->fill($input);

            $cedec_usuario->save();
        } catch (\Exception $ex) {
            $ex->getMessage();
        }

        return back()->with('message', 'Registro Atualizado com Sucesso !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CedecUsuario  $cedecUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(CedecUsuario $cedecUsuario)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usuario()
    {
        return view('usuario.index');
    }

    public function updateCPF($dat)
    {

        print $dat;
    }
}
