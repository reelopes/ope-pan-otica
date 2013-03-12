<?php

echo"<h2>$titulo</h2>";

echo $this->session->flashdata('msg');

echo form_open('cliente/pesquisaCliente');
echo form_label('Pesquisa Cliente:');
echo form_input(array('name'=>'pesquisa'),  set_value('pesquisa'),'autofocus');
echo form_submit('','Pesquisar');
echo form_close();

$clientes = $clientes;//Pega a variavel da Controller (boa pratica)

if($clientes==NULL){
    echo"Sua pesquisa não encontrou nenhum dado correspondente.";
}else{


$this->table->set_heading('NOME','CPF','EMAIL','TELEFONE','EDITAR','EXCLUIR');
foreach ($clientes as $linha) {

    $this->table->add_row($linha->nome, $linha->cpf, $linha->email, $linha->num_telefone, anchor("cliente/atualizarCliente/$linha->id_pessoa/$linha->id_cliente", 'Editar'),anchor("cliente/deletarCliente/$linha->id_pessoa/$linha->id_cliente", 'Excluir'));
}

$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" width="100%" cellspacing="1" class="mytable">' );
$this->table->set_template($tmpl);
echo $this->table->generate();
}
?>
