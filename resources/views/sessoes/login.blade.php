<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="img/LOGO.png">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/stylelogin.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>

    <title>Login</title>
</head>

<body>
    <div class="row d-flex justify-content-center divHeader pt-1 pb-1">
        <div class="col-4">
            <header>
                <div id="divLogo">
                    <img src="{{ asset('img/LOGO.png') }}" alt="Logo do Restaurante Dos Irmãos" width="90px"
                        height="90px" id="logo">
                    <p>Restaurante Dos Irmãos</p>
                </div>
                <a href="/" class="conteudoHeader">Login</a>
            </header>
        </div>
    </div>


    @include('msg/flash-msg')

    <div class="row">
        <div id="container" class="col-10">
            <div id="divImagem-login">
                <img src="img/LoginNordestino.png" alt="login-de-usuario.png" width="200px" height="200x">
            </div>
            <div id="divForm">
                <form action="/logar" method="POST" id="formlogin">
                    {{ csrf_field() }}

                    <h1>Login</h1>
                    <input type="email" name="email" id="email" placeholder="Digite seu email" required>
                    <div style="position: relative">
                        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
                        <img src="img/olho.png" alt="" id="olho">
                    </div>
                    <button type="submit" id="enviar" class="btn">Entrar</button>
                </form>
            </div>
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
