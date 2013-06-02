<?php

echo"<div class=formulario>";
echo"<h2>$titulo</h2>";//TITULO

echo form_open('receita/adicionaReceita');

$id_cliente = $_GET['idCliente'];
$dependentes = $this->dependente_model->listarDependentes($id_cliente);
$nome = $_GET['nomeCliente'];
$cpf = $_GET['cpfCliente'];
$email = $_GET['emailCliente'];

echo"<fieldset>";
echo"<legend>Dados do Cliente:</legend>";
echo"<table>";
echo"<tr><td>";
echo form_label('Nome do Cliente');
echo"</td><td>"; 
echo form_input(array('name'=>'cliente'),$nome,'style="width:350px; height:25px;" readonly');
echo"</td><td>";
echo form_label('Para: ');
echo"</td><td>";
echo'<select name="dependente" style=" height:25px;">';
        echo'<option value="">Próprio cliente</option>';
        foreach($dependentes as $linha) {
            echo'<option value="'.$linha->id_dependente.'">'.$linha->nome.'</option>';
        }
        echo'</select>';
echo"</td></tr>";
echo"<tr><td>";
echo form_label('Email');
echo"</td><td>";
echo form_input(array('name'=>'email'),$email,'style="width:300px;" readonly');
echo"<tr><td>";
echo form_label('CPF');
echo"</td><td>"; 
echo form_input(array('name'=>'cpf'),$cpf,'style="width:125px; height:25px;" readonly');
echo "<img src='".base_url("public/img/search.png")."' width='33px' title='Pesquisar Cliente' style='vertical-align: middle; cursor: hand;' OnClick=\"abrirPopUp('".base_url('receita/listarClientes')."','600','445');\">";
echo"</td></tr>";
echo"</table>";
echo"<br>";
echo"</fieldset>";

echo"<fieldset>";
echo"<legend>Dados do Médico:</legend>";
echo"<table>";
echo"<tr><td>";
echo form_label('Nome do Médico');
echo"</td><td>"; 
echo form_input(array('name'=>'medico'),'','autocomplete ="off" placeholder="nome do médico" style="width:400px;"');
echo"</td></tr>";
echo"<tr><td>";
echo form_label('CRM');
echo"</td><td>";
echo form_input(array('name'=>'crm'),'','autocomplete ="off" placeholder="crm do médico" style="width:150px;"');
echo"<tr><td>";
echo"</table>";
echo"<br>";
echo"</fieldset>";

echo"<fieldset>";
echo"<legend>Dados da Receita:</legend>";
echo"<table border='0' width='100%'>";

echo"<tr  align='center'>";
echo"<td colspan='2'></td>";
echo"<td>Esférica</td>";
echo"<td>Cilíndrico</td>";
echo"<td>Eixo</td>";
echo"<td>DNP</td>";
echo"</tr>";

echo"<tr style='border: 1px solid #666666;'>";
echo"<td rowspan='2' align='center' valign='middle'>Longe</td>";
echo"<td align='right' style='border-left:1px solid #666666;'>OD</td>";
echo"<td align='center'><input type='text' name='longe_od_esferico' style='width:105px;'autocomplete ='off' placeholder='Ex: X,XX' onkeyup='Mascara_double(this);' onkeypress='Mascara_double(this);' maxlength='6'></td>";
echo"<td align='center'><input type='text' name='longe_od_cilindrico' style='width:105px;'autocomplete ='off' placeholder='Ex: -X,XX' onkeyup='Mascara_double(this);' onkeypress='Mascara_double(this);' maxlength='6'></td>";
echo"<td align='center'><input type='text' name='longe_od_eixo' style='width:105px;'autocomplete ='off' placeholder='Eixo em graus' onkeypress='return SomenteNumeros(event);' maxlength='6'></td>";
echo"<td align='center'><input type='text' name='longe_od_dnp' style='width:105px;'autocomplete ='off' placeholder='DNP em mm' onkeypress='return SomenteNumeros(event);' maxlength='6'></td>";
echo"</tr>";

