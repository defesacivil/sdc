<div class="col-12">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <img width="50" src="{{ url('imagem/logo_sdc.png') }}">
                </li>
                <li class="nav-item">
                    <a href="{{ url('help') }}" class="nav-link" title="Documentação de Ajuda do SDC">Ajuda</a>
                </li>
            </ul>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search" name="navSearch">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> --}}

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">0</span>
                    </a>
                    {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <span class="float-right text-sm">
                                    <img src="{{ url('imagem/avatar.png') }}" alt="User Avatar" class="mr-3 img-size-50" width="20px">
                                    Brad Diesel
                                    <i class="fas fa-star text-danger"></i></span><br>
                                    <i class="">Call me whenever you can...</i><br>
                                    <i class="text-sm text-muted"><i class="mr-1 far fa-clock"></i> 4 Hours Ago</i>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <span class="float-right text-sm">
                                    <img src="{{ url('imagem/avatar.png') }}" alt="User Avatar" class="mr-3 img-size-50" width="20px">
                                    Brad Diesel
                                    <i class="fas fa-star text-danger"></i></span><br>
                                    <i class="">Call me whenever you can...</i><br>
                                    <i class="text-sm text-muted"><i class="mr-1 far fa-clock"></i> 4 Hours Ago</i>
                            </div>
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">Ver todas as Mensagens</a>
                    </div> --}}
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">0</span>
                    </a>
                    {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="mr-2 fas fa-envelope"></i> 4 new messages
                            <span class="float-right text-sm text-muted">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="mr-2 fas fa-users"></i> 8 friend requests
                            <span class="float-right text-sm text-muted">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="mr-2 fas fa-file"></i> 3 new reports
                            <span class="float-right text-sm text-muted">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div> --}}
                </li>

            </ul>


            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="route('logout')"
                        onclick="event.preventDefault();
                            this.closest('form').submit();" title="Sair com segurança do SDC">
                            <img width="25" class="" src='{{ asset('/imagem/icon/sair.png') }}' alt="">
                        
                    </a>

                </form>
            </div>
            <div class="text-left">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="mr-auto navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                &nbsp;&nbsp;&nbsp;{{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu p-2" aria-labelledby="navbarDropdown">
                                @can('cedec')
                                    @isset(Session::get('user')['funcionario']['secao'])
                                        <span class="bolder">Seção :</span>&nbsp;{{ Session::get('user')['funcionario']['secao'] }}
                                        {{ Auth::user()->email }}
                                        {{-- <a href="#">Perfil</a> --}}
                                        @endisset
                                    @endcan
                            </div>
                        </li>
                    </ul>
                </div>



            </div>
        </div>
    </nav>
</div>
