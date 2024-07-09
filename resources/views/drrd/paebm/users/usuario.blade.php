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

    <div class="row p-2">

        <div class="col-12">

            <p class="text-center"><a href='{{ url('drrd') }}' class='btn btn-primary'>Voltar</a></p>
            <p class="text-center">
                <legend>Usuários Ativos no Sistema</legend>
            </p>
        </div>
    </div>

    <div class="row p-2">
        <div class="col-12">
            <a href='{{ url('pae/users/create') }}' class='btn btn-success' title="Cadastrar novo acesso de  Empreendedor">* Novo Usuário Externo</a>
        </div>
    </div>


    <div class="row p-2">
        <div class="col-12">
            <form action="{{ url('pae/user') }}" method="POST" name="frmPesquisa" id="frmPesquisa"><br>
                <div class="col-12 col-md-6">
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

    <div class="table-responsive-sm p-2">

        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Empreendedor</th>
                <th>CNPJ</th>
                <th>Nome Usuário</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>Situação</th>
                <th>Opções</th>
            </tr>
            </thead>

            <?php
            
            foreach ($usuarios as $key => $usuario) {
                print '<tr>';
                print '<td>' . ($key + 1) . '</td>';
                print '<td>' . $usuario->empreendedor . '</td>';
                print '<td></td>';
                print '<td>' . $usuario->name . '</td>';
                print '<td>' . $usuario->cpf . '</td>';
                print '<td>' . $usuario->email . '</td>';
                print '<td>' . ($usuario->ativo == 0 ? 'Desativado' : 'Ativado') . '</td>';
            
                print '<td>';
                if ($usuario->ativo == 0) {
                    # Ativar
                    print "<button name='btnStatus' class='btn btn-link' title='Ativar o Usuário' data-user_id='" .
                        $usuario->id .
                        "' data-status='1'>
                                                                                                                                                                                                                                                <img src='" .
                        asset('imagem/icon/check.png') .
                        "' width='25'>
                                                                                                                                                                                                                                                </button>";
                } else {
                    print "<button name='btnStatus' class='btn btn-link' title='Desativar o Acesso do Usuário' data-user_id='" .
                        $usuario->id .
                        "' data-status='0'>
                                                                                                                                                                                                                                                <img src=" .
                        asset('imagem/icon/cancela.png') .
                        " width='25'>
                                                                                                                                                                                                                                                </button> |";
            
                    print "<button name='btnResetSenha' class='btn btn-link' title='Resetar Senha do Usuário Externo' data-user_id='" .
                        $usuario->id .
                        "'>
                                                                                                                                                                                                                                                <img src=" .
                        asset('imagem/icon/password.png') .
                        " width='25'>
                                                                                                                                                                                                                                                </button>";
                }
                print '</td>';
                print '</tr>';
            }
            
            ?>

        </table>
    </div>

    </div>


@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('code')
    <script>
        $(document).ready(function() {


            $("button[name='btnStatus']").click(function(e) {

                var user_id = $(this).data('user_id');
                var status = $(this).data('status');

                var formdata = new FormData();
                formdata.append('user_id', user_id);
                formdata.append('status', status);
                formdata.append('_token', "{{ csrf_token() }}");

                //console.log(id)
                const isConfirmed = confirm('Deseja Alterar o Status do Usuários ?');

                if (isConfirmed) {
                    $.ajax({

                        url: '{{ url('pae/user/status') }}',
                        type: 'POST',
                        data: formdata,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data == true) {
                                window.location.reload();
                            }
                        },
                        error: function(data) {}
                    });
                }
                e.preventDefault();

            });

            $("button[name='btnResetSenha']").click(function(e) {

                var user_id = $(this).data('user_id');

                var formdata = new FormData();
                formdata.append('user_id', user_id);
                formdata.append('_token', "{{ csrf_token() }}");

                //console.log(id)
                const isConfirmed = confirm('Deseja Resetar a senha desse Usuário ?');

                if (isConfirmed) {
                    $.ajax({

                        url: '{{ url('pae/user/reset') }}',
                        type: 'POST',
                        data: formdata,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data == true) {
                                if (!alert('Senha Resetada com Sucesso \n a senha provisória é cedec@pae')) {
                                    window.location.reload();
                                }
                            }
                        },
                        error: function(data) {

                        }
                    });
                }
                e.preventDefault();

            });



        });
    </script>
@stop
