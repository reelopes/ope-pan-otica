<?php

$anoCalendario = $this->uri->segment(3); //Captura o ano da URL
$mesCalendario = $this->uri->segment(4); //Captura o mes da URL
//Verifica se há parametros na URL, se não haver pegamos o dia mes/semana atual do servidor 
if ($anoCalendario == NULL || $mesCalendario == NULL) {

    $anoCalendario = date("Y"); //Adiciona o ano na variavel
    $mesCalendario = date("m"); //Adiciona o mes na variavel
    $dia = date("d"); //dia do mes
    $diasemana = date('w'); //dia da semana
} else {//caso haja parametros na URL
    $dia = date('d'); //Scaptura o dia atual
    $diasemana = date("w", mktime(0, 0, 0, $mesCalendario, $dia, $anoCalendario)); //pedo o dia semana pelos parametros da URL
}
//Ajusto o dia da semana para pegar a Terça-Feira
if ($diasemana == 0)
    $diaDaConsulta = $dia + 2;
if ($diasemana == 1)
    $diaDaConsulta = $dia + 1;
if ($diasemana == 2)
    $diaDaConsulta = $dia + 0;
if ($diasemana == 3)
    $diaDaConsulta = $dia - 1;
if ($diasemana == 4)
    $diaDaConsulta = $dia - 2;
if ($diasemana == 5)
    $diaDaConsulta = $dia - 3;
if ($diasemana == 6)
    $diaDaConsulta = $dia - 4;
$diaDaConsulta = $diaDaConsulta - 28;//Diminui as semanas para o while rodar desde o começo do mês

//captura todas as terças-feiras do mês referente ao calendario exibido
while ($diaDaConsulta <= 31) {

    if ($diaDaConsulta > 0 && $anoCalendario >= date('Y')) {
        
        if($mesCalendario == date('m') && $anoCalendario == date('Y') && $diaDaConsulta < date('d') ){
            
        }  else {
            
        
        if ($anoCalendario == date('Y')) {
            
            if ($mesCalendario >= date('m')) {
                $data[$diaDaConsulta] = base_url('agendamento/horarioConsulta/' . $anoCalendario . '/' . $mesCalendario . '/' . $diaDaConsulta);
            }
        }else if($anoCalendario > date('Y')){
            $data[$diaDaConsulta] = base_url('agendamento/horarioConsulta/'.$anoCalendario.'/'.$mesCalendario.'/'.$diaDaConsulta);

        }
        
        }
    } else {
        $data = NULL;
    }
    $diaDaConsulta = $diaDaConsulta + 7;
}
//Gera o calendario enviando o ano e o mes atual, se ambos forem null é gerado referente ao ano e mês atual
echo $this->calendar->generate($anoCalendario, $mesCalendario, $data);

if ($this->uri->segment(5) != NULL) {

    $horarioAgendamento = $horarioAgendamento;


    $this->table->set_heading('Data', 'Horário', 'Nome', 'CPF', 'E-mail', 'Ediar', 'Excluir');
    foreach ($horarioAgendamento as $linha) {
        
        $this->table->add_row($linha->data_consulta, $linha->horario_consulta, $linha->nome, $linha->cpf, $linha->email, anchor('alterarAgendamento/' . $linha->id_agendamento, 'Editar'), anchor('deletarAgendamento/' . $linha->id_agendamento, 'Excluir'));
    }

 
    $tmpl = array('table_open' => '<table border="1" cellpadding="2" width="100%" cellspacing="1" class="mytable">');
    $this->table->set_template($tmpl);
    echo $this->table->generate();
}
?>
