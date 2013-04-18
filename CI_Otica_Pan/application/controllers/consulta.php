<script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/js/consulta.js"></script> 
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consulta extends CI_Controller {

    public function __construct() {
        parent::__construct();
            $this->load->helper('url');
      
        $this->load->model('agendamento_model');
        $this->load->model('dependente_model');
        $this->load->model('cliente_model');
        $this->load->library('table');
        $this->load->library('uri');
        $this->load->helper('date');
             
    }

    public function index() {

        redirect('consulta/horarioConsulta');
    }

    public function horarioConsulta($anoCalendario = NULL, $mesCalendario = NULL, $diaCalendario = NULL) {
        if ($anoCalendario == null)
            $anoCalendario = $this->uri->segment(3); //Captura o ano da URL
        if ($mesCalendario == NULL)
            $mesCalendario = $this->uri->segment(4); //Captura o mes da URL
        if ($diaCalendario == NULL)
            $diaCalendario = $this->uri->segment(5); //Captura o mes da URL
        $dados = Array(
            'pagina' => 'consulta_cliente',
            'titulo' => 'Consulta Oftalmológica',
            'horarioAgendamento' => $this->agendamento_model->listarConsultasPendentes(),
        );
        $this->load->view('Principal', $dados);
    }

    public function pesquisaDinamica() {

        $pesquisaCliente = $this->uri->segment(3); //Captura a pesquisa da URL
        $this->load->model('cliente_model');

        $clientes = $this->cliente_model->listarClientes($pesquisaCliente, '5')->result();


        if ($clientes == NULL) {
            echo"Sua pesquisa não encontrou nenhum dado correspondente.";
        } else {

            echo"
          <table border='1' cellpadding='2' cellspacing='1' class = 'pesquisaDinamica'>
          <tr>
          <th>Nome</th>
          <th>Cpf</th>
          <th>E-mail</th>
          </tr>
          
          ";
            foreach ($clientes as $linha) {

                echo"
        <tr class=\"alt\" ONCLICK=\"agendaCliente('$linha->id_cliente','$linha->nome','$linha->cpf');\" style=\"cursor: hand;\">
        <td>$linha->nome</td>
        <td>$linha->cpf</td>
        <td>$linha->email</td>
        </tr>
        ";
            }
            echo "</table>";
        }
    }

    public function cadastrarAgendamento() {

        if ($this->input->post() != NULL) {

            $agendamento = elements(array('idCliente', 'horario', 'data','dependente'), $this->input->post());
            
            $this->agendamento_model->cadastrarAgendamento($agendamento);
        } else {

            $dados = Array(
                'pagina' => 'agenda_cliente',
                'titulo' => 'Agendamento de Consulta'
            );


            $this->load->view('Principal', $dados);
        }
    }

    public function deletarAgendamento() {

        if ($this->uri->segment(6) != NULL) {

            $id_agendamento = $this->uri->segment(6);

            if ($this->agendamento_model->deleteAgendamento($id_agendamento)) {
                $this->session->set_flashdata('msg', 'Agendamento deletado com sucesso!');
                redirect('agendamento/horarioConsulta/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5));
            }
        } else {
            $this->session->set_flashdata('msg', 'Erro ao deletar agendamento!');
            redirect('agendamento/horarioConsulta/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5));
        }
    }

}
?>