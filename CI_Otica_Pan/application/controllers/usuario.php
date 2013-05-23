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
                $this -> load -> model('util_model');
                $this -> load -> library('uri');
		$this -> load -> library('form_validation');
		$this -> load -> library('session');
		$this -> load -> library('table');
                
                $this->login_model->logado();//Verifica se o usuário está logado
	}

	public function index() {
		$dados = array('pagina' => 'adiciona_usuario', 'titulo' => 'Cadastrar Usuário');
		$this -> load -> view('Principal', $dados);
	}
        
        public function adiciona() {
            $this -> form_validation -> set_rules('login', 'Login', 'trim|required');
            $this -> form_validation -> set_rules('senha', 'Senha', 'trim|required');
            $this -> form_validation -> set_rules('senha_confirma', 'Senha', 'trim|required');
            $this -> form_validation -> set_rules('lembrete_senha', 'Lembrete de Senha', 'trim');
            $this -> form_validation -> set_rules('email', 'Email', 'trim|required');
            $this -> form_validation -> set_rules('id_nivel', 'Nivel de Acesso', 'trim|required');            
            
            if ($this -> form_validation -> run()) {
                $dados = elements(array('login', 'senha', 'lembrete_senha', 'email', 'id_nivel'), $this -> input -> post());
                $this -> usuario_model -> do_insert($dados);
                
            } else {
                $dados = array('titulo' => 'Novo Usuário', 'pagina' => 'adiciona_usuario');
            }
            
            $this -> load -> view('Principal', $dados);
            }

	public function lista() {
		$dados = array('pagina' => 'lista_usuario', 'titulo' => 'Pesquisa Usuário', 
		'usuario' => $this -> usuario_model -> getAll() -> result());

		$this -> load -> view('Principal', $dados);
	}

	public function update() {
            $this -> form_validation -> set_rules('login', 'Login', 'trim|required');
            $this -> form_validation -> set_rules('senha', 'Senha', 'trim|required');
            $this -> form_validation -> set_rules('senha_confirma', 'Senha', 'trim|required');
            $this -> form_validation -> set_rules('lembrete_senha', 'Lembrete de Senha', 'trim');
            $this -> form_validation -> set_rules('email', 'Email', 'trim|required');
            $this -> form_validation -> set_rules('id_nivel', 'Nivel de Acesso', 'trim|required');
            
            if ($this -> form_validation -> run()) {
                $dados = elements(array('login', 'senha', 'lembrete_senha', 'email', 'id_nivel'), $this -> input -> post());
                $this->usuario_model->do_update(
                        $dados, array('id_usuario' => $this->input->post('id_usuario')));
            }
            
            $dados = array('titulo' => 'Pesquisa usuario', 'pagina' => 'lista_usuario');
            $this -> load -> view('Principal', $dados);
        }

	public function delete() {
		$dados = array('titulo' => 'CRUD &raquo; Delete', 'tela' => 'Delete', );
		$iduser = $this -> uri -> segment(3);

		if ($iduser == NULL) {
                    redirect('usuario/lista');
                } else {
                    $this->util_model->deletarComEvento('usuario', $iduser, 'o Usuário', 'usuario/lista');
                }

		$this -> load -> view('Principal', $dados);
	}
}