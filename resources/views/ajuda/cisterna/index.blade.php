@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Projeto Cisterna</li>
        </ol>
    </nav>

@endsection

<?php /*
backend
pmda
lista para analise - editar /validar comunidade / visualizar
busca - editar /validar comunidade / visualizar
conformidade


frontend
novo pmda
index processos - editar / visualizar / mensagem / enviar */
?>

@section('content')
    <div class="container border p-3 min-vh-100" style="background-color:#e9ecef;">
        <div class="row flex-fill">

            <div class="col-md-12">
                <p class="p-4 text-center"><a class='btn btn-success btn-sm' href={{ url('ajuda') }}>Voltar</a>&nbsp;
                <a class='btn btn-warning btn-sm' href={{ url('exportar') }} title="Exportar dados para Excel">Exportar Excel</a></p>

                
                @hasrole('cedec')
                <div class="row text-center">

                    <div class="col text-center p-2">
                    </div>
                    <!-- Card -->
                    <div class="col text-center p-2">
                        <div class="col card text-white bg-primary mb-3" style="width: 18rem;">
                            <div class="card-header">Quantidade Beneficiários Registrados</div>
                            <div class="card-body text-center">
                                <i class="card-title display-2 bold">{{($dados) ? count($dados) : 0}}</i>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center p-2">
                    </div>
                    <br>

                    {{-- quantidade registros --}}
                    
                </div>    

                <div class="row text-center">

                    <div class="table-responsive">
                        <table
                            class="table table-striped table-hover table-borderless table-primary align-middle">
                            <thead class="table-light">
                                
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Município</th>
                                    <th>Comunidade</th>
                                    <th>Data/Hora</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                                @foreach ($dados as $key=>$dado)
                                    <tr class="table-primary">
                                        <td scope="row">{{ ($key+1) }}</td>
                                        <td>{{ $dado->nome }}</td>
                                        <td>{{ $dado->cpf }}</td>
                                        <td>{{ $dado->municipio }}</td>
                                        <td>{{ $dado->comunidade }}</td>
                                        <td>{{ $dado->created_at }}</td>
                                        <td>
                                            <a href={{ url('cisterna/show/'.$dado->id)}}><img src='{{ asset('/imagem/icon/view.png') }}'></a>
                                        </td>
                                        
                                    </tr>
                                    
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                        </table>
                    </div>
                    

                </div>


                @endrole
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
