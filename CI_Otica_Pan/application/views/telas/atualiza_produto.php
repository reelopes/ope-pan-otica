<?php

echo"<div class=formulario>";
echo"<h2>$titulo</h2>";
$id_produto = $this->uri->segment(3);

if($id_produto == NULL){
    redirect ('produto/lista');
}

if($this->session->flashdata('statusUpdate')){
    $msg = $this->session->flashdata('statusUpdate');
    echo "<body onLoad=\" alert('$msg');\">";
}

$query = $this->produto_model->get_byid($id_produto);
echo validation_errors('<p>','</p>');
echo '<p>'.$this->session->flashdata('statusUpdate').'</p>';
echo form_open("Produto/update/$id_produto");

$todos_fornecedor = $this -> fornecedor_model -> getAll() -> result();
$todas_grife = $this -> grife_model -> getAll() -> result();

echo"<fieldset>";
echo"<legend>Produto</legend>";
echo"<table>";
// Campos da tabela Produto
//echo"<center><table>";
echo"<tr><td>";
echo form_label('Referencia');
echo"</td><td>";
echo form_input(array('name'=>'referencia'), set_value('referencia', $query['produto']->referencia), 'maxlength="8" placeholder="Código do Produto" autocomplete ="off" style="width:150px;" onpaste="return false;"');
echo"</td><td>";
echo form_label('Nome');
echo"</td><td>";
echo form_input(array('name'=>'nome'),
        set_value('nome', $query['produto']->nome), 'maxlength="20" placeholder="Nome do produto" autocomplete ="off" style="width:250px;"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Descricao');
echo"</td><td colspan='3'>"; 
echo form_input(array('name'=>'descricao'),
        set_value('descricao', $query['produto']->descricao), 'maxlength="200" placeholder="Descrição do produto" autocomplete ="off" style="width:525px;"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Preco de custo');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_custo'),
        set_value('preco_custo', $query['produto']->preco_custo), 'maxlength="7" placeholder="0000,00" autocomplete ="off" onkeypress="return(FormataReais(this,\'.\',\'.\',event))" style="width:80px;" onpaste="return false;"');
echo"</td><td>";
echo form_label('Preco de venda');
echo"</td><td>"; 
echo form_input(array('name'=>'preco_venda'),
        set_value('preco_venda', $query['produto']->preco_venda), 'placeholder="0000,00" autocomplete ="off" onkeypress="return(FormataReais(this,\'.\',\'.\',event)); maxlength="7"" style="width:80px;" onpaste="return false;"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Quantidade');
echo"</td><td>"; 
echo form_input(array('name'=>'quantidade'),
        set_value('quantidade', $query['produto']->quantidade), 'maxlength="8"  placeholder="00" autocomplete ="off" style="width:150px;" onpaste="return false;"');
echo"</td><td>";
echo form_label('Status');
echo"</td><td>"; 
echo'<select name="status">';
        if($query['produto']->status == "Disponível") {
            echo '<option value="Disponível"> Disponível</option>';
            echo '<option value="Indisponível"> Indisponível</option></select>';
        } else {
            echo '<option value="Disponível"> Disponível</option>';
            echo '<option selected value="Indisponível"> Indisponível</option></select>';
        }
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Validade');
echo"</td><td>"; 
echo form_input(array('name'=>'validade'),
        set_value('validade', $this->util->data_mysql_para_user($query['produto']->validade)),'maxlength="10" autocomplete ="off" placeholder="DD/MM/AAAA" OnKeyPress="MascaraData(this)" onpaste="return false;"');
echo"</td></tr>";
echo "</table>";
// Oculta campos e mostra campos de acordo com a escolha
if($query['produto']->categoria == 1) {
// div armacao, carrega campos de armacao
echo'<div id="armacao">';
        echo"<fieldset>";
        echo"<legend>Armação</legend>";
        echo "<table>";
        echo"<tr><td>";
        echo form_label('Largura da lente');
        echo"</td><td>"; 
        echo form_input(array('name'=>'largura_lente'), set_value('largura_lente', $query['armacao']->largura_lente),'maxlength="11" placeholder="xx" autocomplete ="off" OnKeyPress="mascaraInteiro(this)" onpaste="return false;"');
        echo"</td><td>";
        echo form_label('Largura da ponte');
        echo"</td><td>"; 
        echo form_input(array('name'=>'largura_ponte'), set_value('largura_ponte', $query['armacao']->largura_ponte),'maxlength="11" placeholder="xx" autocomplete ="off" OnKeyPress="mascaraInteiro(this)" onpaste="return false;"');
        echo"</td></tr>";
        echo"<tr><td>";
        echo form_label('Comprimento da haste');
        echo"</td><td>"; 
        echo form_input(array('name'=>'comprimento_haste'),
                set_value('comprimento_haste', $query['armacao']->comprimento_haste),'maxlength="11" placeholder="xxx" autocomplete ="off" OnKeyPress="mascaraInteiro(this)" onpaste="return false;"');
        echo"</td><td>";
        echo form_label('Modelo');
        echo"</td><td>"; 
        echo form_input(array('name'=>'modelo'), set_value('modelo', $query['armacao']->modelo),'maxlength="11" placeholder="XX-xxx" autocomplete ="off"');
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
        echo"</td><td>";
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
        echo"</fieldset>";
        echo"</table>";
echo"</div>";
}

echo"<p>";
echo"<table>";
echo"<tr><td>";
echo form_label('','',array('style' => 'padding-right: 75px;',));
echo form_submit('', 'Alterar');
echo"</td></tr>";
echo"</table>";
echo"</fieldset>";
echo "</div>";

echo form_hidden('id_produto',$id_produto);
echo form_hidden('produto',$query['produto']->categoria);

echo form_close();
?>