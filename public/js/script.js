/* Função de abrir menu do header */

let apertouMenu = false;
function submenuAbrir(){
    let submenu =  document.getElementById("submenu");
 
    if(apertouMenu == false){
        submenu.style.display = "block";
        apertouMenu = true;
    }
    else{
        submenu.style.display = "none";
        apertouMenu = false;
    }
}