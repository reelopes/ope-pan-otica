<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Fornecedor extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> helper('form');
		$this -> load -> helper('array');
		$this -> load -> model('fornecedor_model');
		$this -> load -> library('form_validation');
		$this -> load -> library('session');
		$this -> load -> library('table');
                
                $this->login_model->logado();//Verifica se o usuário está logado

	}

	public function index() {
		$dados = array('pagina' => 'lista_fornecedor', 'titulo' => 'Manter Fornecedor', 
		'fornecedor' => $this -> fornecedor_model -> getAll() -> result());
		
		$this -> load -> view('Principal', $dados);
	}

	public function adiciona() {
		$dados = array('pagina' => 'adiciona_fornecedor', 'titulo' => 'Cadastrar Fornecedor');

		$this -> form_validation -> set_rules('nome', 'NOME', 'trim|required|max_length[100]|ucwords');
		$this -> form_validation -> set_rules('email', 'EMAIL', 'trim|max_length[100]|strtolower|valid_email');
		$this -> form_validation -> set_rules('cnpj', 'CNPJ', 'trim|numeric|max_length[15]|is_unique[fornecedor.cnpj]');
		$this -> form_validation -> set_rules('data_nascimento', 'Data Nascimento', 'trim');
		$this -> form_validation -> set_rules('num_telefone1', 'Numero do Telefone', 'trim|max_length[15]');
		$this -> form_validation -> set_rules('num_telefone2', 'Numero do Celular', 'trim|max_length[15]');

		if ($this -> form_validation -> run()) {
			$dados = elements(array('nome', 'email', 'cnpj', 'num_telefone1', 'num_telefone2'), $this -> input -> post());
			$this -> fornecedor_model -> do_insert($dados);
		} else {

			$dados = array('titulo' => 'Cadastro Fornecedor', 'pagina' => 'adiciona_fornecedor', );

			$this -> load -> view('Principal', $dados);
		}
	}

	public function lista() {
		$dados = array('pagina' => 'lista_fornecedor', 'titulo' => 'Manter Fornecedor', 
		'fornecedor' => $this -> fornecedor_model -> getAll() -> result());

		$this -> load -> view('Principal', $dados);
	}

	public function pesquisa() {
            $this->form_validation->set_rules('pesquisa');
            $this->form_validation->run();
            $dados = Array(
            'pagina' => 'lista_fornecedor',
            'titulo' => 'Lista Todos os Fornecedores',
            'fornecedor' => $this->fornecedor_model->do_select($this->input->post('pesquisa'))->result(),
        );
		$this -> load -> view('Principal', $dados);
	}

	public function update() {
            $this->form_validation->set_rules('nome', 'NOME', 'trim|required|max_length[100]|ucwords');
            $this->form_validation->set_rules('email', 'EMAIL', 'trim|max_length[100]|strtolower|valid_email');
            $this->form_validation->set_rules('cnpj', 'CNPJ', 'trim|numeric|max_length[15]');
            $this->form_validation->set_rules('num_telefone1', 'Numero do Telefone', 'trim|max_length[15]');
            $this->form_validation->set_rules('num_telefone2', 'Numero do Celular', 'trim|max_length[15]');

            if ($this->form_validation->run() == true) {

                $dados = elements(array('nome', 'email', 'cnpj', 'num_telefone1',
                    'num_telefone2'), $this->input->post());

                $this->fornecedor_model->do_update(
                        $dados, array('id_pessoa' => $this->input->post('id_pessoa'),
                    'id_fornecedor' => $this->input->post('id_fornecedor')));
            }
            
            $dados = array('titulo' => 'Atualiza Fornecedor', 'pagina' => 'atualiza_fornecedor');
            $this -> load -> view('Principal', $dados);
	}

	public function delete() {
		$dados = array('titulo' => 'CRUD &raquo; Delete', 'tela' => 'Delete', );
		$iduser = $this -> uri -> segment(3);

		if ($iduser == NULL)
			redirect('fornecedor/lista');

		$this -> fornecedor_model -> do_delete($iduser);

		$this -> load -> view('Principal', $dados);
	}

}
