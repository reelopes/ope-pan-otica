<?php


echo"<h2>$titulo</h2>";

$id_cliente = $this->uri->segment(3);

echo validation_errors('<p>','</p>');

if ($this->session->flashdata('msg')) {
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');window.opener.location.reload();window.close();\">";
}


echo"<br><center><table>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo "Nome: ";
echo"</td><td>"; //Essa linha pode remover
echo $cliente['pessoa']->nome;
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo "Email: ";
echo"</td><td>";//Essa linha pode remover
echo $cliente['pessoa']->email;
echo"<tr><td>";//Essa linha pode remover
echo "CPF: ";
echo"</td><td>"; //Essa linha pode remover
echo $cliente['cliente']->cpf;
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo "Data Nascimento: ";
echo"</td><td>"; //Essa linha pode remover
echo $this->util->data_mysql_para_user($cliente['cliente']->data_nascimento);
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo "Telefone Casa: ";
echo"</td><td>"; //Essa linha pode remover
echo $cliente['telefone'][0]->num_telefone;
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo "Telefone Celular: ";
echo"</td><td>"; //Essa linha pode remover
echo $cliente['telefone'][1]->num_telefone;
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo "Rua: ";
echo"</td><td>"; //Essa linha pode remover
echo $cliente['endereco']->logradouro;
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo "Bairro: ";
echo"</td><td>"; //Essa linha pode remover
echo $cliente['endereco']->bairro;
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo "Cidade: ";
echo"</td><td>"; //Essa linha pode remover
echo $cliente['endereco']->cidade;
echo"<tr><td>";//Essa linha pode remover
echo "Complemento: ";
echo"</td><td>"; //Essa linha pode remover
echo $cliente['endereco']->complemento;
echo"</td></tr>";//Essa linha pode remover
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo "Estado: ";
echo"</td><td>"; //Essa linha pode remover
echo $cliente['endereco']->estado;
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo "CEP: ";
echo"</td><td>"; //Essa linha pode remover
echo $cliente['endereco']->cep;
echo"</td></tr>";//Essa linha pode remover


echo"</tr><td>"; //Essa linha pode remover
echo"<td>"; //Essa linha pode remover

echo"</td><tr>"; //Essa linha pode remover
echo"</table>"; //Essa linha pode remover
echo"</center>";//Essa pode remover

$dependentes = $this->dependente_model->listarDependentes($id_cliente);


    
echo "<h3>Dependentes</h3>";
if($dependentes==NULL){

    echo"Este cliente não possui dependentes!";
}else {
    

?>

    

<table border="1" width="100%"  class="listholover">
    <tr class="cabecalhoTabela">
        <td>NOME</td>
        <td>DATA DE NASCIMENTO</td>
        <td>RESPONSÁVEL</td>
        <td>EDITAR</td>
        <td>EXCLUIR</td>
    </tr>

<?



foreach ($dependentes as $linha) {
    
    
    
         echo "<tr class='alt'>
        <td>$linha->nome</td>
        <td>".$this->util->data_mysql_para_user($linha->data_nascimento)."</td>
        <td>$linha->responsavel</td>
        <td><a href=\"javascript:abrirPopUpAlteraDependente('".base_url('dependente/atualizarDependente/'.$linha->id_dependente)."');\"><center>Editar</center></a></td>
        <td>".anchor('dependente/deletarDependente/'.$id_cliente.'/'.$linha->id_dependente,'<center>Excluir</center>','onclick="if (! confirm(\'Tem certeza que deseja excluir o dependente abaixo? \n\n Nome: '.$linha->nome.'\n Data de Nascimento: '.$this->util->data_mysql_para_user($linha->data_nascimento).'\n Responsável: '.$linha->responsavel.'\')) { return false; }"')."</td>
            
</tr>";
    
    
} 
}




?>
