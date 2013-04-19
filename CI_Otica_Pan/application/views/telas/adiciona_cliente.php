<?php

echo"<div class=formulario>";
echo"<h2>$titulo</h2>";

if($this->session->flashdata('cadastrook')){
    $msg = $this->session->flashdata('cadastrook');
    echo "<body onLoad=\" alert('$msg');\">";
}

echo form_open('cliente/cadastrarCliente');

//Tratamento do Select de estado
$options = array(
'AC' => 'AC',
'AL' => 'AL',
'AP' => 'AP',
'AM' => 'AM',
'BA' => 'BA',
'CE' => 'CE',
'DF' => 'DF',
'ES' => 'ES',
'GO' => 'GO',
'MA' => 'MA',
'MT' => 'MT',
'MS' => 'MS',
'MG' => 'MG',
'PA' => 'PA',
'PB' => 'PB',
'PR' => 'PR',
'PE' => 'PE',
'PI' => 'PI',
'RJ' => 'RJ',
'RN' => 'RN',
'RS' => 'RS',
'RO' => 'RO',
'RR' => 'RR',
'SC' => 'SC',
'SP' => 'SP',
'SE' => 'SE',
'TO' => 'TO',
    );
if(set_value('estado')==NULL){
    $setValueEstado='SP';
}else{
    $setValueEstado=set_value('estado');
}


echo"<fieldset>";
echo"<legend>Dados Pessoais:</legend>";
echo"<table>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Nome');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'nome'),  set_value('nome'),'autocomplete ="off" placeholder="Nome Completo do Cliete" autofocus style="width:300px;"');
echo form_error('nome');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Email');
echo"</td><td>";//Essa linha pode remover
echo form_input(array('name'=>'email'),set_value('email'),'autocomplete ="off" placeholder="exemplo@exemplo.com.br" style="width:300px;"');
echo form_error('email');
echo"<tr><td>";//Essa linha pode remover
echo form_label('CPF');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cpf'),  set_value('cpf'),'autocomplete ="off" placeholder="XXX.XXX.XXX-XX" OnKeyPress="MascaraCPF(this)"');
echo form_error('cpf');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Data de Nascimento');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'data_nascimento'),  set_value('data_nascimento'),'autocomplete ="off" placeholder="DD/MM/AAAA" OnKeyPress="MascaraData(this)"');
echo form_error('data_nascimento');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone Residencial');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone1'),  set_value('num_telefone1'),'autocomplete ="off" placeholder="(XX)XXXX-XXXX" OnKeyPress="MascaraTelefone(this)"');
echo form_label('Telefone Celular');
echo form_input(array('name'=>'num_telefone2'),  set_value('num_telefone2'),'autocomplete ="off" placeholder="(XX)XXXX-XXXXX" OnKeyPress="MascaraTelefone(this)"');
echo"</td></tr>";//Essa linha pode remover
echo"</table>";
echo form_error('num_telefone1');
echo"<br>";
echo form_error('num_telefone2');
echo"</fieldset>";
echo"<fieldset>";
echo"<legend>Endereço:</legend>";
echo"<table>";
echo"<tr><td>";//Essa linha pode remover
echo form_label('Logradouro');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'rua'),  set_value('rua'),'autocomplete ="off" placeholder="Exemplo: Av Paulista, 2000" style="width:425px;"');
echo form_error('rua');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Bairro');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'bairro'),  set_value('bairro'),'autocomplete ="off" placeholder="Exemplo: Jardim Paulista"');
echo form_error('bairro');
echo form_label('Complemento');
echo form_input(array('name'=>'complemento'),  set_value('complemento'),'autocomplete ="off" placeholder="Exemplo: Apt./Cj./Bloco"');
echo form_error('complemento');
echo"</td></tr>";//Essa linha pode remover

echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Cidade');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cidade'),  set_value('cidade'),'autocomplete ="off" placeholder="Exemplo: São Paulo, 2000"');
echo form_error('cidade');
echo form_label('Estado','',array('style' => 'padding-right: 45px;',));
echo form_dropdown('estado', $options, $setValueEstado);

echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('CEP');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cep'),  set_value('cep'),'autocomplete ="off" placeholder="XXXXX-XXX" OnKeyPress="MascaraCep(this)"');
echo form_error('cep');
echo"</td></tr>";//Essa linha pode remover


echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover
echo form_submit(array('name'=>'Cadastrar'),'Cadastrar');
echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover
echo"</fieldset>";

echo form_close();

?>
