@extends('layouts/pagina_simples')

<div class="container">
    <div class="row">
        <div class="col-12 text-center m-3">
            <img src="{{url('imagem/logo_sdc.png')}}" width="160">
        </div>

    </div>
    <div class="row p-2">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="register-box">
                <form action="{{ url('register') }}" method="post">
                    @csrf

                    {{-- Name field --}}
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="Nome Completo" autofocus>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- CPF --}}
                    <div class="input-group mb-3">
                        <input type="text" name="cpf" class="form-control @error('cpf') is-invalid @enderror"
                            value="{{ old('cpf') }}" placeholder="CPF" autofocus>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>




                    {{-- Email field --}}
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="Email">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Password field --}}
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Senha">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Confirm password field --}}
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="digite a nova senha novamente">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>

                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Register button --}}
                    <button type="submit" class="btn btn-block btn-flat btn-primary">
                        <span class="fas fa-user-plus"></span>
                        Registrar
                    </button>
                </form>
                <a href="{{url('login')}}" class="btn btn-success">Voltar</a>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
</div>

@section('auth_footer')
    <p class="my-0">
        <a href="{{ url('login') }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
@stop
