<?php


echo"<h2>$titulo</h2>";

$id_cliente = $this->uri->segment(3);

if($id_cliente == NULL){
    
    redirect ('cliente/listarClientes');
    
}

$query = $this->cliente_model->retornaCliente($id_cliente);

echo validation_errors('<p>','</p>');


 echo '<p>'.$this->session->flashdata('statusUpdate').'</p>';


echo form_open("cliente/atualizarCliente/$id_cliente");

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
echo form_label('Cpf');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cpf'),  set_value('cpf',$query['cliente']->cpf));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Data Nascimento');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'data_nascimento'),  set_value('data_nascimento',$query['cliente']->data_nascimento));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone Casa');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone1'),  set_value('num_telefone1',$query['telefone'][0]->num_telefone));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Telefone Celular');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'num_telefone2'),  set_value('num_telefone2',$query['telefone'][1]->num_telefone));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Rua');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'rua'),  set_value('rua',$query['endereco']->logradouro));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Bairro');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'bairro'),  set_value('bairro',$query['endereco']->bairro));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Cidade');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cidade'),  set_value('cidade',$query['endereco']->cidade));
echo"<tr><td>";//Essa linha pode remover
echo form_label('Complemento');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'complemento'),  set_value('complemento',$query['endereco']->complemento));
echo"</td></tr>";//Essa linha pode remover
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Estado');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'estado'),  set_value('estado',$query['endereco']->estado));
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Cep');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cep'),  set_value('cep',$query['endereco']->cep));
echo"</td></tr>";//Essa linha pode remover


echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover
echo form_submit(array('name'=>'Alterar'),'Alterar');
echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover


echo form_hidden('id_pessoa',$query['cliente']->id_pessoa);//Campo oculto que armazena id_pessoa
echo form_hidden('id_cliente',$id_cliente);//Campo oculto que armazena id_cliente
echo form_close();

?>
