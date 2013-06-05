<!--Julia-->
<?php
echo"<div class=formulario style='margin-left: 40px; width: 400px;  padding: 2px 2px 2px;  border-radius: 3px;'>";
echo"<h2>$titulo</h2>"; //TITULO

?>
<fieldset>
    <legend>Lembrete de senha:</legend>
    <form method="POST" action=<? echo base_url('login/esqueciSenha') ?>/>
    <table>
        <tr>
            <td>Login:</td><td><input type="text" style="width:310px;" name="login" value="<? echo set_value('login'); ?>"maxlength="50" placeholder='Qual o login?' autocomplete="off" autofocus required title="Campo login é obrigatório" autofocus /></td></tr><tr>
            <?
            if ($this->session->flashdata('lembrete')) {
                echo "<td colspan='4'><p><center>O lembrete de senha é: <span style='color:blue;'>".$this->session->flashdata('lembrete')."</span></center></p></td><tr>";
            }
            if ($this->session->flashdata('lembreteErro')) {
                echo "<td colspan='4'><p><center><span style='color:red;'>".$this->session->flashdata('lembreteErro')."</span></center></p></td><tr>";
            }
            ?>
            <td align='center' colspan="2"><input type="submit" value="Exibir Lembrete"></td></tr>
    </table>
    </form>
</fildset>

<?
echo"</div>";
?>