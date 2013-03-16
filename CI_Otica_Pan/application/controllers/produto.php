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
		$this -> load -> library('form_validation');
		$this -> load -> library('session');
		$this -> load -> library('table');
	}

	public function index() {
		$dados = array('pagina' => 'adiciona_produto', 'titulo' => 'Criar Produto');
		$this -> load -> view('Principal', $dados);
	}

	public function adiciona() {
		$dados = array('pagina' => 'adiciona_produto', 'titulo' => 'Criar Produto');

		$this -> form_validation -> set_rules('cod_barra', 'Codigo de Barra', 'trim|required|max_length[100]|ucwords');
		$this -> form_validation -> set_rules('data_entrega', 'Data de Entrega', 'trim|numeric|max_length[100]');
		$this -> form_validation -> set_rules('descricao', 'Descricao', 'trim|max_length[60]|ucwords');
		$this -> form_validation -> set_rules('preco', 'Preco', 'trim|numeric|ucwords');
		$this -> form_validation -> set_rules('quantidade', 'Quantidade', 'trim');
		$this -> form_validation -> set_rules('status', 'Status', 'ucwords');
		$this -> form_validation -> set_rules('validade', 'Validade', 'trim|numeric');

		if ($this -> form_validation -> run()) {
			$dados = elements(array('cod_barra', 'data_entrega', 'descricao', 'preco', 'quantidade', 'status', 'validade'), $this -> input -> post());
			$this -> produto_model -> do_insert($dados);
		} else {

			$dados = array('titulo' => 'Cadastro de Produto', 'pagina' => 'adiciona_produto', );

			$this -> load -> view('Principal', $dados);
		}
	}

	public function lista() {
		$dados = array('pagina' => 'lista_produto', 'titulo' => 'Manter Produto', 
		'produto' => $this -> produto_model -> getAll() -> result());

		$this -> load -> view('Principal', $dados);
	}

	public function pesquisa() {
		$dados = array('pagina' => 'pesquisa_produto', 'titulo' => 'Procurar', 'pesquisa' => '');

		$this -> form_validation -> set_rules('nome', 'NOME', 'trim|required|max_length[100]|ucwords');

		if ($this -> form_validation -> run()) {
			$pesquisaView = elements(array('nome'), $this -> input -> post());
			$dados = array('pagina' => 'pesquisa_produto', 'titulo' => 'Procurar', 
			'pesquisa' => $this -> produto_model -> do_select($pesquisaView) -> result());
		}

		$this -> load -> view('Principal', $dados);
	}

	public function update() {
		$this -> form_validation -> set_rules('cod_barra', 'Codigo de Barra', 'trim|required|max_length[100]|ucwords');
		$this -> form_validation -> set_rules('data_entrega', 'Data de Entrega', 'trim|max_length[100]');
		$this -> form_validation -> set_rules('descricao', 'Descricao', 'trim|numeric|max_length[60]|ucwords');
		$this -> form_validation -> set_rules('preco', 'Preco', 'trim|numeric|ucwords');
		$this -> form_validation -> set_rules('quantidade', 'Quantidade', 'trim');
		$this -> form_validation -> set_rules('status', 'Status', 'ucwords');
		$this -> form_validation -> set_rules('validade', 'Validade', 'trim|numeric');
        
        if ($this->form_validation->run() == true) {

            $dados = elements(array('cod_barra', 'data_entrega', 'descricao', 'preco',
                'quantidade', 'status', 'validade'), $this->input->post());

            $this->produto_model->do_update(
                    $dados, array('id_produto' => $this->input->post('id_produto')));
        }
		
		$dados = array('titulo' => 'Atualiza Produto', 'pagina' => 'atualiza_produto');
		$this -> load -> view('Principal', $dados);
	}

	public function delete() {
		$dados = array('titulo' => 'CRUD &raquo; Delete', 'tela' => 'Delete', );
		$iduser = $this -> uri -> segment(3);

		if ($iduser == NULL)
			redirect('produto/lista');

		$this -> produto_model -> do_delete($iduser);

		$this -> load -> view('Principal', $dados);
	}

}
