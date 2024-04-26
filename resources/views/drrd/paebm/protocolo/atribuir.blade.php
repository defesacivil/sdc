@extends('layouts.pagina_master')
{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/drrd') }}">Drrd</a></li>
            <li class="breadcrumb-item active" aria-current="page">Atribuição de Processo</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="col-12">
        <div class="row">
            <div class="p-3 col">
                <p class='text-center'><a class='btn btn-success' href='{{ url('pae/protocolo') }}'>Voltar</a></p><br>
                <legend>Atribuição de Processo</legend>
            </div>
        </div>

        {{ Form::open(['url' => 'pae/protocolo/atribuir', 'method' => 'POST']) }}
        {{ Form::token() }}
        <div class="p-2 row">
            <div class="col-6">
                {{ Form::hidden('id', $protocolo_id) }}
                {{ Form::label('Analista') }} :
                {{ Form::select('analista', $lista_analista, "", ['placeholder' => 'Selecione a Opção', 'class' => 'form form-control', 'id' => 'analista']) }}
                
            </div>
        </div>
        <div class="p-2 row">
            <div class="col-6">
                {{ Form::submit('Atribuir processo', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>

    </div>

@stop

@section('css')
@stop

@section('code')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


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
            div class = "alert alert-success">
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
        var path3 = "{{ route('user.autocomplete') }}";

        $("#analista").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: path3,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term,

                    },
                    success: function(data) {
                        if (!data.length) {
                            var result = [{
                                label: "Usuario não Encontrado !",
                                value: "{{ url('#') }}"
                            }];
                            response(result);
                        } else {
                            response($.map(data, function(item) {
                                return {
                                    label: item.value,
                                    nome: item.value,
                                    value: item.id,
                                }

                            }));
                        }
                    }
                });
            },
            select: function(event, ui) {
                $('#analista').val(ui.item.label);
                return false;
            }
        });
    </script>
@stop