echo"<tr style='border: 1px solid #666666;'>";
echo"<td align='right' style='border-left:1px solid #666666;'>OE</td>";
echo"<td align='center'><input type='text' name='longe_oe_esferico' style='width:105px;'autocomplete ='off' placeholder='Ex: -X,XX' onkeyup='Mascara_double(this);' onkeypress='Mascara_double(this);' maxlength='6'></td>";
echo"<td align='center'><input type='text' name='longe_oe_cilindrico' style='width:105px;'autocomplete ='off' placeholder='Ex: X,XX' onkeyup='Mascara_double(this);' onkeypress='Mascara_double(this);' maxlength='6'></td>";
echo"<td align='center'><input type='text' name='longe_oe_eixo' style='width:105px;'autocomplete ='off' placeholder='Eixo em graus' onkeypress='return SomenteNumeros(event);' maxlength='6'></td>";
echo"<td align='center'><input type='text' name='longe_oe_dnp' style='width:105px;'autocomplete ='off' placeholder='DNP em mm' onkeypress='return SomenteNumeros(event);' maxlength='6'></td>";
echo"</tr>";

echo"<tr>";
echo"<td colspan='6'><font size='1'>&nbsp;</font></td>";
echo"</tr>";

echo"<tr style='border: 1px solid #666666;'>";
echo"<td rowspan='2' align='center' valign='middle'>Perto</td>";
echo"<td align='right' style='border-left:1px solid #666666;'>OD</td>";
echo"<td align='center'><input type='text' name='perto_od_esferico' style='width:105px;'autocomplete ='off' placeholder='Ex: X,XX' onkeyup='Mascara_double(this);' onkeypress='Mascara_double(this);' maxlength='6'></td>";
echo"<td align='center'><input type='text' name='perto_od_cilindrico' style='width:105px;'autocomplete ='off' placeholder='Ex: -X,XX' onkeyup='Mascara_double(this);' onkeypress='Mascara_double(this);' maxlength='6'></td>";
echo"<td align='center'><input type='text' name='perto_od_eixo' style='width:105px;'autocomplete ='off' placeholder='Eixo em graus' onkeypress='return SomenteNumeros(event);' maxlength='6' ></td>";
echo"<td align='center'><input type='text' name='perto_od_dnp' style='width:105px;'autocomplete ='off' placeholder='DNP em mm' onkeypress='return SomenteNumeros(event);' maxlength='6'></td>";
echo"</tr>";

echo"<tr style='border: 1px solid #666666;'>";
echo"<td align='right' style='border-left:1px solid #666666;'>OE</td>";
echo"<td align='center'><input type='text' name='perto_oe_esferico' style='width:105px;'autocomplete ='off' placeholder='Ex: -X,XX' onkeyup='Mascara_double(this);' onkeypress='Mascara_double(this);' maxlength='6'></td>";
echo"<td align='center'><input type='text' name='perto_oe_cilindrico' style='width:105px;'autocomplete ='off' placeholder='Ex: X,XX' onkeyup='Mascara_double(this);' onkeypress='Mascara_double(this);' maxlength='6'></td>";
echo"<td align='center'><input type='text' name='perto_oe_eixo' style='width:105px;'autocomplete ='off' placeholder='Eixo em graus' onkeypress='return SomenteNumeros(event);' maxlength='6'></td>";
echo"<td align='center'><input type='text' name='perto_oe_dnp' style='width:105px;'autocomplete ='off' placeholder='DNP em mm' onkeypress='return SomenteNumeros(event);' maxlength='6'></td>";
echo"</tr>";


echo"<tr><td>";
echo form_label('Data da consulta');
echo"</td><td>";
echo form_type(array('name'=>'data'),  set_value('data'),'maxlength="10" autocomplete ="off" min="1900-01-01" max="'.date('Y-m-d').'"','date');
echo"</td>";


echo"<td align='right' colspan='3'>".form_label('DP')."</td>";
echo "<td align='center'>".form_input(array('name'=>'dp'),'','autocomplete ="off" placeholder="DP em mm" style="width:105px;" onkeypress="return SomenteNumeros(event);" maxlength="6"')."</td>";
echo"</tr>";

echo"<tr>";
echo"<td align='top' valign='top'>Observações:</td>";
echo"</tr><tr>";
echo"<td align='left' colspan='6'><textarea name=obervacoes cols=93 rows=4 placeholder='Digite aqui suas observações'></textarea></td>";
echo"</tr>";

echo"<tr>";
echo"<td align='center' colspan='6'>".form_submit(array('name'=>'Salvar'),'Salvar')."</td>";
echo"</tr>";

echo"</table>"; 
echo"</fieldset>";

echo form_hidden('id_cliente',  $id_cliente,'');

echo form_close();



echo "</div>";


//Exime mensagem de dados da consulta 
if ($this->session->flashdata('msgOk')) {
    $msg = $this->session->flashdata('msgOk');
    echo "<body onLoad=\" alert('$msg');\">";
}

?>
