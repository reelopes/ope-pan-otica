<!--Julia-->
<?php
echo"<div class=formulario style='  margin-left: 40px; width: 450px;  padding: 2px 2px 2px;  border-radius: 3px;'>";
echo"<h2>$titulo</h2>";

$id_conta = $this->uri->segment(3);

if($id_conta == NULL){
    redirect ('contasAPagar/lista');
}

$query = $this->contas_a_pagar_model->get_byid($id_conta);
$valor = $this->util->pontoParaVirgula($query->valor);

if($this->session->flashdata('statusUpdate')){
    $msg = $this->session->flashdata('statusUpdate');
    echo "<body onLoad=\" alert('$msg');window.opener.location.reload();window.close();\">";
}

?>
<fieldset>
    <legend>Conta a pagar:</legend>
    <form method="POST" action=<? echo base_url("contasAPagar/update/$id_conta") ?>/>
    <table>
        <tr>
            <td>Nome:</td><td><input type="text" style="width:310px;" name="nome" value="<? echo set_value('nome',$query->nome); ?>"maxlength="50" placeholder='Nome da Conta' autocomplete="off" autofocus required title="Campo nome é obrigatório" autofocus /><span title='Campo obrigatório'>* &nbsp; </span></td></tr><tr>
            <td>Valor:</td><td><input type="text" style="width:210px;" name="preco" value="<? echo set_value('preco',$valor); ?>" autocomplete="off" placeholder='XXX,XX' required title="Campo preço é obrigatório" onkeypress="return(FormataReais(this,'.',',',event));" /></td></tr><tr>
            <td>Vencimento:</td><td><input type="date" style="width:155px;" name="data" value="<? echo set_value('data',$query->data); ?>" required title="Campo Vencimento é obrigatório" autocomplete="off" /></td></tr><tr>
            <td>Descrição:</td></tr><tr><td colspan="2"><textarea name="descricao" value="<? echo set_value('descricao',$query->descricao); ?>" cols=46 rows=7 placeholder='Digite aqui a descrição.' title="Campo descrição é opcional"><? echo set_value('descricao',$query->descricao); ?></textarea></td></tr><tr>
            <td align='center' colspan="2"><input type="submit" value="Alterar"></td></tr>
    </table>
    </form>
</fildset>

<?
echo "</div>";

echo form_close();

?>
