@extends('layouts/master')

@section('title', 'SDC - Sistema de Defesa Civil')


@section('content_header')


@stop

<!-- conteudo -->
@section('content')
    <legend>Visualização Dados User</legend>



<table class="table table-bordered table-sm data-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Email Rec</th>
        <th>Situacao</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div class="row">
    <div class="col">
        
    </div>
</div>
    <div class="row">
        <div class="col text-center">
            <a href='{{ url('dashboard') }}' class="btn btn-success">Voltar</a>
        </div>
    </div>
@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    
    <script type="text/javascript">
        $(function () {   

        var table1 = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('usuarioperfil/index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'ativo', name: 'ativo'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
        });
    </script>
    <script></script>
@stop
