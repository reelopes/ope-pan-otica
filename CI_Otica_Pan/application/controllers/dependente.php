<script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/js/dependente.js"></script> 
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dependente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helpers('url');
        $this->load->helper('form');
        $this->load->model('dependente_model');
        $this->load->library('form_validation');
        $this->load->library('table');
            
        $this->login_model->logado();//Verifica se o usuário está logado
            
            
            
        
             
    }
    
    public function index() {

        $dados = Array(
            'pagina' => 'adiciona_dependente',
            'titulo' => 'Cadastrar Dependente'
        );

        $this->load->view('Principal', $dados);
    }

   
    public function listarDependentes() {

        $dados = Array(
            'pagina' => 'listar_dependentes',
            'titulo' => 'Lista Todos os Dependentes',
            'clientes' => $this->dependente_model->listarDependentes('')->result(),
        );




        $this->load->view('Principal', $dados);
    }

    public function atualizarDependente() {

        $this->form_validation->set_rules('nome', 'NOME', 'trim|required|max_length[100]|ucwords');
        $this->form_validation->set_rules('data_nascimento', 'Data Nascimento', 'trim');
        $this->form_validation->set_rules('responsavel', 'RESPONSAVEL', 'trim|max_length[20]');
        
        if ($this->form_validation->run() == true) {

            $dados = elements(array('nome', 'data_nascimento', 'responsavel'), $this->input->post());
            

            $this->cliente_model->atualizaDependente(
                    $dados, array('id_dependente' => $this->input->post('id_dependente'),
            ));
        }

        $dados = array(
            'titulo' => 'Altera dados do dependente',
            'pagina' => 'altera_dependente',
        );

        $this->load->view('principal', $dados);
    }

    public function deletarDependente() {

        if ($this->uri->segment(3) != NULL) {

            $id_pessoa = $this->uri->segment(3);
            
            if($this->cliente_model->deleteDependente($id_dependente)){
            $this->session->set_flashdata('msg','Dependente deletado com sucesso');
            redirect('dependente/listarDependentes');
            }
            
        } else {
            redirect('dependente/listarDependente');
        }
    }
    
    
    public function cadastrarDependente() {
        
        $this->form_validation->set_rules('nomeCliente', 'NOME DO CLIENTE', 'trim|required|ucwords');
        $this->form_validation->set_rules('cpfCliente', 'CPF DO CLIENTE', 'trim|required|ucwords');
        $this->form_validation->set_rules('nomeDependente', 'NOME DO DEPENDENTE', 'trim|required|max_length[100]|ucwords');
        $this->form_validation->set_rules('dataNascimentoDependente', 'Data Nascimento', 'trim');
        $this->form_validation->set_rules('responsavelDependente', 'RESPONSAVEL', 'trim|max_length[20]|ucwords');
               
      if($this->form_validation->run()==true){

            $dependente = elements(array('nomeDependente', 'dataNascimentoDependente', 'responsavelDependente','idCliente'), $this->input->post());
            $this->dependente_model->cadastrarDependente($dependente);
            
      }else {

            $dados = array(
                'titulo' => 'Cadastro de Dependente',
                'pagina' => 'adiciona_dependente',
            );

            $this->load->view('Principal', $dados);
        }
      
      
      
      }
    
        public function pesquisaDinamica() {

        $pesquisaCliente = $this->uri->segment(3); //Captura o ano da URL
        $this->load->model('cliente_model');

        $clientes = $this->cliente_model->listarClientes($pesquisaCliente, '3')->result();


        if ($clientes == NULL) {
            echo"Sua pesquisa não encontrou nenhum dado correspondente.";
        } else {

            echo"
          <table border='1' cellpadding='2' cellspacing='1' class = 'pesquisaDinamica'>
          <tr>
          <th>Nome</th>
          <th>Cpf</th>
          <th>E-mail</th>
          </tr>
          
          ";
            foreach ($clientes as $linha) {

                echo"
        <tr class=\"alt\" ONCLICK=\"populaResponsavel('$linha->id_cliente','$linha->nome','$linha->cpf');\" style=\"cursor: hand;\">
        <td>$linha->nome</td>
        <td>$linha->cpf</td>
        <td>$linha->email</td>
        </tr>
        ";
            }
            echo "</table>";
        }
    }
    
    }
    
    


?>