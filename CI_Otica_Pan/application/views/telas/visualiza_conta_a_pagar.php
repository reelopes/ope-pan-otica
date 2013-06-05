<!--Manuela-->
<?php
echo"<div class=formulario style='margin-left: 40px; width: 400px;  padding: 2px 2px 2px;  border-radius: 3px;'>";
echo"<h2>$titulo</h2>"; //TITULO

$query = $this->contas_a_pagar_model->get_byid($this->uri->segment(3));
$valor = $this->util->pontoParaVirgula($query->valor);

?>
<fieldset>
    <legend>Conta a pagar:</legend>
    <form method="POST" action=<? echo base_url('contasAPagar/visualiza') ?>/>
    <table>
        <tr>
            <td>Nome:</td><td><input type="text" style="width:310px;" name="nome" value="<? echo set_value('nome',$query->nome); ?>"maxlength="50" placeholder='Nome da Conta' autocomplete="off" autofocus required title="Campo nome é obrigatório" readonly autofocus /></td></tr><tr>
            <td>Valor:</td><td><input type="text" style="width:210px;" name="preco" value="<? echo set_value('preco',$valor); ?>" autocomplete="off" placeholder='XXX,XX' required title="Campo preço é obrigatório" readonly onkeypress="return(FormataReais(this,'.',',',event));" /></td></tr><tr>
            <td>Vencimento:</td><td><input type="date" style="width:155px;" name="data" value="<? echo set_value('data',$query->data); ?>" readonly autocomplete="off" /></td></tr><tr>
            <td>Descrição:</td></tr><tr><td colspan="2"><textarea name="descricao" value="<? echo set_value('descricao',$query->descricao); ?>" readonly cols=46 rows=7 placeholder='Digite aqui a descrição.' title="Campo descrição é opcional"><? echo set_value('descricao',$query->descricao); ?></textarea></td></tr>
    </table>
    </form>
</fildset>

<?
echo '<img src="'.base_url('public/img/voltar.png').'" onClick="history.go(-1)" width="25" id="icone_desbotado" title="Voltar"/>';
echo"</div>";
?>