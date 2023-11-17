<?php

namespace App\Http\Controllers\Estoque;

use App\Http\Controllers\Controller;
use App\Models\Estoque\AjudaEstoqFornecedor;
use Illuminate\Http\Request;

class AjudaEstoqFornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fornecedores = AjudaEstoqFornecedor::paginate(10);
        return view('ajuda/estoque/fornecedor/index',
        [
            'fornecedores' => $fornecedores,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ajuda/estoque/fornecedor/create');
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
                'nome' => "required|max:70",
                'cpfcnpj' => "required|max:20",
                'endereco' => "required|max:70",
                'municipio' => "required|max:45",
                'estado' => "required|max:45",
                'cep' => "required|max:10",
                'tel' => "nullable|max:15",
                'email' => "nullable|max:110",
            ],
            [
                'nome.required' => "O campo Nome é Obrigatório !",
                'nome.max' => "O campo Nome deve ter no máximo 70 Caracteres !",
                
                'cpfcnpj.required' => "O campo CNPCNPJ é Obrigatório !",
                'cpfcnpj.max' => "O campo CPFCNPJ deve ter no máximo 20 Caracteres !",
                
                'endereco.required' => "O campo Endereço é Obrigatório !",
                'endereco.max' => "O campo Endereço deve ter no máximo 70 Caracteres !",
                
                'municipio.required' => "O campo Municipio é Obrigatório !",
                'municipio.max' => "O campo Municipio deve ter no máximo 45 Caracteres !",
                
                'estado.required' => "O campo Estado é Obrigatório !",
                'estado.max' => "O campo Estado deve ter no máximo 45 Caracteres !",
                
                'cep.required' => "O campo Cep é Obrigatório !",
                'cep.max' => "O campo Cep deve ter no máximo 10 Caracteres !",
                
                'tel.max' => "O campo Telefone deve ter no máximo 15 Caracteres !",
                'email.max' => "O campo Email deve ter no máximo 110 Caracteres !",

            ]
        );
        $fornecedor = new AjudaEstoqFornecedor();
        
        $fornecedor->nome     = $request->nome;
        $fornecedor->cpfcnpj  = $request->cpfcnpj;
        $fornecedor->endereco = $request->endereco;
        $fornecedor->municipio= $request->municipio;
        $fornecedor->estado   = $request->estado;
        $fornecedor->cep      = $request->cep;
        $fornecedor->tel      = $request->tel;
        $fornecedor->email      = $request->email;

        $fornecedor->save();

        return redirect('estoque/fornecedor/create')->with('message', 'Registro Gravado com Sucesso ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ajuda\AjudaEstoqueFornecedor  $ajudaEstoqueFornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(AjudaEstoqFornecedor $fornecedor)
    {
        return view('ajuda/estoque/fornecedor/show',
        [
            'fornecedor' => $fornecedor,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajuda\AjudaEstoqueFornecedor  $ajudaEstoqueFornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(AjudaEstoqFornecedor $ajudaEstoqueFornecedor)
    {
        return view('ajuda/estoque/fornecedor/edit',
            ['fornecedor' => $ajudaEstoqueFornecedor]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajuda\AjudaEstoqueFornecedor  $ajudaEstoqueFornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjudaEstoqFornecedor $ajudaEstoqueFornecedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajuda\AjudaEstoqueFornecedor  $ajudaEstoqueFornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(AjudaEstoqFornecedor $ajudaEstoqueFornecedor)
    {
        //
    }
}
