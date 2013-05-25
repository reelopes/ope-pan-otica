<script language=JavaScript>  
   function ativaEnter(event,id,url) {  
      if( event.keyCode===13 ) { 
          
          if(id==='codigoBarras') var campoBusca = 'cod_barra';
          if(id==='codigoProduto')var campoBusca = 'id';
          
                 
document.forms['formularioVenda'].onsubmit = function(){return false;}
window.location.href = url+'/'+document.getElementById(id).value+'/'+campoBusca;
      }  
   }  
function ativaEnterProduto(event,id,url) {  
      if( event.keyCode===13 ) { 
         
         if(document.getElementById('quantidadeProduto').value>9999){

            }else{
         
         
        document.forms['formularioVenda'].onsubmit = function(){return false;}
window.location.href = url+'?id_produto='+document.getElementById('idProduto').value+'&nome_produto='+document.getElementById('nomeProduto').value+'&preco_venda='+document.getElementById('precoVenda').value+'&quantidade_produto='+document.getElementById('quantidadeProduto').value;
         }
}  
   }  
     
   
</script>  

<?php

if ($this->session->flashdata('msg')) {
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');\">";
}
echo $this->session->userdata('produtos');


$nome_cliente = $_GET['nomeCliente'];
$cpf_cliente = $_GET['cpfCliente'];
$id_cliente = $_GET['idCliente'];

if($nome_cliente!=null)$this->session->set_userdata('nome_cliente',$nome_cliente);
if($cpf_cliente!=null)$this->session->set_userdata('cpf_cliente',$cpf_cliente);
if($id_cliente!=null)$this->session->set_userdata('id_cliente',$id_cliente);
if($this->session->userdata('nome_cliente')==null)$this->session->set_userdata('nome_cliente','Cliente não definido');
if($this->session->userdata('cpf_cliente')==null)$this->session->set_userdata('cpf_cliente','000.000.000-00');
if($this->session->userdata('id_cliente')==null)$this->session->set_userdata('id_cliente','0');

echo"<div class=formulario>";
echo"<h2>$titulo</h2>";

echo form_open('venda/cadastrarVenda','id="formularioVenda"');

    
echo"<fieldset>";
echo"<legend>Vendedor:</legend>";
echo form_input(array('name'=>'vendedor'),$this->session->userdata('nome'),'style="width:400px;" readonly');
echo"</fieldset>";

echo"<fieldset>";
echo"<legend>Cliente:</legend>";
echo form_input(array('name'=>'cliente'),$this->session->userdata('nome_cliente'),'id="nomeCliente" style="width:400px; height:25px;" readonly');
echo form_label('CPF');
echo form_input(array('name'=>'cpf'),$this->session->userdata('cpf_cliente'),'id="cpfCliente" style="width:125px; height:25px;" readonly');
echo "<img src='".base_url("public/img/list.png")."' width='33px' title='Pesquisar Cliente' style='vertical-align: middle; cursor: hand;' OnClick=\"abrirPopUp('".base_url('venda/listarClientes')."','600','445');\">";
echo"</fieldset>";

echo"<fieldset>";
echo"<legend>Produtos:</legend>";

if($this->session->flashdata('autoFocusQuantidade')=='autofocus'){
    $autoFocusQuantidade='autofocus';
       $autoFocusCodigoBarras='';

    }  else {
   $autoFocusQuantidade='';
  $autoFocusCodigoBarras='autofocus';

}


echo"<table>";
echo"<tr>";
echo"<td>".form_label('Cod. Barras')."</td>";
echo"<td>".form_input(array('name'=>'codigo_barras'),$this->session->userdata('codigo_barras_temp'),'autocomplete ="off" id="codigoBarras" style="width:210px; height:25px;" onkeypress=ativaEnter(event,"codigoBarras","'.base_url('venda/listarProdutosURL').'") '.$autoFocusCodigoBarras)."</td>";
echo"<td>".form_label('Cod.')."</td>";
echo"<td>".form_input(array('name'=>'codigo_produto'),$this->session->userdata('codigo_produto_temp'),'autocomplete ="off" id="codigoProduto" style="width:123px; height:25px;" onkeypress=ativaEnter(event,"codigoProduto","'.base_url('venda/listarProdutosURL').'")')."</td>";
echo"<td>".form_label('Qtd.')."</td>";
echo"<td>".form_type(array('name'=>'quantidade'),$this->session->userdata('quantidade_temp'),'autocomplete ="off" id="quantidadeProduto" min="1" max ="9999" style="width:75px; height:25px;" onkeypress=ativaEnterProduto(event,"quantidadeProduto","'.base_url('venda/adicionaProduto').'") '.$autoFocusQuantidade.' ','number')."</td>";
echo"<td><img src='".base_url("public/img/list.png")."' width='33px' title='Pesquisar Produto' style='vertical-align: middle; cursor: hand;' OnClick=\"abrirPopUp('".base_url('venda/listarProdutos')."','600','445');\"></td>";
echo"</tr>";

