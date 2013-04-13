<?php

echo"<h2>$titulo</h2>";

echo validation_errors('<p>','</p>');

if($this->session->flashdata('cadastrook')){
    
    echo '<p>'.$this->session->flashdata('cadastrook').'</p>';
}

echo form_open('tipo_lente/adiciona');

echo"<center><table>";
echo"<tr><td>";
echo form_label('Tipo');
echo"</td><td>";
echo form_input(array('name'=>'tipo'),  set_value('tipo'));
echo"</td></tr>";
echo"<tr><td>";

echo"<td>"; 
echo form_submit('', 'Cadastrar');
echo"</td><tr>"; 
echo"</table>"; 

echo form_close();

?>
