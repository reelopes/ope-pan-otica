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
            'day_type' => 'long',
        );

$prefs['template'] = '
    {table_open}<table class="calendar">{/table_open}
    {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
    {cal_cell_content}<span class="day_listing">{day}</span>&nbsp;&bull; {content}&nbsp;{/cal_cell_content}
    {cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>&bull; {content}</div>{/cal_cell_content_today}
    {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
    {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
'; 


        $this->load->library('calendar', $prefs);
        $this->load->helper('date');
        $this->load->library('table');


        $this->login_model->logado(); //Verifica se o usuário está logado
    }

    public function index() {


        $dados = Array(
            'pagina' => 'agenda_cliente',
            'titulo' => 'Agendamento de Consulta'
        );

        $this->load->view('Principal', $dados);
    }

    public function horarioConsulta() {
        $anoCalendario = $this->uri->segment(3); //Captura o ano da URL
        $mesCalendario = $this->uri->segment(4); //Captura o mes da URL
        $diaCalendario = $this->uri->segment(5); //Captura o mes da URL
        $dados = Array(
            'pagina' => 'agenda_cliente',
            'titulo' => 'Agendamento de Consulta',
            'horarioAgendamento' => $this->agendamento_model->listarConsultasDia($anoCalendario . '/' . $mesCalendario . '/' . $diaCalendario)->result(),
        );

        $this->load->view('Principal', $dados);
    }

}

?>