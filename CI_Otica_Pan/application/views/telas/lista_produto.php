<?php
echo "<h2>$titulo</h2>";

echo $this->session->flashdata('msg');

echo form_open('produto/pesquisa');
echo form_label('Pesquisa:');
//echo '<input type="text" name="pesquisa" value="" placeholder="Produto" autofocus>';
echo form_input(array('name'=>'pesquisa'),  set_value('pesquisa'),'autofocus, autocomplete ="off"');
echo form_submit('', 'Procurar');
echo form_close();

$produto = $produto;//Pega a variavel da Controller (boa pratica)

if($produto==NULL){
    echo"Sua pesquisa não encontrou nenhum dado correspondente.";
}else{
    echo"<br><center><table>";//Essa linha pode remover
    if ($produto != NULL) {
        $this -> table -> set_heading('REFERENCIA', 'NOME', 'DESCRIÇÃO', 'PREÇO CUSTO', 'PREÇO VENDA', 'VALIDADE', 'QUANTIDADE', 'STATUS', 'EDITAR','EXCLUIR');
        foreach ($produto as $linha) {
            $this -> table -> add_row($linha ->referencia, $linha -> nome, $linha -> descricao, $linha -> preco_custo, $linha -> preco_venda, $linha -> validade,
                    $linha -> quantidade, $linha -> status,
                    anchor("produto/update/$linha->id_produto",'<center>Editar</center>'),
                    anchor("produto/delete/$linha->id_produto",'<center>Excluir</center>','onclick="if (! confirm(\'Tem certeza que deseja excluir o produto abaixo? \n\n Referência: '.$linha->referencia.'\n Nome: '.$linha->nome.'\n Quantidade: '.$linha->quantidade.'\n\n Obs.: Essa ação apagará os '.$linha->quantidade.' produtos'.'\')) { return false; }"'));
        }
        $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" width="100%" cellspacing="1" class="mytable">' );
        $this->table->set_template($tmpl);
        echo $this -> table -> generate();
    }
    echo"</br></table>"; //Essa linha pode remover
}
?>