<?php


echo"<h2>$titulo</h2>";

$id_produto = $this->uri->segment(3);

if($id_produto == NULL){
    
    redirect ('produto/lista');
    
}

$query = $this->produto_model->get_byid($id_produto);

echo validation_errors('<p>','</p>');


 echo '<p>'.$this->session->flashdata('statusUpdate').'</p>';


echo form_open("Fornecedor/update/$id_pessoa/$id_fornecedor");

echo"<br><center><table>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Nome');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'nome'),  set_value('nome',$query['pessoa']->nome),'autofocus');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Email');
echo"</td><td>";//Essa linha pode remover
echo form_input(array('name'=>'email'),set_value('email',$query['pessoa']->email));
echo"<tr><td>";//Essa linha pode remover
echo form_label('Cnpj');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cnpj'),  set_value('cnpj',$query['fornecedor']->cnpj));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone1'),  set_value('num_telefone1',$query['telefone'][0]->num_telefone));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone Celular');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone2'),  set_value('num_telefone2',$query['telefone'][1]->num_telefone));
echo"</td></tr>";//Essa linha pode remover

echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover
echo form_submit(array('name'=>'Alterar'),'Alterar');
echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover


echo form_hidden('id_pessoa',$id_pessoa);//Campo oculto que armazena id_pessoa
echo form_hidden('id_fornecedor',$id_fornecedor);//Campo oculto que armazena id_cliente
echo form_close();

?>
