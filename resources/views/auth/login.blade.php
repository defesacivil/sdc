<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SDC - Sistema de Defesa Civil MG</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('vendor/admin-lte/adminlte.min.css')}}">
    <style>
        body {
            background-image: url('{{ url('imagem/background/barragem.jpg') }}');
            /* background-image: url('{{ url('imagem/background/background_chuva.png') }}'); */
            background-repeat: no-repeat;
            background-size: cover;

        }
    </style>

</head>

<body class="hold-transition">

    <div class="container h-100">
        <div class="card-img-overlay d-flex">
            <div class="my-auto mx-auto text-center">
                <!-- /.login-logo -->
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        
                        <a href="#" class="h1"><b>ACESSO MINERADORAS</b></a>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">Aqui, nessa página o acesso é feito <b class="text-danger"><i>SOMENTE</i></b> para Usuários do <b>PAE - Plano de Ação de Emergência de Barragens</b></p>
                        
                        <form action="{{ url('login') }}" method="post">
                            @csrf

                            {{-- Email field --}}
                            <div class="input-group mb-3">

                                <input type="cpf" name="cpf"
                                    class="form-control @error('cpf') is-invalid @enderror" value="{{ old('cpf') }}"
                                    placeholder="CPF" autofocus maxlength="11">

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-envelope"></span>
                                    </div>
                                </div>

                                @error('cpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Password field --}}
                            <div class="input-group mb-3">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Digite sua Senha">

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Login field --}}
                            <div class="row">
                                <div class="col-7">
                                    <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                                        <input type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label for="remember">Lembre-me
                                        </label>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <button type=submit
                                        class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                        <span class="fas fa-sign-in-alt"></span> Entrar
                                    </button>
                                </div>
                            </div>

                        </form>



                        <p class="mb-1">
                            <a href="{{ url('forgot-password') }}">Esquecí a Senha</a>
                        </p>
                        <br>
                        <p class="mb-0 h1">

                            <b><a href="https://www.sistema.defesacivil.mg.gov.br" class="text-center">Acesso ao SDC clique <br> http://www.sistema.defesacivil.mg.gov.br</a></b>
                            {{-- <a href="{{ url('register') }}" class="text-center">Registrar novo usuário</a> --}}
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>

            <!-- /.login-box -->

        </div>
    </div>

    <!-- jQuery -->
    <script src="../node_modules/admin-lte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../node_modules/admin-lte/dist/js/adminlte.min.js"></script>
</body>

</html>
