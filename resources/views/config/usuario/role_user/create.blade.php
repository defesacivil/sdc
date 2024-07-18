@extends('layouts.pagina_master')

{{-- header --}}
@section('header')


    <!-- breadcrumb -->
    <div class="row" style="background-color: #C0D6DF">
        <div class="col">
            <nav aria-label="breadcrumb" class="border-botton align-middle">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/config') }}">Configurações</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/config/usuario') }}">Usuários</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/usuario') }}">Perfil / Permissões</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cadastro Perfil em usuário</li>
                </ol>
            </nav>

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-12 text-center p-3">
            <a href='{{ url('usuario') }}' class="btn btn-success">Voltar</a>
        </div>
    </div>

    <legend>Associação Usuário em Perfil</legend>
    <div class="row" id="corpo1">
        <div class='col-md-12'>
            {{ Form::open(['url' => 'usuario/role/add/store']) }}
            {{ Form::token() }}
            <div class='row'>
                <div class='col-6 col-md-6'>
                    {{ Form::label('label', 'Nome Usuário') }}:
                    {{ Form::text('label', $users['name'], ['class' => 'form form-control disable', 'value' => old('name'), 'readonly' => 'readonly']) }}
                    {{ Form::hidden('user_id', $users['id'], ['readonly' => 'readonly']) }}
                </div>
                <br>
                <div class='col-6 col-md-6 p-3'>
                    Perfil:<br>


                    @foreach ($roles as $role)
                        @if ($role['role'] == 'cedec' && $users['tipo'] == 'compdec')
                        @else
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="role_id{{$role['role_id']}}" value="{{ $role['role'] }}" data-role="{{ $role['role']}}" {{ $role['checked'] == 'true' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineCheckbox1">{{ $role['role'] }}</label>
                            </div>
                        @endif
                    @endforeach
                </div>
                <br>
            </div>
            <div class='row'>
                <div class='col'>

                    {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                </div>{{ Form::close() }}
    
            </div>
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
@stop

@section('code')

    <script type="text/javascript">
        $(document).ready(function() {

            //var formData = new FormData();

        // $('input[type="checkbox"]').on('change', function() {

        //     formData.append('checked', $(this).is(":checked"));
        //     formData.append('role', $(this).data('role'));
        //     formData.append('role_id', $(this).val());
        //     formData.append('user_id', '{{$users['id']}}');

        //     /* token laravel */
        //     formData.append('_token', '{{ csrf_token() }}');

        //     $.ajax({
        //         /* url laravel */
        //         url: '{{ url('usuario/role/add/store') }}',
        //         type: 'POST',
        //         data: formData,
        //         processData: false, // tell jQuery not to process the data
        //         contentType: false, // tell jQuery not to set contentType
        //         success: function(response) {
        //             window.location.reload()//; = response.view;
 
        //             toastr.success(response.message);

        //             //Swal.fire('Importação realizada com Sucesso !')
        //         },
        //         error: function(e) {
        //             //console.log(JSON.stringify(e));
        //         }
        //     });
        // });

        });

</script>
@stop
