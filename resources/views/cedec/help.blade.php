<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!--{{ __('Menu Inicial') }} -->
        </h2>
    </x-slot>

    <style>
        a {
            text-decoration: none;
            color: black;
        }

        h1~ul li {
            list-style: none;
        }

        .titulo>a {
            color: brown;
            font-weight: bold;
            font-size: large;
        }

        h1~ul li a:before {
            content: '# ';
            color: brown;
        }

        .subtitulo>a {
            color: black;
        }

        h3>span {
            color: brown;
        }

        h3~p {
            padding: 0 0 0 25px;
        }
    </style>

    <div class="row">
        <div class="col-md-3">
            <br>
            <ul>
                <li><a href="#acesso-login">Acesso ao Sistema Login</a></li>
                <li><a href="#user-externo">Usuário Externo</a></li>
                <li><a href="#user-externo">Usuário Externo</a></li>
            </ul>
        </div>

        <div class="col-md-9 m-7">
            <br>
            <h1>Documentação Ajuda SDC</h1>

            <div class="row p-3">
                <div class="col">
                    <label>Busca :</label>
                    <input type="text" class="form form-control" onkeyup="myFunction()" name="txtBuscaHelper" id='txtBuscaHelder' placeholder="Busca por palavrea chave">
                </div>
                <div class="col">
                    <label>Tipo de Pesquisa :</label>
                    <div class="form-check" title="O sistema fará uma busca baseado nos título dos tópicos">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Por Título
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Por Conteúdo
                        </label>
                    </div>
                </div>
            </div>
                    <p>
                    <h3># Usuários</h3>
                    </p>

                    <!-- INFO USUÁRIO INTERNO -->
                    <div class="row">
                        <div class="col m-5" id='user-interno'>
                            <ul id="myUL">
                                <li><a href="#">
                                        <h3 id='cad-user-interno'><span>#</span>Cadastro de Usuário Interno</h3>
                                    </a>

                                    <p>1-Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                        the
                                        industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                        type and
                                        scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                                        leap
                                        into electronic typesetting, remaining essentially unchanged.
                                    </p>

                                </li>
                                <li><a href="#">Agnes</a></li>

                                <li><a href="#">Billy</a></li>
                                <li><a href="#">Bob</a></li>

                                <li><a href="#">Calvin</a></li>
                                <li><a href="#">Christina</a></li>
                                <li><a href="#">Cindy</a></li>
                            </ul>


                            <h3 id='alt-user-interno'><span>#</span> Alteração dados Usuário Interno</h3>
                            <p>2-Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                the
                                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                type and
                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                                leap
                                into electronic typesetting, remaining essentially unchanged. </p>

                            <h3 id='alt-senha-user-interno'><span>#</span> Mudança Senha Usuário Interno</h3>
                            <p>3-Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                the
                                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                type and
                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                                leap
                                into electronic typesetting, remaining essentially unchanged. </p>
                        </div>
                    </div>

                    <!-- INFO USUÁRIO EXTERNO -->
                    <div class="row">
                        <div class="col m-5" id="user-externo">
                            <h3 id='cad-user-externo'><span>#</span> Cadastro de Usuário Externo</h3>
                            <p>4-Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                the
                                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                type and
                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                                leap
                                into electronic typesetting, remaining essentially unchanged. </p>
                            <h3 id='alt-user-externo'><span>#</span> Alteração dados Usuário Interno</h3>
                            <p>5-Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                the
                                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                type and
                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                                leap
                                into electronic typesetting, remaining essentially unchanged. </p>

                            <h3 id='alt-senha-user-externo'><span>#</span> Mudança Senha Usuário Interno</h3>
                            <p>6-Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                the
                                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                type and
                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                                leap
                                into electronic typesetting, remaining essentially unchanged. </p>
                        </div>
                    </div>
                </div>




</x-app-layout>



<script>
    function myFunction() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('txtBuscaHelder');
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName('li');
        console.log(li[0]);


        // Loop through all list items, and hide those who don't match the search query
        // for (i = 0; i < li.length; i++) {
        //     span = li[i].getElementsByTagName("span")[0];
        //     txtValue = span.textContent || span.innerText;
        //     if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //         li[i].style.display = "";
        //     } else {
        //         li[i].style.display = "none";
        //     }
        // }
    }
</script>
