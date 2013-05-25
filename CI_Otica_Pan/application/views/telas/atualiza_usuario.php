<?php
echo"<div class=formulario style='  margin-left: 40px; width: 500px;  padding: 2px 2px 2px;  border-radius: 3px;'>";
echo"<h2>$titulo</h2>";

if($this->session->flashdata('cadastrook')){
    $msg = $this->session->flashdata('cadastrook');
    echo "<body onload=\"alert('$msg');\">";
}

echo form_open('usuario/atualiza');

$nivel = $this->nivel_model->getAll()->result();
$id = $this->uri->segment(3);
$query = $this->usuario_model->get_byid($id);

echo"<fieldset>";
echo"<legend>Dados do Usuário</legend>";
echo"<table>";
echo"<tr><td>";
echo form_label('Nome');
echo"</td><td>"; 
echo form_input(array('name'=>'nome'),  set_value('nome', $query['usuario']->nome), 'maxlength="100" placeholder="Nome do Usuário" autocomplete ="off" style="width:180px;" autofocus');
echo"</td><td>";
echo form_label('Email');
echo"</td><td>"; 
echo form_input(array('name'=>'email'),  set_value('email', $query['usuario']->email), 'maxlength="100" placeholder="exemplo@email.com" autocomplete ="off" style="width:180px;"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Login');
echo"</td><td>"; 
echo form_input(array('name'=>'login'),  set_value('login', $query['usuario']->login),'maxlength="20" placeholder="Login" autocomplete ="off" style="width:180px;" required title="Campo Login é obrigatório"');
echo"</td><td>";
echo form_label('Nivel');
echo"</td><td>";
echo'<select name="id_nivel">';
if ($nivel != NULL) {
    foreach ($nivel as $linha) {
        if ($linha->id == $query['usuario']->id_nivel) {
            echo'<option selected value="'.$linha -> id.'">'.$linha -> nome.'</option>';
        } else {
            echo'<option value="'.$linha -> id.'">'.$linha -> nome.'</option>';
        }
   }
}
echo'</select>';
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Senha');
echo"</td><td>"; 
echo form_password(array('name'=>'senha'),  set_value('senha', $query['usuario']->senha), 'maxlength="20" placeholder="Senha" autocomplete ="off" style="width:180px;" required title="Campo Senha é obrigatório"');
echo"</td><td>";
echo form_label('Confirme a Senha');
echo"</td><td>"; 
echo form_password(array('name'=>'senha_confirma'), set_value('senha_confirma', $query['usuario']->senha), 'maxlength="20" placeholder="Confirme a Senha" autocomplete ="off" style="width:180px;" required title="Confirme sua senha"');
echo"</td></tr>";
echo"</table><table>";
echo"<tr><td>";
echo form_label('Lembrete da senha');
echo"</td><td>"; 
echo form_input(array('name'=>'lembrete_senha'),  set_value('lembrete_senha', $query['usuario']->lembrete_senha), 'maxlength="200" placeholder="Use uma palavra chave para lembrar sua senha" autocomplete ="off" style="width:405px;"');
echo"</td></tr>";

echo"<tr><td>"; 
echo form_submit(array('name'=>'Alterar'),'Alterar');
echo"</tr></td>"; 
echo"</table>"; 
echo"</fieldset>";
echo form_close();
echo"</div>";
?>