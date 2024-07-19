<?php

use App\Http\Controllers\Compdec\RatController;
use App\Models\CedecUsuario;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/







# http://localhost:8081/drrd1?token=16|zuC7Mdwo8XAn3CzfOnzt5i4xsTefgjRF1AhfFBRI

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {

        //dd("--", $_SERVER['HTTP_HOST']);
        if(auth()->user()->tipo == 'externo'){
            return redirect()->action(['App\Http\Controllers\Drrd\PaeProtocoloController', 'minerar']);
        }else if ($_SERVER['HTTP_HOST'] == 'sdc.net:8081') {
            return redirect()->away('http://sdcold.net:8081/?token=' . md5(12345678) . '&modulo=index&controller=index&action=menu');
        } elseif (null != session()->get('routeInicio')) {
            return redirect()->away('http://sistema.defesacivil.mg.gov.br/index.php?token=' . md5(12345678) . '&' . session()->get('routeInicio'));
        } else {
            return redirect()->away('http://sistema.defesacivil.mg.gov.br/index.php?token=' . md5(12345678) . '&modulo=index&controller=index&action=menu');
        }
    });


    ##############################  DASHBOARD ##############################
    Route::get('/dashboard', function () {

        if ($_SERVER['HTTP_HOST'] == 'sdc.net:8081') {
            return redirect()->away('http://sdcold.net:8081/?token=' . md5(12345678) . '&modulo=index&controller=index&action=menu');
        } elseif (null != session()->get('routeInicio')) {
            return redirect()->away('http://sistema.defesacivil.mg.gov.br/index.php?token=' . md5(12345678) . '&' . session()->get('routeInicio'));
        } else {
            return redirect()->away('http://sistema.defesacivil.mg.gov.br/index.php?token=' . md5(12345678) . '&modulo=index&controller=index&action=menu');
        }
    })->name('dashboard');




    #################################   CONFIG   ##################################
    Route::get('config/index', 'App\Http\Controllers\Config\ConfigController@index');





    # configurações 
    Route::get('config', 'App\Http\Controllers\Usuario\ConfigController@index')->can('cedec');


    # configurações COMPDEC 
    Route::get('configcompdec', 'App\Http\Controllers\Usuario\ConfigController@index')->can('compdec');

    #Mensagens
    Route::get('msg', 'App\Http\Controllers\config\ConfigController@msg');

    # help 
    Route::get('help', 'App\Http\Controllers\Cedec\CedecController@help');





    # USUARIO ###################

    # index
    Route::match(["GET", "POST"], 'usuario', 'App\Http\Controllers\Usuario\UserController@index')->can('cedec');
    
    # user autocomplete
    Route::get('usuario/autocomplete', 'App\Http\Controllers\Usuario\UserController@user_autocomplete')->can('cedec')->name('user.autocomplete');

    # edit 
    Route::get('usuarioperfil/edit/{id}', 'App\Http\Controllers\Usuario\UserController@edit')->can('cedec');

    # update
    Route::post('config/usuarioperfil/update', 'App\Http\Controllers\Usuario\UserController@update')->can('cedec');







    # CONFIG ######################

    # config - usuario 
    Route::get('config/usuario', 'App\Http\Controllers\Usuario\ConfigController@usuario');


    # ROLE 
        # index perfil
        Route::get('role', 'App\Http\Controllers\Usuario\RoleController@index');
        # create
        Route::get('config/role/create', 'App\Http\Controllers\Usuario\RoleController@create');
        # gravar
        Route::get('config/role/store', 'App\Http\Controllers\Usuario\RoleController@store');
        # editar
        Route::get('config/role/edit/{id}', 'App\Http\Controllers\Usuario\RoleController@edit');
        # update
        Route::put('config/role/update/{id}', 'App\Http\Controllers\Usuario\RoleController@update');
        # view 
        Route::get('config/role/show/{id}', 'App\Http\Controllers\Usuario\RoleController@show');
        # delete 
        Route::get('config/role/delete/{id}', 'App\Http\Controllers\Usuario\RoleController@destroy');


    # PERMISSION

        # index
        Route::get('permissao', 'App\Http\Controllers\Usuario\PermissionController@index');
        # create 
        Route::get('config/permissao/create', 'App\Http\Controllers\Usuario\PermissionController@create');
        # gravar 
        Route::post('config/permissao/store', 'App\Http\Controllers\Usuario\PermissionController@store');
        # editar
        Route::get('config/permission/edit/{id}', 'App\Http\Controllers\Usuario\PermissionController@edit');
        # update
        Route::put('config/permissao/update/{id}', 'App\Http\Controllers\Usuario\PermissionController@update');
        # view 
        Route::get('config/permissao/show/{id}', 'App\Http\Controllers\PermissionController@show');
        # delete
        Route::get('config/permissao/delete/{id}', 'App\Http\Controllers\Usuario\PermissionController@destroy');


    # ROLE_USER #######################

        #index
        Route::get('role_user', 'App\Http\Controllers\Usuario\RoleUserDemController@index');

        # adicionar usuario em perfil
        Route::get('usuario/role/add/{id}', 'App\Http\Controllers\Usuario\RoleUserDemController@create')->can('cedec');

        # store ( sincronizar )
        Route::post('usuario/role/add/store', 'App\Http\Controllers\Usuario\RoleUserDemController@store');
        # edit 
        #não implementar
        
        # update
        #não implementar
        
        # view 
        #não implementar



    # PERMISSION_ROLE

    # index
    Route::get('permission_role', 'App\Http\Controllers\Usuario\PermissionRoleController@index');

    # Adicionar permissao para usuario 
    Route::get('usuario/permission/add/{id}', 'App\Http\Controllers\Usuario\PermissionUserController@create')->can('cedec');

    # gravar Permissao no usuario
    Route::post('usuario/permission/add/store', 'App\Http\Controllers\Usuario\PermissionUserController@store');

    # view 
    #não implementar 

    # edit
    #não implementar

    # update
    #não implementar
    
    # deletar
    #não implementar



    



    # CADASTRO USUARIO ##################

    # cadastro usuario
    Route::get('usuario/index', 'App\Http\Controllers\Usuario\CedecUsuarioController@index');

    # editar usuario
    Route::get('usuario/edit/{id}', 'App\Http\Controllers\Usuario\CedecUsuarioController@edit');

    # gravar usuario
    Route::post('usuario/store', 'App\Http\Controllers\Usuario\CedecUsuarioController@edit');

    # update usuario
    Route::post('usuario/update', 'App\Http\Controllers\Usuario\CedecUsuarioController@update');


    ################################ DADOS MUNICIPIO ####################################

    Route::post('municipio/update/{id}', 'App\Http\Controllers\Compdec\CompdecController@updateMunicipio');

    ##############################  COMPDEC ##############################

    # FORM BUSCAR COMPDEC
    Route::get('compdec', 'App\Http\Controllers\Compdec\CompdecController@index');
    Route::post('compdec', 'App\Http\Controllers\Compdec\CompdecController@index');

    # compdec Buscar
    Route::post('compdec/busca}', 'App\Http\Controllers\Compdec\CompdecController@processa');
    # compdec editar
    Route::get('compdec/edit/{id?}', 'App\Http\Controllers\Compdec\CompdecController@edit');
    # compdec salvar
    Route::post('compdec/update/{id}', 'App\Http\Controllers\Compdec\CompdecController@update');

    # FOTO COMPDEC 
    Route::post('compdec/upload/{id}', 'App\Http\Controllers\Compdec\CompdecController@upload');

    # GRAVAR COMPDEC EQUIPE
    Route::post('compdec.equipe/{id}', 'App\Http\Controllers\Compdec\CompdeceqController@store')->name('compdec.equipe');

    # EDITAR COMPDEC EQUIPE
    Route::get('compdeceq.edit/{id}', 'App\Http\Controllers\Compdec\CompdeceqController@edit')->name('compdeceq.edit');

    # UPDATE COMPDEC EQUIPE
    Route::get('compdeceq.update/{id}', 'App\Http\Controllers\Compdec\CompdeceqController@update')->name('compdeceq.update');

    # DELETE COMPDEC EQUIPE
    Route::get('compdec.delete/{id}', 'App\Http\Controllers\Compdec\CompdeceqController@destroy')->name('compdec.delete');

    # COMPDEC LEIS
    Route::post('compdec.leis/{id}', 'App\Http\Controllers\Compdec\CompdecAnexoController@store');

    # VISUALIAR LEIS 
    Route::get('compdec/visualizar/{arquivo}', 'App\Http\Controllers\Compdec\CompdecAnexoController@visualizar');

    # DELETAR LEIS 
    Route::get('leis.delete/{id}', 'App\Http\Controllers\Compdec\CompdecAnexoController@destroy')->name('leis.delete');


    # GRAVAR COMPDEC PLANO CONTINGENCIA
    Route::post('compdec.plano/{id}', 'App\Http\Controllers\Compdec\CompdecUploadPlanoController@store');

    # VISUALIZAR COMPDEC PLANO CONTINGENCIA
    Route::get('compdec/viewplano/{arquivo}', 'App\Http\Controllers\Compdec\CompdecUploadPlanoController@visualizar');

    # DELETAR COMPDEC PLANO CONTINGENCIA
    Route::get('compdec/deleteplano/{id}', 'App\Http\Controllers\Compdec\CompdecUploadPlanoController@destroy');

    ##############################  PREFEITURA ##############################

    # UPLOAD FOTO PREFEITO
    Route::post('prefeitura/upload/{id}', 'App\Http\Controllers\Compdec\PrefeituraController@upload');


    #############################  DRRD ###########################################
    # menu DRRD
    Route::get('drrd', 'App\Http\Controllers\Drrd\DrrdController@menu');

    # acesso mineradora
    Route::match(["GET", "POST"], 'pae/mineradora','App\Http\Controllers\Drrd\PaeProtocoloController@minerar');
    
    
        
    //'App\Http\Controllers\Drrd\DrrdController@acesso')->name('pae.mineradora');



    Route::get('pae/listagem', 'App\Http\Controllers\Drrd\PaeEmpntoController@listagem');




    #  PAE PROTOCOLO  ###########################

    # Protocolo INDEX
    Route::match(["GET", "POST"], 'pae/protocolo', 'App\Http\Controllers\Drrd\PaeProtocoloController@index');

    # Protocolo CREATE
    Route::get('pae/protocolo/create', 'App\Http\Controllers\Drrd\PaeProtocoloController@create');

    # Protocolo EDIT
    Route::get('pae/protocolo/edit/{paeProtocolo}', 'App\Http\Controllers\Drrd\PaeProtocoloController@edit');

    # Protocolo UPDATE
    Route::post('pae/protocolo/update', 'App\Http\Controllers\Drrd\PaeProtocoloController@update');

    # Protocolo EDIT
    Route::get('pae/protocolo/edit/{paeProtocolo}', 'App\Http\Controllers\Drrd\PaeProtocoloController@edit');

    # Protocolo VIEW
    Route::get('pae/protocolo/show/{paeProtocolo}', 'App\Http\Controllers\Drrd\PaeProtocoloController@show');
    
    # protocolo STORE
    Route::post('pae/protocolo/store', 'App\Http\Controllers\Drrd\PaeProtocoloController@store');
    
    # protocolo DELETE
    Route::get('pae/protocolo/deletar/{paeProtocolo}', 'App\Http\Controllers\Drrd\PaeProtocoloController@delete');
    
    # form atribuir processo
    Route::match(["GET", "POST"], 'pae/protocolo/atribuir/{paeProtocolo?}', 'App\Http\Controllers\Drrd\PaeProtocoloController@atribuir');
    
    # protocolo encerrar
    Route::get('pae/protocolo/encerrar/{paeProtocolo}', 'App\Http\Controllers\Drrd\PaeProtocoloController@encerrar');
    

    
    # PAE USER ##############
    Route::match(["GET","POST"], 'pae/user', 'App\Http\Controllers\Drrd\PaeProtocoloController@user');
    
    # form novo usuario externo ( mineradora)
    Route::get('pae/users/create', 'App\Http\Controllers\User\UserController@create');
    
    # gravar novo usuario
    Route::post('pae/users/store', 'App\Http\Controllers\User\UserController@store');
    
    # Mudar Status
    Route::post('pae/user/status', 'App\Http\Controllers\User\UserController@status');
    
    # resetar senha
    Route::post('pae/user/reset', 'App\Http\Controllers\User\UserController@resetsenha');
    
    

    
    
    
    

    # PAE EMPREENDEDOR #################
    # empreendedor INDEX
    Route::match(["GET", "POST"], 'pae/empdor', 'App\Http\Controllers\Drrd\PaeEmpdorController@index');

    # empreendedor CREATE
    Route::get('pae/empdor/create', 'App\Http\Controllers\Drrd\PaeEmpdorController@create');

    # empreendedor STORE
    Route::post('pae/empdor/store', 'App\Http\Controllers\Drrd\PaeEmpdorController@store');

    # empreendedor EDITAR
    Route::get('pae/empdor/edit/{paeEmpdor}', 'App\Http\Controllers\Drrd\PaeEmpdorController@edit');

    # empreendedor UPDATE
    Route::post('pae/empdor/update', 'App\Http\Controllers\Drrd\PaeEmpdorController@update');

    # empreendedor SHOW
    Route::get('pae/empdor/show/{paeEmpdor}', 'App\Http\Controllers\Drrd\PaeEmpdorController@show');

    # empreendedor DELETE
    Route::get('pae/empdor/destroy/{id}', 'App\Http\Controllers\Drrd\PaeEmpdorController@destroy');

    # PAE EMPREENDIMENTO #####################

    # empreendimento INDEX
    Route::match(["GET", "POST"], 'pae/empnto', 'App\Http\Controllers\Drrd\PaeEmpntoController@index');

    # empreendimento CREATE
    Route::get('pae/empnto/create', 'App\Http\Controllers\Drrd\PaeEmpntoController@create');

    # empreendimento STORE
    Route::post('pae/empnto/store', 'App\Http\Controllers\Drrd\PaeEmpntoController@store');

    # empreendimento EDITAR
    Route::get('pae/empnto/edit/{paeEmpnto}', 'App\Http\Controllers\Drrd\PaeEmpntoController@edit');

    # empreendimento UPDATE
    Route::post('pae/empnto/update', 'App\Http\Controllers\Drrd\PaeEmpntoController@update');

    # empreendimento VIEW
    Route::get('pae/empnto/show/{paeEmpnto}', 'App\Http\Controllers\Drrd\PaeEmpntoController@show');

    # empreendimento DELETE
    Route::get('pae/empnto/destroy/{id}', 'App\Http\Controllers\Drrd\PaeEmpntoController@destroy');

    #autocomplete
    Route::get('municipio/autocomplete', 'App\Http\Controllers\Drrd\PaeEmpntoController@municipio_autocomplete')->name('municipio.autocomplete');

    Route::get('regiao/autocomplete', 'App\Http\Controllers\Drrd\PaeEmpntoController@regiao_autocomplete')->name('regiao.autocomplete');

    Route::get('emprendedor/autocomplete', 'App\Http\Controllers\Drrd\PaeEmpntoController@empdor_autocomplete')->name('empdor.autocomplete');

    Route::get('coordenador/autocomplete', 'App\Http\Controllers\Drrd\PaeEmpntoController@coord_autocomplete')->name('coordenador.autocomplete');

    Route::get('empreendimento/autocomplete', 'App\Http\Controllers\Drrd\PaeEmpntoController@empnto_autocomplete')->name('empreendimento.autocomplete');



    #  ANALISE  ###########################

    # Analise PAE INDEX
    Route::match(["GET", "POST"], 'pae/analise', 'App\Http\Controllers\Drrd\PaeAnaliseController@index');

    # Análise PAE CREATE
    Route::get('pae/analise/create/{id}', 'App\Http\Controllers\Drrd\PaeAnaliseController@create');

    # Análise PAE STORE
    Route::post('pae/analise/store', 'App\Http\Controllers\Drrd\PaeAnaliseController@store');

    # Análise PAE EDITAR
    Route::get('pae/analise/edit/{paeAnalise}', 'App\Http\Controllers\Drrd\PaeAnaliseController@edit');

    # Análise PAE DOWNLOAD FILE
    Route::get('pae/analise/download/{file}', 'App\Http\Controllers\Drrd\PaeAnaliseController@download');

    # Análise PAE DELETE
    Route::get('pae/analise/delete/{id}', 'App\Http\Controllers\Drrd\PaeAnaliseController@destroy');

    # Análise PAE UPDATE
    Route::post('pae/analise/update/{paeAnalise}', 'App\Http\Controllers\Drrd\PaeAnaliseController@update');

    #  NOTIFICACAO  ###########################

    # Notificação CREATE
    Route::get('pae/notificacao/create/{id}', 'App\Http\Controllers\Drrd\PaeNotificacaoController@create');

    # Notificacao STORE
    Route::post('pae/notificacao/store', 'App\Http\Controllers\Drrd\PaeNotificacaoController@store');

    # Notificação EDITAR
    Route::get('pae/notificacao/edit/{paeNotificacao}', 'App\Http\Controllers\Drrd\PaeNotificacaoController@edit');

    # Notificação UPDATE
    Route::post('pae/notificacao/update/{paeNotificacao}', 'App\Http\Controllers\Drrd\PaeNotificacaoController@update');

    ################################ ESCOLA ################################

    # INDEX
    Route::get('escola',                            'App\Http\Controllers\Escola\EscolaController@index');

    # ALUNO
    Route::get('escola/curso/aluno',                      'App\Http\Controllers\Escola\CursAlunoController@index');
    Route::get('escola/curso/aluno/create',               'App\Http\Controllers\Escola\CursAlunoController@create');
    Route::get('escola/curso/aluno/show/{escAluno}',      'App\Http\Controllers\Escola\CursAlunoController@show');
    Route::get('escola/curso/aluno/edit/{escAluno}',      'App\Http\Controllers\Escola\CursAlunoController@edit');
    Route::post('escola/curso/aluno/store',               'App\Http\Controllers\Escola\CursAlunoController@store');
    Route::post('escola/curso/aluno/update/{escAluno}',   'App\Http\Controllers\Escola\CursAlunoController@update');

    # TURMA
    // Route::get('escola/turma',                      'App\Http\Controllers\Escola\CursTurmaController@index');
    // Route::get('escola/turma/create',               'App\Http\Controllers\Escola\CursTurmaController@create');
    // Route::get('escola/turma/show/{escAluno}',      'App\Http\Controllers\Escola\CursTurmaController@show');
    // Route::get('escola/turma/edit/{escAluno}',      'App\Http\Controllers\Escola\CursTurmaController@edit');
    // Route::post('escola/turma/store',               'App\Http\Controllers\Escola\CursTurmaController@store');
    // Route::post('escola/turma/update/{escAluno}',   'App\Http\Controllers\Escola\CursTurmaController@update');

    # CURSO
    Route::get('escola/curso',                      'App\Http\Controllers\Escola\CursCursoController@index');
    Route::get('escola/curso/create',               'App\Http\Controllers\Escola\CursCursoController@create');
    Route::get('escola/curso/show/{escAluno}',      'App\Http\Controllers\Escola\CursCursoController@show');
    Route::get('escola/curso/edit/{escAluno}',      'App\Http\Controllers\Escola\CursCursoController@edit');
    Route::post('escola/curso/store',               'App\Http\Controllers\Escola\CursCursoController@store');
    Route::post('escola/curso/update/{escAluno}',   'App\Http\Controllers\Escola\CursCursoController@update');





    ################################### DRD ####################################

    # DRD - Boletim / Diario Plantão

    # DRD index
    Route::get('drd', 'App\Http\Controllers\Drd\DrdController@index');

    # boletim index
    Route::get('boletim', 'App\Http\Controllers\Drd\BoletimController@index');
    Route::post('boletim', 'App\Http\Controllers\Drd\BoletimController@index');
    /* Novo reg */
    Route::get('boletim/create', 'App\Http\Controllers\Drd\BoletimController@create');
    /* Salvar reg */
    Route::post('boletim/store', 'App\Http\Controllers\Drd\BoletimController@store');
    /* mudanca status */
    Route::post('status', 'App\Http\Controllers\Drd\BoletimController@status')->name('status');
    /* visualizar boletim */
    Route::get('boletim/visualizar/{arquivo}', 'App\Http\Controllers\Drd\BoletimController@visualizar');
    /* boletim deletar */
    Route::get('boletim/delete/{boletim}', 'App\Http\Controllers\Drd\BoletimController@destroy');


    ##################################### MODULO CEDEC #####################################

    Route::get('cedec', 'App\Http\Controllers\Cedec\CedecController@index');


    #EQUIPE ##############################

    # MENU
    Route::get('equipe', 'App\Http\Controllers\Equipe\EquipeController@index');

    ## DSP
    Route::match(["GET", "POST"], 'dsp', 'App\Http\Controllers\Equipe\DspController@index');




    ############################### MUDULO AJUDA ################################

        # menu Principal Ajuda Humanitaria
        Route::get('ajuda', 'App\Http\Controllers\Ajuda\AjudaController@menu');
        
        # modulo controle de estoque
        Route::get('estoque', 'App\Http\Controllers\Ajuda\AjudaController@estoque');

        # mudulo Pedido de ajuda Humanitária
        Route::get('mah', 'App\Http\Controllers\Ajuda\AjudaPedidoController@index');
        
        # modulo acesso CISTERNA
        Route::get('cisterna', 'App\Http\Controllers\Ajuda\CisternaController@index');



    # CONTROLE DE ESTOQUE ###################################################################

            # cadastro gerais
            Route::get('estoque/cadastro', 'App\Http\Controllers\Ajuda\AjudaEstoqueController@cadastro');

            ## fornecedor
            Route::get('estoque/fornecedor', 'App\Http\Controllers\Estoque\AjudaEstoqFornecedorController@index');
            Route::get('estoque/fornecedor/create', 'App\Http\Controllers\Estoque\AjudaEstoqFornecedorController@create');
            Route::post('estoque/fornecedor/store', 'App\Http\Controllers\Estoque\AjudaEstoqFornecedorController@store');
            Route::get('estoque/fornecedor/edit/{fornecedor}', 'App\Http\Controllers\Estoque\AjudaEstoqFornecedorController@edit');
            Route::get('estoque/fornecedor/show/{fornecedor}', 'App\Http\Controllers\Estoque\AjudaEstoqFornecedorController@show');

            Route::get('estoque/movimentacao', 'App\Http\Controllers\Ajuda\AjudaEstoqueController@movimentacao');
            Route::get('estoque/relatorio', 'App\Http\Controllers\Ajuda\AjudaEstoqueController@relatorio');


    # PEDIDO DE AJUDA HUMANITARIA ####################################

            

            Route::get('mah/config', 'App\Http\Controllers\Ajuda\AjudaPedidoConfigController@index');

            /* mah busca */
            Route::match(["GET", "POST"], 'mah/busca', 'App\Http\Controllers\Ajuda\MahController@busca');


    ################## PEDIDO
            # mah INDEX
            Route::match(["GET", "POST"], 'mah/busca', 'App\Http\Controllers\Ajuda\AjudaPedidoController@busca');

            /* mah INDEX COMPDEC **/
            Route::get('mah_compdec', 'App\Http\Controllers\Ajuda\AjudaPedidoController@index_compdec');


            # mah CREATE
            Route::get('mah/pedido/create', 'App\Http\Controllers\Ajuda\AjudaPedidoController@create');
            # mah EDIT
            Route::get('mah/pedido/edit/{pedido}', 'App\Http\Controllers\Ajuda\AjudaPedidoController@edit')->name('pedido/edit');
            # mah UPDATE
            Route::post('mah/pedido/update/{pedido}', 'App\Http\Controllers\Ajuda\AjudaPedidoController@update');
            # mah VIEW
            Route::get('mah/pedido/show/{pedido}', 'App\Http\Controllers\Ajuda\AjudaPedidoController@show')->name('pedido/show');
            # mah PRINT
            Route::get('mah/pedido/print/{pedido}', 'App\Http\Controllers\Ajuda\AjudaPedidoController@print');
            # mah STORE
            Route::post('mah/pedido/store', 'App\Http\Controllers\Ajuda\AjudaPedidoController@store');
            # mah DESTROY
            Route::get('mah/pedido/destroy/{pedido}', 'App\Http\Controllers\Ajuda\AjudaPedidoController@destroy')->name('pedido/delete');

            Route::post('mah/pedido/upload', 'App\Http\Controllers\Ajuda\AjudaPedidoController@upload');

            Route::get('mah/pedido/deletedoc/{id}/{nome_file}', 'App\Http\Controllers\Ajuda\AjudaPedidoController@deletedoc');

            Route::get('mah/download/{id}/{nome_file}', 'App\Http\Controllers\Ajuda\AjudaPedidoController@download');

            Route::get('mah/enviar/status/{pedido}/{status}', 'App\Http\Controllers\Ajuda\AjudaPedidoController@status');



    ################## ANEXO
            // # mah CREATE
            // Route::get('mah/anexo/create', 'App\Http\Controllers\Ajuda\AnexoController@create');
            // # mah EDIT
            // Route::get('mah/anexo/edit', 'App\Http\Controllers\Ajuda\AnexoController@edit');
            // # mah UPDATE
            // Route::post('mah/anexo/update', 'App\Http\Controllers\Ajuda\AnexoController@update');
            // # mah VIEW
            // Route::get('mah/panexo/show/{anexo}', 'App\Http\Controllers\Ajuda\AnexoController@show');
            // # mah STORE
            // Route::post('mah/anexo/store', 'App\Http\Controllers\Ajuda\AnexoController@store');
            // # mah DESTROY
            // Route::get('mah/anexo/destroy/{anexo}', 'App\Http\Controllers\Ajuda\AnexoController@destroy');

    ################## ANALISE TECNICA
            # mah INDEX
            Route::get('mah/analise/index', 'App\Http\Controllers\Ajuda\AjudaPedidoAnaliseTecnicaController@index');

            # mah CREATE
            Route::get('mah/analise/create', 'App\Http\Controllers\Ajuda\AjudaPedidoAnaliseTecnicaController@create');
            # mah EDIT
            Route::get('mah/analise/edit', 'App\Http\Controllers\Ajuda\AjudaPedidoAnaliseTecnicaController@edit');
            # mah UPDATE
            Route::post('mah/analise/update', 'App\Http\Controllers\Ajuda\AjudaPedidoAnaliseTecnicaController@update');
            # mah VIEW
            Route::get('mah/panalise/show/{paeProtocolo}', 'App\Http\Controllers\Ajuda\AjudaPedidoAnaliseTecnicaController@show');
            # mah STORE

            Route::post('mah/analise/store', 'App\Http\Controllers\Ajuda\AjudaPedidoAnaliseTecnicaController@store')->name('analise.store');
            # mah DESTROY

            Route::get('mah/analise/destroy/{analise}', 'App\Http\Controllers\Ajuda\AjudaPedidoAnaliseTecnicaController@destroy')->name('parecer.deletar');

    ################## BENEFICIARIO
            # mah CREATE
            Route::get('mah/beneficiario/create', 'App\Http\Controllers\Ajuda\AjudaPedidoBeneficiarioController@create');
            # mah EDIT
            Route::get('mah/beneficiario/edit', 'App\Http\Controllers\Ajuda\AjudaPedidoBeneficiarioController@edit');
            # mah UPDATE
            Route::post('mah/beneficiario/update', 'App\Http\Controllers\Ajuda\AjudaPedidoBeneficiarioController@update');
            # mah VIEW
            Route::get('mah/pbeneficiario/show/{paeProtocolo}', 'App\Http\Controllers\Ajuda\AjudaPedidoBeneficiarioController@show');
            # mah STORE
            Route::post('mah/beneficiario/store', 'App\Http\Controllers\Ajuda\AjudaPedidoBeneficiarioController@store');
            # mah DESTROY
            Route::get('mah/beneficiario/destroy', 'App\Http\Controllers\Ajuda\AjudaPedidoBeneficiarioController@destroy');

    ################## PEDIDO ITEM
            # mah CREATE
            Route::get('mah/pedidoitem/create', 'App\Http\Controllers\Ajuda\AjudaPedidoItensController@create');
            # mah EDIT
            Route::get('mah/pedidoitem/edit', 'App\Http\Controllers\Ajuda\AjudaPedidoItensController@edit');
            # mah UPDATE
            Route::post('mah/pedidoitem/update', 'App\Http\Controllers\Ajuda\AjudaPedidoItensController@update');
            # mah VIEW
            Route::get('mah/pedidoitem/show/{paeProtocolo}', 'App\Http\Controllers\Ajuda\AjudaPedidoItensController@show');
            # mah STORE
            Route::post('mah/pedidoitem/store', 'App\Http\Controllers\Ajuda\AjudaPedidoItensController@store')->name('mah.item.store');
            # mah DESTROY
            Route::get('mah/pedidoitem/destroy/{pedidoItens}', 'App\Http\Controllers\Ajuda\AjudaPedidoItensController@destroy');

    ################## PRESTAÇÃO DE CONTAS
            # mah CREATE
            Route::get('mah/prestconta/create', 'App\Http\Controllers\Ajuda\AjudaPrestContaController@create');
            # mah EDIT
            Route::get('mah/prestconta/edit', 'App\Http\Controllers\Ajuda\AjudaPrestContaController@edit');
            # mah UPDATE
            Route::post('mah/prestconta/update', 'App\Http\Controllers\Ajuda\AjudaPrestContaController@update');
            # mah VIEW
            Route::get('mah/pprestconta/show/{paeProtocolo}', 'App\Http\Controllers\Ajuda\AjudaPrestContaController@show');
            # mah STORE
            Route::post('mah/prestconta/store', 'App\Http\Controllers\Ajuda\AjudaPrestContaController@store');
            # mah DESTROY
            Route::get('mah/prestconta/destroy', 'App\Http\Controllers\Ajuda\AjudaPrestContaController@destroy');


    # AJUDA TDAP ################################

            # index    
            Route::get('ajuda/tdap', 'App\Http\Controllers\Tdap\TdapController@index');

            # PMDA ##################

            Route::get('pmda', 'App\Http\Controllers\Pmda\PmdaController@index');
            Route::post('pmda', 'App\Http\Controllers\Pmda\PmdaController@index');

            Route::get('pmda/create', 'App\Http\Controllers\Pmda\PmdaController@create');


            # editar 
            Route::get('pmda/edit/{pmda}', 'App\Http\Controllers\Pmda\PmdaController@edit')->name('pmda/edit');

            # iss gravar
            Route::post('pmda/edit/iss', 'App\Http\Controllers\Pmda\PmdaController@iss')->name('updateIss');
            Route::post('pmda/edit/municipio', 'App\Http\Controllers\Pmda\PmdaController@municipio')->name('updateMunicipio');

            #PONTO DE CAPTAÇÃO
            Route::post('pmda/edit/ponto', 'App\Http\Controllers\Pmda\PmdaPontoController@store')->name('novoPonto');
            Route::get('pmda/ponto/delete/{ponto}', 'App\Http\Controllers\Pmda\PmdaPmdaPontoController@destroy')->name('delPonto');
            Route::post('pmda/ponto/search', 'App\Http\Controllers\Pmda\PmdaPontoController@search')->name('searchPonto');



    ############################## DIARIO PLANTAO ###################################

    Route::match(['GET', 'POST'], 'diario', 'App\Http\Controllers\Drd\DiarioController@index');

    Route::get('diario/show/{diario}', 'App\Http\Controllers\Drd\DiarioController@show');


    ################################ VISTORIA / INTERDICAO ##################################

    # Vistoria MENU
    Route::get('vistoria/menu', 'App\Http\Controllers\Compdec\VistoriaController@menu');

    ################## VISTORIA

    # Vistoria Index
    Route::get('vistoria', 'App\Http\Controllers\Compdec\VistoriaController@index');

    # Vistoria CREATE
    Route::get('vistoria/create', 'App\Http\Controllers\Compdec\VistoriaController@create');

    # Vistoria EDIT
    Route::get('vistoria/edit/{vistoria}', 'App\Http\Controllers\Compdec\VistoriaController@edit');

    # Vistoria UPDATE
    Route::post('vistoria/update', 'App\Http\Controllers\Compdec\VistoriaController@update');

    # Vistoria VIEW
    Route::get('vistoria/show/{vistoria}/{all?}', 'App\Http\Controllers\Compdec\VistoriaController@show')->name('vistoria/show');

    # Vistoria STORE
    Route::post('vistoria/store', 'App\Http\Controllers\Compdec\VistoriaController@store');

    # Vistoria DESTROY
    Route::get('vistoria/destroy', 'App\Http\Controllers\Compdec\VistoriaController@destroy');

    Route::match(['GET', 'POST'], 'vistoria/search', 'App\Http\Controllers\Compdec\VistoriaController@search');

    Route::get('vistoria/exportVistoria', 'App\Http\Controllers\Compdec\VistoriaController@exportVistoria');

    Route::get('send-email-vistoria/{vistoria}/{tp}', 'App\Http\Controllers\PDFController@PDFVistoria');

    # delete imagem
    Route::post('vistoria/deleteImagem', 'App\Http\Controllers\Compdec\VistoriaController@deleteImagem');


    ################## INTERDICAO

    # Interdicao Index
    Route::get('interdicao', 'App\Http\Controllers\Compdec\InterdicaoController@index');

    # Interdicao CREATE
    Route::get('interdicao/create', 'App\Http\Controllers\Compdec\InterdicaoController@create');

    # Interdicao EDIT
    Route::get('interdicao/edit', 'App\Http\Controllers\Compdec\InterdicaoController@edit');

    # Interdicao UPDATE
    Route::post('interdicao/update', 'App\Http\Controllers\Compdec\InterdicaoController@update');

    # Interdicao VIEW
    Route::get('interdicao/show/{interdicao}', 'App\Http\Controllers\Compdec\InterdicaoController@show')->name('interdicao.show');

    # Interdicao STORE
    Route::post('interdicao/store', 'App\Http\Controllers\Compdec\InterdicaoController@store');

    # Interdicao DESTROY
    Route::get('interdicao/destroy', 'App\Http\Controllers\Compdec\InterdicaoController@destroy');


    ##################################### RAT ######################################

    # Rat Index
    Route::get('rat', 'App\Http\Controllers\Compdec\RatController@index');

    # Rat CREATE
    Route::get('rat/create', 'App\Http\Controllers\Compdec\RatController@create');

    # Rat EDIT
    Route::get('rat/edit/{rat}', 'App\Http\Controllers\Compdec\RatController@edit');

    # Rat UPDATE
    Route::post('rat/update/{rat}', 'App\Http\Controllers\Compdec\RatController@update');

    # Rat VIEW
    Route::get('rat/show/{rat}', 'App\Http\Controllers\Compdec\RatController@show');

    # Rat STORE
    Route::post('rat/store', 'App\Http\Controllers\Compdec\RatController@store');

    # Rat DESTROY
    Route::get('rat/destroy', 'App\Http\Controllers\Compdec\RatController@destroy');

    # Rat CONFIG
    Route::get('rat/config', 'App\Http\Controllers\Compdec\RatController@config');

    # Rat SEARCH
    Route::match(['GET', 'POST'], 'rat/search', 'App\Http\Controllers\Compdec\RatController@search');


    # Rat DELETE IMAGEM
    Route::post('rat/deleteImagem', 'App\Http\Controllers\Compdec\RatController@deleteImagem');

    Route::get('rat/exportRats', [RatController::class, 'exportRats']);

    Route::get('rat/print/{rat}', [RatController::class, 'RatPdfPrint']);


    ############## OCORRENCIA
    //Route::get('rat/destroy', 'App\Http\Controllers\Compdec\RatController@destroy');

    ############## ALVO
    //Route::get('rat/destroy', 'App\Http\Controllers\Compdec\RatController@destroy');


    ##################################### PREPARA MINAS ######################################

    # Rat Index
    Route::get('prepara', 'App\Http\Controllers\Compdec\PreparaController@index');

    # Prepara CREATE
    Route::get('prepara/create', 'App\Http\Controllers\Compdec\PreparaController@create');

    # Prepara EDIT
    Route::get('prepara/edit/{prepara}', 'App\Http\Controllers\Compdec\PreparaController@edit');

    # Prepara UPDATE
    Route::post('prepara/update/{prepara}', 'App\Http\Controllers\Compdec\PreparaController@update');

    # Prepara VIEW
    Route::get('prepara/show/{prepara}', 'App\Http\Controllers\Compdec\PreparaController@show');

    # Prepara STORE
    Route::post('prepara/store', 'App\Http\Controllers\Compdec\PreparaController@store');

    # Prepara DESTROY
    Route::get('prepara/destroy', 'App\Http\Controllers\Compdec\PreparaController@destroy');

    # Prepara SEARCH
    Route::match(['GET', 'POST'], 'prepara/search', 'App\Http\Controllers\Compdec\PreparaController@search');



    ################# DEMANDA #######################

    Route::get('demanda', 'App\Http\Controllers\Cedec\DemandaController@index');
});

Route::get('autentica/{token}', 'App\Http\Controllers\Cedec\ApiController@autentica');
require __DIR__ . '/auth.php';
