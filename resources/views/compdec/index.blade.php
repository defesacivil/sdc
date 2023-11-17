@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Compdec</li>
        </ol>
    </nav>

@endsection

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if ($errors->any())
        <ul class='errors'>
            @foreach ($errors->all() as $error)
                <li class='error'>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="container border p-3 min-vh-100" style="background-color:#e9ecef;">

        <div class="col-md-12">

            @can('cedec')
                <p class='text-center'><a class='btn btn-success btn-sm' href='dashboard'>Voltar</a></p><br>
                {{ Form::open(['url' => 'compdec']) }}
                {{ Form::token() }}

                {{ Form::label('txtBusca', 'Buscar Município Compdec') }} :
                {{ Form::text('txtBusca', '', ['class' => 'form form-control form-control-sm']) }}
                <br>

                {{ Form::submit('Pesquisar', ['class' => 'btn btn-primary btn-sm']) }}

                {{ Form::close() }}

                <br>

                @if (isset($compdecs))
                    <table class='table table-bordered table-sm table-striped'>
                        <tr>
                            <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Cod<br><br></th>
                            <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Municipio</th>
                            <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Situação</th>
                            <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Ultima Atualização</th>
                            <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Opções</th>
                        </tr>
                        @foreach ($compdecs as $compdec)
                            <tr>
                                <td>{{ $compdec->id }}</td>
                                <td>{{ $compdec->id_municipio . ' - ' . $compdec->nome }}</td>
                                <td>{{ $compdec->com_ativa == 0 ? 'Inativa' : 'Ativo' }}</td>

                                <td>{{ \Carbon\Carbon::parse($compdec->ultimo_atualiza)->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    <a href='{{ url('compdec/edit', ['id' => $compdec->id]) }}' title="Clique aqui para editar o Registro !"><img
                                            src='{{ asset('/imagem/icon/editar.png') }}' alt=""></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            @endcan

        </div>

    </div>

@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')

    <script type="text/javascript">
        $(document).ready(function() {

        })
    </script>

@stop
