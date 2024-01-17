<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="img/LOGO.png">
    <link rel="stylesheet" href="{{ asset('css/stylelogin.css') }}">
    <title>Login</title>
</head>

<body>
    <header>
        <div id="divLogo">
            <img src="img/LOGO.png" alt="Logo do Restaurante Dos Irmãos" width="90px" height="90px" id="logo">
            <p>Restaurante Dos Irmãos</p>
        </div>
        <a href="/" class="conteudoHeader">Login</a>
    </header>

    <div id="container">
        <div id="divImagem-login">
            <img src="img/LoginNordestino.png" alt="login-de-usuario.png" width="200px" height="200x">
        </div>
        <div id="divForm">
            <form action="/logar" method="POST" id="formlogin">
                {{ csrf_field() }}

                <h1>Login</h1>
                <input type="email" name="email" id="email" placeholder="Digite seu email" required>
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
                <button type="submit" id="enviar">Entrar</button>
            </form>
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
