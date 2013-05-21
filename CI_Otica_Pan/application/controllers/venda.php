
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

class Venda extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('table');
        $this->load->library('form_validation');
        $this->load->library('uri');
        $this->load->helper('date');
        $this->load->model('cliente_model');


        $this->login_model->logado(); //Verifica se o usuário está logado
    }

    public function index() {

        redirect('venda/cadastrarVenda');
    }

    public function cadastrarVenda() {

        $this->form_validation->set_rules('id_cliente', 'id_cliente', 'trim|required');
        $this->form_validation->set_rules('data', 'data', 'trim|required');


        if ($this->form_validation->run()) {

            $dados = elements(array('variaveis do input'
                    ), $this->input->post());
            $this->venda_model->cadastrarVenda($dados);
        } else {

            $dados = array(
                'titulo' => 'Venda de Produtos',
                'pagina' => 'adiciona_venda',
            );

            $this->load->view('Principal', $dados);
        }
    }
    
     public function listarClientes() {

    

            $dados = array(
                'titulo' => 'Listar Clientes',
                'pagina' => 'listar_clientes_venda',
            );

            $this->load->view('Principal_popup', $dados);
        
    }
}
?>