function agendaCliente(idCliente,nome,cpf) {
    ocultaPesquisaDinamica();
    var link = window.location.toString()+'/'+idCliente;
    var contador=0;
    for(i=0; i< link.length; i++){
        if(link[i] === "/"){
            contador++;
        }
   }
   if(contador===10)window.location.href = window.location.toString()+'/'+idCliente;
   if(contador > 10)window.location.href = window.location.toString()+'/../'+idCliente;

    mostraFormAgendamento();
        
}

function mostraFormAgendamento() {
    
    var elem = document.getElementById("formAgendamento");
    elem.style.display = "block";
   
}

function ocultaPesquisaDinamica() {
    var elem = document.getElementById("pesquisaDinamica");
    elem.style.display = "none";
}

function ocultaFormAgendamento() {
    var elem = document.getElementById("formAgendamento");
    elem.style.display = "none";
}