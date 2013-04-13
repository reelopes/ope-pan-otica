<?php


echo"<h2>$titulo</h2>";

$id_tipo_lente = $this->uri->segment(3);

if($id_tipo_lente == NULL){
    redirect ('tipo_lente/lista');
}

$query = $this->tipo_lente_model->get_byid($id_tipo_lente);

echo validation_errors('<p>','</p>');


 echo '<p>'.$this->session->flashdata('statusUpdate').'</p>';


echo form_open("tipo_lente/update/$id_tipo_lente");

echo"<br><center><table>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Descrição');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'tipo'),  set_value('tipo',$query['tipo_lente']->tipo),'autofocus');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover


echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover
echo form_submit(array('name'=>'Alterar'),'Alterar');
echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover


echo form_hidden('id_tipo_lente',$id_tipo_lente);//Campo oculto que armazena id_cliente
echo form_close();

?>
