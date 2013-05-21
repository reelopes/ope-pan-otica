       <link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/jquery/estilo/table_jui.css" />
        <link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/jquery/estilo/jquery-ui-1.8.4.custom.css" />
        <script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/js/jquery.mim.js"></script>
        <script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/js/jquery.dataTables.min.js"></script>

        <script language="Javascript" type="text/javascript"> 

function putData(campoPai,valor,close) {  
   var codigo = valor;
     window.opener.document.getElementById(campoPai).value = codigo; 
     
     if(close==true){
        window.close();   
     }
}  
</script>
               
        
        

<?php

//Exime mensagem de agendamento do cliente Javascript
if ($this->session->flashdata('msg')) {
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');\">";
}

    $clientes = $this->cliente_model->listarClientes('')->result();

?>
        
<div class='tabela'>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
<thead>
<tr>
<th>NOME</th><th>CPF</th></tr>
</thead>
<tbody>
        
        <?
   echo "<tr class='alt' OnClick=\"putData('nomeCliente','Cliente não definido');putData('idCliente','0'); putData('cpfCliente','000.000.000-00',true);\">";
   echo "<td>Cliente não definido</td>";
   echo "<td>000.000.000-00</td>";
   echo"</tr>";
   
foreach ($clientes as $linha) {

    $nomeReduzido = (explode(" ",$linha->nome));
          
   if(sizeof($nomeReduzido)>3){
       $nomeReduzido = $nomeReduzido[0].' '.$nomeReduzido[1].' '.$nomeReduzido[sizeof($nomeReduzido)-1];
   }else{
       $nomeReduzido = $linha->nome;
   }
   
   echo "<tr class='alt' OnClick=\"putData('nomeCliente','".$linha->nome."');putData('idCliente','".$linha->id_cliente."'); putData('cpfCliente','".$linha->cpf."',true);\">";
   echo "<td>".$nomeReduzido."</td>";
   echo "<td>".$linha->cpf."</td>";
   echo"</tr>";
   
}
?>
</tbody>
    </table>
</div>
