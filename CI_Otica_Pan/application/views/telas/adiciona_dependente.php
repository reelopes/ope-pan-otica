<?php

echo"<h2>$titulo</h2>";

echo validation_errors('<p>','</p>');

if($this->session->flashdata('cadastrook')){
    $msg = $this->session->flashdata('cadastrook');
    echo "<body onLoad=\" alert('$msg');\">";
}

?>
        Pesquisa Cliente: <input type="text" name="nome" onKeyDown="ocultaFormDependente();" onKeyUp="carregaAjax('pesquisaDinamica', '<? echo base_url('dependente/pesquisaDinamica') ?>/' + this.value)" autofocus autocomplete="off">
        <?
           echo "<br><br><div id='pesquisaDinamica' style='display:none;'>"; 
    

    echo "</div>";

    if(validation_errors()==''){
        
         echo "<div id='formDependente'  style='display:none;'";
        
    }  else {
        
         echo "<div id='formDependente'  style='display:block;'";
    }
        


    ?>
    <form></form>

    <form method="POST" action=<? echo base_url('dependente/cadastrarDependente') ?>/>
    <input type="hidden" id="inputIdCliente" name="idCliente" value="" />
    <table><tr>
            <td>Nome do Cliente:</td><td><input type="text" id="inputNomeCliente" name="nomeCliente" value="<? echo set_value('nomeCliente'); ?>" readonly/></td></tr><tr>
            <td>CPF do Cliente:</td><td><input type="text" id="inputCpfCliente" name="cpfCliente" value="<? echo set_value('cpfCliente'); ?>" readonly /></td></tr><tr>
            <td>Nome do Dependente:</td><td><input type="text" id="inputNomeDependente" name="nomeDependente" value="<? echo set_value('nomeDependente'); ?>" /></td></tr><tr>
            <td>Data Nascimento do Dependente:</td><td><input type="text" id="inputDataNascimentoDependente" name="dataNascimentoDependente" value="<? echo set_value('dataNascimentoDependente'); ?>"/></td></tr><tr>
            <td>Responsável do Dependente:</td><td><input type="text" id="inputResponsavelDependente" name="responsavelDependente" value="<? echo set_value('responsavelDependente'); ?>" /></td></tr><tr>
            <td></td><td><input type="submit" value="Cadastrar"></td></tr>
        
    </table>
    </form>

    <?
 echo"</div>";
?>



