<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('array');
        $this->load->library('table');
        $this->load->model('login_model');
    }

    function index() {
        // VALIDATION RULES
        $this->load->library('form_validation');
        $this->form_validation->set_rules('usuario', 'Username', 'required', 'strtolower');
        $this->form_validation->set_rules('senha', 'Password', 'required', 'strtolower');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('login_view');
        } else {

            $dados = array(
                'usuario' => $this->input->post('usuario'),
                'senha' => $this->input->post('senha'),
            );

            if ($this->login_model->login($dados) == TRUE) {
             
                redirect('principal');
                
            } else {
                
            $this->session->set_flashdata('erroLogin','Usuário ou senha inválidos');//Adiciona na sessão temporaria o status do cadastro
            redirect('login');
            }
        }
    }

}
