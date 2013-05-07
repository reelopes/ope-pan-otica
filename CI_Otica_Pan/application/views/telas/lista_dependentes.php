<?
echo"<h2>$titulo</h2>";
$id_cliente = $this->uri->segment(3);
$dependentes = $this->dependente_model->listarDependentes($id_cliente);
?>


<div class='tabela'>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="lista_dependentes_table1">
        
        <thead>
            <tr>
        <th>Nome</th>
        <th>Data Nas.</th>
        <th>Responsável</th>
        <th>&nbsp</th>
        <th>&nbsp</th>
        </tr>
        </thead>
        <tbody>
<?



foreach ($dependentes as $linha) {
    
    
    
   echo "<tr>
        <td valign='middle'>$linha->nome</td>
        <td valign='middle'>".$this->util->data_mysql_para_user($linha->data_nascimento)."</td>
        <td valign='middle'>$linha->responsavel</td>
        <td valign='middle'><a href=\"javascript:abrirPopUp('".base_url('dependente/atualizarDependente/'.$linha->id_dependente)."','500','300');\"><center><img src=".base_url('public/img/edit.png')." width='23' title='Editar'></center></a></td>
        <td valign='middle'>".anchor('dependente/deletarDependente/'.$id_cliente.'/'.$linha->id_dependente,'<center><img src="'.base_url('public/img/delete.png').'" width="23" title="Excluir" /></center>','onclick="if (! confirm(\'Tem certeza que deseja excluir o dependente abaixo? \n\n Nome: '.$linha->nome.'\n Data de Nascimento: '.$this->util->data_mysql_para_user($linha->data_nascimento).'\n Responsável: '.$linha->responsavel.'\')) { return false; }"')."</td>
            
</tr>";
    
    
} 
echo"</tbody>";
echo"</table>";
echo"</div>";
?>