echo"<tr>";
echo"<td>".form_label('Produto')."</td>";
echo"<td>".form_input(array('name'=>'nome_produto'),$this->session->userdata('nome_produto_temp'),'id="nomeProduto" style="width:210px; height:25px;" readonly')."</td>";
echo"<td>".form_label('Preço Uni.')."</td>";
echo"<td>".form_input(array('name'=>'preco_venda'),$this->session->userdata('preco_venda_temp'),'id="precoVenda" style="width:123px; height:25px;" readonly')."</td>";

echo"</tr>";

echo"</table>";

echo'<div id="data-grid-local"></div>';
?>
<script>
(function($){
    var $dgLocal = $('#data-grid-local')
     
    $dgLocal.datagrid({
        jsonStore: {
            data: {"rows":[
                    
                    <? 
                foreach ($this->session->userdata('itens') as $linha){
                    
                    echo '{"Cod":"'.$linha["idProduto"].'","nome":"'.$linha["nomeProduto"].'","Qtd":"'.$linha["quantidadeProduto"].'","valor_unitario":" R$ '.$linha["precoVenda"].'","sub_total":"R$ '.$subTotal_aux = $this->util->pontoParaVirgula($linha["precoVenda"]*$linha["quantidadeProduto"]).'"},';
                    $subTotal = $subTotal_aux +$subTotal;
                }

                    ?>
                        
            ]}
        }
        ,pagination: false
        ,height:115
        ,rowClick: false
        ,rowHover: false
        
        
        ,mapper:[{
            name: 'Cod',alias:'Código',css:{width:1,textAlign:'left'}
        },{
            name: 'nome',alias:'Nome',css:{width:350,textAlign:'left'}
        },{
            name: 'Qtd',alias:'Qtd',css:{width:7,textAlign:'left'}
        },{
            name: 'valor_unitario',alias:'Valor Unitário',css:{textAlign:'left'}
        },{
            name: 'sub_total',alias:'Sub Total',css:{width:150,textAlign:'left'}
        }]
    })
     
})(jQuery)

</script>
<?
echo"<table width='100%' align='right'>";
echo"<tr align='right'>";
echo"<td width='70%'></td>";
echo"<td>".form_label('Sub. Total')."</td>";
echo"<td>".form_input(array('name'=>'sub_total'),'R$ '.$this->util->pontoParaVirgula($subTotal),'style="width:125px; height:23px;" readonly')."</td>";
echo"<td width='18px'> </td>";
echo"</tr>";
echo"<tr align='right'>";
echo"<td width='70%'></td>";
echo"<td>".form_label('Desconto')."</td>";
echo"<td>".form_input(array('name'=>'desconto'),'','style="width:125px; height:23px;"')."</td>";
echo"</tr>";
echo"<tr align='right'>";
echo"<td align='left'>
     <div align='left' style='float:left; width:100px;'><input type='submit' value='Vender'></div>
     <div align='center' style='float:left; width:100px;'><input type='submit' value='Salvar'></div>
     <div align='right' style='float:left; width:100px;'><input type='submit' value='Cancelar'></div>
</td>";
echo"<td>".form_label('<b>Total</b>')."</td>";
echo"<td>".form_input(array('name'=>'total'),'R$ '.$this->util->pontoParaVirgula($subTotal-$desconto),'style="width:125px; height:23px;" readonly')."</td>";
echo"</tr>";
echo"</table>";



echo '<input type="hidden" value="'.$this->session->userdata('id_cliente').'" name="id_cliente" id="idCliente" />';
echo '<input type="hidden" value="'.$this->session->userdata('id_produto_temp').'" name="id_roduto" id="idProduto" />';




echo"</fieldset>";

echo form_close();

echo "</div>";

?>
