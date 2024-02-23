
function processarPagamento() {
    // Capturar os valores selecionados
    var metodoPagamento = document.getElementById('metodo_pagamento').value;
    var comandaID = document.getElementById('comanda_id').value;
    var desconto = document.getElementById('desconto').value;

    // Construir a URL com os parâmetros
    document.location.href = '/comandas/pagamento/' +encodeURIComponent(comandaID)+ '/' + encodeURIComponent(metodoPagamento)+ '/' + encodeURIComponent(desconto);

}