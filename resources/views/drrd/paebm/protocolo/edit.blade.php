@extends('layouts.pagina_master')
{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/drrd') }}">Drrd</a></li>
            <li class="breadcrumb-item active" aria-current="page">Protocolo</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="col-12">
        <div class="row">
            <div class="col p-3">
                <p class='text-center'><a class='btn btn-success' href='{{ url('pae/protocolo') }}'>Voltar</a></p><br>
                <legend>Edição Empreendedor</legend>
            </div>
        </div>

        {{ Form::open(['url' => 'pae/protocolo/update', 'method' => 'POST']) }}
        {{ Form::token() }}
        <div class="row p-2">
            <div class="col-6">

                {{ Form::hidden('id', $protocolo['id']) }}
                {{ Form::label('Número Protocolo') }} :
                {{ Form::text('num_protocolo', $protocolo->num_protocolo, ['class' => 'form form-control', 'readonly']) }}
            </div>
            <div class="col-6">
                {{ Form::label('Data Entrada') }} :
                {{ Form::input('dateTime-local', 'dt_entrada', $protocolo->dt_entrada, ['class' => 'form form-control', 'readonly']) }}
            </div>
        </div>       
        
        <div class="row p-2">
            <div class="col-6">
                {{ Form::label('CCPAE') }} :
                {{ Form::text('ccpae', $protocolo->ccpae, ['class' => 'form form-control']) }}
            </div>
            <div class="col-6">
                {{ Form::label('CCPAE Vencimento') }} :
                {{ Form::date('ccpae_venc', $protocolo->ccpae_venc, ['class' => 'form form-control']) }}
            </div>
        </div>

        <div class='row p-2'>
            <div class='col-6'>
                {{ Form::label('empreendimento', '') }}:
                {{ Form::text('empnto_search', $protocolo->nome, ['class' => 'form form-control', 'value' => old('empnto_search'), 'id' => 'empnto_search']) }}
                {{ Form::hidden('pae_empnto_id', $protocolo->pae_empnto_id, ['id' => 'pae_empnto_id']) }}
            </div>
            <div class='col-6'>
                {{ Form::label('obs', '') }}:
                {{ Form::textarea('obs', $protocolo->obs, ['class' => 'form form-control', 'value' => old('obs')]) }}
            </div>
        </div>


        <div class="row p-2">
            <div class="col-6">
                {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
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
