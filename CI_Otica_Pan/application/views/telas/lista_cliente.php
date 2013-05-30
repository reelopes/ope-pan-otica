
<?php

echo"<div class=formulario style='  margin-left: 40px; float:left; width: 650px;  padding: 2px 2px 0px;  border-radius: 3px;'>";
echo"<h2>$titulo</h2>";
$id_cliente = $this->uri->segment(3);

if ($this->session->flashdata('msg')) {
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');window.opener.location.reload();window.close();\">";
}


echo"<fieldset>";
echo"<legend>Dados Pessoais:</legend>";
echo"<table>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Nome');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'nome'),  $cliente['pessoa']->nome,'readonly maxlength="100" autocomplete ="off" placeholder="Nome Completo do Cliete" autofocus style="width:300px;"');
echo form_error('nome');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Email');
echo"</td><td>";//Essa linha pode remover
echo form_input(array('name'=>'email'),$cliente['pessoa']->email,'readonly maxlength="100" autocomplete ="off" placeholder="exemplo@exemplo.com.br" style="width:300px;"');
echo form_error('email');
echo"<tr><td>";//Essa linha pode remover
echo form_label('CPF');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cpf'), $cliente['cliente']->cpf,'readonly maxlength="14" autocomplete ="off" placeholder="XXX.XXX.XXX-XX" OnKeyPress="MascaraCPF(this)"');
echo form_error('cpf');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Data de Nascimento');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'data_nascimento'),$this->util->data_mysql_para_user($cliente['cliente']->data_nascimento),'readonly maxlength="10" autocomplete ="off" placeholder="DD/MM/AAAA" OnKeyPress="MascaraData(this)"');
echo form_error('data_nascimento');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone Residencial');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone1'),$cliente['telefone'][0]->num_telefone,'readonly maxlength="14" autocomplete ="off" placeholder="(XX)XXXX-XXXX" OnKeyPress="MascaraTelefone(this)"');
echo form_label('Telefone Celular');
echo form_input(array('name'=>'num_telefone2'),$cliente['telefone'][1]->num_telefone,'readonly maxlength="15" autocomplete ="off" placeholder="(XX)XXXX-XXXXX" OnKeyPress="MascaraTelefone(this)"');
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
echo form_input(array('name'=>'rua'), $cliente['endereco']->logradouro,'readonly maxlength="80" autocomplete ="off" placeholder="Exemplo: Av Paulista, 2000" style="width:425px;"');
echo form_error('rua');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Bairro');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'bairro'),$cliente['endereco']->bairro,'readonly maxlength="50" autocomplete ="off" placeholder="Exemplo: Jardim Paulista"');
echo form_error('bairro');
echo form_label('Complemento');
echo form_input(array('name'=>'complemento'),$cliente['endereco']->complemento,'readonly maxlength="20" autocomplete ="off" placeholder="Exemplo: Apt./Cj./Bloco"');
echo form_error('complemento');
echo"</td></tr>";//Essa linha pode remover
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Cidade');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cidade'),$cliente['endereco']->cidade,'readonly maxlength="50" autocomplete ="off" placeholder="Exemplo: São Paulo"');
echo form_error('cidade');
echo form_label('Estado','',array('style' => 'padding-right: 45px;',));
echo form_dropdown('estado', array($cliente['endereco']->estado));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('CEP');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cep'),$cliente['endereco']->cep,'readonly maxlength="9" autocomplete ="off" placeholder="XXXXX-XXX" OnKeyPress="MascaraCep(this)"');
echo form_error('cep');
echo"</td></tr>";//Essa linha pode remover
echo"</table>"; //Essa linha pode remover
echo"</fieldset>";

echo'<img src="'.base_url('public/img/voltar.png').'" width="25" id="icone_desbotado" onClick="history.go(-1)" title="Voltar" />';
echo"</div>";

echo "<div style='float:left; margin-left:10px; padding: 90px 0px 0px;'}>";

$dependentes = $this->dependente_model->listarDependentes($id_cliente);

if($dependentes==NULL){
?>
            <table border="0">
                <tr id="icone_desativado">
        <td align="center">
            <? echo"<img src='".base_url('public/img/dependente.png')."' title='Não possui Dependentes'>" ?>
             <p>Não possui Dependentes</p>
            </a>
        </td>
        </tr>

        
 <?
}else {
    ?>
        <table border="0">
            <tr id="icone_desbotado">
        <td align="center">
            <? echo"<a href=\"javascript:abrirPopUp('".base_url('dependente/listarDependentes/'.$id_cliente)."','500','350');\" title='Listar Dependentes'><img src='".base_url('public/img/dependente.png')."' title='Listar Dependentes'>"; ?>
             <p>Listar Dependentes</p>
            </a>
        </td>
        </tr>
    
    <?
    
    
}

echo "<tr><td>&nbsp;</td></tr>";

$receitas = $this->receita_model->receitasCliente($id_cliente);

if($receitas==NULL){
?>
        
        
        <tr id="icone_desativado">
        <td align="center">
            <? echo"<img src='".base_url('public/img/check_list.png')."' title='Não possui Receita' width='64'>" ?>
             <p>Não possui Receita</p>
            </a>
        </td>
        </tr>
        </table>
        
 <?
}else {
    ?>
        
        <tr id="icone_desbotado">
        <td align="center">
            <? echo"<a href=\"javascript:abrirPopUp('".base_url('receita/listaReceita/'.$id_cliente)."','700','350');\" title='Listar Receitas'><img src='".base_url('public/img/check_list.png')."' title='Listar Receitas' width='64'>"; ?>
             <p>Listar Receitas</p>
            </a>
        </td>
        </tr>
        </table>
    
    <?
    
    
}
echo"</div>";
?>
