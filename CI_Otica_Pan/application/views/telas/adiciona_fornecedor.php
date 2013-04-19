<?php

echo"<div class=formulario>";
echo"<h2>$titulo</h2>";

if($this->session->flashdata('cadastrook')){
    $msg = $this->session->flashdata('cadastrook');
    echo "<body onLoad=\" alert('$msg');\">";
}

echo form_open('fornecedor/adiciona');


echo"<fieldset>";
echo"<legend>Dados Básicos:</legend>";
echo"<table>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Nome');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'nome'),  set_value('nome'),'autocomplete ="off" placeholder="Nome Completo do Fornecedor" autofocus style="width:300px;"');
echo form_error('nome');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Email');
echo"</td><td>";//Essa linha pode remover
echo form_input(array('name'=>'email'),set_value('email'),'autocomplete ="off" placeholder="exemplo@exemplo.com.br" style="width:300px;"');
echo form_error('email');
echo"<tr><td>";//Essa linha pode remover
echo form_label('CNPJ');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cnpj'),  set_value('cnpj'),'autocomplete ="off" placeholder="XX.XXX.XXX/XXXX-XX" OnKeyPress="MascaraCNPJ(this)"');
echo form_error('cnpj');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone Fixo');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone1'),  set_value('num_telefone1'),'autocomplete ="off" placeholder="(XX)XXXX-XXXX" OnKeyPress="MascaraTelefone(this)"');
echo form_error('num_telefone1');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone Celular');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone2'),  set_value('num_telefone2'),'autocomplete ="off" placeholder="(XX)XXXX-XXXXX" OnKeyPress="MascaraTelefone(this)"');
echo form_error('num_telefone2');
echo"</td></tr>";//Essa linha pode remove

echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover
echo form_submit(array('name'=>'Cadastrar'),'Cadastrar');
echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover
echo form_close();
echo"</fieldset>";
?>
