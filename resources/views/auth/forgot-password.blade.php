@include('layouts/pagina_simples')
<div class="container">




    <div class="row p-2">
        <div class="col-12 text-center">
            <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/logo_sdc.png') }}' width="150">
        </div>
    </div>
    <div class="row p-5">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>


        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <label for="email">Email</label>
            <div class="input-group mb-3">

                <input type="mail" class="form form-control" name="email" id="email" value="{{ old('email') }}" required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            

            <div class="flex items-center justify-end mt-4">
                <input type="submit" class="btn btn-primary" value="{{ __('Email Password Reset Link') }}">

            </div>
        </form>
    </div>
    <div class="row p-2">
        <div class="col-12 text-center">
            <a class="btn btn-success btn-sm" href="{{url('login')}}">Voltar</a>
        </div>
    </div>
</div>
