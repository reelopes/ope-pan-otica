<?php


echo"<h2>$titulo</h2>";

$id_grife = $this->uri->segment(3);

if($id_grife == NULL){
    redirect ('grife/lista');
}

$query = $this->grife_model->get_byid($id_grife);

echo validation_errors('<p>','</p>');


 echo '<p>'.$this->session->flashdata('statusUpdate').'</p>';


echo form_open("grife/update/$id_grife");

echo"<br><center><table>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Descrição');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'nome'),  set_value('descricao',$query['grife']->nome),'autofocus');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover


echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover
echo form_submit(array('name'=>'Alterar'),'Alterar');
echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover


echo form_hidden('id_grife',$id_grife);//Campo oculto que armazena id_cliente
echo form_close();

?>
