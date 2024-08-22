@extends('layouts.pagina_master')

{{-- breadcrumb --}}
@section('breadcrumb')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            {{-- <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/busca') }}">Pesquisa Pedido Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edição Pedido Ajuda Humanitária</li> --}}
        </ol>
    </nav>
@endsection

<!-- conteudo -->
@section('content')

    <div class="row">
        <div class="col-12 col-md-12 shadow" style="background: #CAC7C6">

            <div class="row p-2">
                <div class="col text-center">
                    <a href='{{ url('dashboard') }}' class="btn btn-success">Voltar</a>
                </div>
            </div>

            <div class="row p-2">
                <div class='col-md-12'>
                    <legend>Informações do Usuário</legend>

                    <!-- mensagem de usuario desativado -->
                    @if (Session::has('message'))
                        <div class="mt-8 sm:rounded-lg">
                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif


                    {{ Form::open(['url' => 'usuario/update']) }}
                    {{ Form::token() }}

                    <div class='col'>
                        {{ Form::hidden('id', $user->funcionario->id) }}
                        {{ Form::label('id_deposito', 'Identificador do Deposito') }}:
                        {{ Form::select('id_deposito', $deposito, '', ['class' => 'form form-control']) }}
                        <br>
                    </div>
                    <div class='col'>
                        {{ Form::label('nome', 'Nome do Usuario') }}:
                        {{ Form::text('nome', $user->name, ['class' => 'form form-control', 'value' => old('nome')]) }}
                        <br>
                    </div>

                    {{-- <div class='col'>
                        {{ Form::label('nivel', 'Nivel de Acesso do Usuário') }}:
                        {{ Form::select('nivel', ['0' => '0', '1' => '1', '2' => '2', '3' => '3'], $cedecusuario->nivel, ['class' => 'form form-control']) }}
                    <br>
                    </div> --}}
                    <div class='col'>
                        {{ Form::label('cpf', 'CPF do Usuário') }}:
                        {{ Form::text('cpf', old('cpf', $user->cpf), ['class' => 'form form-control',]) }}

                        <br>
                    </div>
                    <div class='col'>
                        {{ Form::label('login', 'Login do Usuário') }}:
                        {{ Form::text('login', $user->email, ['class' => 'form form-control']) }}
                        <br>
                    </div>

                    <div class='col'>
                        {{ Form::label('telefone', '') }}:
                        {{ Form::text('telefone', $user->telefone, ['class' => 'form form-control']) }}
                        <br>
                    </div>

                    <div class='col'>
                        {{ Form::label('celular', 'Whatsapp') }}:
                        {{ Form::text('telefone', $user->celular, ['class' => 'form form-control']) }}
                        <br>
                    </div>
                    <div class='col'>
                        {{ Form::label('posto', 'Posto/Graduação') }}:
                        {{ Form::select('posto', post(), '', ['class' => 'form form-control']) }}
                        <br>
                    </div>
                    <div class='col'>
                        {{ Form::label('funcao', 'Função') }}:
                        {{ Form::text('telefone', $user->celular, ['class' => 'form form-control']) }}
                        <br>
                    </div>


                    {{-- <div class='col'>
                    {{ Form::label('id_funcionario', 'Identificador do Funcionario') }}:
                    {{ Form::select('id_funcionario', $funcionario, $cedecusuario->id_funcionario, ['class' => 'form form-control']) }}
                    <br>
                </div> --}}



                    {{-- <div class='col'>
                {{ Form::label('situacao', 'Situação do Usuário Ativo ou Inativo') }}:
                <div class='form-check'>
                    {{ Form::checkbox('situacao', $cedecusuario->situacao, $cedecusuario->situacao == 0 ? false : true) }}

                    <label class='form-check-label' for='situacao'>
                        Situação do Usuário Ativo ou Inativo
                    </label>
                </div>
                <br>
                </div> --}}
                    {{-- <div class='col'>
                        {{ Form::label('it_m_deposito', 'Acesso ao Módulo Ajuda Humanitária') }}:
                        <div class='form-check'>
                            {{ Form::checkbox('it_m_deposito', $cedecusuario->it_m_deposito, $cedecusuario->it_m_deposito == 0 ? false : true) }}
                            <label class='form-check-label' for='it_m_deposito'>
                                Acesso ao Módulo Ajuda Humanitária
                            </label>
                        </div>
                        <br>
                    </div>
                    <div class='col'>
                        {{ Form::label('it_m_pipa', 'Acesso ao Módulo Caminhão Pipa') }}:
                        <div class='form-check'>
                            {{ Form::checkbox('it_m_pipa', $cedecusuario->it_m_pipa, $cedecusuario->it_m_pipa == 0 ? false : true) }}
                            <label class='form-check-label' for='it_m_pipa'>
                                Acesso ao Módulo Caminhão Pipa
                            </label>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="row">
                    <div class='col'>
                        {{ Form::label('it_m_cce', 'Acesso ao Módulo Centrole de Emergência') }}:
                        <div class='form-check'>
                            {{ Form::checkbox('it_m_cce', $cedecusuario->it_m_cce, $cedecusuario->it_m_cce == 0 ? false : true) }}
                            <label class='form-check-label' for='it_m_cce'>
                                Acesso ao Módulo Centrole de Emergência
                            </label>
                        </div>
                        <br>
                    </div>

                    <div class='col'>
                        {{ Form::label('it_m_decretacao', 'Acesso ao Módulo DTec') }}:
                        <div class='form-check'>
                            {{ Form::checkbox('it_m_decretacao', $cedecusuario->it_m_decretacao, $cedecusuario->it_m_decretacao == 0 ? false : true) }}
                            <label class='form-check-label' for='it_m_decretacao'>
                                Acesso ao Módulo DTec
                            </label>
                        </div>
                        <br>
                    </div>
                    <div class='col'>
                        {{ Form::label('it_m_comdec', 'Acesso ao Módulo Compdec') }}:
                        <div class='form-check'>
                            {{ Form::checkbox('it_m_comdec', $cedecusuario->it_m_comdec, $cedecusuario->it_m_comdec == 0 ? false : true) }}
                            <label class='form-check-label' for='it_m_comdec'>
                                Acesso ao Módulo Compdec
                            </label>
                        </div>
                        <br>
                    </div>
                </div>

                <div class='row'>
                    <div class='col'>
                        {{ Form::label('it_m_apoio', 'Acesso ao Módulo Equipe de Apoio') }}:
                        <div class='form-check'>
                            {{ Form::checkbox('it_m_apoio', $cedecusuario->it_m_apoio, $cedecusuario->it_m_apoio == 0 ? false : true) }}
                            <label class='form-check-label' for='it_m_apoio'>
                                Acesso ao Módulo Equipe de Apoio
                            </label>
                        </div>
                        <br>
                    </div>
                    <div class='col'>
                        {{ Form::label('it_m_poco', 'Acesso ao Módulo Poço Artesiano') }}:
                        <div class='form-check'>
                            {{ Form::checkbox('it_m_poco', $cedecusuario->it_m_poco, $cedecusuario->it_m_poco == 0 ? false : true) }}
                            <label class='form-check-label' for='it_m_poco'>
                                Acesso ao Módulo Poço Artesiano
                            </label>
                        </div>
                        <br>
                    </div>
                    <div class='col'>
                        {{ Form::label('it_m_escola', 'Acesso ao Módulo Escola') }}:
                        <div class='form-check'>
                            {{ Form::checkbox('it_m_escola', $cedecusuario->it_m_escola, $cedecusuario->it_m_escola == 0 ? false : true) }}
                            <label class='form-check-label' for='it_m_escola'>
                                Acesso ao Módulo Escola
                            </label>
                        </div>
                        <br>
                    </div>
                </div>

                <div class='row'>

                    <div class='col'>
                        {{ Form::label('cedec_admin', 'Usuário Administrador') }}:
                        <div class='form-check'>
                            {{ Form::checkbox('cedec_admin', $cedecusuario->cedec_admin, $cedecusuario->cedec_admin == 0 ? false : true) }}
                            <label class='form-check-label' for='cedec_admin'>
                                Usuário Administrador
                            </label>
                        </div>
                        <br>
                    </div>
                    <div class='col'>

                        <br>
                    </div>

                </div> --}}


                    <div class='col'>
                        {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                    </div>{{ Form::close() }}


            </div>
        </div>

    </div>


    @stop

    @section('css')
        <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
    @stop



    @section('code')
        <script type='text/javascript'>
            $(document).ready(function() {
                $('#cpf').inputmask("999.999.999-99");
            });
        </script>


    @endsection
