<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="{{ asset('img/LOGO.png') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/stylesistema.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>

    <title>Sistema</title>
</head>

<body>
    <header>
        <div id="divLogo">
            <img src="{{ asset('img/LOGO.png') }}" alt="Logo do Restaurante Dos Irmãos" width="90px" height="90px"
                id="logo">
            <p>Restaurante Dos Irmãos</p>
        </div>
        <a href="#" class="conteudoHeader">Sobre a empresa</a>
        <div class="submenu-trigger btn conteudoHeader" id="submenu-trigger" onclick="submenuAbrir()">
            <span id="nomeUsuario"> {{ session()->get('usuario')->nome }} </span>
            <div class="submenu" id="submenu">
                <a href="/deslogar">Deslogar</a>
            </div>
        </div>
    </header>

    <div class="container">
        @if (isset($comanda) && isset($mesa))
            <div class="row">
                <div id="divDescricaoComanda" class="col-4">
                    <div class="row">
                        <div class="col-6">
                            <p>Comanda de: {{ $comanda->nome }}</p>
                            <p>Mesa: {{ $mesa->numero }}</p>
                        </div>
                        <div class="col-6">
                            <p>Valor: R${{ $comanda->valor }}.</p>
                            @if ($comanda->status === 0)
                                <p>Status: Não pago.</p>
                            @elseif($comanda->status === 1)
                                <p>Status: Pago.</p>
                            @endif
                        </div>
                    </div>

                </div>
                <div id="divProdutosComanda" class="col-8">

                </div>

            </div>
        @endif
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
