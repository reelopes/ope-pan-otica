<?php

echo"<h2>$titulo</h2>";

if($this->session->flashdata('msg')){
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');\">";
}


echo form_open('cliente/pesquisaCliente');
echo form_label('Pesquisa Cliente:');
echo form_input(array('name'=>'pesquisa'),  set_value('pesquisa'),'autofocus');
echo form_submit('','Pesquisar');
echo form_close();

$clientes = $clientes;//Pega a variavel da Controller (boa pratica)

if($clientes==NULL){
    echo"Sua pesquisa não encontrou nenhum dado correspondente.";
}else{

echo"<br><br>";
$this->table->set_heading('NOME','CPF','EMAIL','TELEFONE','VISUALIZAR','EDITAR','EXCLUIR');
foreach ($clientes as $linha) {

    $this->table->add_row($linha->nome, $linha->cpf, $linha->email, $linha->num_telefone,anchor("cliente/listaCliente/$linha->id_cliente", '<center>Visualizar</center>'),anchor("cliente/atualizarCliente/$linha->id_cliente", '<center>Editar</center>'),anchor("cliente/deletarCliente/$linha->id_pessoa/$linha->id_cliente", '<center>Excluir</center>', 'onclick="if (! confirm(\'Tem certeza que deseja excluir o cliente abaixo? \n\n Nome: ' .$linha->nome . '\n CPF: ' .$linha->cpf. '\n Email: ' . $linha->email. '\')) { return false; }"'));
}

$tmpl = array(
            'table_open' => '<table border="1" cellpadding="2" width="100%" cellspacing="1" class="listholover">',
             'row_start' => '<tr class="alt">',
             'row_alt_start'=> '<tr class="alt">',
            );
$this->table->set_template($tmpl);
echo $this->table->generate();
}
?>
