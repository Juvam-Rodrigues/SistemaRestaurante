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
let clicou = false;
document.getElementById('olho').onmousedown = function() {
    if(!clicou){
        document.getElementById('senha').type = 'text';
        clicou = true;
    }
    else{
        document.getElementById('senha').type = 'password';
        clicou = false;

    }
    
  };
   