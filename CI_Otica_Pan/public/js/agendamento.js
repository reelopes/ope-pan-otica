function agendaCliente(idCliente,nome,cpf) {
    
    ocultaPesquisaDinamica();
    mostraFormAgendamento(idCliente,nome,cpf);
        
}

function mostraFormAgendamento(idCliente,nome,cpf) {
    
    var elem = document.getElementById("formAgendamento");
    var inputIdCliente = document.getElementById("inputIdCliente");
    var inputNome = document.getElementById("inputNome");
    var inputcpf = document.getElementById("inputCpf");
    elem.style.display = "block";
    
    inputIdCliente.value=idCliente;
    inputNome.value=nome;
    inputcpf.value=cpf;
    
    
    
    
    
    
}

function ocultaPesquisaDinamica() {
    var elem = document.getElementById("pesquisaDinamica");
    elem.style.display = "none";
}

function ocultaFormAgendamento() {
    var elem = document.getElementById("formAgendamento");
    elem.style.display = "none";
}