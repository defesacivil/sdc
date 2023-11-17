@extends('layouts.pagina_master')
{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/pae/protocolo') }}">Protocolo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Novo Protocolo</li>
        </ol>
    </nav>
@endsection

@section('content')


    <div class="row flex-fill">
        <div class="col-md-12">

            <div class="row">
                <div class="col p-3">
                    <p class='text-center'><a class='btn btn-success' href='{{ url('pae/protocolo') }}'>Voltar</a></p><br>
                    <legend>Cadastro Empreendedor</legend>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                </div>
            </div>
            <div class='col-md-12'>

                {{ Form::open(['url' => 'pae/protocolo/store', 'method' => 'POST']) }}
                {{ Form::token() }}

                <div class='row p-2'>
                    <div class='col'>
                        {{ Form::label('Data Entrada', '') }}:
                        {{ Form::input('dateTime-local', 'dt_entrada', '', ['class' => 'form form-control', 'value' => old('dt_entrada'), 'id' => 'dt_entrada']) }}
                        {{ Form::hidden('user_id', Auth::user()->id) }}
                    </div>
                    <div class='col'>
                        {{ Form::label('limite_analise', '') }}:
                        {{ Form::text('limite_analise', '', ['class' => 'form form-control', 'value' => old('limite_analise'), 'id' => 'limite_analise', 'readonly' => 'readonly']) }}
                    </div>
                </div>

                <div class='row p-2'>
                    <div class='col'>
                        {{ Form::label('ccpae', '') }}:
                        {{ Form::text('ccpae', '', ['class' => 'form form-control', 'value' => old('ccpae')]) }}
                    </div>
                    <div class='col'>
                        {{ Form::label('ccpae_vencimento', '') }}:
                        {{ Form::date('ccpae_venc', '', ['class' => 'form form-control', 'value' => old('ccpae_venc')]) }}
                    </div>
                </div>
                <div class='row p-2'>
                    <div class='col'>
                        {{ Form::label('empreendimento', '') }}:
                        {{ Form::text('empnto_search', '', ['class' => 'form form-control', 'value' => old('empnto_search'), 'id' => 'empnto_search']) }}
                        {{ Form::hidden('pae_empnto_id', '', ['id' => 'pae_empnto_id']) }}
                    </div>
                </div>
                
                <div class='row p-2'>
                    <div class='col'>
                        {{ Form::label('obs', '') }}:
                        {{ Form::textarea('obs', '', ['class' => 'form form-control', 'value' => old('obs')]) }}
                    </div>
                </div>


                <div class='row p-2'>
                    <div class='col'>
                        {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                    </div>{{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@stop


@section('css')

@stop

@section('code')

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">
        $("#dt_entrada").blur(function() {

            var hoje = new Date($("#dt_entrada").val());
            hoje.setDate(hoje.getDate() + 365);

            //console.log(hoje.toLocaleDateString('pt-br'));

            $("#limite_analise").val(hoje.toLocaleDateString('pt-br'));

        });

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
                        search: request.term,

                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.value + " - " + item.empdor,
                                nome: item.value,
                                value: item.id,
                            }
                        }));
                    }
                });
            },
            select: function(event, ui) {
                console.log(ui.item.label);
                $('#empnto_search').val(ui.item.label);
                $('#pae_empnto_id').val(ui.item.value);
                return false;
            }
        });
    </script>

@stop
