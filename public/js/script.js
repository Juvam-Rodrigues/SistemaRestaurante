/* Função de abrir menu do header */

let apertouMenu = false;
function submenuAbrir() {
    let submenu = document.getElementById("submenu");

    if (apertouMenu == false) {
        submenu.style.display = "block";
        apertouMenu = true;
    }
    else {
        submenu.style.display = "none";
        apertouMenu = false;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    let botaoClicadoId = localStorage.getItem('botaoClicadoId');

    if (botaoClicadoId !== null) {
        let botaoClicado = document.getElementById(botaoClicadoId);
        if (botaoClicado) {
            botaoClicado.classList.add('botaoAcessado');
        }
    }
});

function mudarCorBotao(botao) {
    let botaoClicado = document.querySelector('.botaoAcessado');

    if (botaoClicado !== null) {
        botaoClicado.classList.remove('botaoAcessado');
    }

    botao.classList.add('botaoAcessado');
    localStorage.setItem('botaoClicadoId', botao.id);
}

//Script de mostrar senha no login
document.getElementById('olho').addEventListener('mousedown', function() {
    document.getElementById('senha').type = 'text';
  });
  
  document.getElementById('olho').addEventListener('mouseup', function() {
    document.getElementById('senha').type = 'password';
  });
  
  // Para que o password não fique exposto apos mover a imagem.
  document.getElementById('olho').addEventListener('mousemove', function() {
    document.getElementById('senha').type = 'password';
  });