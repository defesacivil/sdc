@extends('layouts/master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')
    <br>
    @can('cedec')
        <p class='text-center'><a class='btn btn-success' href='drd'>Voltar</a></p><br>

        <p><a href='{{ url('diario/create') }}' name="btnNovo" id="btnNovo" class="btn btn-success"
                title="Criar novo Boletim">Criar Novo*</a></p>
        {{ Form::open(['url' => 'boletim']) }}
        {{ Form::token() }}

        {{ Form::label('txtBusca', 'Busca Diario') }} :
        {{ Form::text('txtBusca', '', ['class' => 'form form-control']) }}
        <br>

        {{ Form::submit('Pesquisar', ['class' => 'btn btn-primary']) }}

        {{ Form::close() }}

        <br>


        <table class='table table-bordered table-sm'>
            <tr>
                <th>Cod</th>
                <th>Número</th>
                <th>Data Diário</th>
                <th>Turno</th>
                <th>Hora </th>
                <th>Plantonista</th>
                <th>Opções</th>
            </tr>
            @foreach ($diarios as $diario)
                
                <tr>
                    <td>{{ $diario->id }}</td>
                    <td>{{ $diario->num }}</td>
                    <td>{{ \Carbon\Carbon::parse($diario->dt_diario)->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $diario->turno }}</td>
                    <td>{{ $diario->hora }}</td>
                    <td>{{ $diario->usuario_id }}</td>
                    <td>
                        <a href='{{ url('diario/delete', ['id' => $diario->id]) }}'
                            onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};">
                            <img src='{{ asset('/imagem/icon/delete.png') }}' alt=""></a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="row">
            <div class="col-12 text-center">
                
            </div>
        </div>

    @endcan


@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $("a[name='btnStatus'").click(function(event) {
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('status') }}",
                    data: {
                        'id': $(this).data('id'),
                    },
                    type: 'POST',
                    success: function(result) {
                        location.reload();
                    }
                });

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
                toastr.success("{{ session('message') }}");
                "erro";
            @endif
            @if ($errors->any())

                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}")
                @endforeach
            @endif


        });
    </script>
@stop
