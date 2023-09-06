<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img src='#'></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          {{-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> --}}
        </li>
        <li class="nav-item">
          {{-- <a class="nav-link" href="#">Link</a> --}}
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>

      <div class="text-center">
        <img width="30" class="" src='{{asset('/imagem/avatar.png')}}' alt=""></a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();" title="Sair com segurança do SDC">
                {{ __('Log Out') }}
        </a>

        </form>
      </div>
      &nbsp;&nbsp;&nbsp;{{ Auth::user()->name }}<br>
      &nbsp;&nbsp;&nbsp;{{ Auth::user()->email }}<br>
      <div class="text-left">
      
      </div>
      
    </div>
  </nav>
