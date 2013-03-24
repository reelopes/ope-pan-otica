<script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/js/agendamento.js"></script> 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Agendamento extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('agendamento_model');
        $this->load->library('table');
        $this->load->library('uri');

        $prefs = array(
            'show_next_prev' => TRUE,
            'next_prev_url' => base_url('agendamento/index'),
            'month_type' => 'long',
            'day_type' => 'short',
            'template' =>
            '{table_open}<table class="calendar">{/table_open}
    {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
   {cal_cell_content}<div class="day_listing"> <a href="{content}">{day}</a></div>{/cal_cell_content}
   {cal_cell_content_today}<div class="today"><a href="{content}">{day}</a></div>{/cal_cell_content_today}
   {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
    {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
');


        $this->load->library('calendar', $prefs);
        $this->load->helper('date');
        $this->load->library('table');
    }

    public function index() {
        
        redirect('agendamento/horarioConsulta/'.date('Y').'/'.date('m').'/'.date('d'));
    }
        
    public function horarioConsulta($anoCalendario = NULL,$mesCalendario = NULL,$diaCalendario = NULL) {
            if($anoCalendario==null)$anoCalendario = $this->uri->segment(3); //Captura o ano da URL
            if($mesCalendario==NULL)$mesCalendario = $this->uri->segment(4); //Captura o mes da URL
            if($diaCalendario==NULL)$diaCalendario = $this->uri->segment(5); //Captura o mes da URL
        $dados = Array(
            'pagina' => 'agenda_cliente',
            'titulo' => 'Agendamento de Consulta',
            'horarioAgendamento' => $this->agendamento_model->listarConsultasDia($anoCalendario . '/' . $mesCalendario . '/' . $diaCalendario)->result(),
        );
        $this->load->view('Principal', $dados);
    }
    
    public function pesquisaDinamica(){
        
            $pesquisaCliente = $this->uri->segment(3); //Captura o ano da URL
             $this->load->model('cliente_model');
     
             $clientes =  $this->cliente_model->listarClientes($pesquisaCliente,'5')->result();
                      
             
if($clientes==NULL){
    echo"Sua pesquisa não encontrou nenhum dado correspondente.";
}else{

        echo"
          <table border='1' cellpadding='2' cellspacing='1' class = 'pesquisaDinamica'>
          <tr>
          
          <td>Nome</td>
          <td>Cpf</td>
          <td>E-mail</td>
          </tr>
          
          ";
foreach ($clientes as $linha) {
    
    echo"
        <tr ONCLICK=\"agendaCliente('$linha->id_cliente','$linha->nome','$linha->cpf');\" style=\"cursor: hand;\">
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
           
           if($this->input->post()!= NULL){
        
       $agendamento = elements(array('idCliente', 'horario','data'), $this->input->post());
            $this->agendamento_model->cadastrarAgendamento($agendamento);

                        
        } else {

            $dados = Array(
            'pagina' => 'agenda_cliente',
            'titulo' => 'Agendamento de Consulta'
        );
            

            $this->load->view('Principal', $dados);
        }
    }
    
    
    }
    
    


?>