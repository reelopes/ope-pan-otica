<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dependente_model extends CI_Model {

    public function cadastrarDependente($dados = null) {
        if ($dados != null) {

            $this->db->trans_start(); //Começa uma transação no banco de dados
            //Trata os elementos de Dependente
            $dependente = array(
                'nome' => element('nomeDependente', $dados),
                'data_nascimento' => $this->util->data_user_para_mysql(element('dataNascimentoDependente', $dados)),
                'responsavel' => element('responsavelDependente', $dados),
                'id_cliente' => element('idCliente', $dados),
            );
            $this->db->insert('dependente', $dependente); //insere no BD

            $this->db->trans_complete();

            $this->session->set_flashdata('cadastrook', 'Cadastro efetuado com sucesso'); //Adiciona na sessão temporaria o status do cadastro
            redirect('dependente');
        }
    }

    public function listarDependentes($id_cliente=NULL) {
     
        if($id_cliente==null) return $teste=banana;
          
        $this->db->select('dependente.id as id_dependente,dependente.id_cliente as id_cliente, dependente.nome,dependente.data_nascimento,dependente.responsavel');
        $this->db->from('dependente');
        $this->db->where("dependente.id_cliente = '$id_cliente'");
        return $this->db->get()->result();
    }

    public function retornaDependente($id_dependente) {

        if ($id_dependente != NULL) {

            $this->db->where('id', $id_dependente);
            $dependente = $this->db->get('dependente')->row();

            return $dependente;
        }
    }

    public function atualizaDependente($dados = NULL, $condicao = NULL) {

        if ($dados != null || $condicao != null) {

            $this->db->trans_start();

            //Inicio de Update Dependente
            $dependente = array(
                'nome' => element('nome', $dados),
                'data_nascimento' => $this->util->data_user_para_mysql(element('data_nascimento', $dados)),
                'responsavel' => element('responsavel', $dados),
            );

            $condicao_dependente = array(
                'id' => $condicao['id_dependente'],
            );
            $this->db->update('dependente', $dependente, $condicao_dependente);
            //Final de Update dependente
            
            if ($this->db->trans_complete()) {
                $this->session->set_flashdata('statusUpdate', 'Alterado com sucesso');
            } else {
                $this->session->set_flashdata('statusUpdate', 'Não foi possível alterar o cliente');
            }

            //retorna para a pagina que chamou a função
            redirect(current_url());
        }
            redirect(current_url());
    }

    public function deletaDependente($id = null) {

        if ($id != null) {

            $this->db->where('id', $id);
            $this->db->delete('dependente');
            return true;
        }

        return false;
    }

}

