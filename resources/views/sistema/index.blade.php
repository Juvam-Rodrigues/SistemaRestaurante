<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="img/LOGO.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/stylesistema.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>

    <title>Sistema</title>
</head>

<body>
    <header>
        <div id="divLogo">
            <img src="img/LOGO.png" alt="Logo do Restaurante Dos Irmãos" width="90px" height="90px" id="logo">
            <p>Restaurante Dos Irmãos</p>
        </div>
        <a href="#" class="conteudoHeader">Sobre a empresa</a>
        <div class="submenu-trigger btn conteudoHeader" id="submenu-trigger" onclick="submenuAbrir()">
            <span> {{ session()->get('usuario')->nome }} </span>
            <div class="submenu" id="submenu">
                <a href="/deslogar">Deslogar</a>
            </div>
        </div>
    </header>

    <div id="container">

        <div id="divContainerMesas">

            <div class="divSuperior">
                <p class="textoMesasComandas">Mesas</p>

                <!-- Button trigger modal -->
                <button class="btn btn-primary botaoModal" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Adicionar nova mesa
                </button>
            </div>

            <!-- Modal de adicionar mesa -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Mesa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/mesas/adicionar" method="post">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <label for="mumero_mesa">Insira o número da nova mesa:</label>
                                <input type="text" class="form-control" id="numero" name="numero">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Adicionar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="divInferior">
                @foreach (session()->get('usuario')->mesas()->get() as $mesa)
                    <!-- varrer as mesas aqui -->
                    <p>{{ $mesa->numero }}</p>
                    <!-- Substitua 'nome' pelo nome da coluna que deseja exibir -->
                @endforeach
            </div>
        </div>



        <div>
            <p>Comandas</p>
        </div>
        <div>
            <!-- varrer as comadas-->
        </div>
    </div>







    <footer>
        <div class="creditos">
            <p>Todos direitos reservado a <br>
                <strong>Juvam Rodrigues do Nascimento Neto.</strong>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>
