<?
$receitas = $receitas;

if ($this->session->flashdata('msg')) {
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');\">";
}

?>

<div class='tabela'>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="lista_dependentes_table1">
        
        <thead>
            <tr>
            <th>Nome</th>
            <th>Data</th>
            <th>Médico</th>
            <th>&nbsp</th>
            </tr>
        </thead>
        <tbody>
<?



foreach ($receitas as $linha) {
    
    if ($linha->id_dependente == null) {
        $all = $this->receita_model->retornaReceita($linha->id);
        $nome = $all['pessoa']->nome;
    } else {
        $all = $this->receita_model->retornaReceita($linha->id);
        $nome = $all['dependente']->nome;
    }
    
    echo "<tr>
        <td valign='middle'>".$nome."</td>
        <td valign='middle'>".$this->util->data_mysql_para_user($linha->data)."</td>
        <td valign='middle'>$linha->medico</td>
        <td valign='middle'><a onClick=\"window.close();window.open('".base_url('receita/visualizaReceita/'.$linha->id)."','40000','40000');\"/><center><img src=".base_url('public/img/pesquisar.png')." width='23' title='Visualizar'></center></a></td>
        </tr>";
}

echo"</tbody>";
echo"</table>";
echo"</div>";
?>