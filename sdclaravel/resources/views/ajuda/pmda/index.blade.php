@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">PMDA</li>
        </ol>
    </nav>

@endsection

@section('content')
    <div class="container">

        <div class="row flex-fill">

            <div class="col-md-12">

                <!-- menu opções - novo | pesquisa |voltar-->
                <div class="row">
                    <div class="col">
                        <ul class="nav">
                            @can('compdec')
                                <li class="nav-item mr-1">
                                    <a class="btn btn-primary btn-sm" href="{{ url('pmda/create') }}"
                                        title="Inserir novo Registro">+
                                        Novo Registro</a>
                                </li>
                            @endcan
                            <li class="nav-item mr-1">

                                <!-- #######  acesso CEDEC ####### -->
                                @can('cedec')
                                    <a class="btn btn-info btn-sm" id="btn_search" href='mah/busca'>Pesquisar</a>
                                @endcan

                                <!-- ####### Acesso COMPDEC ###### -->
                                {{-- @can('compdec')
                                    <a class="btn btn-info btn-sm" id="btn_search1">Pesquisar</a>
                                @endcan --}}
                            </li>

                            @can('cedec')
                                <li class="nav-item mr-1">
                                    <a class="btn btn-secondary btn-sm" href="{{ url('pae/empdor/export') }}"
                                        title="Inserir novo Registro">* Exportar Excel</a>
                                </li>
                            @endcan
                            <li class="nav-item mr-1">
                                <a class="btn btn-success btn-sm" href="{{ url('dashboard') }}">Voltar</a>
                            </li>
                        </ul>

                    </div>
                </div>

                <br>

                @can('cedec')
                    <p class='text-center'><a class='btn btn-success' href='dashboard'>Voltar</a></p><br>
                    {{ Form::open(['url' => 'pmda']) }}
                    {{ Form::token() }}

                    {{ Form::label('txtBusca', 'Busca PMDA') }} :
                    {{ Form::text('txtBusca', '', ['class' => 'form form-control']) }}
                    <br>

                    {{ Form::submit('Pesquisar', ['class' => 'btn btn-primary']) }}

                    {{ Form::close() }}

                    <br>
                @endcan

                @can('compdec')

                    @if (isset($pmdas))
                        <table class='table table-bordered table-striped table-sm'>
                            <tr>
                                <th>Protocolo</th>
                                <th>Municipio</th>
                                <th>Quant.</th>
                                <th>Ultima Atualização</th>
                                <th>Opções</th>
                            </tr>
                            @foreach ($pmdas as $pmda)
                                <tr>
                                    <td>{{ $pmda->protocolo }}</td>
                                    <td>{{ $pmda->municipio_id . ' - ' . $pmda->nome }}</td>
                                    <td>{{ statusPmda($pmda->status) }}</td>

                                    <td>{{ $pmda->updated_at }}</td>
                                    <td>
                                        <!-- em edição -->
                                        @if ($pmda->status == 0)
                                            @can('compdec')
                                                <a href='{{ url('pmda/edit', ['id' => $pmda->id, '-inicio-tab']) }}'><img src='{{ asset('/imagem/icon/editar.png') }}' alt="" title="Editar Registro"></a>
                                                <a href='{{ url('pmda/delete', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/delete.png') }}' alt="" title="Apagar Registro"></a>
                                            @endcan
                                            
                                        <!-- completo -->
                                        @elseif($pmda->status == 1)
                                            @can('compdec')
                                                <a href='{{ url('pmda/edit', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/editar.png') }}' alt=""></a>
                                            @endcan

                                            {{-- Em analise --}}
                                        @elseif($pmda->status == 2)
                                            @can('cedec')
                                                <a href='{{ url('pmda/edit', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/editar.png') }}' alt=""></a>
                                                <a href='{{ url('pmda/tramita', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/tramita.png') }}' alt=""></a>
                                            @endcan

                                            {{-- Arquivado     --}}
                                        @elseif($pmda->status == 3)
                                            <a href='{{ url('pmda/show', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/view.png') }}' alt="" title="Visualizar / imprimir"></a>

                                            {{-- Aprovado --}}
                                        @elseif($pmda->status == 4)
                                            @can('cedec')
                                                <a href='{{ url('pmda/tramita', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/tramita.png') }}' alt=""></a>
                                            @endcan

                                            {{-- Anulado --}}
                                        @elseif($pmda->status == 5)
                                            @can('compdec')
                                                <a href='{{ url('pmda/delete', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/delete.png') }}' alt="" title="Apagar Registro"></a>
                                            @endcan

                                        {{-- Nulo --}}
                                        @elseif($pmda->status == 6)
                                        
                                    
                                        {{-- Atendido --}}
                                        @elseif($pmda->status == 7)

                                        {{-- Cancelado --}}
                                        @elseif($pmda->status == 8)

                                        {{-- Encerrado --}}
                                        @elseif($pmda->status == 9)
                                        @endif

                                        {{-- Ações livres --}}
                                        <a href='{{ url('pmda/show', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/view.png') }}' alt="" title="Visualizar / imprimir"></a>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                @else
                    @if (isset($pmdas))
                        <table class='table table-bordered table-sm'>
                            <tr>
                                <th>Cod</th>
                                <th>Municipio</th>
                                <th>Status</th>
                                <th>Ultima Atualização</th>
                                <th>Opções</th>
                            </tr>
                            @foreach ($pmdas as $pmda)
                                <tr>
                                    <td>{{ $pmda->id }}</td>
                                    <td>{{ $pmda->municipio_id . ' - ' . $pmda->nome }}</td>
                                    <td>{{ statusPmda($pmda->status) }}</td>

                                    <td>{{ $pmda->updated_at }}</td>
                                    <td>
                                        <!-- em edição -->
                                        @if ($pmda->status == 0)
                                            @can('compdec')
                                                <a href='{{ url('pmda/edit', ['id' => $pmda->id, '-inicio-tab']) }}'><img src='{{ asset('/imagem/icon/editar.png') }}' alt="" title="Editar Registro"></a>
                                                <a href='{{ url('pmda/delete', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/delete.png') }}' alt="" title="Apagar Registro"></a>
                                            @endcan
                                            
                                            <!-- completo -->
                                        @elseif($pmda->status == 1)
                                            @can('compdec')
                                                <a href='{{ url('pmda/edit', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/editar.png') }}' alt=""></a>
                                            @endcan

                                            {{-- Em analise --}}
                                        @elseif($pmda->status == 2)
                                            @can('cedec')
                                                <a href='{{ url('pmda/edit', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/editar.png') }}' alt=""></a>
                                                <a href='{{ url('pmda/tramita', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/tramita.png') }}' alt=""></a>
                                            @endcan

                                        {{-- Arquivado     --}}
                                        @elseif($pmda->status == 3)

                                            {{-- Aprovado --}}
                                        @elseif($pmda->status == 4)
                                            @can('cedec')
                                                <a href='{{ url('pmda/tramita', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/tramita.png') }}' alt=""></a>
                                            @endcan

                                        {{-- Anulado --}}
                                        @elseif($pmda->status == 5)
                                            @can('compdec')
                                                <a href='{{ url('pmda/delete', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/delete.png') }}' alt="" title="Apagar Registro"></a>
                                            @endcan

                                        {{-- Nulo --}}
                                        @elseif($pmda->status == 6)                                        

                                        {{-- Atendido --}}
                                        @elseif($pmda->status == 7)

                                        {{-- Cancelado --}}
                                        @elseif($pmda->status == 8)

                                        {{-- Encerrado --}}
                                        @elseif($pmda->status == 9)
                                        
                                        @endif
                                        
                                        <a href='{{ url('pmda/show', ['id' => $pmda->id]) }}'><img src='{{ asset('/imagem/icon/view.png') }}' alt="" title="Visualizar / imprimir"></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                @endcan

            </div>
        </div>

    @stop

    @section('css')
    @stop

    @section('code')

        <script type="text/javascript">
            $(document).ready(function() {

            })
        </script>
        <script>
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
            @endif
            @if ($errors->any())

                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}")
                @endforeach
            @endif
        </script>

    @endsection
