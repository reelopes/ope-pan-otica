<?php

echo"<h2>$titulo</h2>";//TITULO

$ano = $this->uri->segment(3); //Captura o ano da URL
$mes = $this->uri->segment(4); //Captura o mês da URL
$dia = $this->uri->segment(5); //Captura o dia da URL

if ($ano == null) {
    $anoCalendario = date('Y'); //Captura o ano do sistema
} else {
    $anoCalendario = $ano; //Captura o ano da URL
}

if ($mes == null) {
    $mesCalendario = date('m'); //Captura o mes do sistema
} else {
    $mesCalendario = $mes; //Captura o mes da URL
}

    $horarioAgendamento = $horarioAgendamento; //Boa pratica esse dado vem da controller

    if ($horarioAgendamento == null) {
        
        $this->table->add_row('Não há horários agendados para este dia.');
        $tmpl = array('table_open' => '<table border="0" cellpadding="2" width="100%" cellspacing="1" class="mytable">');
        $this->table->set_template($tmpl);
    } else {
        
        $this->table->set_heading('Data', 'Horário', 'Nome','Cliente','Consultar');
        
        foreach ($horarioAgendamento as $linha) {
            
                     
            if($linha->id_dependente!=NULL){
                
                $nome = $linha->nome_dependente;
                $strCliente="<img src=../../../../../../../../../CI_otica_pan/public/img/false.png width=18>";
            }else{
                $nome = $linha->nome_cliente;
                $strCliente="<img src=../../../../../../../../../CI_otica_pan/public/img/true.png width=18>";
            }
          
           
                $this->table->add_row($this->util->data_mysql_para_user($linha->data_consulta), $linha->horario_consulta, $nome,"<center>".$strCliente."</center>", "<center><img src=../../../../../../../../../CI_otica_pan/public/img/ConsultaMedica.png width=23></center>");
            
            }
          
        }
        $tmpl = array(
            'table_open' => '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">',
        );
        
echo"<div class='tabela'>";
$this->table->set_template($tmpl);
echo $this->table->generate();
echo"</div>";
?>

