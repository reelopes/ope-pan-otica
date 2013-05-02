<?php

echo"<div class=formulario>";
echo"<h2>$titulo</h2>";

// Boa pratica, pega variavel da Controller
$todos_fornecedor = $todos_fornecedor;
$todas_grife = $todas_grife;
$produto = $produto;

if ($this->session->flashdata('msg')) {
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');window.opener.location.reload();window.close();\">";
}

// Campos da tabela Produto
echo"<fieldset>";
echo"<legend>Produto</legend>";
echo"<table>";
echo"<tr><td>";
echo form_label('Referência*');
echo"</td><td>";
echo form_input(array('name'=>'referencia'),  set_value('referencia', $produto['produto']->referencia), 'readonly maxlength="8" placeholder="Código do Produto" autocomplete ="off" style="width:150px;" onpaste="return false;"');
echo"<tr><td>";
echo form_label('Nome*');
echo"</td><td>";
echo form_input(array('name'=>'nome'),  set_value('nome', $produto['produto']->nome), 'readonly maxlength="20" placeholder="Nome do produto" autocomplete ="off" style="width:250px;"');
echo"</td>";
echo"<td>";
echo form_label('Descrição');
echo"</td><td>"; 
echo form_input(array('name'=>'descricao'),  set_value('descricao', $produto['produto']->descricao), 'readonly maxlength="200" placeholder="Descrição do produto" autocomplete ="off" style="width:250px;"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Preço de custo*');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_custo'),  set_value('preco_custo', $produto['produto']->preco_custo), 'readonly maxlength="7" placeholder="0000,00" autocomplete ="off" onkeypress="return(FormataReais(this,\'.\',\',\',event))" style="width:80px;" onpaste="return false;"');
echo"</td>";
echo"<td>";
echo form_label('Preço de venda*');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_venda'),  set_value('preco_venda', $produto['produto']->preco_venda), 'readonly maxlength="7" placeholder="0000,00" autocomplete ="off" onkeypress="return(FormataReais(this,\'.\',\',\',event))" style="width:80px;" onpaste="return false;"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Quantidade');
echo"</td><td>"; 
echo form_input(array('name'=>'quantidade'),  set_value('quantidade', $produto['produto']->quantidade), 'readonly maxlength="8"  placeholder="00" autocomplete ="off" style="width:150px;" OnKeyPress="mascaraInteiro(this)" onpaste="return false;"');
echo"</td>";
echo"<td>";
echo form_label('Status');
echo"</td><td>"; 
echo form_input(array('name'=>'status'),  set_value('status', $produto['produto']->status), 'readonly placeholder="00" autocomplete ="off" style="width:150px;" onpaste="return false;"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Validade');
echo"</td><td>"; 
echo form_input(array('name'=>'validade'),  set_value('validade', $produto['produto']->validade), 'readonly maxlength="10" placeholder="DD/MM/AAAA" autocomplete ="off" style="width:150px;" OnKeyPress="MascaraData(this)" onpaste="return false;"');
echo"</td></tr>";
echo"</table>";
echo"<p></p>";
if($produto['produto']->categoria == 1) {
    // div armacao, carrega campos de armacao
    echo'<div id="armacao">';
        echo"<fieldset>";
        echo"<legend>Armação</legend>";
        echo"<table>";
        echo"<tr><td>";
        echo form_label('Largura da lente*');
        echo"</td><td>";
        echo form_input(array('name'=>'largura_lente'),  set_value('largura_lente', $produto['armacao']->largura_lente),'readonly maxlength="11" placeholder="xx" autocomplete ="off" OnKeyPress="mascaraInteiro(this)" onpaste="return false;"');
        echo"</td>";
        echo"<td>";
        echo form_label('Largura da ponte*');
        echo"</td><td>"; 
        echo form_input(array('name'=>'largura_ponte'),  set_value('largura_ponte', $produto['armacao']->largura_ponte),'readonly maxlength="11" placeholder="xx" autocomplete ="off" OnKeyPress="mascaraInteiro(this)" onpaste="return false;"');
        echo"</td></tr>";
        echo"<tr><td>";
        echo form_label('Comprimento da haste*');
        echo"</td><td>";
        echo form_input(array('name'=>'comprimento_haste'),  set_value('comprimento_haste', $produto['armacao']->comprimento_haste),'readonly maxlength="11" placeholder="xxx" autocomplete ="off" OnKeyPress="mascaraInteiro(this)" onpaste="return false;"');
        echo"<td>";
        echo form_label('Fornecedor*');
        echo"</td><td>";
        echo'<select name="fornecedor">';
        if ($todos_fornecedor != NULL) {
            foreach ($todos_fornecedor as $linha) {
                echo'<option value="'.$linha -> id_fornecedor.'">'.$linha -> nome.'</option>';
           }
        }
        echo'</select>';
        echo"</td></tr>";
        echo"<tr><td>";
        echo form_label('Modelo*');
        echo"</td><td>"; 
        echo form_input(array('name'=>'modelo'),  set_value('modelo', $produto['armacao']->modelo),'readonly maxlength="11" placeholder="XX-xxx" autocomplete ="off"');
        echo"</td>";
        echo"<td>";
        echo form_label('Grife*');
        echo"</td><td>";    
        echo'<select name="grife">';
        if ($todas_grife != NULL) {
            foreach ($todas_grife as $linha) {
                echo'<option value="'.$linha -> id.'">'.$linha -> nome.'</option>';

            }    
        }
        echo'</select>';
        echo"</td></tr>";
        echo"</table>";
        echo"</fieldset>";
    echo"</div>";
}
echo "</div>";
echo"</fieldset>";
?>