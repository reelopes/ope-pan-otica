<?php
echo"<div class=formulario style='margin-left: 40px; width: 400px;  padding: 2px 2px 2px;  border-radius: 3px;'>";
echo"<h2>$titulo</h2>"; //TITULO
//Exime mensagem de agendamento do cliente Javascript
if ($this->session->flashdata('msg')) {
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');\">";
}
if ($this->session->flashdata('msgOk')) {
    $msg = $this->session->flashdata('msgOk');
    echo "<body onLoad=\" alert('$msg');window.opener.location.reload();window.close();\">";
}
?>
<fieldset>
    <legend>Dados do Serviço:</legend>

    <form method="POST" action=<? echo base_url('venda/adicionaServico') ?>/>
    <table>
        <tr>
            <td>Nome <span style="color:gray;" title="Campo obrigatório">*</span></td><td><input type="text" style="width:210px;" name="nome" value="<? echo set_value('nome'); ?>" placeholder='Nome do Serviço' autocomplete="off" autofocus required title="Campo nome é obrigatório" /></td></tr><tr>
            <td>Preço <span style="color:gray;" title="Campo obrigatório">*</span></td><td><input type="text" style="width:210px;" name="preco" value="<? echo set_value('preco'); ?>" autocomplete="off" placeholder='XXX,XX.' required title="Campo preço é obrigatório" onkeypress="return(FormataReais(this,'.',',',event));" /></td></tr><tr>
            <td>Descrição </td><td><textarea name="descricao" cols=30 rows=7 placeholder='Digite aqui a descrição.' title="Campo descrição é opcional"><? echo set_value('descricao'); ?></textarea></td></tr><tr>
            <td></td><td><input type="submit" value="Cadastrar"></td></tr>

    </table>
</form>
</fildset>

<?
echo"</div>";
?>