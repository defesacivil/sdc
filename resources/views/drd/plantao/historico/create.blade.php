@extends('layouts/master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')
    <br>
    @can('cedec')
        <p class='text-center'><a class='btn btn-success' href='drd'>Voltar</a></p><br>


        {{ Form::open(['url' => '/boletim/store', 'files' => true]) }}
        {{ Form::token() }}

        <div class='col'>
            {{ Form::label('nome', 'Nome Documento (PDF, DOC, DOCX, ODT)') }}:
            {{ Form::file('nome', ['class' => 'form form-control', 'required']) }}
            <br>
        </div>
        <div class='col'>
            {{ Form::label('data', 'Data de Postagem') }}:
            {{ Form::input('dateTime-local', 'data', '', ['class' => 'form form-control', 'required']) }}
            <br>
        </div>
        <div class='col'>
            {{ Form::label('descricao', 'Nome Exibição') }}:
            {{ Form::text('descricao', '', ['class' => 'form form-control', 'required']) }}
            <br>
        </div>
        <div class='col'>
            {{ Form::label('situacao', 'Situação do Boletim') }}:
            {{ Form::select(
                'situacao',
                [
                    '1' => 'Ativado',
                    '0' => 'Desativado',
                ],
                '',
                ['class' => 'form form-control', 'required'],
            ) }}
            <br>
        </div>
        <div class='row'>
            {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
        </div>{{ Form::close() }}
        </div>

        <br>

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
