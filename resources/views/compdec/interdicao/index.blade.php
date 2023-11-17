@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('vistoria/menu') }}">Vistoria - Interdicao</a></li>
            <li class="breadcrumb-item active" aria-current="page">Interdições</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container min-vh-100">
    <div class="row flex-fill">

        <div class="col-md-12">
            <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('vistoria/menu') }}>Voltar</a>
                <a class='btn btn-info btn-sm' href={{ url('interdicao/create') }} title="Criar novo Registro">+ Novo</a>
            </p>

            <legend class="p-4">Laudo de Interdições</legend>

                

            <div class="table table-responsive table-sm border">
                <table class="table table-striped
                table-hover	
                table-borderless
                table-primary
                align-middle">
                    <thead class="table-light">
                        <caption></caption>
                        <tr>
                            <th class="p-2">Número</th>
                            <th class="p-2">Município</th>
                            <th class="p-2">Endereço</th>
                            <th class="p-2">Data Registro</th>
                            <th class="p-2">Vistoriador</th>
                            <th class="p-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($interdicoes as $key => $interdicao)
                            <tr class="table-primary">
                                <td scope="row">{{ $interdicao->numero }}</td>
                                <td>{{ $interdicao->municipio->nome }}</td>
                                <td>{{ $interdicao->endereco }}</td>
                                <td>{{ $interdicao->dt_registro }}</td>
                                <td>{{ $interdicao->vistoriador }}</td>
                                <td>
                                    @can('compdec')
                                        <a href="{{ url('interdicao/edit/' . $interdicao->id) }}"><img width="25" src={{ asset('/imagem/icon/editar.png') }}></a>
                                    @endcan
                                    <a href="{{ url('interdicao/show/' . $interdicao->id) }}"><img width="25" src={{ asset('/imagem/icon/view.png') }}></a>
                                </td>
                            </tr>
                        @endForeach

                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
            {{ $interdicoes->links() }}


        </div>
    </div>

@stop

@section('css')

@stop

@section('code')

    <script type="text/javascript">
        $(document).ready(function() {



        })
    </script>

@endsection
