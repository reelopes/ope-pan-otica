<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helpers('url');
        $this->load->helper('form');
        $this->load->model('cliente_model');
        $this->load->library('form_validation');
        $this->load->library('table');
            
        $this->login_model->logado();//Verifica se o usuário está logado
            
            
            
        
             
    }
    
    public function index() {

        $dados = Array(
            'pagina' => 'adiciona_cliente',
            'titulo' => 'Cadastrar Cliente'
        );

        $this->load->view('Principal', $dados);
    }

    public function cadastrarCliente() {

        $this->form_validation->set_rules('nome', 'NOME', 'trim|required|max_length[100]|ucwords');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|max_length[100]|strtolower|valid_email');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|numeric|required|max_length[15]|is_unique[cliente.cpf]');
        $this->form_validation->set_rules('data_nascimento', 'Data Nascimento', 'trim');
        $this->form_validation->set_rules('num_telefone1', 'Numero do Telefone', 'trim|max_length[15]');
        $this->form_validation->set_rules('num_telefone2', 'Numero do Celular', 'trim|max_length[15]');
        $this->form_validation->set_rules('rua', 'RUA', 'trim|max_length[80]');
        $this->form_validation->set_rules('bairro', 'BAIRRO', 'trim|max_length[50]|');
        $this->form_validation->set_rules('cidade', 'CIDADE', 'trim||max_length[50]');
        $this->form_validation->set_rules('complemento', 'COMPLEMENTO', 'trim|max_length[20]');
        $this->form_validation->set_rules('estado', 'ESTADO', 'trim|max_length[2]');
        $this->form_validation->set_rules('cep', 'CEP', 'trim|max_length[10]');
        
        
        
        
        
        
        //Trata a mensagem que CPF já Existe no sistema
        //$this-> form_validation->set_message('is_unique','Campo %s já existe no sistema');


        if ($this->form_validation->run() == true) {

            $dados = elements(array('nome', 'email', 'cpf', 'data_nascimento', 'num_telefone1',
                'num_telefone2', 'rua', 'bairro', 'cidade', 'complemento', 'estado', 'cep'), $this->input->post());
            $this->cliente_model->cadastrarCliente($dados);
        } else {

            $dados = array(
                'titulo' => 'Cadastro de Cliente',
                'pagina' => 'adiciona_cliente',
            );

            $this->load->view('Principal', $dados);
        }
    }

    public function listarClientes() {

        $dados = Array(
            'pagina' => 'listar_clientes',
            'titulo' => 'Lista Todos os Clientes',
            'clientes' => $this->cliente_model->listarClientes('')->result(),
        );




        $this->load->view('Principal', $dados);
    }

    public function atualizarCliente() {

        $this->form_validation->set_rules('nome', 'NOME', 'trim|required|max_length[100]|ucwords');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|max_length[100]|strtolower|valid_email');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|numeric|max_length[15]');
        $this->form_validation->set_rules('data_nascimento', 'Data Nascimento', 'trim');
        $this->form_validation->set_rules('num_telefone1', 'Numero do Telefone', 'trim|max_length[15]');
        $this->form_validation->set_rules('num_telefone2', 'Numero do Celular', 'trim|max_length[15]');
        $this->form_validation->set_rules('rua', 'RUA', 'trim|max_length[80]');
        $this->form_validation->set_rules('numero', 'NUMERO', 'trim|max_length[10]');
        $this->form_validation->set_rules('bairro', 'BAIRRO', 'trim|max_length[50]|');
        $this->form_validation->set_rules('cidade', 'CIDADE', 'trim||max_length[50]');
        $this->form_validation->set_rules('complemento', 'COMPLEMENTO', 'trim|max_length[20]');
        $this->form_validation->set_rules('estado', 'ESTADO', 'trim|max_length[2]');
        $this->form_validation->set_rules('cep', 'CEP', 'trim|max_length[10]');
        if ($this->form_validation->run() == true) {

            $dados = elements(array('nome', 'email', 'cpf', 'data_nascimento', 'num_telefone1',
                'num_telefone2', 'rua', 'numero', 'bairro', 'cidade', 'complemento', 'estado', 'cep'), $this->input->post());

            $this->cliente_model->atualizaCliente(
                    $dados, array('id_pessoa' => $this->input->post('id_pessoa'),
                'id_cliente' => $this->input->post('id_cliente'),
            ));
        }

        $dados = array(
            'titulo' => 'Altera dados do cliente',
            'pagina' => 'altera_cliente',
        );

        $this->load->view('principal', $dados);
    }

    public function deletarCliente() {

        if ($this->uri->segment(3) != NULL) {

            $id_pessoa = $this->uri->segment(3);
            
            if($this->cliente_model->deleteCliente($id_pessoa)){
            $this->session->set_flashdata('msg','Cliente deletado com sucesso');
            redirect('cliente/listarClientes');
            }
            
        } else {
            redirect('cliente/listarClientes');
        }
    }
    
    public function pesquisaCliente(){
            
        $this->form_validation->set_rules('pesquisa');
        $this->form_validation->run();
            $dados = Array(
            'pagina' => 'listar_clientes',
            'titulo' => 'Lista Todos os Clientes',
            'clientes' => $this->cliente_model->listarClientes($this->input->post('pesquisa'))->result(),
        );




        $this->load->view('Principal', $dados);
    }
}

?>
