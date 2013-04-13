<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Tipo_lente extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> helper('form');
		$this -> load -> helper('array');
		$this -> load -> model('tipo_lente_model');
                $this -> load -> library('uri');
		$this -> load -> library('form_validation');
		$this -> load -> library('session');
		$this -> load -> library('table');
                
                $this->login_model->logado();//Verifica se o usuário está logado

	}

	public function index() {
		$dados = array('pagina' => 'adiciona_tipo_lente', 'titulo' => 'Criar Tipo de Lente');
		$this -> load -> view('Principal', $dados);
	}
        
        public function adiciona() {
            $this -> form_validation -> set_rules('tipo', 'Tipo', 'trim|max_length[60]|ucwords|required');
            
            if ($this -> form_validation -> run()) {
                $dados = elements(array('tipo'), $this -> input -> post());
                $this -> tipo_lente_model -> do_insert($dados);
                
            } else {
                $dados = array('titulo' => 'Criar Tipo de Lente', 'pagina' => 'adiciona_tipo_lente');
                $this -> load -> view('Principal', $dados);
            }
	}

	public function lista() {
		$dados = array('pagina' => 'lista_tipo_lente', 'titulo' => 'Manter Tipo de Lente', 
		'tipo_lente' => $this -> tipo_lente_model -> getAll() -> result());

		$this -> load -> view('Principal', $dados);
	}
        
        public function pesquisa() {
            $this->form_validation->set_rules('pesquisa');
            $this->form_validation->run();
            $dados = Array(
            'pagina' => 'lista_tipo_lente',
            'titulo' => 'Manter Tipo de Lente',
            'tipo_lente' => $this->tipo_lente_model->do_select($this->input->post('pesquisa'))->result(),
            );
            
            $this -> load -> view('Principal', $dados);
	}

	public function update() {
            $this -> form_validation -> set_rules('tipo', 'Tipo', 'trim|max_length[60]|ucwords|required');
            
            if ($this->form_validation->run() == true) {

            $dados = elements(array('tipo'), $this->input->post());

            $this->tipo_lente_model->do_update(
                    $dados, array('id_tipo_lente' => $this->input->post('id_tipo_lente')));
            
            }
		$dados = array('titulo' => 'Atualiza Tipo de Lente', 'pagina' => 'atualiza_tipo_lente');
		$this -> load -> view('Principal', $dados);
            }

	public function delete() {
		$dados = array('titulo' => 'CRUD &raquo; Delete', 'tela' => 'Delete', );
		$iduser = $this -> uri -> segment(3);

		if ($iduser == NULL)
			redirect('tipo_lente/lista');

		$this -> tipo_lente_model -> do_delete($iduser);

		$this -> load -> view('Principal', $dados);
	}

}
