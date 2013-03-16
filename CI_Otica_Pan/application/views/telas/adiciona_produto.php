<?php


echo"<h2>$titulo</h2>";



echo validation_errors('<p>','</p>');

if($this->session->flashdata('cadastrook')){
    
    echo '<p>'.$this->session->flashdata('cadastrook').'</p>';
}

echo form_open('produto/adiciona');

echo"<br><center><table>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Código de Barra');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cod_barra'),  set_value('cod_barra'),'autofocus');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Data de Entrega');
echo"</td><td>";//Essa linha pode remover
echo form_input(array('name'=>'data_entrega'),set_value('data_entrega'));
echo"<tr><td>";//Essa linha pode remover
echo form_label('Descrição');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'descricao'),  set_value('descricao'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Preço');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'preco'),  set_value('preco'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Quantidade');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'quantidade'),  set_value('quantidade'));
echo"</td></tr>";//Essa linha pode remove
echo"<tr><td>";//Essa linha pode remover
echo form_label('Status');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'status'),  set_value('status'));
echo"</td></tr>";//Essa linha pode remove
echo"<tr><td>";//Essa linha pode remover
echo form_label('Validade');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'validade'),  set_value('validade'));
echo"</td></tr>";//Essa linha pode remove

echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover
echo form_submit(array('name'=>'Cadastrar'),'Cadastrar');
echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover
echo form_close();

?>
