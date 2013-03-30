function mostra(opcao) {
    if (opcao == 1) {
        mostraArmacao();
    } else if(opcao == 2) {
        mostraLente();
    } else {
        ocultaArmacao();
        ocultaLente();
    }
}

function mostraArmacao() {
    var elem = document.getElementById("armacao");
    elem.style.display = "block";
    ocultaLente();
}

function ocultaArmacao() {
    var elem = document.getElementById("armacao");
    elem.style.display = "none";
}

function mostraLente() {
    var elem = document.getElementById("lente");
    elem.style.display = "block";
    ocultaArmacao();
}

function ocultaLente() {
    var elem = document.getElementById("lente");
    elem.style.display = "none";
}