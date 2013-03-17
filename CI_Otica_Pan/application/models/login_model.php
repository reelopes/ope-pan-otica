<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {
    # VALIDA USUÁRIO

    function login($dados = null) {

        $login = $dados['usuario'];
        $senha = $dados['senha'];

        $this->db->where('login', $login);
        $this->db->where('senha', $senha);
        $query = $this->db->get('usuario');

        if ($query->num_rows == 1) {
            
            $logadoSistema = array(
                'logado' => TRUE,
                'login' => $login,
            );
            $this->session->set_userdata($logadoSistema);//Atribui na sessão que o usuario está logado
            return TRUE;//Se achar um o login com usuario e senha retorna true
            
        } else {
            return FALSE;//Se não achar login com usuário e senha retorna false
            
        }
    }

    # VERIFICA SE O USUÁRIO ESTÁ LOGADO

    function logado() {
        $logado = $this->session->userdata('logado');

        if (!isset($logado) || $logado != true) {
             $this->session->set_flashdata('erroLogin','É necessário logar no sistema');//Adiciona na sessão temporaria o status do cadastro
            redirect('login');
        }
    }

}
