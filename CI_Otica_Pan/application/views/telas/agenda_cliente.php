<?php

echo"<h2>$titulo</h2>";//TITULO


//Exime mensagem de agendamento do cliente Javascript
if ($this->session->flashdata('msg')) {
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');\">";
}

$id_cliente = $this->uri->segment(6); //Captura o id do cliente da URL
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

$dados = array();
for ($i = 1; $i < 32; $i++) {

    $diaSemana = date("w", mktime(0, 0, 0, $mesCalendario, $i, $anoCalendario)); //Captura o dia da semana (ex: 0 Domingo, 1 Segunda 2 terça ...
    if ($diaSemana != 0 && $diaSemana != 6) {//Não irá fazer link em sábados e Domingos
        if ($i > 9) {//Esse if serve para acrescentar zeros nos números de 1 a 9 ex: 01,02,03,04
            $dados[$i] = base_url('agendamento/horarioConsulta/' . $anoCalendario . '/' . $mesCalendario . '/' . $i);
        } else {
            $dados[$i] = base_url('agendamento/horarioConsulta/' . $anoCalendario . '/' . $mesCalendario . '/0' . $i);
        }
    }
}
//Gera o calendario enviando o ano e o mes atual, se ambos forem null é gerado referente ao ano e mês atual
echo "<div style=float:left;>" . $this->calendar->generate($anoCalendario, $mesCalendario, $dados) . "</div>";

$diaCalendario = $this->uri->segment(5); //Captura o dia do mes que o usuario escolheu no calendario

if ($diaCalendario != NULL) {//verifica se o usuário escolheu algum dia no calendario
    echo "<div style=float:left;>";

    $diaSemana_url = date("w", mktime(0, 0, 0, $mesCalendario, $dia, $anoCalendario)); //Captura o dia da semana que vem na URL (ex: 0 Domingo, 1 Segunda 2 terça ...
//Verifica se a data escolhida é menor que a data atual se for não deixa adicionar cliente
    if ($anoCalendario . $mesCalendario . $diaCalendario >= date('Y') . date('m') . date('d') && $diaSemana_url != "0" && $diaSemana_url != "6") {
        ?>
        Pesquisa Cliente: <input type="text" name="nome" onKeyDown="ocultaFormAgendamento();" onKeyUp="carregaAjax('pesquisaDinamica', '<? echo base_url('agendamento/pesquisaDinamica') ?>/' + this.value)" autofocus autocomplete="off">
        <?
    }//Acaba o if de verificação se a data é inferior a data atual
    echo"</div>";

    echo "<br><br><div id='pesquisaDinamica' style='display:none;'>";

    echo "</div>";

    echo "<div id='formAgendamento'  style='display:none;'";
    echo"<form></form>";
    //Se vier algum parametro na URL Mostro o Form com os dados do Cliente
    if ($id_cliente != null) {

        $cliente = $this->cliente_model->retornaCliente($id_cliente); //Captura o cliente no 
        $dependentes = $this->dependente_model->listarDependentes($id_cliente); //Resgata os dependentes do cliente
        ?>


        <form method="POST" action=<? echo base_url('agendamento/cadastrarAgendamento') ?>/>
        <input type="hidden" name="idCliente" value='<? echo $cliente['cliente']->id; ?>' />
        <table><tr>
                <td>Data:</td><td><input type="text" name="data" value="<? echo $diaCalendario . '/' . $mesCalendario . '/' . $anoCalendario ?>" /></td></tr><tr>
                <td>Horário:</td><td><input type="text" name="horario" value="" autofocus /></td></tr><tr>
                <td>Nome:</td><td><input type="text" name="nome" value='<? echo $cliente['pessoa']->nome; ?>' disabled/></td></tr><tr>
                <td>CPF:</td><td><input type="text" name="cpf" value="<? echo $cliente['cliente']->cpf; ?>" disabled /></td></tr><tr>


                <td>Dependente:</td><td>

                    <select name="dependente">
                        <option value="0">Próprio Cliente</option>

        <?
        foreach ($dependentes as $linha) {
            echo "<option value=\"$linha->id_dependente\">$linha->nome</option>";
        }
        ?>

                    </select>

                </td></tr><tr>

                <td></td><td><input type="submit" value="Agendar" /></td>
            </tr>
        </table>
        </form>

        <?
    }
    echo"</div>";


    $horarioAgendamento = $horarioAgendamento; //Boa pratica esse dado vem da controller

    if ($horarioAgendamento == null) {

        $this->table->add_row('Não há horários agendados para este dia.');
        $tmpl = array('table_open' => '<table border="0" cellpadding="2" width="100%" cellspacing="1" class="mytable">');
        $this->table->set_template($tmpl);
    } else {
        if ($anoCalendario . $mesCalendario . $diaCalendario >= date('Y') . date('m') . date('d')) {
        $this->table->set_heading('Data', 'Horário', 'Nome', 'CPF', 'E-mail','Dependente','Excluir');
        }else{
            $this->table->set_heading('Data', 'Horário', 'Nome', 'CPF', 'E-mail','Dependente');
        }
        foreach ($horarioAgendamento as $linha) {
            
                     
            if($linha->id_dependente==NULL){
                $nome = $linha->nome_cliente;
                $strDependente="N";
            }else{
                $nome = $linha->nome_dependente;
                $strDependente="S";
            }
            
            if ($anoCalendario . $mesCalendario . $diaCalendario >= date('Y') . date('m') . date('d')) {
                $this->table->add_row($this->util->data_mysql_para_user($linha->data_consulta), $linha->horario_consulta, $nome, $linha->cpf, $linha->email,$strDependente, anchor('agendamento/deletarAgendamento/' . $anoCalendario . '/' . $mesCalendario . '/' . $diaCalendario . '/' . $linha->id_agendamento, '<center>Excluir</center>', 'onclick="if (! confirm(\'Tem certeza que deseja excluir o agendamento abaixo? \n\n Nome: ' . $nome . '\n Data do agendamento: ' . $this->util->data_mysql_para_user($linha->data_consulta) . '\n Horário: ' . $linha->horario_consulta . '\')) { return false; }"'));
            } else {
                $this->table->add_row($this->util->data_mysql_para_user($linha->data_consulta), $linha->horario_consulta, $nome, $linha->cpf, $linha->email,$strDependente);
            }
        }
        $tmpl = array(
            'table_open' => '<table border="1" cellpadding="2" width="100%" cellspacing="1" class="listholover">',
            'row_start' => '<tr class="alt">',
            'row_alt_start' => '<tr class="alt">',
        );
        $this->table->set_template($tmpl);
    }

    echo $this->table->generate();
}

if ($id_cliente != NULL) {
    echo"<body onLoad=\"mostraFormAgendamento();\"";
}
?>