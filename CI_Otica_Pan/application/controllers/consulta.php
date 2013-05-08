<script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/js/consultaOftalmologica.js"></script>        
<link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/jquery/estilo/table_jui.css" />
        <link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/jquery/estilo/jquery-ui-1.8.4.custom.css" />
        <script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/js/jquery.mim.js"></script>
        <script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                oTable = $('#example').dataTable({
                    "bPaginate": true,
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bSort": false
                });
            });
        </script>

    
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
        $this->load->library('form_validation');
        $this->load->library('uri');
        $this->load->helper('date');
        
                 $this->login_model->logado();//Verifica se o usuário está logado
    
    }

    public function index() {

        redirect('consulta/horarioConsulta');
    }

    public function horarioConsulta() {
        
            $dados = Array(
            'pagina' => 'consulta_cliente',
            'titulo' => 'Consulta Oftalmológica',
            'horarioAgendamento' => $this->agendamento_model->listarConsultas('data_consulta <="'.date('Y/m/d').'" and status = "Pendente" or status = "faltou" and data_consulta="'.date('Y/m/d').'"'),
        );
      
        
        $this->load->view('Principal', $dados);
    }

 public function atualizarAgendamento() {
     
     $idCliente = $this->uri->segment(3);
     $status = $this->uri->segment(4);
     
     $this->agendamento_model->AtualizaAgendamento($idCliente,$status);
     
 }
 
 public function cadastrarConsulta() {
     
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|max_length[15]|valid_cpf|is_unique[cliente.cpf]');
        $this->form_validation->set_rules('data_nascimento', 'Data Nascimento', 'trim');
        $this->form_validation->set_rules('cep', 'CEP', 'trim|max_length[10]');
        
               
        if ($this->form_validation->run() == true) {

            $dados = elements(array('nome', 'email', 'cpf', 'data_nascimento', 'num_telefone1',
                'num_telefone2', 'rua', 'bairro', 'cidade', 'complemento', 'estado', 'cep'), $this->input->post());
            $this->cliente_model->cadastrarCliente($dados);
        } else {
            
            $id_agendamento=$this->uri->segment(3);
            //Resgata as informações do banco.
            

            
            $dados = array(
                'titulo' => 'Dados da Consulta Oftalmológica',
                'pagina' => 'adiciona_consulta',
                'agendamento' => $this->agendamento_model->listarConsultas('agendamento.id ='.$id_agendamento),
            );

            $this->load->view('Principal_popup', $dados);
        }
     
     
 }
 
 
    }


?>