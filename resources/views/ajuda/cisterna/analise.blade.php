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
                    <a class='btn btn-warning btn-sm' href={{ route('exportar') }} title="Exportar dados para Excel">Exportar Excel</a>
                </p>


                @hasrole('cedec')

                    <div class="row text-center">

                        <div class="row">
                            <div class="col">
                                <form action="{{ url('') }}" method="post" name="frm_''" id="frm_''">
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="p-2 text-center col-12">
                                <input type="submit" name="btnSalvar" id="btnSalvar" class="btn btn-primary">
                            </div>
                        </div>
                        </form>

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
