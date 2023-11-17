@extends('layouts/master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')
    <br>
    @can('cedec')
        <p class='text-center'><a class='btn btn-success' href='drd'>Voltar</a></p><br>

        <table class='table table-bordered table-sm'>
            <tr>
                <th class="col-2">Codido :</th>
                <td class="col-10">{{ $diario->id }}</td>
            </tr>
            <tr>
                <th>Data :</th>
                <td>{{ \Carbon\Carbon::parse($diario->data)->format('d/m/Y H:i:s') }}</td>
            </tr>
            <tr>
                <th>Período</th>
                <td>{{ $diario->periodo }}</td>
            </tr>
            <tr>
                <th>Plantonista</th>
                <td>{{ $diario->usuario_id }}</td>
            </tr>
            <tr>
        </table>
        <div class="row">
            <div class="col-2 text-right"></div>
            <div class="col-10 text-right">
                <table class='table table-bordered table-sm'>
                    
                    <tr>
                        <th class="col-2">Codido :</th>
                        <td class="col-10">{{ $diario->id }}</td>
                    </tr>
                </table>

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
