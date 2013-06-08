<link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/jquery/datagrid/jquery-ui.css" />
<script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/datagrid/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/datagrid/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/datagrid/jquery.ui.datagrid.min.js"></script>
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

class FluxoFinanceiro extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('table');
        $this->load->library('form_validation');
        $this->load->library('uri');
        $this->load->helper('date');
        $this->load->model('cliente_model');
        $this->load->model('produto_model');
        $this->load->model('venda_model');
        $this->load->model('fluxoFinanceiro_model');


        $this->login_model->logado(); //Verifica se o usuário está logado
    }

    public function index() {

        redirect('fluxoFinanceiro/gerarRelatorio');
    }
    
    public function gerarRelatorio() {
        $dados = Array(
            'pagina' => 'fluxo_financeiro',
            'titulo' => 'Relatório de Fluxo Financeiro'
        );
        $this->load->view('Principal', $dados);
    }
    
    public function relatorio(){
        
        $this->form_validation->set_rules('dataInicial', 'dataInicial', 'trim|required');
        $this->form_validation->set_rules('dataFinal', 'dataFinal', 'trim|required');
        $this->form_validation->set_rules('contas_pagar', 'contas_pagar', 'trim');
        $this->form_validation->set_rules('vendas', 'vendas', 'trim');
               $dados = Array(
            'pagina' => 'fluxo_financeiro',
            'titulo' => 'Relatório de Fluxo Financeiro',
            );
        if ($this->form_validation->run() == true) {

            $inputDataInicial = $this->input->post('dataInicial');
            $inputDataFinal = $this->input->post('dataFinal');
            $contas_pagar = $this->input->post('contas_pagar');
            $vendas = $this->input->post('vendas');
            if($contas_pagar=='on'){
                $contas_pagar='1';
            }else{
                $contas_pagar='0';
            }
            if($vendas=='on'){
                $vendas='1';
            }else{
                $vendas='0';
            }
    
            
      $this->session->unset_userdata('dadosRelatorio');
      
            
       $dadosRelatorio = $this->fluxoFinanceiro_model->gerarRelatorio($inputDataInicial,$inputDataFinal,$contas_pagar,$vendas);
       
       $this->session->set_userdata('dadosRelatorio',$dadosRelatorio);
       $this->session->set_userdata('dataInicial',$inputDataInicial);
       $this->session->set_userdata('dataFinal',$inputDataFinal);
       
       $dados = Array(
            'pagina' => 'fluxo_financeiro',
            'titulo' => 'Relatório de Fluxo Financeiro',
            'url'=>"<body onLoad=\" 
               abrirPopUp('" . base_url("fluxoFinanceiro/relatorioPopUp/") . "','900','800');
\">",
        );
   
        } else {

            
       }

       
             $this->load->view('Principal', $dados);

       
    }
    
        public function relatorioPopUp() {
        $dados = Array(
            'pagina' => 'relatorio_fluxo_financeiro',
            'titulo' => 'Relatório de Fluxo Financeiro',
            'dadosRelatorio'=> $this->session->flashdata('dadosRelatorio'),
            'dataInicial'=>$this->session->flashdata('dataInicial'),
            'dataFinal'=>$this->session->flashdata('dataFinal'),
        );
        $this->load->view('Principal_popup', $dados);
    }
    
    
}
?>