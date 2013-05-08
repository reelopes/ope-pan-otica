<?php
echo "<h2>$titulo</h2>";

if($this->session->flashdata('msg')){
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');\">";
}

$fornecedor = $fornecedor;//Pega a variavel da Controller (boa pratica)

$this->table->set_heading('NOME', 'EMAIL', 'CNPJ', 'TELEFONE', '&nbsp; ');

foreach ($fornecedor as $linha) {
    
    $this -> table -> add_row($linha -> nome, $linha -> email, $linha -> cnpj, $linha -> num_telefone, anchor("Fornecedor/update/$linha->id_pessoa/$linha->id_fornecedor",'<center>Editar</center>'));

}

$tmpl = array(
    'table_open'=>'<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">',
      );

echo"<div class='tabela'>";
$this->table->set_template($tmpl);
echo $this->table->generate();
echo"</div>";

?>