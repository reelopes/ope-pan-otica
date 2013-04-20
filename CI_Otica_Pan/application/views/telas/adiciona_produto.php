<?php

echo"<div class=formulario>";
echo"<h2>$titulo</h2>";

if($this->session->flashdata('cadastrook')){
    $msg = $this->session->flashdata('cadastrook');
    echo "<body onload=\"ocultaArmacao(); alert('$msg');\">";
}

if($carrega == 1) {
    echo '<body onload="mostraArmacao();" />';
} else {
    echo '<body onload="ocultaArmacao();" />';
}

echo form_open('produto/adiciona');

// Boa pratica, pega variavel da Controller
$todos_fornecedor = $todos_fornecedor;
$todas_grife = $todas_grife;
$carrega = $carrega;

// Campos da tabela Produto
echo"<fieldset>";
echo"<legend>Produto:</legend>";
echo"<table>";
echo"<tr><td>";
echo form_label('Categoria','',array('style' => 'padding-right: 78px;'));
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
echo form_label('Referencia');
echo"</td><td>";
echo form_input(array('name'=>'referencia'),  set_value('referencia'), 'maxlength="8" placeholder="Código do Produto" autocomplete ="off" style="width:150px;"');
echo"<tr><td>";
echo form_label('Nome');
echo"</td><td>";
echo form_input(array('name'=>'nome'),  set_value('nome'), 'maxlength="20" placeholder="Nome do produto" autocomplete ="off" style="width:250px;"');
echo"</td>";
echo"<td>";
echo form_label('Descricao');
echo"</td><td>"; 
echo form_input(array('name'=>'descricao'),  set_value('descricao'), 'maxlength="200" placeholder="Descrição do produto" autocomplete ="off" style="width:250px;"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Preco de custo');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_custo'),  set_value('preco_custo'), 'maxlength="7" placeholder="0000,00" autocomplete ="off" style="width:80px;" onkeypress="return(FormataReais(this,\'.\',\'.\',event))"');
echo"</td>";
echo"<td>";
echo form_label('Preco de venda');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_venda'),  set_value('preco_venda'), 'maxlength="7" placeholder="0000,00" autocomplete ="off" style="width:80px;" onkeypress="return(FormataReais(this,\'.\',\'.\',event))"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Quantidade');
echo"</td><td>"; 
echo form_input(array('name'=>'quantidade'),  set_value('quantidade'), 'maxlength="8"  placeholder="00" autocomplete ="off" style="width:150px;"');
echo"</td>";
echo"<td>";
echo form_label('Status');
echo"</td><td>"; 
echo'<select name="status">
    <option value="Disponível"> Disponível</option>
    <option value="Indisponível"> Indisponível</option>
    </select>';
//echo form_input(array('name'=>'status'),  set_value('status'), 'placeholder="" autocomplete ="off" style="width:300px;"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Validade');
echo"</td><td>"; 
echo form_input(array('name'=>'validade'),  set_value('validade'), 'maxlength="10" placeholder="DD/MM/AAAA" autocomplete ="off" style="width:150px;" OnKeyPress="MascaraData(this)"');
echo"</td></tr>";
echo"</table>";

    // div armacao, carrega campos de armacao
    echo'<div id="armacao">';
        echo"<table>";
        echo"<tr><td>";
        echo form_label('Largura da lente');
        echo"</td><td>"; 
        echo form_input(array('name'=>'largura_lente'),  set_value('largura_lente'),'placeholder="xx" autocomplete ="off"');
        echo"</td>";
        echo"<td>";
        echo form_label('Largura da ponte');
        echo"</td><td>"; 
        echo form_input(array('name'=>'largura_ponte'),  set_value('largura_ponte'),'placeholder="xx" autocomplete ="off"');
        echo"</td></tr>";
        echo"<tr><td>";
        echo form_label('Comprimento da haste');
        echo"</td><td>";
        echo form_input(array('name'=>'comprimento_haste'),  set_value('comprimento_haste'),'placeholder="xxx" autocomplete ="off"');
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
        echo form_input(array('name'=>'modelo'),  set_value('modelo'),'placeholder="x.xxx" autocomplete ="off"');
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
    echo"</div>";

echo"<table>";
echo"<tr><td>";
echo form_label('','',array('style' => 'padding-right: 145px;',));
echo form_submit('', 'Cadastrar');
echo"</td></tr>"; 
echo"</table>";
echo "</div>";
echo"</fieldset>";

echo validation_errors('<p>','</p>');

echo form_close();
?>
