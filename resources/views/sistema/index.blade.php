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

    <div id="container" class="row">

        <div class="divContainerMesa">
            <div class="row">
                <div class="divSuperior col-12">
                    <div class="divTextoMesasComandas">
                        <p class="textoMesasComandas"><strong>Mesas</strong></p>
                    </div>

                    <div class="divBotaoModal">
                        <button class="btn btn-success botaoModal" data-bs-toggle="modal"
                            data-bs-target="#modalAdicionarMesa">
                            Adicionar nova mesa
                        </button>
                    </div>
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

            <div class="row">
                <div class="divInferior" style="border-bottom: 1px solid black">
                    <div class="row col-12">
                        <!-- No loop das mesas -->
                        @foreach (session()->get('usuario')->mesas()->get() as $mesa)
                            <div class="col-lg-3 col-md-4 col-sm-6" style="margin-bottom:2%">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <p>{{ $mesa->numero }}</p>
                                        <div class="divBotoesCard">
                                            <a href="/mesas/acessar/{{ $mesa->id }}"
                                                class="btn btn-primary botaoAcessar" id="botao{{ $mesa->id }}"
                                                onclick="mudarCorBotao(this)">Acessar mesa</a>
                                            <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalApagarMesa{{ $mesa->id }}">Apagar mesa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal de apagar mesa -->
                            <div class="modal fade" id="modalApagarMesa{{ $mesa->id }}" tabindex="-1"
                                aria-labelledby="modalApagarMesaLabel{{ $mesa->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Apagar mesa</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <!-- Como esse modal é para ser ativado a partir de o id de cada mesa colocamos o id no target e no modal-->
                                        <form action="/mesas/apagar/{{ $mesa->id }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <span>Você tem certeza que deseja apagar a mesa:
                                                    {{ $mesa->numero }}?</span>
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="containerComandas">
            <div class="row">
                <div class="divSuperior col-12">
                    <div class="divTextoMesasComandas">
                        <p class="textoMesasComandas"><strong>Comandas</strong></p>
                    </div>
                    <div class="divGuardarComandas">
                        <form action="/comandas/guarda/{{ $comanda->id }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-secondary">Guardar comandas pagas</button>
                        </form>
                    </div>
                    <div class="divBotaoModal">
                        <button class="btn btn-success botaoModal" data-bs-toggle="modal"
                            data-bs-target="#modalAdicionarComanda">
                            Adicionar nova comanda
                        </button>
                    </div>
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
                                <label for="nome">Insira o nome da nova comanda:</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>

                                <label for="mesa_id">Selecione a mesa:</label>
                                <select class="form-control" id="mesa_id" name="mesa_id" required>
                                    @foreach (session()->get('usuario')->mesas()->get() as $mesa)
                                        <option value="{{ $mesa->id }}">{{ $mesa->numero }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Adicionar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="divInferior">
                    <div class="divMesaAtualTxt col-12" style="margin-bottom: 1%">
                        @if (isset($mesas))
                            <h1>Mesa atual: <span style="color: red">{{ $mesas->numero }}</span></h1>
                        @endif
                    </div>
                    <div class="row col-12">
                        @if (isset($comandas))
                            @foreach ($comandas as $comanda)
                                <div class="col-lg-3 col-md-4 col-sm-6" style="margin-bottom:2%">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <p class="card-text">{{ $comanda->nome }}</p>
                                            @if ($comanda->status === 0)
                                                <span class="mb-3 btn btn-warning">Status: Não pago</span>
                                            @elseif($comanda->status === 1)
                                                @if ($comanda->tipo_pagamento === 'Dinheiro')
                                                    <span class="mb-3 btn btn-success">Status: Pago no dinheiro.</span>
                                                @elseif ($comanda->tipo_pagamento === 'Pix')
                                                    <span class="mb-3 btn btn-success">Status: Pago no pix.</span>
                                                @elseif ($comanda->tipo_pagamento === 'Cartao')
                                                    <span class="mb-3 btn btn-success">Status: Pago no cartão.</span>
                                                @endif
                                            @endif
                                            <div class="divBotoesCard">
                                                <a href="/comandas/acessar/{{ $comanda->id }}"
                                                    class="btn btn-primary botaoAcessar">Acessar
                                                    comanda</a>
                                                <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalApagarComanda{{ $comanda->id }}">Apagar
                                                    comanda</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal de apagar comanda -->
                                <div class="modal fade" id="modalApagarComanda{{ $comanda->id }}" tabindex="-1"
                                    aria-labelledby="modalApagarComandaLabel{{ $comanda->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Apagar Comanda
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <!-- Como esse modal é para ser ativado a partir de o id de cada mesa colocamos o id no target e no modal-->
                                            <form action="/comandas/apagar/{{ $comanda->id }}" method="post">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <span>Você tem certeza que deseja apagar a comanda de:
                                                        {{ $comanda->nome }}?</span>
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
                            @endforeach
                        @endif
                    </div>
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
