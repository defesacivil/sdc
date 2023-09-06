@extends('layouts/master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')
    <br>
    @can('cedec')
        <p class='text-center'><a class='btn btn-success' href='drd'>Voltar</a></p><br>

        <p><a href='{{ url('boletim/create') }}' name="btnNovo" id="btnNovo" class="btn btn-success"
                title="Criar novo Boletim">Criar Novo*</a></p>
        {{ Form::open(['url' => 'boletim']) }}
        {{ Form::token() }}

        {{ Form::label('txtBusca', 'Busca Boletim (Nome Plantonista)') }} :
        {{ Form::text('txtBusca', '', ['class' => 'form form-control']) }}
        <br>

        {{ Form::submit('Pesquisar', ['class' => 'btn btn-primary']) }}

        {{ Form::close() }}

        <br>


        <table class='table table-bordered table-sm'>
            <tr>
                <th>Cod</th>
                <th>Data</th>
                <th>Nome Exibição</th>
                <th>Arquivo</th>
                <th>Plantonista</th>
                <th>Ativo</th>
                <th>Opções</th>
            </tr>
            @foreach ($boletims as $boletim)
                @php
                    $checked = '';
                    if ($boletim->situacao == 0) {
                        $icon_sit = 'red';
                        $checked = '';
                    } else {
                        $icon_sit = 'green';
                    }
                    
                @endphp
                <tr>
                    <td>{{ $boletim->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($boletim->data)->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $boletim->descricao }}</td>
                    <td><a href='{{ url('boletim/visualizar/' . $boletim->nome) }}'
                            title="Clique para fazer o Download ou Visualização do Arquivo">{{ $boletim->nome }}</a></td>
                    <td>{{ $boletim->usuario }}</td>
                    <td><a href='' data-id='{{ $boletim->id }}' name="btnStatus"><img width="20"
                                src='{{ asset('/imagem/icon/' . $icon_sit . '.png') }}' title="Clique para Mudar o Status"></a>
                    </td>
                    <td>
                        <a href='{{ url('boletim/delete', ['id' => $boletim->id]) }}'
                            onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};">
                            <img src='{{ asset('/imagem/icon/delete.png') }}' alt=""></a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="row">
            <div class="col-12 text-center">
                {{ $boletims->links() }}
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
