<?php
echo"<div class=formulario>";
echo"<h2>$titulo</h2>";

if($this->session->flashdata('cadastrook')){
    $msg = $this->session->flashdata('cadastrook');
    echo "<body onload=\"ocultaCampo('crm','id_crm'); alert('$msg');\">";
}

echo '<body onload="ocultaCampo(\'crm\',\'id_crm\');" />';

echo form_open('usuario/adiciona');

$nivel = $this->nivel_model->getAll()->result();

echo"<fieldset>";
echo"<legend>Dados do Usuário</legend>";
echo"<table>";
echo"<tr><td>";
echo form_label('Nome');
echo"</td><td>"; 
echo form_input(array('name'=>'nome'),  set_value('nome'), 'maxlength="100" placeholder="Nome do Usuário" autocomplete ="off" style="width:180px;" autofocus required title="Campo Nome é obrigatório"')."<span title='Campo obrigatório'>* &nbsp; </span>";
echo"</td><td>";
echo form_label('Email');
echo"</td><td>"; 
echo form_type(array('name'=>'email'),  set_value('email'), 'maxlength="100" placeholder="exemplo@email.com" autocomplete ="off" style="width:255px;"', 'email');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Login');
echo"</td><td>"; 
echo form_input(array('name'=>'login'),  set_value('login'),'maxlength="20" placeholder="Login"  autocomplete ="off" style="width:180px;" required title="Campo Login é obrigatório"')."<span title='Campo obrigatório'>* &nbsp; </span>";
echo"</td><td>";
echo form_label('Nivel');
echo"</td><td>";
echo'<select name="id_nivel" onChange="if (id_nivel.value == 4) { mostraCampo(\'crm\', \'id_crm\'); } else { ocultaCampo(\'crm\',\'id_crm\'); }">';
echo'<option value="0">Selecione...</option>';
if ($nivel != NULL) {
    foreach ($nivel as $linha) {
        echo'<option value="'.$linha -> id.'">'.$linha -> nome.'</option>';
   }
}
echo'</select>'."<span title='Campo obrigatório'>* &nbsp; </span>";
echo"</td></tr>";
echo"<tr id=\"crm\"><td>";
echo'<div>';
    echo form_label('CRM');
    echo"</td><td>";
    echo form_input(array('name'=>'crm'),  set_value('crm'), 'id="id_crm" maxlength="20" placeholder="crm do médico" autocomplete ="off" style="width:180px;" required title="Campo CRM é obrigatório"')."<span title='Campo obrigatório'>* &nbsp; </span>";
    echo"</td></tr>";
echo "</div>";
echo"<tr><td>";
echo form_label('Senha');
echo"</td><td>"; 
echo form_password(array('name'=>'senha'),  set_value('senha'), 'maxlength="20" placeholder="Senha" autocomplete ="off" style="width:180px;" required title="Campo Senha é obrigatório"')."<span title='Campo obrigatório'>* &nbsp; </span>";
echo"</td><td>";
echo form_label('Confirme a Senha');
echo"</td><td>"; 
echo form_password(array('name'=>'senha_confirma'), set_value('senha_confirma'), 'maxlength="20" placeholder="Confirme a Senha" autocomplete ="off" style="width:180px;" required title="Confirme sua senha"')."<span title='Campo obrigatório'>* &nbsp; </span>";
echo"</td></tr>";
echo"</table><table>";
echo"<tr><td>";
echo form_label('Lembrete da senha');
echo"</td><td>"; 
echo form_input(array('name'=>'lembrete_senha'),  set_value('lembrete_senha'), 'maxlength="200" placeholder="Use uma palavra chave para lembrar sua senha" autocomplete ="off" style="width:405px;" required title="Campo Lembrete de senha é obrigatório"')."<span title='Campo obrigatório'>* &nbsp; </span>";
echo"</td></tr>";

echo"<tr><td>"; 
echo form_submit('', 'Cadastrar','onClick="if (senha.value != senha_confirma.value) { alert(\'As senhas informadas não conferem!\'); return false;}"');
echo"</tr></td>"; 
echo"</table>"; 
echo"</fieldset>";
echo form_close();
echo"</div>";
?>