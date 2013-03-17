<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agendamento extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('agendamento_model');
        $this->load->library('table');
        $prefs = array(
            'show_next_prev' => TRUE,
            'next_prev_url' => base_url('agendamento/index'),
            'month_type'   => 'long',
            'day_type' => 'short',
        );
        $this->load->library('calendar', $prefs);
        $this->load->helper('date');
        $this->load->library('table');
        
        
                $this->login_model->logado();//Verifica se o usuário está logado

        
    }

    public function index() {
        
        
        $dados = Array(
            'pagina' => 'agenda_cliente',
            'titulo' => 'Agendamento de Consulta'
        );
        
        $this->load->view('Principal', $dados);
    }
    
    
    public function horarioConsulta(){
$anoCalendario = $this->uri->segment(3);//Captura o ano da URL
$mesCalendario = $this->uri->segment(4);//Captura o mes da URL
$diaCalendario = $this->uri->segment(5);//Captura o mes da URL
            $dados = Array(
            'pagina' => 'agenda_cliente',
            'titulo' => 'Agendamento de Consulta',
            'horarioAgendamento' => $this->agendamento_model->listarConsultasDia($anoCalendario.'/'.$mesCalendario.'/'.$diaCalendario)->result(),
        );
        
        $this->load->view('Principal', $dados);
    }
        
    
  

}

?>