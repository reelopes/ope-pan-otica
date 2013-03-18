<?php
echo "<h2>$titulo</h2>";

echo $this->session->flashdata('msg');

echo form_open('fornecedor/pesquisa');
echo form_label('Pesquisa Fornecedor:');
echo form_input(array('name'=>'pesquisa'),  set_value('pesquisa'),'autofocus');
echo form_submit('', 'Procurar');
echo form_close();

$fornecedor = $fornecedor;//Pega a variavel da Controller (boa pratica)

if($fornecedor==NULL){
    echo"Sua pesquisa não encontrou nenhum dado correspondente.";
}else{
    echo"<br><center><table>";//Essa linha pode remover
    if ($fornecedor != NULL) {
        $this -> table -> set_heading('NOME', 'EMAIL', 'CNPJ', 'TELEFONE', 'MANTER');
        foreach ($fornecedor as $linha) {

            $this -> table -> add_row($linha -> nome, $linha -> email, $linha -> cnpj, $linha -> num_telefone, anchor("Fornecedor/update/$linha->id_pessoa/$linha->id_fornecedor",'Editar').'
                  |  '.anchor("Fornecedor/delete/$linha->id_pessoa",'Excluir'));
        }
        $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" width="100%" cellspacing="1" class="mytable">' );
        $this->table->set_template($tmpl);
        echo $this -> table -> generate();
    }
    echo"</br></table>"; //Essa linha pode remover
}
?>