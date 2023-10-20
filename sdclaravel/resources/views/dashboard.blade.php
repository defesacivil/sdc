<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>


    <div class="container-fluid d-flex border">
        <div class="row align-items-center flex-fill">

            @can('cedec')
                {{-- AJUDA HUMANITÁRIA --}}
                <div class="col-6 col-md-4 col-lg-3 text-center">
                    <figure class="figure">
                        <a class='text-center' href='ajuda'>
                            <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/ajuda.png') }}'
                                alt=""></a>
                        <figcaption class="figure-caption text-center">AJUDA HUMANITÁRIA</figcaption>
                    </figure>
                </div>

                {{-- MODULO PLANTÃO DRRD  --}}
                {{-- <div class="col-6 col-md-4 col-lg-3 text-center">

                    <figure class="figure">
                        <a href='{{ url('drd') }}'>
                            <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/cce.png') }}'
                                alt=""></a>
                        <figcaption class="figure-caption text-center">DRD</figcaption>
                    </figure>
                </div> --}}


                {{-- COMPDEC CEDEC --}}
                <div class="col-6 col-md-4 col-lg-3 text-center">

                    <figure class="figure">
                        <a href='compdec'>
                            <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/comdec.png') }}'
                                alt=""></a>
                        <figcaption class="figure-caption text-center">COMPDEC</figcaption>
                    </figure>
                </div>
                {{-- EQUIPE DE APOIO --}}

                {{-- <div class="col-6 col-md-4 col-lg-3 text-center">

                    <figure class="figure">
                        <a href='equipe'>
                            <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/equipe.png') }}'
                                alt=""></a>
                        <figcaption class="figure-caption text-center">EQUIPE DE APOIO</figcaption>
                    </figure>

                </div> --}}


                {{-- MODULO CEDEC --}}

                <div class="col-6 col-md-4 col-lg-3 text-center">

                    <figure class="figure">
                        <a href='cedec'><img class="figure-img img-fluid rounded"
                                src='{{ asset('/imagem/icon/cedec.png') }}' alt=""></a>
                        <figcaption class="figure-caption text-center">CEDEC</figcaption>
                    </figure>

                </div>


                {{-- ESCOLA DE DEFESA CIVIL --}}

                {{-- <div class="col-6 col-md-4 col-lg-3 text-center">

                    <figure class="figure">
                        <a href='escola'><img class="figure-img img-fluid rounded"
                                src='{{ asset('/imagem/icon/escola.png') }}' alt=""></a>
                        <figcaption class="figure-caption text-center">ESCOLA DE DEFESA CIVIL</figcaption>
                    </figure>

                </div> --}}


                {{-- PAEBM --}}
                @can('paebm')
                    <div class="col-6 col-md-4 col-lg-3 text-center">
                        <div class="col bg-gray-100 sm:rounded-lg">
                            <figure class="figure">
                                <a href='{{ url('drrd') }}'><img class="figure-img img-fluid rounded"
                                        src='{{ asset('/imagem/icon/paebm.png') }}' alt=""></a>
                                <figcaption class="figure-caption text-center">PAEBM</figcaption>
                            </figure>
                        </div>

                    </div>
                @endcan

                
                {{-- CONFIGURAÇÕES --}}
                <div class="col-6 col-md-4 col-lg-3 text-center">
                    
                    <figure class="figure">
                        <a href='config'><img class="figure-img img-fluid rounded"
                                src='{{ asset('/imagem/icon/config.png') }}' alt=""></a>
                        <figcaption class="figure-caption text-center">CONFIGURAÇÕES</figcaption>
                    </figure>
                </div>
            @endcan

            {{-- #########  ACESSO TODOS USUÁRIOS --}}
            {{-- RAT --}}
            <div class="col-6 col-md-4 col-lg-3 text-center">
                <div class="col bg-gray-100 sm:rounded-lg">
                    <figure class="figure">
                        <a href='{{ url('rat') }}'>
                            <img width="128" class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/rat.png') }}'
                                alt=""></a>
                        <figcaption class="figure-caption text-center">RAT</figcaption>
                    </figure>
                </div>
            </div>

            {{-- VISTORIA --}}
            <div class="col-6 col-md-4 col-lg-3 text-center">
                <div class="col bg-gray-100 sm:rounded-lg">
                    <figure class="figure">
                        <a href='{{ url('vistoria/menu') }}'>
                            <img width="128" class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/vistoria_interdicao.png') }}'
                                alt=""></a>
                        <figcaption class="figure-caption text-center">VISTORIA/INTERDICAO</figcaption>
                    </figure>
                </div>
            </div>


            {{-- PREPARA MINAS
            <div class="col-6 col-md-4 col-lg-3 text-center">
                <div class="col bg-gray-100 sm:rounded-lg">
                    <figure class="figure">
                        <a href='{{ url('prepara') }}'>
                            <img width="128" class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/prepara_minas.png') }}'
                                alt=""></a>
                        <figcaption class="figure-caption text-center">PREPARA MINAS</figcaption>
                    </figure>
                </div>
            </div> --}}


            {{-- COMPDEC EDIT --}}
            @can('compdec')

                <div class="col-6 col-md-4 col-lg-3 text-center">
                    <div class="col bg-gray-100 sm:rounded-lg">
                        <figure class="figure">
                            <a href='{{ url('compdec/edit') }}'>
                                <img class="figure-img img-fluid rounded w-160" src='{{ asset('/imagem/icon/comdec.png') }}'
                                    alt=""></a>
                            <figcaption class="figure-caption text-center">COMPDEC</figcaption>
                        </figure>
                    </div>
                </div>
            @endcan

            {{-- PMDA EDIT
            @can('compdec')
                <div class="col-6 col-md-4 col-lg-3 text-center">
                    <div class="col bg-gray-100 sm:rounded-lg">
                        <figure class="figure">
                            <a href='{{ url('pmda') }}'>
                                <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/pmda.png') }}'
                                    alt=""></a>
                            <figcaption class="figure-caption text-center">PMDA</figcaption>
                        </figure>
                    </div>
                </div>
            @endcan --}}

            {{-- PEDIDO DE AJUDA HUMANITARIA --}}
            @can('compdec')
                <div class="col-6 col-md-4 col-lg-3 text-center">
                    <div class="col bg-gray-100 sm:rounded-lg">
                        <figure class="figure">
                            <a href='{{ url('ajuda') }}'>
                                <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/pedido_cesta.png') }}'
                                    alt=""></a>
                            <figcaption class="figure-caption text-center">PEDIDO DE MAH</figcaption>
                        </figure>
                    </div>
                </div>
            @endcan


            {{-- CONFIGURAÇÕES COMPDEC
            @can('compdec')
                <div class="col-6 col-md-4 col-lg-3 text-center">
                    <div class="col bg-gray-100 sm:rounded-lg">
                        <figure class="figure">
                            <a href='configcompdec'><img class="figure-img img-fluid rounded"
                                    src='{{ asset('/imagem/icon/config.png') }}' alt=""></a>
                            <figcaption class="figure-caption text-center">CONFIGURAÇÕES</figcaption>
                        </figure>
                    </div>
                </div>
            @endcan --}}

        </div>

    </div>



</x-app-layout>
