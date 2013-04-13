<?php

echo"<h2>$titulo</h2>";

echo validation_errors('<p>','</p>');

if($this->session->flashdata('cadastrook')){
    echo '<p>'.$this->session->flashdata('cadastrook').'</p>';
}

echo form_open('produto/adiciona');

// Boa pratica, pega variavel da Controller
$todos_fornecedor = $todos_fornecedor;
$todas_grife = $todas_grife;
$carrega = $carrega;

// Oculta campos e mostra campos de acordo com a escolha
if($carrega == 1) {
    echo '<body onload="ocultaLente();" />';
    echo "<table>";
    echo"<tr><td>";
    echo form_label('Categoria');
    echo"</td><td>";
    echo'<select name=produto onChange="mostra(value);">
       <option value="0"> Outro</option>
       <option value="1"  selected> Armação</option>
    </select>';
    echo"</td></tr>";
    echo"<tr><td>";
    echo"</table>";
} else {
    echo '<body onload="ocultaArmacao();ocultaLente();" />';
    echo "<table>";
    echo"<tr><td>";
    echo form_label('Categoria');
    echo"</td><td>"; 
    echo'<select name=produto onChange="mostra(value);">
       <option value="0"> Outro</option>
       <option value="1"> Armação</option>
    </select>';
    echo"</td></tr>";
    echo"<tr><td>";
    echo"</table>";
}

// div armacao, carrega campos de armacao
echo'<div id="armacao">';
echo"<p>";
echo"<table>";
echo"<tr><td>";
echo form_label('Largura da lente');
echo"</td><td>"; 
echo form_input(array('name'=>'largura_lente'),  set_value('largura_lente'),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Largura da ponte');
echo"</td><td>"; 
echo form_input(array('name'=>'largura_ponte'),  set_value('largura_ponte'),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Comprimento da haste');
echo"</td><td>"; 
echo form_input(array('name'=>'comprimento_haste'),  set_value('comprimento_haste'),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Modelo');
echo"</td><td>"; 
echo form_input(array('name'=>'modelo'),  set_value('modelo'),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Grife');
echo"</td><td>";    
echo'<select name="grife">';
echo'<option value="'. 1 .'">'. 2 .'</option>';
if ($todas_grife != NULL) {
    foreach ($todas_grife as $linha) {
        echo'<option value="'.$linha -> id.'">'.$linha -> nome.'</option>';
        
    }    
}
echo'</select>';
echo"</td></tr>";
echo"<tr><td>";
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
echo"</table>"; 
echo"</div>";

// Campos da tabela Produto
echo"<center><table>";
echo"<tr><td>";
echo form_label('Referencia');
echo"</td><td>";
echo form_input(array('name'=>'referencia'),  set_value('referencia'));
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Nome');
echo"</td><td>";
echo form_input(array('name'=>'nome'),  set_value('nome'));
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Descricao');
echo"</td><td>"; 
echo form_input(array('name'=>'descricao'),  set_value('descricao'));
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Preco de custo');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_custo'),  set_value('preco_custo'));
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Preco de venda');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_venda'),  set_value('preco_venda'));
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Quantidade');
echo"</td><td>"; 
echo form_input(array('name'=>'quantidade'),  set_value('quantidade'));
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Status');
echo"</td><td>"; 
echo form_input(array('name'=>'status'),  set_value('status'));
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Validade');
echo"</td><td>"; 
echo form_input(array('name'=>'validade'),  set_value('validade'));
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Data de entrega');
echo"</td><td>"; 
echo form_input(array('name'=>'data_entrega'),  set_value('data_entrega'));
echo"</td></tr>";

echo"</tr><td>"; 
echo"<td>"; 
echo form_submit('', 'Cadastrar');
echo"</td><tr>"; 
echo"</table>";

echo form_close();
?>
