<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\Ajuda\Cisterna;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToArray;

class CisternaController extends Controller
{

    # listar os dados no celular
    public function ListAll(Request $request)
    {

        $cisterna = Cisterna::all()->toarray();

        return response()->json([
            'data' => array_values($cisterna),
            JSON_FORCE_OBJECT,

        ]);
    }


    # processador
    public function processar(Request $request) {

        //dd($request->all());

        $dados = (!empty($request->all())) ? $request->all(): "";

        //dd(json_decode($dados[0], true));
        
        if(!empty($dados)) {
            foreach(json_decode($dados[0], true) as $dado){

                //dd($dado);

                $cisterna = new Cisterna();
                $benef = $cisterna->where('cpf', '=', $dado['cpf'])->first();
                
                //var_dump($benef);
                
                # atualização
                if($benef) { 
                    
                    $benef->update($dado);
                    
                # novo reg
                }else { 

                    $cisterna->fill($dado);
                    $cisterna->save();
                }

            }

        }

        //dd($request, $request[0]);

    }


    # novo registro os dados no serividor
    public function create(Request $request, Cisterna $cisterna)
    {

        $val = Validator::make(
            $request->all(),
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


        if ($val->fails()) {
            return response()->json([
                'error' => $val->errors(),
            ]);
        } else {
            $cisterna->save();

            // return response()->json([
            //     'view' => '../show/' . $rat->id,
            //     'message' => 'Registro Gravado com Sucesso',
            //     'status' => true,
            // ]);
        }
    }


    # atualizar os dados no serividor
    public function update(Request $request, Cisterna $cisterna)
    {

        $val = Validator::make(
            $request->all(),
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


        if ($val->fails()) {
            return response()->json([
                'error' => $val->errors(),
            ]);
        } else {
            $cisterna->update();

            // return response()->json([
            //     'view' => '../show/' . $rat->id,
            //     'message' => 'Registro Gravado com Sucesso',
            //     'status' => true,
            // ]);
        }
    }
}
