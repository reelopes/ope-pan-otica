       <link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/jquery/estilo/table_jui.css" />
        <link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/jquery/estilo/jquery-ui-1.8.4.custom.css" />
        <script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/js/jquery.mim.js"></script>
        <script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        oTable = $('#listaOrcamentosPendentes').dataTable({
            "bPaginate": true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "bSort": false
        });
    });
</script>
<?php
echo "<h2>$titulo</h2>";

if($this->session->flashdata('msg')){
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\"alert('$msg');\">";
}

$orcamentos = $orcamentos;//Pega a variavel da Controller (boa pratica)

$this->table->set_heading('Data', 'Forma Pgto','Valor Total','Cliente','Vendedor ','&nbsp; ','&nbsp; ');

foreach ($orcamentos as $linha) {
    
    $data = $this->util->data_mysql_para_user($linha->data_orcamento);
    if($linha->nome_cliente==null){$nomeCliente = 'Cliente não definido';}else{$nomeCliente=$linha->nome_cliente;}    
    
    $this->table->add_row($data,$linha->forma_pagamento,"R$ ".  number_format((($linha->preco_total_itens+$linha->preco_total_lentes+$linha->preco_total_servicos)-$linha->desconto),'2',',',''),$nomeCliente,$linha->vendedor,"<a href=\"javascript:abrirPopUp('" . base_url('contasAPagar/update/' . $linha->id) . "','500','450');\"> <center><img src='..\public/img/edit.png' width='23'/></center></a>", '<center><p onClick="if (! confirm(\'Tem certeza que deseja excluir a conta a pagar abaixo? \n\nNome: '.$linha->nome.'\nValor: '.$linha->valor.'\nData do pagamento: '.$this->util->data_mysql_para_user($linha->data).'\')) { return false; }">' . anchor('contasAPagar/delete/'.$linha->id, '<img src="..\public/img/delete.png" width="23"/>') . '</p></center>');
}

$tmpl = array(
    'table_open'=>'<table cellpadding="0" cellspacing="0" border="0" class="display" id="listaOrcamentosPendentes">',
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