<?php
echo"<div class=formulario style='  margin-left: 40px; width: 400px;  padding: 2px 2px 2px;  border-radius: 3px;'>";
echo"<h2>$titulo</h2>";//TITULO
//Exime mensagem de agendamento do cliente Javascript
if ($this->session->flashdata('msg')) {
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');\">";
}
if ($this->session->flashdata('msgOk')) {
    $msg = $this->session->flashdata('msgOk');
    echo "<body onLoad=\" alert('$msg');window.opener.location.reload();window.close();\">";
}


$id_cliente = $this->uri->segment(3); //Captura o id do cliente da URL

if ($id_cliente != null) {

        $cliente = $this->cliente_model->retornaCliente($id_cliente); //Captura o cliente no 
       
        ?>

        <fieldset>
        <legend>Dados do Dependente:</legend>
        
        <form method="POST" action=<? echo base_url('dependente/cadastrarDependente') ?>/>
    <input type="hidden" id="inputIdCliente" name="idCliente" value="<?echo $id_cliente?>" />
    <table><tr>
            <td>Nome do Cliente:</td><td><input type="text" id="inputNomeCliente" style="width:200px;" name="nomeCliente" value="<? echo $cliente['pessoa']->nome; ?>" readonly/></td></tr><tr>
            <td>CPF do Cliente:</td><td><input type="text" id="inputCpfCliente" style="width:200px;" name="cpfCliente" value="<? echo $cliente['cliente']->cpf; ?>" readonly /></td></tr><tr>
            <td>Nome do Dependente:</td><td><input type="text" id="inputNomeDependente" style="width:200px;" autofocus required title="Campo nome é obrigatório" name="nomeDependente" value="<? echo set_value('nomeDependente'); ?>" /></td></tr><tr>
            <td>Data de Nascimento:</td><td><input type="date" id="inputDataNascimentoDependente" maxlength="10" autocomplete ="off" min="1900-01-01" max="<? echo date('Y-m-d') ?>" style="width:200px;" name="dataNascimentoDependente" value="<? echo set_value('dataNascimentoDependente'); ?>"/></td></tr><tr>
            <td>Parentesco:</td><td><input type="text" id="inputResponsavelDependente" style="width:200px;" name="responsavelDependente" value="<? echo set_value('responsavelDependente'); ?>" /></td></tr><tr>
            <td></td><td><input type="submit" value="Cadastrar"></td></tr>
        
    </table>
        </form>
        </fildset>

        <?
        echo"</div>";
    }
?>