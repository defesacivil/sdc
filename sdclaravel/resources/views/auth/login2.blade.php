@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop




<div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-4">
        <form action="{{ url('login') }}" method="post">
            @csrf
    
            {{-- Email field --}}
            <div class="input-group mb-3">
                <input type="cpf" name="cpf" class="form-control @error('cpf') is-invalid @enderror"
                       value="{{ old('cpf') }}" placeholder="{{ __('adminlte::adminlte.cpf') }}" autofocus>
    
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
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
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="{{ __('adminlte::adminlte.password') }}">
    
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
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                        <label for="remember">
                            {{ __('adminlte::adminlte.remember_me') }}
                        </label>
                    </div>
                </div>
    
                <div class="col-5">
                    <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                        <span class="fas fa-sign-in-alt"></span>
                        {{ __('adminlte::adminlte.sign_in') }}
                    </button>
                </div>
            </div>
    
        </form>

    </div>
</div>


@section('auth_footer')
    
        <p class="my-0">
            <a href="{{ url('reset') }}">
                {{ __('adminlte::adminlte.i_forgot_my_password') }}
            </a>
        </p>


        <p class="my-0">
            <a href="{{ url('register') }}">
                {{ __('adminlte::adminlte.register_a_new_membership') }}
            </a>
        </p>

@stop
