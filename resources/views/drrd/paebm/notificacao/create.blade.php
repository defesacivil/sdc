@extends('layouts.pagina_master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />-->


@stop

@section('content')

    <div class="row">
        <div class="col p-3">
            <p class='text-center'><a class='btn btn-success' href='{{ url('pae/protocolo/show/'.$analise[0]->protocolos->id) }}'>Voltar</a></p><br>
            <legend>Notificação PAEBM - Protocolo : {{$analise[0]->protocolos->num_protocolo }}</legend>
            <p>Empreendedor: <b>{{ $analise[0]->protocolos->empreendimento->empreendedor->nome }}</b></p>
            <p>Empreendimento: <b>{{ $analise[0]->protocolos->empreendimento->nome }}</b></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

        </div>
    </div>
    <div class='col-md-12'>

        {{ Form::open(['url' => 'pae/notificacao/store', 'method' => 'POST']) }}
        {{ Form::token() }}

        <div class='row p-2'>
            <div class='col'>
                {{ Form::label('Número SEI', '') }}:
                {{ Form::text('num_sei', '', ['class' => 'form form-control', 'value' => old('num_sei')]) }}
                {{ Form::hidden('user_id', Auth::user()->id) }}
                {{ Form::hidden( 'pae_analise_id', $analise[0]->id) }}
                {{ Form::hidden( 'pae_protocolo_id', $analise[0]->protocolos->id) }}
            </div>
            <div class='col'>
                {{ Form::label('Data Notificação', '') }}:
                {{ Form::date('dt_notificacao', date('Y-m-d'), ['class' => 'form form-control', 'value' => old('dt_notificacao')]) }}
            </div>
        </div>
        <div class='row p-2'>
            <div class='col'>
                {{ Form::label('prorrogacao', '') }}:
                {{ Form::select(
                    'prorrogacao',
                    [
                        '' => 'Prorrogação',
                        '1' => 'Sim',
                        '0' => 'Não',
                    ],
                    '',
                    ['class' => 'form form-control'],
                ) }}
            </div>
            <div class='col'>
                {{ Form::label('Data Devolutiva', '') }}:
                {{ Form::date('dt_devolutiva', '', ['class' => 'form form-control', 'value' => old('dt_devolutiva')]) }}
            </div>
        </div>
        <div class='row p-2'>
            <div class='col'>
                {{ Form::label('obs', '') }}:
                {{ Form::textarea('obs', '', ['class' => 'form form-control', 'value' => old('obs'), 'rows' => '3']) }}
            </div>
        </div>

        <div class='row p-2'>
            <div class='col'>
                {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
            </div>{{ Form::close() }}

        </div>
    </div>
@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "showDuration": "800",
        }
        @if (session('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "showDuration": "600",
            }
            toastr.success("{{ session('message') }}"); <
            div class = "alert alert-success" >
                {{ session('message') }} <
                /div>
        @endif
        @if ($errors->any())

            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>

    <script>
        /* autocomplete empreendimento  */
        var path3 = "{{ route('empreendimento.autocomplete') }}";
        $("#empnto_search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: path3,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('#empnto_search').val(ui.item.label);
                $('#pae_empnto_id').val(ui.item.id);
                return false;
            }
        });
    </script>

@stop
