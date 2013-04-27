<?php


echo"<div class=formulario>";
echo"<h2>$titulo</h2>";

$id_cliente = $this->uri->segment(3);

if($id_cliente == NULL){
    
    redirect ('cliente/listarClientes');
    
}

$query = $this->cliente_model->retornaCliente($id_cliente);

if($this->session->flashdata('statusUpdate')){
    $msg = $this->session->flashdata('statusUpdate');
    echo "<body onLoad=\" alert('$msg');\">";
}


echo form_open("cliente/atualizarCliente/$id_cliente");


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
echo form_input(array('name'=>'nome'),  set_value('nome',$query['pessoa']->nome),'maxlength="100" autocomplete ="off" placeholder="Nome Completo do Cliete" autofocus style="width:300px;"');
echo form_error('nome');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Email');
echo"</td><td>";//Essa linha pode remover
echo form_input(array('name'=>'email'),set_value('email',$query['pessoa']->email),'maxlength="100" autocomplete ="off" placeholder="exemplo@exemplo.com.br" style="width:300px;"');
echo form_error('email');
echo"<tr><td>";//Essa linha pode remover
echo form_label('CPF');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cpf'),  set_value('cpf',$query['cliente']->cpf),'maxlength="14" autocomplete ="off" placeholder="XXX.XXX.XXX-XX" OnKeyPress="MascaraCPF(this)"');
echo form_error('cpf');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Data Nascimento');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'data_nascimento'),  set_value('data_nascimento',$this->util->data_mysql_para_user($query['cliente']->data_nascimento)),'maxlength="10" autocomplete ="off" placeholder="DD/MM/AAAA" OnKeyPress="MascaraData(this)"');
echo form_error('data_nascimento');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone Residencial');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone1'),  set_value('num_telefone1',$query['telefone'][0]->num_telefone),'maxlength="14" autocomplete ="off" placeholder="(XX)XXXX-XXXX" OnKeyPress="MascaraTelefone(this)"');
echo form_label('Telefone Celular');
echo form_input(array('name'=>'num_telefone2'),  set_value('num_telefone2',$query['telefone'][1]->num_telefone),'maxlength="15" autocomplete ="off" placeholder="(XX)XXXX-XXXXX" OnKeyPress="MascaraTelefone(this)"');
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
echo form_input(array('name'=>'rua'),  set_value('rua',$query['endereco']->logradouro),'maxlength="80" autocomplete ="off" placeholder="Exemplo: Av Paulista, 2000" style="width:425px;"');
echo form_error('rua');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Bairro');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'bairro'),  set_value('bairro',$query['endereco']->bairro),'maxlength="50" autocomplete ="off" placeholder="Exemplo: Jardim Paulista"');
echo form_error('bairro');
echo form_label('Complemento');
echo form_input(array('name'=>'complemento'),  set_value('complemento',$query['endereco']->complemento),'maxlength="20" autocomplete ="off" placeholder="Exemplo: Apt./Cj./Bloco"');
echo form_error('complemento');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Cidade');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cidade'),  set_value('cidade',$query['endereco']->cidade),'maxlength="50" autocomplete ="off" placeholder="Exemplo: São Paulo, 2000"');
echo form_error('cidade');
echo form_label('Estado','',array('style' => 'padding-right: 45px;',));
echo form_dropdown('estado', $options, set_value('estado',$query['endereco']->estado));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('CEP');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cep'),  set_value('cep',$query['endereco']->cep),'maxlength="9" autocomplete ="off" placeholder="XXXXX-XXX" OnKeyPress="MascaraCep(this)"');
echo form_error('Cep');
echo"</td></tr>";//Essa linha pode remover


echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover
echo form_submit(array('name'=>'Alterar'),'Alterar');
echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover
echo"</fildset>";

echo form_hidden('id_pessoa',$query['cliente']->id_pessoa);//Campo oculto que armazena id_pessoa
echo form_hidden('id_cliente',$id_cliente);//Campo oculto que armazena id_cliente
echo form_close();

?>
