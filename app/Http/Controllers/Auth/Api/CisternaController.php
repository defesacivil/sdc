<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\Ajuda\Cisterna;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToArray;

use function PHPSTORM_META\map;

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


    # busca cpf
    public function busca(Request $request)
    {

        //dd($request->cpf);

        $cisterna = Cisterna::where('cpf', '=', $request->cpf)->get();

        //dd($cisterna);

        return response()->json([
            'data' => $cisterna,
            JSON_FORCE_OBJECT,

        ]);
    }


    # processador
    public function processar(Request $request)
    {

        //dd($request->all());

        $dados = (!empty($request->all())) ? $request->all() : "";

        //dd(json_decode($dados[0], true));

        if (!empty($dados)) {
            foreach (json_decode($dados[0], true) as $dado) {

                //dd($dado);

                $cisterna = new Cisterna();
                $benef = $cisterna->where('cpf', '=', $dado['cpf'])->first();

                //var_dump($benef);

                # atualização
                if ($benef) {

                    $benef->update($dado);

                    # novo reg
                } else {

                    $cisterna->fill($dado);
                    $cisterna->save();
                }
            }
        }

        //dd($request, $request[0]);

    }


    # novo registro os dados no serividor
    public function create(Request $request)
    {

        $dados = json_decode($request->getContent(), true);

        $dados['id_cad'] = $dados['id'];
        unset($dados['id']);

        $cisterna = new Cisterna();


        $cisterna->id_cad                 = $dados['id_cad'];
        $cisterna->municipio              = $dados['municipio'];
        $cisterna->comunidade             = $dados['comunidade'];
        $cisterna->nome                   = $dados['nome'];
        $cisterna->endereco               = $dados['endereco'];
        $cisterna->localiza               = $dados['localiza'];
        $cisterna->cpf                    = $dados['cpf'];
        $cisterna->dtNasc                 = $dados['dtNasc'];
        $cisterna->cadUnico               = $dados['cadUnico'];
        $cisterna->qtdPessoa              = $dados['qtdPessoa'];
        $cisterna->renda                  = $dados['renda'];
        $cisterna->moradia                = $dados['moradia'];
        $cisterna->outroMoradia           = $dados['outroMoradia'];
        $cisterna->compTelhado            = $dados['compTelhado'];
        $cisterna->larguracompTelhado     = $dados['larguracompTelhado'];
        $cisterna->areaTotalTelhado       = $dados['areaTotalTelhado'];
        $cisterna->compTestada            = $dados['compTestada'];
        $cisterna->numCaidaTelhado        = $dados['numCaidaTelhado'];
        $cisterna->coberturaTelhado       = $dados['coberturaTelhado'];
        $cisterna->coberturaOutros        = $dados['coberturaOutros'];
        $cisterna->existeFogaoLenha       = $dados['existeFogaoLenha'];
        $cisterna->medidaTelhadoAreaFogao = $dados['medidaTelhadoAreaFogao'];
        $cisterna->testadaDispParteFogao  = $dados['testadaDispParteFogao'];
        $cisterna->atendPipa              = $dados['atendPipa'];
        $cisterna->outroAtendPipa         = $dados['outroAtendPipa'];
        $cisterna->respAtDefesaCivil      = $dados['respAtDefesaCivil'];
        $cisterna->respAtExercito         = $dados['respAtExercito'];
        $cisterna->respAtParticular       = $dados['respAtParticular'];
        $cisterna->respAtPrefeitura       = $dados['respAtPrefeitura'];
        $cisterna->respAtOutros           = $dados['respAtOutros'];
        $cisterna->outrObs                = $dados['outrObs'];
        $cisterna->nomeAgente             = $dados['nomeAgente'];
        $cisterna->cpfAgente              = $dados['cpfAgente'];
        $cisterna->nomeEng                = $dados['nomeEng'];
        $cisterna->creaEng                = $dados['creaEng'];
        $cisterna->dt_cadastro            = $dados['dt_cadastro'];
        $cisterna->img_frontal            = $dados['img_frontal'];
        $cisterna->img_lat_direito        = $dados['img_lat_direito'];
        $cisterna->img_lat_esquerdo       = $dados['img_lat_esquerdo'];
        $cisterna->img_fundo              = $dados['img_fundo'];
        $cisterna->img_local_ins_p1       = $dados['img_local_ins_p1'];
        $cisterna->img_local_ins_p2       = $dados['img_local_ins_p2'];
        $cisterna->img_op1                = $dados['img_op1'];
        $cisterna->img_op2                = $dados['img_op2'];
        $cisterna->img_op3                = $dados['img_op3'];
        $cisterna->img_op4                = $dados['img_op4'];

        $result = $cisterna->save();
        //dd($result)  ;      

        return response()->json([
            'message' => 'Registro Gravado com Sucesso',
            'status' => $result,
        ]);
        // }
    }


    public function uploadFotos(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cpf' => 'required',
            'nome' => 'required',
        ]);

            $filename = $request->input('nome');
            $cpf = $request->input('cpf');

            $existeImage = Storage::exists('cisterna/' . $request->cpf . '/' . $request->nome);

            if(!$existeImage) {

                $request->file('image')->storeAs('cisterna/' . $request->cpf, $filename);

            return response()->json(
                [
                    'message' => 'Imagem enviada com sucesso',
                    //'path' => Storage::url($imagePath)
                    //'cpf' => $request->cpf,
                    //'image' => $request->hasFile('image')
                    'filename' => $request->input('nome')
                ]
            );
        } else {
            return response()->json(
                [
                    'message' => 'ja existe o arquivo' 
                ]);
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
