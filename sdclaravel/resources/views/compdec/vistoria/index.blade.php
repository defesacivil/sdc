@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('vistoria/menu') }}">Vistoria - Interdição</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vistoria</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row flex-fill">

            <div class="col-md-12">
                <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('vistoria/menu') }}>Voltar</a>
                    <a class='btn btn-info btn-sm' href={{ url('vistoria/create') }} title="Criar novo Registro">+ Novo</a>
                </p>

                <legend class="p-4">Laudo de Vistoria</legend>



                <div class="table table-responsive table-sm">
                    <table class="table table-striped
                table-hover	
                table-borderless
                table-primary
                align-middle">
                        <thead class="table-light">
                            <caption></caption>
                            <tr>
                                <th>Número</th>
                                <th>Município</th>
                                <th>Tipo Ocorrência</th>
                                <th>Endereço</th>
                                <th>Data Registro</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($vistorias as $key => $vistoria)
                                <tr class="table-primary">
                                    <td scope="row">{{ $vistoria->numero }}</td>
                                    <td>{{ $vistoria->municipio }}</td>
                                    <td>{{ $vistoria->tp_ocorrencia }}</td>
                                    <td>{{ $vistoria->endereco }}</td>
                                    <td>{{ \Carbon\Carbon::parse($vistoria->dt_vistoria)->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        @can('compdec')
                                            <a href="{{ url('vistoria/edit/' . $vistoria->id) }}"><img width="25" src={{ asset('/imagem/icon/editar.png') }}></a>
                                            @if ($vistoria->ck_clas_risc_muito_alta == 1)
                                                <a href="{{ url('interdicao/show/'.$vistoria->id) }}"><img width="25" src={{ asset('/imagem/icon/relatorio.png') }} title='Termo de Interdição'></a>
                                            @endif
                                        @endcan
                                        <a href="{{ url('vistoria/show/' . $vistoria->id) }}"><img width="25" src={{ asset('/imagem/icon/view.png') }}></a>
                                    </td>
                                </tr>
                            @endForeach

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
                {{ $vistorias->links() }}


            </div>
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
