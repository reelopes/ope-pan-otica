<?php

echo"<h2>$titulo</h2>";

echo validation_errors('<p>','</p>');

if($this->session->flashdata('cadastrook')){
    
    echo '<p>'.$this->session->flashdata('cadastrook').'</p>';
}

echo form_open('usuario/adiciona');

$nivel = $this->nivel_model->getAll()->result();

echo"<br><center><table>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Login');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'login'),  set_value('login'),'autofocus');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Email');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'email'),  set_value('email'),'autofocus');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Senha');
echo"</td><td>"; //Essa linha pode remover
echo form_password(array('name'=>'senha'),  set_value('senha'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Confirme a Senha');
echo"</td><td>"; //Essa linha pode remover
echo form_password(array('name'=>'senha_confirma'), set_value('senha_confirma'));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Lembrete da senha');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'lembrete_senha'),  set_value('lembrete_senha'));
echo"<tr><td>";//Essa linha pode remover
echo form_label('Nivel');
echo"</td><td>";
echo'<select name="id_nivel">';
if ($nivel != NULL) {
    foreach ($nivel as $linha) {
        echo'<option value="'.$linha -> id.'">'.$linha -> nome.'</option>';
   }
}
echo'</select>';
echo"</td></tr>";
echo"</td></tr>";//Essa linha pode remove

echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover
echo form_submit(array('name'=>'Cadastrar'),'Cadastrar');
echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover
echo form_close();

?>