@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rat</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div style="background-color:#e9ecef;" class="container min-vh-100">
        <div class="row">
            <div class="p-3 border col-md-12">
                <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('/dashboard') }}>Voltar</a>
                    <a class='btn btn-info btn-sm' href={{ url('rat/create') }} title="Criar novo Registro">+ Novo</a>
                    <a class='btn btn-primary btn-sm' id='btnSearch' title="Criar novo Registro">Pesquisa</a>
                    <span>&nbsp;&nbsp;&nbsp;</span>
                    <a class='btn btn-warning btn-sm' href={{ url('rat/exportRats') }} title="Criar novo Registro">Exportar Excel</a>
                    <a class='btn btn-primary btn-sm' href={{ url('rat/config') }} title="Criar novo Registro">Configurações</a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <legend class="p-4">Rat - Relatório de Atividades de Defesa Civil</legend>
            </div>
            <div class="col-3 p-2">
                <img class="border" width="80" src="{{ url('/imagem/brasao/brasao1_854.png') }}" alt="">
            </div>
        </div>


        {{ Form::open(['url' => 'rat/search']) }}

        <div class="row" id="search2">
            <div class="p-1 col-md-6">
                <div class='col-md-6'>
                    {{ Form::token() }}
                    {{ Form::label('ano', 'Ano') }} :
                    {{ Form::number('ano', '', ['class' => 'form form-control', 'maxlenght=4', 'id' => 'ano', 'name' => 'ano']) }}
                </div>
            </div>
            {{ Form::submit('Busca', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </div>
@stop

@section('css')

@stop

@section('code')

    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {


            $('.js-example-basic-single').select2();

            /* busca*/
            $("#search2").hide();

            $("#btnSearch").click(function() {
                $("#search2").toggle('slow');
                $('#btnSearch').css('display', 'none');

            });

            $('#btnPesquisa').click(function() {

                $.ajax({
                    type: 'POST',
                    url: '{{ url('') }}',
                    data: '_token = <?php echo csrf_token(); ?>',
                    success: function(data) {
                        $("#msg").html(data.msg);
                    }
                });

            });



        })
    </script>


@endsection
