<?php

namespace App\Http\Controllers\Drd;

use App\Http\Controllers\Controller;
use App\Models\Drd\Boletim;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BoletimController extends Controller
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

        $boletims = DB::table('cce_boletim')
            ->join('cedec_usuario', 'cce_boletim.usuario_id', '=', 'cedec_usuario.id')
            ->select('cce_boletim.*', 'cedec_usuario.nome as usuario')
            ->orderBy('cce_boletim.data', 'desc')
            ->paginate(15);


        if ($method == 'GET') {
            return view('drd/boletim/index', [
                'boletims' => $boletims,
            ]);
        } elseif ($method == 'POST') {

            if (true) {

                $param = request()->input('txtBusca');

                $boletims = DB::table('cce_boletim')
                    ->join('cedec_usuario', 'cce_boletim.usuario_id', '=', 'cedec_usuario.id')
                    ->select('cce_boletim.*', 'cedec_usuario.nome as usuario', 'cedec_usuario.id')
                    ->where('cedec_usuario.nome', "LIKE", '%' . $param . '%')
                    ->orderBy('cedec_usuario.nome', 'desc')
                    ->paginate(15);


                return view('drd/boletim/index', [
                    'boletims' => $boletims,
                    'active_tab' => $active_tab,
                ]);
            }
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function status(Request $id)
    {

        $boletim_id = request()->id;

        $boletim = Boletim::find($boletim_id);

        if($boletim->situacao == 0){
            $boletim->situacao = 1;
        }else {
            $boletim->situacao = 0;
        }

        $boletim->update();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drd/boletim/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate(
            [
                'nome' => 'required|file|mimes:pdf,doc,docx,odt|max:1024',
                'data' => 'required|date',
                'descricao' => 'required|max:30',
            ],
            [
                'nome.required'  => 'Obrigatório anexar um arquivo !',
                'nome.max'    => 'Arquivo muito grande, Tamanho Máximo permitido : 1Mb',
                'nome.mimes' => 'Tipo de Arquivos permitidos : PDF, DOC, DOCX, ODT',
                'data.required' => "O Campo data é Obrigatório !",
                'data.date' => 'O campo Data de ver uma Data Válida !',
                'descricao.required' => 'O campo Descrição é obrigatório !',
                'descricao.max' => 'O Campo Descrição deve ter no máximo 30 caracteres !',
            ]
        );

        

        $fileName = 'boletim_site'.time().$request->file('nome')->extension();

        $boletim = new Boletim();
        
        $boletim->nome = $fileName;
        $boletim->data = $request->data;
        $boletim->descricao = $request->descricao;
        $boletim->situacao = $request->situacao;
        $boletim->usuario_id = Auth::user()->id;
        $boletim->save();

        $request->file('nome')->storeAs('boletim', $fileName);

        return redirect('boletim')->with('message','Registro Lançado com Sucesso ');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drd\Boletim  $boletim
     * @return \Illuminate\Http\Response
     */
    public function show(Boletim $boletim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drd\Boletim  $boletim
     * @return \Illuminate\Http\Response
     */
    public function edit(Boletim $boletim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drd\Boletim  $boletim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Boletim $boletim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drd\Boletim  $boletim
     * @return \Illuminate\Http\Response
     */
    public function destroy(Boletim $boletim)
    {
        //dd($boletim);
        $boletim->delete();
        try{
            Storage::delete('boletim/'.$boletim->nome, $boletim->nome);           
        }catch(Exception $e){
            print $e;
        }
        return redirect('boletim')->with('message','Registro Deletado com Sucesso ');
    }

    /**
     * visualizar Plano de contingencia.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function visualizar(Response $response, $arquivo)
    {
        try {
            return Storage::download('boletim/'.$arquivo, $arquivo);       
        }catch(FileNotFoundException $e){
            abort(404);

        }
    }
}
