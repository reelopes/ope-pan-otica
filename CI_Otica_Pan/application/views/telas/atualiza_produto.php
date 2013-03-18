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

echo"<br><center><table>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
//echo form_label('Código de Barra');
//echo"</td><td>"; //Essa linha pode remover
//echo form_input(array('name'=>'cod_barra'),  set_value('cod_barra'),'autofocus');
//echo"</td></tr>";//Essa linha pode remover
//echo"<tr><td>";//Essa linha pode remover
echo form_label('Data de Entrega');
echo"</td><td>";//Essa linha pode remover
echo form_input(array('name'=>'data_entrega'), set_value('data_entrega',$query['produto']->data_entrega),'autofocus');
echo"<tr><td>";//Essa linha pode remover
echo form_label('Descrição');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'descricao'), set_value('descricao',$query['produto']->descricao),'autofocus');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Preço');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'preco'), set_value('preco',$query['produto']->preco),'autofocus');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Quantidade');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'quantidade'), set_value('quantidade',$query['produto']->quantidade),'autofocus');
echo"</td></tr>";//Essa linha pode remove
echo"<tr><td>";//Essa linha pode remover
echo form_label('Status');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'status'), set_value('status',$query['produto']->status),'autofocus');
echo"</td></tr>";//Essa linha pode remove
echo"<tr><td>";//Essa linha pode remover
echo form_label('Validade');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'validade'), set_value('validade',$query['produto']->validade),'autofocus');
echo"</td></tr>";//Essa linha pode remove


echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover
echo form_submit(array('name'=>'Alterar'),'Alterar');
echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover


echo form_hidden('id_produto',$id_produto);//Campo oculto que armazena id_pessoa
echo form_close();

?>
