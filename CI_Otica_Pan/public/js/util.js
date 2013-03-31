//Funções que pesqusam diretamente na pagina

function openAjax() {
    var Ajax;
    try {Ajax = new XMLHttpRequest(); // XMLHttpRequest para browsers mais populares, como: Firefox, Safari, dentre outros.
    }catch(ee){
    try {Ajax = new ActiveXObject("Msxml2.XMLHTTP"); // Para o IE da MS
    }catch(e){
    try {Ajax = new ActiveXObject("Microsoft.XMLHTTP"); // Para o IE da MS
    }catch(e){Ajax = false;}
    }
    }
    return Ajax;
} 

function carregaAjax(div, getURL) {

    document.getElementById(div).style.display = "block";
    if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
        var exibeResultado = document.getElementById(div); // div que exibirá o resultado.
        var Ajax = openAjax(); // Inicia o Ajax.
        Ajax.open("GET", getURL, true); // fazendo a requisição
        Ajax.onreadystatechange = function(){
            if(Ajax.readyState == 1) { // Quando estiver carregando, exibe: carregando...
                exibeResultado.innerHTML = "<div>Carregando</div>";
            }
            if(Ajax.readyState == 4) { // Quando estiver tudo pronto.
                if(Ajax.status == 200) {
                    var resultado = Ajax.responseText; // Coloca o retornado pelo Ajax nessa variável
                    //resultado = resultado.replace(/\+/g,""); // Resolve o problema dos acentos (saiba mais aqui: http://www.plugsites.net/leandro/?p=4)
                    //resultado = resultado.replace(/ã/g,"a");
                    resultado = unescape(resultado); // Resolve o problema dos acentos
                    exibeResultado.innerHTML = resultado;
                } else {
                    exibeResultado.innerHTML = "Por favor, tente novamente!";
                }
            }
        }
    Ajax.send(null); // submete
    }
}

//adiciona mascara de cnpj
function MascaraCNPJ(cnpj){
	if(mascaraInteiro(cnpj)==false){
            event.returnValue = false;
	}	
        return formataCampo(cnpj, '00.000.000/0000-00', event);
}

//adiciona mascara de cep
function MascaraCep(cep){
	if(mascaraInteiro(cep)==false){
            event.returnValue = false;
	}	
	return formataCampo(cep, '00000-000', event);
}

//adiciona mascara de data
function MascaraData(data){
	if(mascaraInteiro(data)==false){
		event.returnValue = false;
	}	
	return formataCampo(data, '00/00/0000', event);
}

//adiciona mascara ao telefone
function MascaraTelefone(tel){	
	if(mascaraInteiro(tel)==false){
		event.returnValue = false;
	}	
	return formataCampo(tel, '(00) 0000-0000', event);
}

//adiciona mascara ao CPF
function MascaraCPF(cpf){
	if(mascaraInteiro(cpf)==false){
		event.returnValue = false;
	}	
	return formataCampo(cpf, '000.000.000-00', event);
}

//valida numero inteiro com mascara
function mascaraInteiro(){
	if (event.keyCode < 48 || event.keyCode > 57){
		event.returnValue = false;
                return false;
	}
	return true;
}

//formata de forma generica os campos
function formataCampo(campo, Mascara, evento) { 
	var boleanoMascara; 
	
	var Digitato = evento.keyCode;
	exp = /\-|\.|\/|\(|\)| /g
	campoSoNumeros = campo.value.toString().replace( exp, "" ); 
   
	var posicaoCampo = 0;	 
	var NovoValorCampo="";
	var TamanhoMascara = campoSoNumeros.length;; 
	
	if (Digitato != 8) { // backspace 
		for(i=0; i<= TamanhoMascara; i++) { 
			boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
								|| (Mascara.charAt(i) == "/")) 
			boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(") 
								|| (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " ")) 
			if (boleanoMascara) { 
				NovoValorCampo += Mascara.charAt(i); 
				  TamanhoMascara++;
			}else { 
				NovoValorCampo += campoSoNumeros.charAt(posicaoCampo); 
				posicaoCampo++; 
			  }	   	 
		  }	 
		campo.value = NovoValorCampo;
		  return true; 
	}else { 
		return true; 
	}
}