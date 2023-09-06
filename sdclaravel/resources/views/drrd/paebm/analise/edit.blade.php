@extends('layouts/master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />-->


@stop

@section('content')

    <div class="row">
        <div class="col p-3">
            <p class='text-center'><a class='btn btn-success' href='{{ url('pae/protocolo/show/'.$analise[0]->protocolos->id) }}'>Voltar</a></p><br>
            <legend>Edição Analise PAEBM - {{$analise[0]->protocolos->num_protocolo}}</legend>
            <p>Empreendedor: {{$analise[0]->protocolos->empreendimento->empreendedor->nome}}</p>
            <p>Empreendimento: {{$analise[0]->protocolos->empreendimento->nome}}</p>
        </div>
    </div>
        <div class="row">
            <div class="col-12">
                
            </div>
        </div>
        <div class='col-md-12'>

            {{ Form::open(['url' => 'pae/analise/update/'.$analise[0]->id, 'method' => 'POST']) }}
            {{ Form::token() }}
    
            <div class='row p-2'>
                <div class='col'>
                    {{ Form::label('Parecer', '') }}:
                    {{ Form::textarea('parecer', $analise[0]->parecer, ['class' => 'ckeditor form form-control', 'value' => old('parecer'), 'id'=>'wysiwyg-editor']) }}
                    {{ Form::hidden('user_id', Auth::user()->id) }}
                    {{ Form::hidden( 'pae_protocolo_id', $analise[0]->protocolos->id) }}
                </div>
            </div>
            <div class='row p-2'>
                <div class='col'>
                    {{ Form::label('obs', '') }}:
                    {{ Form::textarea('obs', $analise[0]->obs, ['class' => 'form form-control', 'value' => old('obs'), 'rows' => '3']) }}
                </div>
            </div>
    
            <div class='row p-2'>
                <div class='col'>
                    {{ Form::label('tipo', '') }}:
                    {{ Form::select(
                        'tipo',
                        [
                            '' => 'Selecione o Tipo da Análise',
                            '1' => 'Analise 1',
                            '2' => 'Analise 2',
                            '3' => 'Analise 3',
                            '4' => 'Analise 4',
                        ],
                        $analise[0]->tipo,
                        ['class' => 'form form-control'],
                    ) }}
                </div>
            </div>
            <div class='row p-2'>
                <div class='col'>
                    {{ Form::label('situacao', '') }}:
                    {{ Form::select(
                        'situacao',
                        [
                            '' => 'Selecione a Situação',
                            '1' => 'Aprovado',
                            '0' => 'Reprovado',
                        ],
                        $analise[0]->situacao,
                        ['class' => 'form form-control'],
                    ) }}
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
    