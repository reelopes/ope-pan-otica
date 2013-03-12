<?php


echo"<h2>$titulo</h2>";



echo validation_errors('<p>','</p>');

if($this->session->flashdata('cadastrook')){
    
    echo '<p>'.$this->session->flashdata('cadastrook').'</p>';
}

echo form_open('cliente/cadastrarCliente');

echo"<br><center><table>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Nome');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'nome'),  set_value('nome'),'autofocus');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Email');
echo"</td><td>";//Essa linha pode remover
echo form_input(array('name'=>'email'),set_value('email'));
echo"<tr><td>";//Essa linha pode remover
echo form_label('Cpf');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cpf'),  set_value('cpf'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Data Nascimento');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'data_nascimento'),  set_value('data_nascimento'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone Casa');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone1'),  set_value('num_telefone1'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone Celular');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone2'),  set_value('num_telefone2'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Rua');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'rua'),  set_value('rua'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Bairro');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'bairro'),  set_value('bairro'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Cidade');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cidade'),  set_value('cidade'));
echo"<tr><td>";//Essa linha pode remover
echo form_label('Complemento');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'complemento'),  set_value('complemento'));
echo"</td></tr>";//Essa linha pode remover
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Estado');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'estado'),  set_value('estado'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Cep');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cep'),  set_value('cep'));
echo"</td></tr>";//Essa linha pode remover


echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover
echo form_submit(array('name'=>'Cadastrar'),'Cadastrar');
echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover
echo form_close();

?>
