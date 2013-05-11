<link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/jquery/estilo/table_jui.css" />
<link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/jquery/estilo/jquery-ui-1.8.4.custom.css" />
<script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/js/jquery.mim.js"></script>
<script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/jquery/js/jquery.dataTables.min.js"></script>

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

class Produto extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> helper('form');
		$this -> load -> helper('array');
		$this -> load -> model('produto_model');
                $this -> load -> model('tipo_lente_model');
                $this -> load -> model('fornecedor_model');
                $this -> load -> model('grife_model');
                $this -> load -> library('uri');
		$this -> load -> library('form_validation');
		$this -> load -> library('session');
		$this -> load -> library('table');
                
                $this->login_model->logado();//Verifica se o usuário está logado

	}

	public function index() {
		$dados = array('pagina' => 'adiciona_produto', 'titulo' => 'Criar Produto', 'carrega' => 0,
                    'tipo_lente' => $this -> tipo_lente_model -> getAll() -> result(),
                    'todos_fornecedor' => $this -> fornecedor_model -> getAll() -> result(),
                    'todas_grife' => $this -> grife_model -> getAll() -> result(), 'msgErroP' => '');
		$this -> load -> view('Principal', $dados);
	}
        
        public function adiciona() {
            $this -> form_validation -> set_rules('cod_barra', 'Código de Barras', 'trim');
            $this -> form_validation -> set_rules('nome', 'Nome', 'trim|required');
            $this -> form_validation -> set_rules('descricao', 'Descricao', 'trim|max_length[60]');
            $this -> form_validation -> set_rules('preco_custo', 'Preço de Custo', 'trim|ucwords|required|max_length[10]');
            $this -> form_validation -> set_rules('preco_venda', 'Preço de Venda', 'trim|ucwords|required|max_length[10]');
            $this -> form_validation -> set_rules('quantidade', 'Quantidade', 'trim');
            $this -> form_validation -> set_rules('validade', 'Validade', 'trim');
            
            if($this -> input -> post('produto') == 1) {
                $this -> form_validation -> set_rules('largura_lente', 'Largura da lente', 'required');
                $this -> form_validation -> set_rules('largura_ponte', 'Largura da Ponte', 'required');
                $this -> form_validation -> set_rules('comprimento_haste', 'Comprimento da haste', 'required');
                $this -> form_validation -> set_rules('modelo', 'modelo', 'trim');
                $this -> form_validation -> set_rules('grife', 'Grife', 'required');
                $this -> form_validation -> set_rules('fornecedor', 'Fornecedor', 'required');
                
            }
            $msgPM = '';
            
            if ($this -> form_validation -> run()) {
                if ($this -> input -> post('preco_custo') <= $this -> input -> post('preco_venda')) {
                    $dados = elements(array('cod_barra', 'nome', 'descricao', 'preco_custo', 'preco_venda', 'quantidade', 'validade',
                    'largura_lente', 'largura_ponte', 'comprimento_haste', 'modelo', 'grife', 'fornecedor',
                    'produto'), $this -> input -> post());
                    $this -> produto_model -> do_insert($dados);
                } else {
                    $msgPM = 'Preço de custo é maior que Preço de venda';
                }
            }
           if ($this -> input -> post('preco_custo') > $this -> input -> post('preco_venda')) {
               $msgPM = 'Preço de custo é maior que Preço de venda';
           }
            
            $dados = array('titulo' => 'Criar Produto', 'pagina' => 'adiciona_produto', 'carrega' => $this -> input -> post('produto'),
                'todos_fornecedor' => $this -> fornecedor_model -> getAll() -> result(),
                'todas_grife' => $this -> grife_model -> getAll() -> result(), 'msgErroP' => $msgPM);
            
            $this -> load -> view('Principal', $dados);
	}

	public function lista() {
		$dados = array('pagina' => 'lista_produto', 'titulo' => 'Pesquisa Produto', 
		'produto' => $this -> produto_model -> getAll() -> result());

		$this -> load -> view('Principal', $dados);
	}

	public function visualiza() {
            $dados = array('pagina' => 'vizualiza_produto', 'titulo' => 'Visualiza Produto',
            'todos_fornecedor' => $this -> fornecedor_model -> getAll() -> result(),
            'produto' => $this -> produto_model -> get_byid($this->uri->segment(3)),
            'todas_grife' => $this -> grife_model -> getAll() -> result());

            $this -> load -> view('Principal', $dados);
	}

	public function update() {
            $this -> form_validation -> set_rules('cod_barra', 'cod_barra', 'trim|required');
            $this -> form_validation -> set_rules('nome', 'Nome', 'trim|required');
            $this -> form_validation -> set_rules('descricao', 'Descricao', 'trim|max_length[60]|');
            $this -> form_validation -> set_rules('preco_custo', 'Preço de Custo', 'trim|numeric|ucwords|required');
            $this -> form_validation -> set_rules('preco_venda', 'Preço de Venda', 'trim|numeric|ucwords|required');
            $this -> form_validation -> set_rules('quantidade', 'Quantidade', 'trim');
            $this -> form_validation -> set_rules('status', 'Status', 'trim');
            $this -> form_validation -> set_rules('validade', 'Validade', 'trim');
            
            if($this -> input -> post('produto') == 1) {
                $this -> form_validation -> set_rules('largura_lente', 'Largura da lente', 'required');
                $this -> form_validation -> set_rules('largura_ponte', 'Largura da Ponte', 'required');
                $this -> form_validation -> set_rules('comprimento_haste', 'Comprimento da haste', 'required');
                $this -> form_validation -> set_rules('modelo', 'modelo', 'trim');
                $this -> form_validation -> set_rules('grife', 'Grife', 'required');
                $this -> form_validation -> set_rules('fornecedor', 'Fornecedor', 'required');
                
            }
            
            if ($this -> form_validation -> run()) {
                $dados = elements(array('cod_barra', 'nome', 'descricao', 'preco_custo', 'preco_venda', 'quantidade', 'status', 'validade', 'data_entrega',
                    'largura_lente', 'largura_ponte', 'comprimento_haste', 'modelo', 'grife', 'fornecedor',
                    'produto'), $this -> input -> post());
                
                $this->produto_model->do_update(
                        $dados, $this->input->post('id_produto'));
            }
            
            $dados = array('titulo' => 'Atualiza Produto', 'pagina' => 'atualiza_produto');
            $this -> load -> view('Principal', $dados);
        }
        
	public function delete() {
		$dados = array('titulo' => 'CRUD &raquo; Delete', 'tela' => 'Delete', );
		$id = $this -> uri -> segment(3);

		if ($id == NULL) {
                    redirect('produto/lista');
                }

		$this -> produto_model -> do_delete($id);
		$this -> load -> view('Principal', $dados);
	}
}