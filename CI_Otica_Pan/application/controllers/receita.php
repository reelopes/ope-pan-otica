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
                    "bSort": false,
                    "oLanguage": {
                   "sLengthMenu": "<br>Escolhe um cliente para cadastrar o dependente"
                  }
                });
            });
        </script>
         <script type="text/javascript">
            $(document).ready(function() {
                oTable = $('#lista_dependentes_table1').dataTable({
                    "bPaginate": true,
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                });
            });
        </script>


<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Receita extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('table');
        $this->load->library('uri');
        $this->load->helper('form');
        $this->load->model('receita_model');
        $this->load->model('cliente_model');
        $this->load->model('dependente_model');
        $this->login_model->logado(); //Verifica se o usuário está logado
    }

    public function exibeReceita(){
        
        $id_receita = $this->uri->segment(3);

        $dados = Array(
        'pagina' => 'lista_receita',
        'titulo' => 'Visualiza Receita',
        'dados_receita' => $this->receita_model->retornaReceita($id_receita),
        );
        $this->load->view('Principal_popup', $dados);
    }
    
    public function listaReceita(){

        $id_cliente = $this->uri->segment(3);
        
        $dados = Array(
        'pagina' => 'listar_receita',
        'titulo' => 'Pesquisa Receita',
        'receitas' => $this->receita_model->receitasCliente($id_cliente)
        );
        $this->load->view('Principal_popup', $dados);
    }
    
    public function adicionaReceita() {

        $dados = Array(
        'pagina' => 'adiciona_receita',
        'titulo' => 'Cadastro de Receita'
        );
        
        if ($this->input->post('id_cliente') != null) {
            $dados = elements(array('medico','crm','data', 'id_cliente',
                    'dependente','longe_od_esferico', 'longe_od_cilindrico', 'longe_od_eixo', 'longe_od_dnp','longe_oe_esferico', 
                    'longe_oe_cilindrico', 'longe_oe_eixo', 'longe_oe_dnp','perto_od_esferico', 'perto_od_cilindrico', 
                    'perto_od_eixo', 'perto_od_dnp','perto_oe_esferico', 'perto_oe_cilindrico', 'perto_oe_eixo', 
                    'perto_oe_dnp','dp','obervacoes'
                    ), $this->input->post());
            
            $this->receita_model->cadastraReceita($dados);
        }
        
        $this->load->view('Principal', $dados);
    }
    
    public function listarClientes() {

        $dados = array(
            'titulo' => 'Listar Clientes',
            'pagina' => 'listar_clientes_receita',
        );

        $this->load->view('Principal_popup', $dados);
    }
}
?>