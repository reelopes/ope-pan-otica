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
        
        $this->table->set_heading('Data', 'Horário', 'Nome', 'CPF', 'E-mail','Dependente','Consultar');
        
        foreach ($horarioAgendamento as $linha) {
            
                     
            if($linha->id_dependente==NULL){
                $nome = $linha->nome_cliente;
                $strDependente="N";
            }else{
                $nome = $linha->nome_dependente;
                $strDependente="S";
            }
          
           
                $this->table->add_row($this->util->data_mysql_para_user($linha->data_consulta), $linha->horario_consulta, $nome, $linha->cpf, $linha->email,$strDependente, "<a href=\"javascript:abrirPopUpConsultarCliente('".base_url('consulta/AtualizarConsulta/'.$linha->id_dependente)."');\"><center>Consultar</center>");
            
            }
          
        }
        $tmpl = array(
            'table_open' => '<table border="1" cellpadding="2" width="100%" cellspacing="1" class="listholover">',
            'row_start' => '<tr class="alt">',
            'row_alt_start' => '<tr class="alt">',
        );
        $this->table->set_template($tmpl);
    
    echo $this->table->generate();

?>

