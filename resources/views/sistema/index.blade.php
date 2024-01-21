<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="img/LOGO.png">
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
        <div>
            <p>Mesas</p>
        </div>
        
        <div>
            @foreach(session()->get('usuario')->mesas()->get() as $mesa)
            <!-- varrer as mesas aqui -->
            <p>{{ $mesa->nome }}</p>
            <!-- Substitua 'nome' pelo nome da coluna que deseja exibir -->
            @endforeach
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
            <strong>Juvam Rodrigues do Nascimento Neto.</strong></p>
        </div>
    </footer>


</body>

</html>
