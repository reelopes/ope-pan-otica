<?php

echo"<h2>$titulo</h2>";//TITULO


$cheques = $this->cheque_model->listaChequesPendentes();

?>

<div class='tabela'>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
        <thead>
            <tr>
                <th width=150>Data</th><th width=400>Descrição</th><th width=160>Valor</th><th width=180>Baixa no cheque</th><th width=210>Alterar data do cheque</th>
            </tr>
        </thead>
        <tbody>

            <?
            foreach ($cheques as $linha) {
                
            if($linha->status=="1"){
                $faltou = "CHECKED";
             }else{
                $faltou=" ";
             }
             
            $data = $this->util->data_mysql_para_user($linha->data);
            if ($linha->data < date('Y-m-d')) {
                $data = "<span title='Título vencido' style='color:red;'>".$data."</span>";
            } else if($linha->data == date('Y-m-d')) {
                $data = "<span title='Vence hoje'><b>".$data."</b></span>";
            }
             
                echo"<tr>";
                echo "<td><center>" . $data . "<center></td>";
                echo "<td>" . $linha->descricao . "</td>";
                echo "<td>R$ " . $this->util->pontoParaVirgula($linha->valor) . "</td>";
                echo "<td><center><input type='checkbox' title='Baixa no cheque' name='a' id=".$linha->id." value='ON' ".$faltou." onClick=\"Baixa('".$linha->id."','".base_url('cheque/baixaCheque')."');\"/></center></td>";
                echo "<td><center><a href=\"javascript:abrirPopUp('" . base_url('cheque/atualizarCheque/' . $linha->id) . "','700','700');\"><img src=../../../../../../../../../CI_otica_pan/public/img/gerenciar_cheques.png width=23 title='Alterar data do cheque'></a></center></td>";
                echo"</tr>";
            }
            ?>
        </tbody>
    </table>
<?

$tmpl = array(
    'table_open'=>'<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">',
    'cell_start' => '<td valign="middle">',
    'cell_end' => '</td>',
    'cell_alt_start' => '<td valign="middle">',
    'cell_alt_end' => '</td>'
);
//echo"<div class='tabela'>";
$this->table->set_template($tmpl);
//echo $this->table->generate();
//echo"</div>";


?>
</div>
