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
    <link rel="stylesheet" href="{{ asset('css/styledentrocomanda.css') }}">

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
                            <p><strong>Comanda de:</strong> {{ $comanda->nome }}</p>
                            <p><strong>Mesa:</strong> {{ $mesa->numero }}</p>
                        </div>
                        <div class="col-6">
                            <p><strong>Valor: R${{ $comanda->valor }}.</strong></p>
                            @if ($comanda->status === 0)
                                <p><strong>Status:</strong> Não pago.</p>
                            @elseif($comanda->status === 1)
                                <p><strong>Status:</strong> Pago.</p>
                            @endif
                        </div>
                    </div>

                </div>
                <div id="divProdutosComanda" class="col-8">
                    <div class="row border-bottom border-dark">
                        <div class="divSuperior col-12">
                            <div class="divTextoProduto">
                                <p class="textoProduto">Produtos</p>
                            </div>
                            <div class="divBotaoModal">
                                <button class="btn btn-success botaoModal" data-bs-toggle="modal"
                                    data-bs-target="#modalAdicionarProduto">
                                    Adicionar produto no catálogo
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="divConteudoSecoes col-12">
                            
                        </div>
                    </div>
                </div>


            </div>


            <!-- Modal de adicionar produto no catálogo de produtos-->
            <div class="modal fade" id="modalAdicionarProduto" tabindex="-1"
                aria-labelledby="modalAdicionarProdutoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar produto no
                                catálogo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form action="/produtos/adicionar" method="post">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nome" class="form-label">Insira o nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Insira a
                                        descrição:</label>
                                    <textarea class="form-control" id="descricao" name="descricao" rows="5"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="categoria" class="form-label">Selecione a Categoria:</label>
                                    <select class="form-select" id="categoria" name="categoria" required>
                                        <option value="Almoço/Quentinha">Almoço/Quentinha</option>
                                        <option value="CafeDaManha">Café da manhã</option>
                                        <option value="Bebidas">Bebidas</option>
                                        <option value="Sobremesas">Sobremesas</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="valor" class="form-label">Insira o valor unitário:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="number" step="0.01" class="form-control" id="preco"
                                            name="preco" required>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Adicionar</button>
                            </div>
                        </form>
                    </div>
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
