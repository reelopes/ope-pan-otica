<?php

echo"<h2>$titulo</h2>";

echo validation_errors('<p>','</p>');

if($this->session->flashdata('cadastrook')){
    $msg = $this->session->flashdata('cadastrook');
    echo "<body onLoad=\" alert('$msg');\">";
}

$clientes = $this->cliente_model->listarClientes('')->result();

$this->table->set_heading('NOME','CPF','EMAIL','TELEFONE');
foreach ($clientes as $linha) {

    $nomeReduzido = (explode(" ",$linha->nome));
          
   if(sizeof($nomeReduzido)>3){
       $nomeReduzido = $nomeReduzido[0].' '.$nomeReduzido[1].' '.$nomeReduzido[sizeof($nomeReduzido)-1];
   }else{
       $nomeReduzido = $linha->nome;
   }
    
    $this->table->add_row($nomeReduzido, $linha->cpf, $linha->email, $linha->num_telefone);
}

$tmpl = array(
    'table_open'=>'<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">',
    'row_start' => '<tr class="alt">',
    'row_alt_start' => '<tr class="alt">',
      );

echo"<div class='tabela'>";
$this->table->set_template($tmpl);
echo $this->table->generate();
echo"</div>";
?>
 
      
    <form></form>

    <form method="POST" action=<? echo base_url('dependente/cadastrarDependente') ?>/>
    <input type="hidden" id="inputIdCliente" name="idCliente" value="" />
    <table><tr>
            <td>Nome do Cliente:</td><td><input type="text" id="inputNomeCliente" name="nomeCliente" value="<? echo set_value('nomeCliente'); ?>" readonly/></td></tr><tr>
            <td>CPF do Cliente:</td><td><input type="text" id="inputCpfCliente" name="cpfCliente" value="<? echo set_value('cpfCliente'); ?>" readonly /></td></tr><tr>
            <td>Nome do Dependente:</td><td><input type="text" id="inputNomeDependente" name="nomeDependente" value="<? echo set_value('nomeDependente'); ?>" /></td></tr><tr>
            <td>Data Nascimento do Dependente:</td><td><input type="text" id="inputDataNascimentoDependente" name="dataNascimentoDependente" value="<? echo set_value('dataNascimentoDependente'); ?>"/></td></tr><tr>
            <td>Parentesco:</td><td><input type="text" id="inputResponsavelDependente" name="responsavelDependente" value="<? echo set_value('responsavelDependente'); ?>" /></td></tr><tr>
            <td></td><td><input type="submit" value="Cadastrar"></td></tr>
        
    </table>
    </form>





