
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
        $this->load->model('produto_model');


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

    public function listarProdutos() {


        $dados = array(
            'titulo' => 'Listar Produtos',
            'pagina' => 'listar_produtos_venda',
        );

        $this->load->view('Principal_popup', $dados);
    }

    public function listarProdutosURL() {
        
        if($this->uri->segment(4)==NULL || $this->uri->segment(3)==NULL){

            $this->session->set_flashdata('msg','Produto não encontrado');
                    redirect(base_url('venda/cadastrarVenda'));

        }
        
        
        $produtos = $this->produto_model->do_select($this->uri->segment(4), $this->uri->segment(3))->result();

        if ($produtos != null) {

            $this->session->set_flashdata('autoFocusQuantidade', 'autofocus');
            $this->session->set_userdata('nome_produto_temp', $produtos[0]->nome);
            $this->session->set_userdata('codigo_produto_temp', $produtos[0]->id_produto);
            $this->session->set_userdata('codigo_barras_temp', $produtos[0]->cod_barra);
            $this->session->set_userdata('preco_venda_temp', $this->util->pontoParaVirgula($produtos[0]->preco_venda));
            $this->session->set_userdata('quantidade_temp', '1');
            $this->session->set_userdata('id_produto_temp', $produtos[0]->id_produto);
        
            
        }else{
            $this->session->set_flashdata('msg','Produto não encontrado');
           
            $this->session->set_userdata('nome_produto_temp', NULL);
            $this->session->set_userdata('codigo_produto_temp', NULL);
            $this->session->set_userdata('codigo_barras_temp', NULL);
            $this->session->set_userdata('preco_venda_temp', NULL);
            $this->session->set_userdata('quantidade_temp', NULL);
            $this->session->set_userdata('id_produto_temp', NULL);
        }
        

        redirect(base_url('venda/cadastrarVenda'));
    }

    public function adicionaProduto() {

        $id_produto = $_GET['id_produto'];
        $nome_produto = $_GET['nome_produto'];
        $preco_venda = $_GET['preco_venda'];
        $quantidade_produto = $_GET['quantidade_produto'];
        
        if($id_produto ==null || $nome_produto ==null || $preco_venda ==null || $quantidade_produto ==null){
       $this->session->set_flashdata('msg','Não foi possível adicionar o produto tente novamente.');
        redirect(base_url('venda/cadastrarVenda'));

        }
        

        if ($this->session->userdata('itens') == null) {

            $itens = array($produtos = array('idProduto' => $id_produto, 'nomeProduto' => $nome_produto, 'precoVenda' => $preco_venda, 'quantidadeProduto' => $quantidade_produto));
            $this->session->set_userdata('itens', $itens);
        } else {
            $itens = $this->session->userdata('itens');
            array_push($itens, $produtos = array('idProduto' => $id_produto, 'nomeProduto' => $nome_produto, 'precoVenda' => $preco_venda, 'quantidadeProduto' => $quantidade_produto));
            $this->session->set_userdata('itens', $itens);
        }
        $this->session->set_userdata('codigo_barras_temp', null);
        $this->session->set_userdata('codigo_produto_temp', null);
        $this->session->set_userdata('quantidade_temp', null);
        $this->session->set_userdata('nome_produto_temp', null);
        $this->session->set_userdata('preco_venda_temp', null);
     
        redirect(base_url('venda/cadastrarVenda'));
    }

    public function adicionaLente() {
        //Sem cliente não pode adicionar lente
        if($this->session->userdata('id_cliente')== '0'){
        echo"<script>alert('Para adicionar uma lente é necessário associar um cliente!');window.close();</script>";

        }
        
        
        
        $this->form_validation->set_rules('referencia', 'referencia', 'trim|required');
        $this->form_validation->set_rules('nome_lente', 'nome_lente', 'trim|required');
        $this->form_validation->set_rules('preco_venda', 'preco_venda', 'trim|required');
         if ($this->form_validation->run() == true) {
          if ($this->session->userdata('lente') == null) {
            
              $array_lente = array($lente = array(
                  'referencia' => $this->input->post('referencia'), 
                  'nome_lente' => $this->input->post('nome_lente'),
                  'preco_venda' => $this->input->post('preco_venda'), 
                  'quantidade_lente' => '1'));
              $this->session->set_userdata('lente', $array_lente);
              
        } else {
            $array_lente = $this->session->userdata('lente');
            array_push($array_lente, $lente = array(
                  'referencia' => $this->input->post('referencia'), 
                  'nome_lente' => $this->input->post('nome_lente'),
                  'preco_venda' => $this->input->post('preco_venda'), 
                  'quantidade_lente' => '1'));
            $this->session->set_userdata('lente', $array_lente);
        }
            echo"<script>window.close();window.opener.location.reload();</script>";
    }
            $dados = array(
                'titulo' => 'Cadastro de Lente',
                'pagina' => 'adiciona_lente_venda',
            );

            $this->load->view('Principal_popup', $dados);
    
    
    }
    
    public function adicionaServico() {
      
        
        $this->form_validation->set_rules('nome', 'nome', 'trim|required');
        $this->form_validation->set_rules('preco', 'preco', 'trim|required');
        $this->form_validation->set_rules('descricao', 'descricao', 'trim|required');
         if ($this->form_validation->run() == true) {
          if ($this->session->userdata('servico') == null) {
            
              $array_servico = array($servico = array(
                  'nome' => $this->input->post('nome'), 
                  'preco' => $this->input->post('preco'),
                  'descricao' => $this->input->post('descricao'), 
                  'quantidade_servico' => '1'));
              $this->session->set_userdata('servico', $array_servico);
              
        } else {
            $array_servico = $this->session->userdata('servico');
            array_push($array_servico, $lente = array(
                  'nome' => $this->input->post('nome'), 
                  'preco' => $this->input->post('preco'),
                  'descricao' => $this->input->post('descricao'), 
                  'quantidade_servico' => '1'));
            $this->session->set_userdata('servico', $array_servico);
        }
            echo"<script>window.close();window.opener.location.reload();</script>";
    }
            $dados = array(
                'titulo' => 'Cadastro de Serviço',
                'pagina' => 'adiciona_servico_venda',
            );

            $this->load->view('Principal_popup', $dados);
    
    
    }
    
    
}
?>