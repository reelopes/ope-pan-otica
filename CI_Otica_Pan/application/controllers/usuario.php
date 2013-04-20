<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class usuario extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> helper('form');
		$this -> load -> helper('array');
                $this -> load -> model('usuario_model');
                $this -> load -> model('nivel_model');
                $this -> load -> library('uri');
		$this -> load -> library('form_validation');
		$this -> load -> library('session');
		$this -> load -> library('table');
                
                $this->login_model->logado();//Verifica se o usuário está logado
	}

	public function index() {
		$dados = array('pagina' => 'adiciona_usuario', 'titulo' => 'Novo Usuário');
		$this -> load -> view('Principal', $dados);
	}
        
        public function adiciona() {
            $this -> form_validation -> set_rules('login', 'Login', 'trim|required');
            $this -> form_validation -> set_rules('senha', 'Senha', 'trim|required');
            $this -> form_validation -> set_rules('senha_confirma', 'Senha', 'trim|required');
            $this -> form_validation -> set_rules('lembrete_senha', 'Lembrete de Senha', 'trim');
            $this -> form_validation -> set_rules('email', 'Email', 'trim|required');
            $this -> form_validation -> set_rules('id_nivel', 'Nivel de Acesso', 'trim|required');
            
            if ($this -> input -> post('senha') == $this -> input -> post('senha_confirma')) {
                
            }
            
            
            if ($this -> form_validation -> run()) {
                $dados = elements(array('login', 'senha', 'lembrete_senha', 'email', 'id_nivel'), $this -> input -> post());
                $this -> usuario_model -> do_insert($dados);
                
            } else {
                $dados = array('titulo' => 'Novo Usuário', 'pagina' => 'adiciona_usuario');
            }
            
            $this -> load -> view('Principal', $dados);
            }

	public function lista() {
		$dados = array('pagina' => 'lista_usuario', 'titulo' => 'Manter Usuário', 
		'usuario' => $this -> usuario_model -> getAll() -> result());

		$this -> load -> view('Principal', $dados);
	}

	public function pesquisa() {
		$dados = array('pagina' => 'pesquisa_usuario', 'titulo' => 'Manter Usuário', 'pesquisa' => '');

		$this -> form_validation -> set_rules('pesquisa', 'NOME', 'trim|required|max_length[100]|ucwords');

		if ($this -> form_validation -> run()) {
			$pesquisaView = $this -> input -> post('pesquisa');
			$dados = array('pagina' => 'pesquisa_usuario', 'titulo' => 'Manter usuario', 
			'pesquisa' => $this -> usuario_model -> do_select($pesquisaView) -> result());
		}
		$this -> load -> view('Principal', $dados);
	}

	public function update() {
            $this -> form_validation -> set_rules('referencia', 'Referencia', 'trim|required');
            $this -> form_validation -> set_rules('nome', 'Nome', 'trim|required');
            $this -> form_validation -> set_rules('descricao', 'Descricao', 'trim|max_length[60]|');
            $this -> form_validation -> set_rules('preco_custo', 'Preço de Custo', 'trim|numeric|ucwords|required');
            $this -> form_validation -> set_rules('preco_venda', 'Preço de Venda', 'trim|numeric|ucwords|required');
            $this -> form_validation -> set_rules('quantidade', 'Quantidade', 'trim');
            $this -> form_validation -> set_rules('status', 'Status', 'trim');
            $this -> form_validation -> set_rules('validade', 'Validade', 'trim');
            $this -> form_validation -> set_rules('data_entrega', 'Data de entrega', 'trim');
            
            if($this -> input -> post('usuario') == 1) {
                $this -> form_validation -> set_rules('largura_lente', 'Largura da lente', 'required');
                $this -> form_validation -> set_rules('largura_ponte', 'Largura da Ponte', 'required');
                $this -> form_validation -> set_rules('comprimento_haste', 'Comprimento da haste', 'required');
                $this -> form_validation -> set_rules('modelo', 'modelo', 'trim');
                $this -> form_validation -> set_rules('grife', 'Grife', 'required');
                $this -> form_validation -> set_rules('fornecedor', 'Fornecedor', 'required');
                
            }
            
            if ($this -> form_validation -> run()) {
                $dados = elements(array('referencia', 'nome', 'descricao', 'preco_custo', 'preco_venda', 'quantidade', 'status', 'validade', 'data_entrega',
                    'largura_lente', 'largura_ponte', 'comprimento_haste', 'modelo', 'grife', 'fornecedor',
                    'usuario'), $this -> input -> post());

                $this->usuario_model->do_update(
                        $dados, array('id_usuario' => $this->input->post('id_usuario')));
            }
            
            $dados = array('titulo' => 'Atualiza usuario', 'pagina' => 'atualiza_usuario');
            $this -> load -> view('Principal', $dados);
        }

	public function delete() {
		$dados = array('titulo' => 'CRUD &raquo; Delete', 'tela' => 'Delete', );
		$iduser = $this -> uri -> segment(3);

		if ($iduser == NULL)
			redirect('usuario/lista');

		$this -> usuario_model -> do_delete($iduser);

		$this -> load -> view('Principal', $dados);
	}
}