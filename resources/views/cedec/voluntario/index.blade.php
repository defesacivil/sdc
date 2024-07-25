@extends('layouts.pagina_master_web')

{{-- header --}}
@section('header')

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h4>
                <p class="p-4 text-center">Cadastro de Voluntários da Defesa Civil de MG</p>
            </h4>

            <a href='#'>Cancelar cadastro></a>
            <span>Voçe pode pedir a remoção do cadastro da base de Dados de Voluntários</span>
        </div>
    </div>

    @include('cedec.voluntario.form.index')

@stop

@section('css')
@stop

@section('code')


    <script type="text/javascript">
        $(document).ready(function() {

            $('.profissao').select2();
            $('.municipio_id').select2();

            $('#municipio_id').on('select2:select', function(e) {
                //$('#regiao_id').
            });
        })
    </script>

@endsection
