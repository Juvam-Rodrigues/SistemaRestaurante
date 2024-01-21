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
                <div class="divTextoMesasComandas">
                    <p class="textoMesasComandas">Mesas</p>
                </div>

                <div class="divBotaoModal"><!-- Button trigger modal -->
                    <button class="btn btn-success botaoModal" data-bs-toggle="modal"
                        data-bs-target="#modalAdicionarMesa">
                        Adicionar nova mesa
                    </button>
                </div>
            </div>

            <!-- Modal de adicionar mesa -->
            <div class="modal fade" id="modalAdicionarMesa" tabindex="-1" aria-labelledby="modalAdicionarMesaLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar mesa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/mesas/adicionar" method="post">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <label for="mumero_mesa">Insira o número da nova mesa:</label>
                                <input type="text" class="form-control" id="numero" name="numero" required>
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
                    <div class="card text-center" style="width: 18rem;">
                        <div class="card-body">

                            <!-- varrer as mesas aqui -->
                            <p>{{ $mesa->numero }}</p>
                            <div>
                                <a href="#" class="btn btn-primary botaoAcessar">Acessar mesa</a>
                                <a href="#" class="btn btn-danger">Apagar mesa</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="containerComandas">
            <div class="divSuperior">
                <div class="divTextoMesasComandas">
                    <p class="textoMesasComandas">Comandas</p>
                </div>
                <div class="divBotaoModal"><!-- Button trigger modal -->
                    <button class="btn btn-success botaoModal" data-bs-toggle="modal"
                        data-bs-target="#modalAdicionarComanda">
                        Adicionar nova comanda
                    </button>
                </div>
            </div>

            <!-- Modal de adicionar comandas -->
            <div class="modal fade" id="modalAdicionarComanda" tabindex="-1"
                aria-labelledby="modalAdicionarComandaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar comanda</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/comandas/adicionar" method="post">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <label for="mumero_mesa">Insira o nome da nova comanda:</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Adicionar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="divInferior">
                    <!-- varrer as comadas-->
                </div>
            </div>

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
