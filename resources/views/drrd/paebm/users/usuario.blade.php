@extends('layouts.pagina_master')
{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/pae/protocolo') }}">Protocolo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuarios Externos</li>
        </ol>
    </nav>
@endsection

@section('content')


    <div class="row">
        <p class="text-center"><a href='{{ url('drrd') }}' class='btn btn-primary'>Voltar</a></p>
        <p class="text-center">
            <legend>Usuários Ativos no Sistema</legend>
        </p>
    </div>

    <div class="row">
        <div class="col-12">
            <a href='{{ url('pae/users/create') }}' class='btn btn-success' title="Cadastrar novo acesso de  Empreendedor">* Novo Usuário Externo</a>
        </div>

    </div>


    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('pae/user') }}" method="POST" name="frmPesquisa" id="frmPesquisa"><br>
                <div class="col-6">
                    <div class="input-group mb-3">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="text" class="form-control" name="pesquisa" id="pesquisa" placeholder="Pesquisar pelo nome no Usuario" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <input type="submit" class="btn btn-primary" name="btn" value="Pesquisar">
                    </div>
                </div>
                <br>

            </form>
        </div>
    </div>

            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Empreendedor</th>
                    <th>CNPJ</th>
                    <th>Nome Usuário</th>
                    <th>CPF</th>
                    <th>Situação</th>
                    <th>Opções</th>
                </tr>

                <?php
                
                foreach ($usuarios as $key => $usuario) {
                    print '<tr>';
                    print '<td>' . ($key + 1) . '</td>';
                    print '<td>' . $usuario->empreendedor . '</td>';
                    print '<td></td>';
                    print '<td>' . $usuario->name . '</td>';
                    print '<td>' . $usuario->cpf . '</td>';
                    print '<td>' . ($usuario->ativo == 0 ? 'Desativado' : 'Ativado') . '</td>';
                
                    print '<td>';
                    if ($usuario->ativo == 0) {
                        print "<button name='btnAtivar' class='btn btn-link' onclick=\"return confirm('ativar ?')\" title='Ativar o Usuário' data-status='{{ $usuario->ativo }}'>
                                        <img src='" .
                            asset('imagem/icon/check.png') .
                            "' width='25'>
                                        </button>";
                    } else {
                        print "<button name='btnDesativar' class='btn btn-link' onclick=\"return confirm('desativar ?')\" title='Desativar o Acesso do Usuário' data-status='{{ $usuario->ativo }}'>
                                        <img src=" .
                            asset('imagem/icon/cancela.png') .
                            " width='25'>
                                        </button>";
                    }
                    print '</td>';
                    print '</tr>';
                }
                
                ?>

            </table>


@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('code')
    <script>
        $(document).ready(function() {

            //$(".default_col").addClass('collapsed');

            $(".collapse-btn").dblclick(function() {
                var targetId = $(this).attr("id");
                $(this).closest("tr").next("tr").toggle('slow');
            });


            $("a[name='btnAtivar']").click(function() {

                alert();


            });



        });
    </script>
@stop
