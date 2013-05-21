<?php
echo"<div class=formulario>";
echo"<h2>$titulo</h2>";

echo form_open('venda/cadastrarVenda');

    
echo"<fieldset>";
echo"<legend>Vendedor:</legend>";
echo form_input(array('name'=>'vendedor'),$this->session->userdata('nome'),'style="width:400px;" readonly');
echo"</fieldset>";

echo"<fieldset>";
echo"<legend>Cliente:</legend>";
echo form_input(array('name'=>'cliente'),'Cliente não definido','id="nomeCliente" style="width:400px; height:25px;" readonly');
echo form_label('CPF');
echo form_input(array('name'=>'cpf'),'000.000.000-00','id="cpfCliente" style="width:125px; height:25px;" readonly');
echo "<img src='".base_url("public/img/list.png")."' width='33px' title='Pesquisar Cliente' style='vertical-align: middle; cursor: hand;' OnClick=\"abrirPopUp('".base_url('venda/listarClientes')."','600','445');\">";
echo"</fieldset>";

echo"<fieldset>";
echo"<legend>Produtos:</legend>";

echo form_label('Cod.');
echo form_input(array('name'=>'cod'),'','style="width:123px; height:25px;" ');
echo form_label('Cod. Barras');
echo form_input(array('name'=>'cod_barras'),'','style="width:210px; height:25px;" ');
echo form_label('Qtd.');
echo form_input(array('name'=>'qtd'),'','style="width:75px; height:25px;"  ');
echo '<img src="'.base_url('public/img/list.png').'" width="33px"  title="Pesquisar Cliente" style="vertical-align: middle;">';

echo'<div id="data-grid-local"></div>';
?>
<script>
(function($){
    var $dgLocal = $('#data-grid-local')
     
    $dgLocal.datagrid({
        jsonStore: {
            data: {"rows":[
                {"Cod":"1","nome":"hdwuaduiawhduiahuwddn","Qtd":"1","valor_unitario":"R$ 50,00","sub_total":"R$ 100,00"}
                ,{"Cod":"2","nome":"Beltrano da Silva","Qtd":"2","valor_unitario":"R$ 50,00","sub_total":"R$ 100,00"}
                ,{"Cod":"3","nome":"Beltrano da Silva","Qtd":"3","valor_unitario":"R$ 50,00","sub_total":"R$ 100,00"}
                ,{"Cod":"4","nome":"Beltrano da Silva","Qtd":"1","valor_unitario":"R$ 50,00","sub_total":"R$ 100,00"}
                
            ]}
        }
        ,pagination: false
        ,height:115
        ,rowClick: false
        
        
        ,mapper:[{
            name: 'Cod',alias:'Código',css:{width:1,textAlign:'left'}
        },{
            name: 'nome',alias:'Nome',css:{width:400,textAlign:'left'}
        },{
            name: 'Qtd',alias:'Qtd',css:{width:7,textAlign:'left'}
        },{
            name: 'valor_unitario',alias:'Valor Unitário',css:{width:10,textAlign:'left'}
        },{
            name: 'sub_total',alias:'Sub Total',css:{textAlign:'left'}
        }]
    })
     
})(jQuery)

</script>
<?
echo"<table width='100%' align='right'>";
echo"<tr align='right'>";
echo"<td width='70%'></td>";
echo"<td>".form_label('Sub. Total')."</td>";
echo"<td>".form_input(array('name'=>'sub_total'),'R$ 2,50','style="width:125px; height:23px;" readonly')."</td>";
echo"<td width='18px'> </td>";
echo"</tr>";
echo"<tr align='right'>";
echo"<td width='70%'></td>";
echo"<td>".form_label('Desconto')."</td>";
echo"<td>".form_input(array('name'=>'desconto'),'R$ 2,50','style="width:125px; height:23px;"')."</td>";
echo"</tr>";
echo"<tr align='right'>";
echo"<td align='left'>
     <div align='left' style='float:left; width:100px;'><input type='submit' value='Vender'></div>
     <div align='center' style='float:left; width:100px;'><input type='submit' value='Salvar'></div>
     <div align='right' style='float:left; width:100px;'><input type='submit' value='Cancelar'></div>
</td>";
echo"<td>".form_label('<b>Total</b>')."</td>";
echo"<td>".form_input(array('name'=>'desconto'),'R$ 2,50','style="width:125px; height:23px;" readonly')."</td>";
echo"</tr>";
echo"</table>";



echo '<input type="hidden" value="0" name="id_cliente" id="idCliente" />';




echo"</fieldset>";

echo form_close();

echo "</div>";

?>
