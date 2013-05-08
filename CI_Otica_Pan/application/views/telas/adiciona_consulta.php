<?php

echo"<div class=formulario style='  margin-left: 40px; width: 600px;  padding: 2px 2px 2px;  border-radius: 3px;'>";
echo"<h2>$titulo</h2>";//TITULO
//Exime mensagem de agendamento do cliente Javascript
if ($this->session->flashdata('msg')) {
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');\">";
}
//Tratamento das mensagem, se for ok, exime a mensagem e fecha o popup
if ($this->session->flashdata('msgOk')) {
    $msg = $this->session->flashdata('msgOk');
    echo "<body onLoad=\" alert('$msg');window.opener.location.reload();window.close();\">";
}


$agendamento = $agendamento;//Boas praticas, captura o agendamento da controler

foreach ($agendamento as $agendamento)//Transforma as informações no array mais amigavel
    
echo form_open('consulta/cadastrarConsulta');

echo"<fieldset>";
echo"<legend>Dados do Cliente:</legend>";
echo"<table>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Nome do Cliente');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'nome_cliente'), $agendamento->nome_cliente,'placeholder="Nome Completo do Cliete" style="width:300px;" readonly');
echo"</td></tr>";//Essa linha pode remover
if($agendamento->nome_dependente != NULL){
    echo"<tr><td>";//Essa linha pode remover
echo form_label('Nome do Dependente');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'nome_dependente'), $agendamento->nome_dependente,'placeholder="Nome Completo do Cliete" style="width:300px;" readonly');
echo"</td></tr>";//Essa linha pode remover
}
echo"<tr><td>";//Essa linha pode remover
echo form_label('Email');
echo"</td><td>";//Essa linha pode remover
echo form_input(array('name'=>'email'),$agendamento->email,'placeholder="exemplo@exemplo.com.br" style="width:300px;" readonly');
echo"<tr><td>";//Essa linha pode remover
echo form_label('CPF');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'cpf'),$agendamento->cpf,'placeholder="XXX.XXX.XXX-XX" readonly');
echo"</td></tr>";//Essa linha pode remover
echo"<tr><td>";//Essa linha pode remover
echo form_label('Data da Consulta');
echo"</td><td>"; //Essa linha pode remover
echo form_input(array('name'=>'data_consulta'), $this->util->data_mysql_para_user($agendamento->data_consulta),'readonly style="width:100px;"');
echo form_label('Horário da Consulta');
echo form_input(array('name'=>'horario_consulta'),$agendamento->horario_consulta,'readonly style="width:70px;"');
echo"</td></tr>";//Essa linha pode remover
echo"</table>";
echo"<br>";
echo"</fieldset>";
echo"<fieldset>";
echo"<legend>Dados da Consulta:</legend>";
echo"<table border='0' width='100%'>";

echo"<tr  align='center'>";
echo"<td colspan='2'></td>";
echo"<td>Esférica</td>";
echo"<td>Cilindrica</td>";
echo"<td>Eixo</td>";
echo"<td>DP</td>";
echo"</tr>";

echo"<tr style='border: 1px solid #666666;'>";
echo"<td rowspan='2' align='right' valign='middle'>Longe</td>";
echo"<td align='right' style='border-left:1px solid #666666;'>OD</td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"</tr>";

echo"<tr style='border: 1px solid #666666;'>";
echo"<td align='right' style='border-left:1px solid #666666;'>OE</td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"</tr>";

echo"<tr>";
echo"<td colspan='6'>&nbsp;</td>";
echo"</tr>";

echo"<tr style='border: 1px solid #666666;'>";
echo"<td rowspan='2' align='right' valign='middle'>Longe</td>";
echo"<td align='right' style='border-left:1px solid #666666;'>OD</td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"</tr>";

echo"<tr style='border: 1px solid #666666;'>";
echo"<td align='right' style='border-left:1px solid #666666;'>OE</td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:100px;'></td>";
echo"</tr>";

echo"</table>"; //Essa linha pode remover
echo"</fieldset>";

echo form_close();

echo "</div>";


?>
