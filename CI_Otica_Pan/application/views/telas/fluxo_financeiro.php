<?php
echo"<div class=formulario style='margin-left: 40px; width: 460px;  padding: 2px 2px 2px;  border-radius: 3px;'>";
echo"<h2>$titulo</h2>"; //TITULO

?>
<fieldset>
    <legend>Filtros:</legend>
    <form method="POST" action=<? echo base_url('fluxoFinanceiro/gerarRelatorio') ?>/>
        <fieldset>
            <legend>Período:</legend>
            <table>
                <tr>
                    <td>De&nbsp;</td><td><input type="date" style="width:155px;" name="data" value="<? echo set_value('data'); ?>"autocomplete="off" /><span>&nbsp;&nbsp;</span></td>
                    <td>Até&nbsp;</td><td><input type="date" style="width:155px;" name="data" value="<? echo set_value('data'); ?>"autocomplete="off" /></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Exibir:</legend>
                <table><tr>
                    <td>Contas a Pagar&nbsp;&nbsp;<input name="contas_pagar" type="checkbox" id = "ativo" checked/></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>Vendas&nbsp;&nbsp;<input name="vendas" type="checkbox" id = "ativo" checked/></td>
                </tr></table>
        </fieldset>
    <table>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
        <input type="submit" value="Gerar Relatório">
    </form>
</fieldset>
<?
echo"</div>";
?>