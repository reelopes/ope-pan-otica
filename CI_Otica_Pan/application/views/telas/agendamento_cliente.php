<?php
echo"<h2>$titulo</h2>";//TITULO
//Exime mensagem de agendamento do cliente Javascript
if ($this->session->flashdata('msg')) {
    $msg = $this->session->flashdata('msg');
    echo "<body onLoad=\" alert('$msg');\">";
}
if ($this->session->flashdata('msgOk')) {
    $msg = $this->session->flashdata('msgOk');
    echo "<body onLoad=\" alert('$msg');window.opener.location.reload();window.close();\">";
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

if ($id_cliente != null) {

        $cliente = $this->cliente_model->retornaCliente($id_cliente); //Captura o cliente no 
        $dependentes = $this->dependente_model->listarDependentes($id_cliente); //Resgata os dependentes do cliente
        ?>


        <form method="POST" action=<? echo base_url('agendamento/cadastrarAgendamento') ?>/>
        <input type="hidden" name="idCliente" value='<? echo $cliente['cliente']->id; ?>' />
        <table><tr>
                <td>Data:</td><td><input type="text" name="data" value="<? echo $dia . '/' . $mesCalendario . '/' . $anoCalendario ?>" /></td></tr><tr>
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
?>