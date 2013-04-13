<?php

echo"<h2>$titulo</h2>";
$id_produto = $this->uri->segment(3);

if($id_produto == NULL){
    redirect ('produto/lista');
}

$query = $this->produto_model->get_byid($id_produto);
echo validation_errors('<p>','</p>');
echo '<p>'.$this->session->flashdata('statusUpdate').'</p>';
echo form_open("Produto/update/$id_produto");

$todos_fornecedor = $this -> fornecedor_model -> getAll() -> result();
$todas_grife = $this -> grife_model -> getAll() -> result();

// Oculta campos e mostra campos de acordo com a escolha
if($query['produto']->categoria == 1) {
// div armacao, carrega campos de armacao
echo'<div id="armacao">';
echo"<p>";
echo"<table>";
echo"<tr><td>";
echo form_label('Largura da lente');
echo"</td><td>"; 
echo form_input(array('name'=>'largura_lente'), set_value('largura_lente', $query['armacao']->largura_lente),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Largura da ponte');
echo"</td><td>"; 
echo form_input(array('name'=>'largura_ponte'), set_value('largura_ponte', $query['armacao']->largura_ponte),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Comprimento da haste');
echo"</td><td>"; 
echo form_input(array('name'=>'comprimento_haste'),
        set_value('comprimento_haste', $query['armacao']->comprimento_haste),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Modelo');
echo"</td><td>"; 
echo form_input(array('name'=>'modelo'), set_value('modelo', $query['armacao']->modelo),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Grife');
echo"</td><td>";    
echo'<select name="grife">';
if ($todas_grife != NULL) {
    foreach ($todas_grife as $linha) {
        if($query['grife']-> id == $linha -> id) {
            echo'<option selected value="'.$linha -> id.'">'.$linha -> nome.'</option>';
        } else {
            echo'<option value="'.$linha -> id.'">'.$linha -> nome.'</option>';
        }
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
        if($query['fornecedorE']-> id == $linha -> id_fornecedor) {
            echo'<option selected value="'.$linha -> id_fornecedor.'">'.$linha -> nome.'</option>';
        } else {
            echo'<option value="'.$linha -> id_fornecedor.'">'.$linha -> nome.'</option>';
        }
   }
}
echo'</select>';
echo"</td></tr>";
echo"<tr><td>";
echo"</table>"; 
echo"</div>";
} else {
    
}

// Campos da tabela Produto
echo"<center><table>";
echo"<tr><td>";
echo form_label('Referencia');
echo"</td><td>";
echo form_input(array('name'=>'referencia'), set_value('referencia', $query['produto']->referencia),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Nome');
echo"</td><td>";
echo form_input(array('name'=>'nome'),
        set_value('nome', $query['produto']->nome),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Descricao');
echo"</td><td>"; 
echo form_input(array('name'=>'descricao'),
        set_value('descricao', $query['produto']->descricao),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Preco de custo');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_custo'),
        set_value('preco_custo', $query['produto']->preco_custo),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Preco de venda');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_venda'),
        set_value('preco_venda', $query['produto']->preco_venda),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Quantidade');
echo"</td><td>"; 
echo form_input(array('name'=>'quantidade'),
        set_value('quantidade', $query['produto']->quantidade),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Status');
echo"</td><td>"; 
echo form_input(array('name'=>'status'),
        set_value('status', $query['produto']->status),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Validade');
echo"</td><td>"; 
echo form_input(array('name'=>'validade'),
        set_value('validade', $query['produto']->validade),'autofocus');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Data de entrega');
echo"</td><td>"; 
echo form_input(array('name'=>'data_entrega'),
        set_value('data_entrega', $query['produto']->data_entrega),'autofocus');
echo"</td></tr>";

echo"</tr><td>"; 
echo"<td>"; 
echo form_submit('', 'Cadastrar');
echo"</td><tr>"; 
echo"</table>";

echo form_hidden('id_produto',$id_produto);

echo form_close();
?>