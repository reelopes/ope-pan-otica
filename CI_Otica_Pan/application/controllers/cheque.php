<link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/jquery/estilo/table_jui.css" />
<link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/jquery/estilo/jquery-ui-1.8.4.custom.css" />
<script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/js/jquery.mim.js"></script>
<script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/js/jquery.dataTables.min.js">
</script>

<script type="text/javascript">
    $(document).ready(function() {
        oTable = $('#example').dataTable({
            "bPaginate": true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    });
</script>

<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cheque extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('array');
//        $this->load->model('cheque_model');
        $this->load->model('venda_model');
        $this->load->model('util_model');
        $this->load->library('uri');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('table');

        $this->login_model->logado(); //Verifica se o usuário está logado
    }

    public function index() {
        $dados = array('pagina' => 'gerenciar_cheques', 'titulo' => 'Cheques Pendêntes');
        $this->load->view('Principal', $dados);
    }
    
}
?>
