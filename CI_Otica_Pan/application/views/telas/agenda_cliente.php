<?php


if($this->session->flashdata('msgCadastro')){
    $msg = $this->session->flashdata('msgCadastro');
    echo "<body onLoad=\" alert('$msg');\">";
}


if ($this->uri->segment(3) == null) {
    $anoCalendario = date('Y'); //Captura o ano do sistema
} else {
    $anoCalendario = $this->uri->segment(3); //Captura o ano da URL
}

if ($this->uri->segment(4) == null) {
    $mesCalendario = date('m'); //Captura o mes do sistema
} else {
    $mesCalendario = $this->uri->segment(4); //Captura o mes da URL
}


$dados = array(
    '12' => base_url('agendamento/horarioConsulta/' . $anoCalendario . '/' . $mesCalendario . '/12'),
);

//Gera o calendario enviando o ano e o mes atual, se ambos forem null é gerado referente ao ano e mês atual
echo "<div style=float:left;>" . $this->calendar->generate($anoCalendario, $mesCalendario, $dados) . "</div>";

$diaCalendario = $this->uri->segment(5); //Captura o dia do mes que o usuario escolheu no calendario

if ($diaCalendario != NULL) {//verifica se o usuário escolheu algum dia no calendario
    echo "<div style=float:left;>";
    ?>

    Pesquisa Cliente: <input type="text" name="nome" onKeyDown="ocultaFormAgendamento();" onKeyUp="carregaAjax('pesquisaDinamica', '<? echo base_url('agendamento/pesquisaDinamica') ?>/' + this.value)" autocomplete="off">

    <?
    echo"</div>";

    echo "<br><br><div id='pesquisaDinamica' style='display:none;'>";

    echo "</div>";

    echo "<div id='formAgendamento'  style='display:none;'";
    ?>
    <form></form>
    <form method="POST" action=<? echo base_url('agendamento/cadastrarAgendamento') ?>/>
    <input type="hidden" id="inputIdCliente" name="idCliente" value="" />
    Data: <input type="text" name="data" value="<? echo $diaCalendario . '/' . $mesCalendario . '/' . $anoCalendario ?>" /><br>
    Horário<input type="text" name="horario" value=""  /><br>
    Nome: <input type="text" id="inputNome" name="nome" value="" disabled/><br>
    Cpf: <input type="text" id="inputCpf" name="cpf" value="" disabled /><br>
    <input type="submit" value="Agendar" />
    </form>

    <?
    echo"</div>";


    $horarioAgendamento = $horarioAgendamento;

    if ($horarioAgendamento == null) {

        $this->table->add_row('Não existem clientes agendados para este dia');
         $tmpl = array('table_open' => '<table border="0" cellpadding="2" width="100%" cellspacing="1" class="mytable">');
    $this->table->set_template($tmpl);
    } else {
        $this->table->set_heading('Data', 'Horário', 'Nome', 'CPF', 'E-mail','Excluir');
        foreach ($horarioAgendamento as $linha) {

            $this->table->add_row($this->util->data_mysql_para_user($linha->data_consulta), $linha->horario_consulta, $linha->nome, $linha->cpf, $linha->email,anchor('deletarAgendamento/' . $linha->id_agendamento, 'Excluir'));
            
        }
         $tmpl = array('table_open' => '<table border="1" cellpadding="2" width="100%" cellspacing="1" class="mytable">');
    $this->table->set_template($tmpl);
    }
   
    echo $this->table->generate();
}
?>