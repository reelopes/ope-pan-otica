<?php

echo"<h2>$titulo</h2>";//TITULO


$cheques = array('id_cheque' => "1", 'data' => "12/12/2013", 'descricao' => "Teste 1", 'valor' => "200.00", 'status' => "Recebido");

            
        $this->table->set_heading('Data', 'Descrição', 'Valor','Status');
        
        foreach ($cheques as $linha) {
          
           if($linha->status=="Recebido"){
               $recebido = "CHECKED";
             }else{
                 $recebido = " ";
             }
                $this->table->add_row('<center>'.$linha->data.'</center>',$linha->descricao,'<p R$ ><center>'."R$ ".$this->util->pontoParaVirgula($linha->valor),"<center><input type='checkbox' title='Marcar/Desmarcar cheque recebido' name='a' id=".$linha->id_cheque." value='ON' ".$recebido." onClick=\"MarcarFalta('".$linha->id_cheque."','".base_url('consulta/atualizarAgendamento')."');\"/></center>");
            
            }
          
        
        $tmpl = array(
            'table_open' => '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">',
        );
        
echo"<div class='tabela'>";
$this->table->set_template($tmpl);
echo $this->table->generate();
echo"</div>";


?>
<div id="foo"></div>
</form>
