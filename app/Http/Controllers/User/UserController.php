<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Drrd\PaeEmpdor;
use App\Models\Estoque\AjuDeposito;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $empdors = PaeEmpdor::all();

        return view('drrd/paebm/users/create',
    [
        'empdors' => $empdors,
    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

     
        $request->validate(
            [
                'selEmpreendedor' => "required|integer",
                'nomeUser' => "required|max:80",
                'cpfUser' => "required|max:14",
                'emailUser' => "email",
                
            ],
            [
                'selEmpreendedor.required' => "O campo Data de Entrada é Obrigatório !",
                'selEmpreendedor.integer' => "O campo deve ser selecionado corretamente !",

                'nomeUser.required' => "O campo Nome de Usuário é Obrigatório !",
                'nomeUser.max' => "O campo Nome de Usuário deve ter no máximo 80 Caracteres !",

                'cpfUser.required' => "O campo CPF é Obrigatório !",
                'cpfUser.max' => "O campo CPF deve ter no máximo 14 Caracteres !",

                'emailUser.email' => "O campo E-mail deve ser um email válido !",
            ]
        );

        $user = new User();
              
        $user->id_empdor= $request->selEmpreendedor;
        $user->name     = $request->nomeUser;
        $user->cpf      = str_replace([".","-"],"", $request->cpfUser);
        $user->email      = $request->emailUser;
        $user->password = "";
        $user->ativo    = 0;
        $user->tipo     = "externo";
        $user->sub_tipo = "";
        $user->municipio_id = 1;
        
        $user->save();

        return redirect('pae/user')->with('message', 'Registro Gravado com Sucesso ');

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
    public function edit($id)
    {

        $user = User::with('funcionario')
        ->where('id', '=', $id)->first();
        $depositos = AjuDeposito::all();      
        $deposito = $depositos->pluck('nome', 'id');

        // $posto = <option>Escolha uma Opção</option>
        // <option>GOVERNADOR</option>
        // <option>SECRET.GOV</option>
        // <option>CEL PM</option>
        // <option>CEP BM</option>
        // <option>TEN CEL PM</option>
        // <option>TEN CEM BM</option>
        // <option>MAJ PM</option>
        // <option>MAJ BM</option>
        // <option>CAP PM</option>
        // <option>CAP BM</option>
        // <option>TEN BM</option>
        // <option>TEN PM</option>
        // <option>SUB TEN PM</option>
        // <option>SUB TEN BM</option>
        // <option>1º SGT PM</option>
        // <option>1º SGT BM</option>
        // <option>2º SGT PM</option>
        // <option>2º SGT BM</option>
        // <option>3º SGT PM</option>
        // <option>2º SGT BM</option>
        // <option>SD PM</option>
        // <option>SD BM</option>
        // <option>CB PM</option>
        // <option>CB BM</option>
        // <option>SC</option>
        // <option>FC</option>


        //dd($user->funcionario->nome);

        return view('usuario/edit', [
            'user' => $user,
            'deposito' => $deposito,
        ]);
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
        //
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


    # desativar
    public function status(Request $request)
    {
        //dd($request->user_id);
        $user = User::find($request->user_id);

        $user->ativo = $request->status;
        $user->save();

        return true;
    }

    # Resetar senha
    public function resetsenha(Request $request)
    {
        //dd($request->user_id);
        $user = User::find($request->user_id);

        $user->password = bcrypt("cedec@pae");
        $user->save();

        return true;
    }


    
}
