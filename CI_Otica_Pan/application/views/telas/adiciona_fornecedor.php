<?php


echo"<h2>$titulo</h2>";



echo validation_errors('<p>','</p>');

if($this->session->flashdata('cadastrook')){
    
    echo '<p>'.$this->session->flashdata('cadastrook').'</p>';
}

echo form_open('fornecedor/adiciona');

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
echo form_label('Cnpj');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cnpj'),  set_value('cnpj'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone Fixo');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone1'),  set_value('num_telefone1'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone Celular');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone2'),  set_value('num_telefone2'));
echo"</td></tr>";//Essa linha pode remove

echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover
echo form_submit(array('name'=>'Cadastrar'),'Cadastrar');
echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover
echo form_close();

?>
