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
    <link rel="stylesheet" href="{{ asset('css/stylerelatorio.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>

    <title>Sistema</title>
</head>

<body>
    <div class="row d-flex justify-content-center divHeader">
        <div class="col-9">
            <header>
                <div id="divLogo">
                    <img src="{{ asset('img/LOGO.png') }}" alt="Logo do Restaurante Dos Irmãos" width="90px"
                        height="90px" id="logo">
                    <p>Restaurante Dos Irmãos</p>
                </div>
                <a href="#" class="conteudoHeader">Sobre a empresa</a>
                <a href="/relatorio/vendas" class="conteudoHeader">Relatórios de vendas</a>
                <div class="submenu-trigger btn conteudoHeader" id="submenu-trigger" onclick="submenuAbrir()">
                    <span id="nomeUsuario"> {{ session()->get('usuario')->nome }} </span>
                    <div class="submenu" id="submenu">
                        <a href="/deslogar">Deslogar</a>
                    </div>
                </div>
        </div>
        </header>
    </div>

    @include('msg/flash-msg')

    <div class="row d-flex justify-content-center">
        <div class="col-11 container">
            <div class="row pt-2 pb-3">
                <div class="col-1 d-flex justify-content-start align-items-center">
                    <img src="{{ asset('img/volte.png') }}" alt="seta de voltar" width="20px" height="20px">
                    <a href="/relatorio/vendas"
                        class="ms-3 link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Voltar</a>
                </div>
                <div class="col-11 d-flex justify-content-center">
                    <span style="font-size: 1.5rem"><strong>Lista
                            de comandas guardadas</strong></span>
                </div>
            </div>
            <table class="table table-hover table-bordered border-dark">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comandas as $comanda)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($comanda->updated_at)->format('d/m/Y') }}</td>
                            <td>{{ $comanda->nome }}</td>
                            <td>R$ {{ $comanda->valor }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="row divFooter">
        <footer class="col-12">
            <div class="creditos">
                <p>Todos direitos reservado a <br>
                    <strong>Juvam Rodrigues do Nascimento Neto.</strong>
                </p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>
