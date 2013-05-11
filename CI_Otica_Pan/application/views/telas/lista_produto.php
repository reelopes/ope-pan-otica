<?php
echo "<h2>$titulo</h2>";

if($this->session->flashdata('msg')){
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');\">";
}

$produto = $produto;//Pega a variavel da Controller (boa pratica)

$this->table->set_heading('COD. PRODUTO','NOME','PREÇO DE CUSTO','PREÇO DE VENDA','QTD', '&nbsp; ','&nbsp; ');

foreach ($produto as $linha) {
    
    if($linha->categoria=="0"){
        $lenPopUp = "'780','400'";
    } else {
        $lenPopUp = "'780','550'";
    }
  
    if ($linha->status == "0") {
        continue;
    }
    
    $this->table->add_row($linha->cod_barra.$linha->id_produto, $linha->nome, '<p><center>'.$this->util->pontoParaVirgula($linha->preco_custo), '<p><center>'.$this->util->pontoParaVirgula($linha->preco_venda), '<p><center>'.$linha->quantidade, anchor("produto/visualiza/$linha->id_produto", '<center><img src="..\public/img/search.png" width="23"/></center>'),"<a href=\"javascript:abrirPopUp('" . base_url('produto/update/' . $linha->id_produto) . "',".$lenPopUp.");\"> <center><img src='..\public/img/edit.png' width='23'/></center></a>");
    
}

$tmpl = array(
    'table_open'=>'<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">',
    'cell_start' => '<td valign="middle">',
    'cell_end' => '</td">',
    'cell_alt_start' => '<td valign="middle">',
    'cell_alt_end' => '</td>',
);

echo"<div class='tabela'>";
$this->table->set_template($tmpl);
echo $this->table->generate();
echo"</div>";

?>