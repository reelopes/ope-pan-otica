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

class Receita extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('table');
        $this->load->library('uri');
        $this->load->helper('form');
        $this->load->model('receita_model');
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
    
    
    
    
    
    

}
?>