<?php
echo "<h2>$titulo</h2>";

if($this->session->flashdata('msg')){
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');\">";
}

$produto = $produto;//Pega a variavel da Controller (boa pratica)

$this->table->set_heading('REFERÊNCIA','NOME','PREÇO DE CUSTO','PREÇO DE VENDA','QUANTIDADE','STATUS', '&nbsp; ','&nbsp; ');

foreach ($produto as $linha) {
    
    $this->table->add_row($linha->referencia, $linha->nome, $this->util->pontoParaVirgula($linha->preco_custo), $this->util->pontoParaVirgula($linha->preco_venda), $linha->quantidade, $linha->status, anchor("produto/visualiza/$linha->id_produto", '<center><img src="..\public/img/search.png" width="23"/></center>'),anchor("produto/update/$linha->id_produto", '<center><img src="..\public/img/edit.png" width="23"/></center>')); //anchor('produto/delete/'.$linha->id_produto,'<img src="..\public/img/delete.png" width="23"/>').'<center><p onClick="if (! confirm(\'Tem certeza que deseja excluir o produto abaixo? \n\n Referência: '.$linha->referencia.'\n Nome: '.$linha->nome.'\n Quantidade: '.$linha->quantidade.'\')) { return false; }">'.'</p></center>'

}

$tmpl = array(
    'table_open'=>'<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">',
      );

echo"<div class='tabela'>";
$this->table->set_template($tmpl);
echo $this->table->generate();
echo"</div>";

?>