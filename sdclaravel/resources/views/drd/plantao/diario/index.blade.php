@extends('layouts/master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')
    <br>
    @can('cedec')

    <p class='text-center'><a class='btn btn-success' href='drd'>Voltar</a></p><br>
    <p class="alert alert-danger">Antes de fazer o lancamento verifique se existe o plantão já aberto </p>

        <p><a href='{{ url('diario/create') }}' name="btnAbrir" id="btnAbrir" class="btn btn-success"
                title="Abrir Plantão">Criar Novo*</a></p>
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
                <th class="col-1">Cod</th>
                <th class="col-3">Data Diário</th>
                <th class="col-3">Período</th>
                <th class="col-4">Plantonista</th>
                <th class="col-1">Opções</th>
            </tr>
            @foreach ($diarios as $diario)
                
                <tr>
                    <td>{{ $diario->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($diario->dt_diario)->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $diario->periodo }}</td>
                    <td>{{ $diario->usuario_id }}</td>
                    <td>
                        {{-- Lancamento novo registro de hisitorico --}}
                        <a href='{{ url('plantao/diario/historico', ['id' => $diario->id]) }}'
                            onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};" title="Lançamento do Historico do Plantão">
                            <img src='{{ asset('/imagem/icon/notas.png') }}' alt="Lançar diario"></a>

                            {{-- editar abertura do plantão --}}
                            <a href='{{ url('plantao/diario/edit', ['id' => $diario->id]) }}'
                                onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};" title="Editar abertura do plantão">
                                <img src='{{ asset('/imagem/icon/editar.png') }}' alt=""></a>


                                <a href='{{ url('diario/show', ['id' => $diario->id]) }}'
                                    title="Visualizar Historico do Plantão">
                                    <img src='{{ asset('/imagem/icon/view.png') }}' alt=""></a>
                            </td>
                </tr>
            @endforeach
        </table>
        <div class="row">
            <div class="col-12 text-center">
                {{$diarios->links()}}
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
