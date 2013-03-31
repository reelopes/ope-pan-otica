<?php

echo"<h2>$titulo</h2>";

echo validation_errors('<p>','</p>');

if($this->session->flashdata('cadastrook')){
    
    echo '<p>'.$this->session->flashdata('cadastrook').'</p>';
}

echo form_open('produto/adiciona');

// Boa pratica, pega variavel da Controller
$tipo_lente = $tipo_lente; 
$fornecedor = $fornecedor;

// Oculta campos e mostra campos de acordo com a escolha
if($carrega == 1) {
    echo '<body onload="ocultaLente();" />';
    echo "<table>";
    echo"<tr><td>";
    echo form_label('Categoria');
    echo"</td><td>";
    echo'<select name=produto onChange="mostra(value);">
       <option value="0"> Selecione...</option>
       <option value="1"  selected> Armação</option>
       <option value="2"> Lente</option>
    </select>';
    echo"</td></tr>";
    echo"<tr><td>";
    echo"</table>";
} else if ($carrega == 2) {
    echo '<body onload="ocultaArmacao()" />';
    echo "<table>";
    echo"<tr><td>";
    echo form_label('Categoria');
    echo"</td><td>";
    echo'<select name=produto onChange="mostra(value);">
       <option value="0"> Selecione...</option>
       <option value="1"> Armação</option>
       <option value="2" selected> Lente</option>
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
       <option value="0"> Selecione...</option>
       <option value="1"> Armação</option>
       <option value="2"> Lente</option>
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
echo form_label('Aro');
echo"</td><td>"; 
echo form_input(array('name'=>'aro'),  set_value('aro'),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Marca');
echo"</td><td>"; 
echo form_input(array('name'=>'marca_armacao'),  set_value('marca_armacao'),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Modelo');
echo"</td><td>"; 
echo form_input(array('name'=>'modelo'),  set_value('modelo'),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Preço de Custo');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_custo'),  set_value('preco_custo'),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Fornecedor');
echo"</td><td>";
   
echo'<select name="fornecedor">';
if ($fornecedor != NULL) {
    foreach ($fornecedor as $linha) {
        echo'<option value="'.$linha -> id_pessoa.'">'.$linha -> nome.'</option>';
   }
}
echo'</select>';
echo"</td></tr>";
echo"<tr><td>";
echo"</table>"; 
echo"</div>";

// div lente, carrega campos de lente
echo'<div id="lente">';
echo "<table>";
    echo"<tr><td>";
    echo form_label('Tipo de Lente');
    echo"</td><td>";
    
    echo'<select name="lista_tipo_lente">';
    if ($tipo_lente != NULL) {
        foreach ($tipo_lente as $linha) {
           echo'<option value="'.$linha -> id.'">'.$linha -> descricao.'</option>';
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
//echo form_label('Código de Barra');
//echo"</td><td>"; 
//echo form_input(array('name'=>'cod_barra'),  set_value('cod_barra'),'autofocus');
//echo"</td></tr>";
//echo"<tr><td>";
//echo form_label('Data de Entrega');
//echo"</td><td>";
//echo form_input(array('name'=>'data_entrega'),set_value('data_entrega'));
//echo"<tr><td>";
echo form_label('Descrição');
echo"</td><td>";
echo form_input(array('name'=>'descricao'),  set_value('descricao'));
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Preço');
echo"</td><td>";
echo form_input(array('name'=>'preco'),  set_value('preco'));
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Quantidade');
echo"</td><td>"; 
echo form_input(array('name'=>'quantidade'),  set_value('quantidade'));
echo"</td></tr>";
//echo"<tr><td>";
//echo form_label('Status');
//echo"</td><td>"; 
//echo form_input(array('name'=>'status'),  set_value('status'));
//echo"</td></tr>";//Essa linha pode remove
echo"<tr><td>";
echo form_label('Validade');
echo"</td><td>"; 
echo form_input(array('name'=>'validade'),  set_value('validade'));
echo"</td></tr>";

echo"</tr><td>"; 
echo"<td>"; 
echo form_submit('', 'Cadastrar');
echo"</td><tr>"; 
echo"</table>";

echo form_close();
?>
