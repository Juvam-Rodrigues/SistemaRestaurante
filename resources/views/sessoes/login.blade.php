<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>Login</title>
</head>

<body>
    <header>
        <img src="" alt="">
        <a href="/" class="conteudoHeader">Login</a>
        <a href="/registro" class="conteudoHeader">Registrar</a>
    </header>
    
        <form action="/logar" method="POST" id="formlogin">
            {{ csrf_field() }}

            <h1>Login</h1>
            <input type="email" name="email" id="email" placeholder="Digite seu email" required>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
            <button type="submit" id="enviar">Entrar</button>
        </form>
    </div>

</body>

</html>
