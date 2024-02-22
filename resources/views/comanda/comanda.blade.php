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
    @include('msg/flash-msg')

    <div class="row">
        <div class="container col-11">
            @if (isset($comanda) && isset($mesa))
                <div class="row">
                    <div class="divDescricaoComanda col-4 border-end border-dark">

                        <div class="row border-bottom border-dark">
                            <div class="col-12 d-flex justify-content-start p-2">
                                <img src="{{ asset('img/volte.png') }}" alt="seta de voltar" width="20px"
                                    height="20px">
                                <a href="/sistema"
                                    class="ms-3 link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Voltar</a>
                            </div>
                        </div>

                        <div class="row mt-5 mb-5">
                            <div class="col-6">
                                <p><strong>Comanda de:</strong> {{ $comanda->nome }}</p>
                                <p><strong>Mesa:</strong> {{ $mesa->numero }}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>Valor: R${{ $comanda->valor }}.</strong></p>
                                @if ($comanda->status === 0)
                                    <p style="color: red"><strong>Status:</strong> Não pago.</p>
                                @elseif($comanda->status === 1)
                                    <p style="color: green"><strong>Status:</strong> Pago.</p>
                                @endif
                            </div>
                        </div>

                        <div class="row border-top border-dark">
                            <div class="col-12 mt-3 mb-3">
                                <button class="btn btn-success botaoModal" data-bs-toggle="modal"
                                    data-bs-target="#modalPagarConta">Pagar</button>
                            </div>
                        </div>

                    </div>

                    <div id="divProdutosComanda" class="col-8">
                        <div class="row border-bottom border-dark">
                            <div class="divSuperior col-12 d-flex align-items-center">
                                <div class="divTextoProduto">
                                    <strong>
                                        <p class="textoProduto mb-0">Produtos disponíveis:</p>
                                    </strong>
                                </div>
                                <div class="divBotaoModal ms-auto">
                                    <!-- ms-auto para empurrar o botão para a margem direita -->
                                    <button class="btn btn-success botaoModal" data-bs-toggle="modal"
                                        data-bs-target="#modalAdicionarProduto">
                                        Adicionar produto no catálogo
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom border-dark p-3">
                            <div class="divConteudoSecoes col-12">
                                <!-- Mostrar as opções de categoria-->
                                <a href="/produtos/listar/{{ $comanda->id }}/{{ $categoria = 'AlmocoOuQuentinha' }}"
                                    class="btn btn-primary mx-3">Almoço/Quentinha</a>
                                <a href="/produtos/listar/{{ $comanda->id }}/{{ $categoria = 'CafeDaManha' }}"
                                    class="btn btn-primary mx-3">Café da manhã</a>
                                <a href="/produtos/listar/{{ $comanda->id }}/{{ $categoria = 'Bebidas' }}"
                                    class="btn btn-primary mx-3">Bebidas</a>
                                <a href="/produtos/listar/{{ $comanda->id }}/{{ $categoria = 'Sobremesas' }}"
                                    class="btn btn-primary mx-3">Sobremesas</a>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Mostrar os produtos disponíveis-->
                            @if (session('produtosPorCategoria'))
                                @foreach (session('produtosPorCategoria') as $produto)
                                    <div class="col-lg-4 col-md-4 col-sm-6 p-2" style="margin-bottom:2%">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <p>{{ $produto->nome }}</p>
                                                <div class="divBreveDescricaoLerMais">
                                                    <div class="divBreveDescricao">
                                                        <span class="breve-descricao">{{ $produto->descricao }}</span>
                                                    </div>
                                                    <div class="divLerMais">
                                                        <button
                                                            class="btn btn-link btn-sm link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDescricaoProduto{{ $produto->id }}">
                                                            Ler Mais
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="divValor">
                                                    <span><strong>Valor unitário:
                                                            R${{ $produto->preco }}</strong></span>
                                                </div>
                                                <div class="divBotoesCard mt-2">
                                                    <a href="/pedidos/adicionar/produto/{{ $produto->id }}/{{ $comanda->id }}/{{ $produto->categoria }}"
                                                        class="btn btn-primary botaoAdicionar me-2 d-flex align-items-center justify-content-center textoBotoesCard"
                                                        id="botao{{ $produto->id }}"
                                                        onclick="mudarCorBotao(this)">Adicionar produto</a>
                                                    <a href="#" class="btn btn-danger textoBotoesCard"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalApagarProduto{{ $produto->id }}">Apagar
                                                        produto da categoria</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Modal de apagar produto -->
                                    <div class="modal fade" id="modalApagarProduto{{ $produto->id }}"
                                        tabindex="-1" aria-labelledby="modalApagarLabel{{ $produto->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Apagar produto
                                                        do
                                                        catálogo</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <!-- Como esse modal é para ser ativado a partir de o id de cada produto colocamos o id no target e no modal-->
                                                <form action="/produtos/apagar/{{ $produto->id }}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <span>Você tem certeza que deseja apagar o produto:
                                                            <strong>{{ $produto->nome }}</strong>?</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Sim</button>
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal" aria-label="Close">Não</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal de descrição produto -->
                                    <div class="modal fade" id="modalDescricaoProduto{{ $produto->id }}"
                                        tabindex="-1"
                                        aria-labelledby="modalDescricaoProdutoLabel{{ $produto->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Descrição do
                                                        produto: <strong>{{ $produto->nome }}</strong></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Adicionamos uma alturma maxima a esse corpo do modal e,
                                                        caso passe fazemos uma barra de rolagem com esse overflow-y -->
                                                    <div class="d-flex justify-content-start"
                                                        style="max-height: 300px; overflow-y: auto;">
                                                        <p
                                                            style="white-space: pre-line; word-wrap: break-word; text-align: justify;">
                                                            {{ wordwrap($produto->descricao, 50, "\n", true) }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <span>O valor unitário do produto é: R$
                                                        <strong>{{ $produto->preco }}</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>


                        <!-- Produtos que foram pedidos -->
                        <div class="row border-top border-dark">
                            <div class="divSuperior col-12 d-flex justify-content-center">
                                <div class="divTextoPedido">
                                    <!-- Tem que dar esse margin bottom pois o <p> tem uma margim bottom padrão-->
                                    <strong>
                                        <p class="textoPedido mb-0">Produtos pedidos:</p>
                                    </strong>
                                </div>

                            </div>
                        </div>
                        <div class="row border-top border-dark">
                            @if (session('listaPedidos'))
                                @foreach (session('listaPedidos') as $pedido)
                                    <div class="col-lg-4 col-md-4 col-sm-6 p-2" style="margin-bottom:2%">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <p>{{ $pedido->produto->nome }}</p>
                                                <div class="divValorUnitario mb-3">
                                                    <span><strong>Valor unitário do produto:
                                                            R${{ $pedido->produto->preco }}</strong></span>
                                                </div>
                                                <div class="divValorAcumulado">
                                                    <span><strong>Valor total para o produto:
                                                            R${{ $pedido->valor_acumulado }}</strong></span>
                                                </div>
                                                <div
                                                    class="divQuantidadeDoPedido mt-3 d-flex justify-content-center align-items-center">
                                                    <span><strong>Quantidade:
                                                            {{ $pedido->quantidade }}.</strong></span>
                                                </div>
                                                <div class="divBotoesCard mt-3 d-flex justify-content-between"
                                                    style="width: 5rem">
                                                    <a href="/pedidos/adicionar/produto/{{ $pedido->produto->id }}/{{ $comanda->id }}/{{ $pedido->produto->categoria }}"
                                                        class="btn btn-success"><img
                                                            src="{{ asset('img/adicionar.png') }}" alt=""
                                                            width="25px" height="25px"></a>
                                                    <a href="/pedidos/remover/produto/{{ $pedido->produto->id }}/{{ $comanda->id }}/{{ $pedido->produto->categoria }}"
                                                        class="btn btn-danger"><img
                                                            src="{{ asset('img/excluir.png') }}" alt=""
                                                            width="25px" height="25px"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
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
                                    <option value="AlmocoOuQuentinha">Almoço/Quentinha</option>
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

        <div class="modal fade" id="modalPagarConta" tabindex="-1" aria-labelledby="modalPagarContaLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Pagar conta de {{ $comanda->nome }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="/comandas/pagar" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="mb-3">
                                <h4>Valor a ser pago: <span style="color: green;">R$ {{ $comanda->valor }}</span></h4>
                            </div>

                            <input type="hidden" name="id" value="{{ $comanda->id }}">

                            <div class="mb-5">
                                <label for="metodo_pagamento" class="form-label">Vai ser pago em:</label>
                                <select class="form-select" id="metodo_pagamento" name="metodo_pagamento" required>
                                    <option value="Dinheiro">Dinheiro</option>
                                    <option value="Cartao">Cartão</option>
                                    <option value="Pix">Pix</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <div class="divTextoPix d-flex flex-column align-items-center">
                                    <p><strong>Escanei agora!</strong></p>
                                    <img src="{{ asset('img/seta-para-baixo.png') }}" alt="" width="80px"
                                        height="80px">
                                </div>
                                <div class="divImgQrCode">
                                    <img src="{{ asset('img/qrCodePix.png') }}" alt="qrcodepix" width="220px"
                                        height="220px">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Pagar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <footer class="site-footer">
        <div class="creditos">
            <p>Todos direitos reservado a <br>
                <strong>Juvam Rodrigues do Nascimento Neto.</strong>
            </p>
        </div>
    </footer>
</body>

</html>
