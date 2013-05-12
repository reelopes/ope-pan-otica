<?php

echo"<div class=formulario>";
echo"<h2>$titulo</h2>";

if($this->session->flashdata('cadastrook')){
    $msg = $this->session->flashdata('cadastrook');
    echo "<body onload=\"ocultaArmacao(); alert('$msg');\">";
}

// Boa pratica, pega variavel da Controller
$todos_fornecedor = $todos_fornecedor;
$todas_grife = $todas_grife;
$carrega = $carrega;

if($carrega == 1) {
    echo '<body onload="mostraArmacao();" />';
} else {
    echo '<body onload="ocultaArmacao();" />';
}

echo form_open('produto/adiciona');

echo  '<p onClick="if (! confirm(\'Preço de custo é maior que Preço de venda.\n Deseja Cadastrar mesmo assim?\')) { return false; }">';


// Campos da tabela Produto
echo"<fieldset>";
echo"<legend>Produto</legend>";
echo"<table>";
echo"<tr><td>";
echo form_label('Categoria');
echo"</td><td>";
// Oculta campos e mostra campos de acordo com a escolha
if($carrega == 1) {
    echo '<body onload="mostraArmacao();" />';
    echo'<select name=produto onChange="mostra(value);">
       <option value="0"> Outro</option>
       <option value="1"  selected> Armação</option>
    </select>';
} else {
    echo '<body onload="ocultaArmacao();" />';
    echo'<select name=produto onChange="mostra(value);">
       <option value="0"> Outro</option>
       <option value="1"> Armação</option>
    </select>';
}

echo"</td>";
echo"<td>";
echo form_label('Codigo de Barra');
echo"</td><td>";
echo form_input(array('name'=>'cod_barra'),  set_value('cod_barra'), 'maxlength="20" placeholder="Código do Produto" autocomplete ="off" style="width:150px;" onpaste="return false;" autofocus');
echo"<tr><td>";
echo form_label('Nome');
echo"</td><td>";
echo form_input(array('name'=>'nome'),  set_value('nome'), 'maxlength="50" placeholder="Nome do produto" autocomplete ="off" style="width:250px;" required title="Campo nome é obrigatório"');
echo"</td>";
echo"<td>";
echo form_label('Descrição');
echo"</td><td>"; 
echo form_input(array('name'=>'descricao'),  set_value('descricao'), 'placeholder="Descrição do produto" autocomplete ="off" style="width:250px;"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Preço de custo');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_custo'),  set_value('preco_custo'), 'id="precoCusto" maxlength="3" placeholder="0.000,00" autocomplete ="off" onkeypress="return(FormataReais(this,\'.\',\',\',event));" style="width:80px;" onpaste="return false;" required title="Campo preço é obrigatório"');
echo"</td>";
echo"<td>";
echo form_label('Preço de venda');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_venda'),  set_value('preco_venda'), 'id="precoVenda" maxlength="3" placeholder="0.000,00" autocomplete ="off" onkeypress="return(FormataReais(this,\'.\',\',\',event));" style="width:80px;" onpaste="return false;" required title="Campo preço é obrigatório"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Quantidade');
echo"</td><td>"; 
echo form_type(array('name'=>'quantidade'), '1', ' maxlenght="11" min="0" autocomplete="off" style="width:100px;" OnKeyPress="mascaraInteiro(this)" onpaste="return false;" required title="Campo quantidade é obrigatório"', 'number');
echo"</td><td>";
echo form_label('Validade');
echo"</td><td>"; 
echo form_type(array('name'=>'validade'),  set_value('validade'),'maxlength="10" autocomplete ="off" min="'.date('Y-m-d').'"','date');
echo form_error('validade');
echo"</td></tr>";
echo"</table>";
echo"<p></p>";
    // div armacao, carrega campos de armacao
    echo'<div id="armacao">';
        echo"<fieldset>";
        echo"<legend>Armação</legend>";
        echo"<table>";
        echo"<tr><td>";
        echo form_label('Largura da lente');
        echo"</td><td>"; 
        echo form_input(array('name'=>'largura_lente'),  set_value('largura_lente'),'maxlength="11" placeholder="xx" autocomplete ="off" OnKeyPress="mascaraInteiro(this)" onpaste="return false;"');
        echo"</td>";
        echo"<td>";
        echo form_label('Largura da ponte');
        echo"</td><td>"; 
        echo form_input(array('name'=>'largura_ponte'),  set_value('largura_ponte'),'maxlength="11" placeholder="xx" autocomplete ="off" OnKeyPress="mascaraInteiro(this)" onpaste="return false;"');
        echo"</td></tr>";
        echo"<tr><td>";
        echo form_label('Comprimento da haste');
        echo"</td><td>";
        echo form_input(array('name'=>'comprimento_haste'),  set_value('comprimento_haste'),'maxlength="11" placeholder="xxx" autocomplete ="off" OnKeyPress="mascaraInteiro(this)" onpaste="return false;"');
        echo"<td>";
        echo form_label('Fornecedor');
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
        echo form_label('Modelo');
        echo"</td><td>"; 
        echo form_input(array('name'=>'modelo'),  set_value('modelo'),'maxlength="11" placeholder="XX-xxx" autocomplete ="off"');
        echo"</td>";
        echo"<td>";
        echo form_label('Grife');
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
echo"<p></p>";
echo"<table>";
echo"<tr><td>";
echo form_label('','',array('style' => 'padding-right:80px;',));
echo form_submit('', 'Cadastrar','onClick="if (precoCusto.value > precoVenda.value) { if (! confirm(\'Preço de custo é maior que Preço de venda.\n\nDeseja Cadastrar mesmo assim?\')) { return false;} }"');
echo"</td></tr>"; 
echo"</table>";
echo "</div>";
echo"</fieldset>";

echo validation_errors('<p>','</p>');

echo form_close();
?>
