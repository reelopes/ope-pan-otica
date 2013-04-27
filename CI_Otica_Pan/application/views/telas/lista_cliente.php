
<?php

echo"<div class=formulario>";
echo"<h2>$titulo</h2>";
$id_cliente = $this->uri->segment(3);

if ($this->session->flashdata('msg')) {
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');window.opener.location.reload();window.close();\">";
}

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
echo form_dropdown('estado', $options, $setValueEstado);
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('CEP');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cep'),$cliente['endereco']->cep,'readonly maxlength="9" autocomplete ="off" placeholder="XXXXX-XXX" OnKeyPress="MascaraCep(this)"');
echo form_error('cep');
echo"</td></tr>";//Essa linha pode remover
echo"</table>"; //Essa linha pode remover
echo"</fieldset>";
echo"</div>";
$dependentes = $this->dependente_model->listarDependentes($id_cliente);
    
echo "<h3>Dependentes</h3>";
if($dependentes==NULL){

    echo"Este cliente não possui dependentes!";
}else {
    

?>

    

<table border="1" width="100%"  class="listholover">
    <tr class="cabecalhoTabela">
        <td>NOME</td>
        <td>DATA DE NASCIMENTO</td>
        <td>RESPONSÁVEL</td>
        <td>EDITAR</td>
        <td>EXCLUIR</td>
    </tr>

<?



foreach ($dependentes as $linha) {
    
    
    
         echo "<tr class='alt'>
        <td>$linha->nome</td>
        <td>".$this->util->data_mysql_para_user($linha->data_nascimento)."</td>
        <td>$linha->responsavel</td>
        <td><a href=\"javascript:abrirPopUpAlteraDependente('".base_url('dependente/atualizarDependente/'.$linha->id_dependente)."');\"><center>Editar</center></a></td>
        <td>".anchor('dependente/deletarDependente/'.$id_cliente.'/'.$linha->id_dependente,'<center>Excluir</center>','onclick="if (! confirm(\'Tem certeza que deseja excluir o dependente abaixo? \n\n Nome: '.$linha->nome.'\n Data de Nascimento: '.$this->util->data_mysql_para_user($linha->data_nascimento).'\n Responsável: '.$linha->responsavel.'\')) { return false; }"')."</td>
            
</tr>";
    
    
} 
}




?>
