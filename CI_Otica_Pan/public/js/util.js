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
                
        exp = /\-|\.|\/|\(|\)|\,|\:| /g
	campoSoNumeros = tel.value.toString().replace( exp, "" ); 
               
        
        if(campoSoNumeros.length===11){
        return formataCampo(tel, '(00) 00000-0000', event);
        }else{
	return formataCampo(tel, '(00) 0000-0000', event);
        }
}

//cria mascara para Reais
function FormataReais(fld, milSep, decSep, e) {
var sep = 0;
var key = '';
var i = j = 0;
var len = len2 = 0;
var strCheck = '0123456789';
var aux = aux2 = '';
var whichCode = (window.Event) ? e.which : e.keyCode;
if (whichCode == 13) return true;
key = String.fromCharCode(whichCode);  // Valor para o código da Chave
if (strCheck.indexOf(key) == -1) return false;  // Chave inválida
len = fld.value.length;
for(i = 0; i < len; i++)
if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
aux = '';
for(; i < len; i++)
if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
aux += key;
len = aux.length;
if (len == 0) fld.value = '';
if (len == 1) fld.value = '0'+ decSep + '0' + aux;
if (len == 2) fld.value = '0'+ decSep + aux;
if (len > 2) {
aux2 = '';
for (j = 0, i = len - 3; i >= 0; i--) {
if (j == 3) {
aux2 += milSep;
j = 0;
}
aux2 += aux.charAt(i);
j++;
}
fld.value = '';
len2 = aux2.length;
for (i = len2 - 1; i >= 0; i--)
fld.value += aux2.charAt(i);
fld.value += decSep + aux.substr(len - 2, len);
}
return false;
}

//adiciona mascara ao preco
function MascaraPreco(preco){	
	if(mascaraInteiro(preco)==false){
		event.returnValue = false;
	}
	return formataCampo(preco, '0000.00', event);
}

//adiciona mascara ao CPF
function MascaraCPF(cpf){
	if(mascaraInteiro(cpf)==false){
		event.returnValue = false;
	}	
	return formataCampo(cpf, '000.000.000-00', event);
}
function MascaraHorario(horario){
	if(mascaraInteiro(horario)==false){
		event.returnValue = false;
	}	
	return formataCampo(horario, '00:00', event);
}


function ValidarCPF(Objcpf){
	var cpf = Objcpf.value;
	exp = /\.|\-/g
	cpf = cpf.toString().replace( exp, "" ); 
	var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
	var soma1=0, soma2=0;
	var vlr =11;
	
	for(i=0;i<9;i++){
		soma1+=eval(cpf.charAt(i)*(vlr-1));
		soma2+=eval(cpf.charAt(i)*vlr);
		vlr--;
	}	
	soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
	soma2=(((soma2+(2*soma1))*10)%11);
	
	var digitoGerado=(soma1*10)+soma2;
	if(digitoGerado!=digitoDigitado)	
		alert('CPF Invalido!');		
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
	exp = /\-|\.|\/|\(|\)|\,|\:| /g
	campoSoNumeros = campo.value.toString().replace( exp, "" ); 
   
	var posicaoCampo = 0;	 
	var NovoValorCampo="";
	var TamanhoMascara = campoSoNumeros.length;
	
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


function abrirPopUp(url,width,height) {

    var left = (screen.width  - width)/2;
    var top = (screen.height - height)/2;
    
   window.open(url,'janela', 'left='+left+',width='+width+', height='+height+', top='+top+', scrollbars=yes, status=no, toolbar=no, location=yes, directories=no, menubar=no, resizable=no, fullscreen=no'); 

}