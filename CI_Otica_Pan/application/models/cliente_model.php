<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cliente_model extends CI_Model {

    public function cadastrarCliente($dados = null) {
        if ($dados != null) {

            if(element('email', $dados)==NULL){$email = "";}else{$email=element('email', $dados);}
                
            
            
            
            
            $this->db->trans_start(); //Começa uma transação em diversas tabelas
            //Trata os elementos de Pesspa
            $pessoa = array(
                'nome' => element('nome', $dados),
                'email' => $email,
            );
            $this->db->insert('pessoa', $pessoa); //insere no BD
            $id_pessoa = $this->db->insert_id(); //Pega o ultimo ID inserido no BD
            //Trata os elemenos
            $cliente = array(
                'cpf' => element('cpf', $dados),
                'data_nascimento' => $this->util->data_user_para_mysql(element('data_nascimento', $dados)),
                'id_pessoa' => $id_pessoa,
            );
            
            $this->db->insert('cliente', $cliente); //insere no BD
            $id_cliente = $this->db->insert_id(); //Pega o ultimo ID inserido no BD
            //trata os elementos de endereço
            $endereco = array(
                'logradouro' => element('rua', $dados),
                'bairro' => element('bairro', $dados),
                'cidade' => element('cidade', $dados),
                'complemento' => element('complemento', $dados),
                'estado' => element('estado', $dados),
                'cep' => element('cep', $dados),
                'id_cliente' => $id_cliente,
            );
            $this->db->insert('endereco', $endereco); //insere no BD


            $telefone_fixo = array(
                'num_telefone' => element('num_telefone1', $dados),
                'id_tipo_telefone' => '1',
                'id_pessoa' => $id_pessoa,
            );

            $this->db->insert('telefone', $telefone_fixo); //insere no BD

            $telefone_celular = array(
                'num_telefone' => element('num_telefone2', $dados),
                'id_tipo_telefone' => '2',
                'id_pessoa' => $id_pessoa,
            );
            $this->db->insert('telefone', $telefone_celular); //insere no BD

            $this->db->trans_complete();

            $this->session->set_flashdata('cadastrook', 'Cadastro efetuado com sucesso'); //Adiciona na sessão temporaria o status do cadastro
            redirect('cliente');
        }
    }

    public function listarClientes($pesquisa, $limite=NULL) {

        
        $this->db->select('pessoa.id as id_pessoa,cliente.id as id_cliente, pessoa.nome,cliente.cpf,pessoa.email,telefone.num_telefone');
        $this->db->from('pessoa');
        $this->db->join('cliente', 'pessoa.id = cliente.id_pessoa');
        $this->db->join('telefone', 'pessoa.id = telefone.id_pessoa');
        $this->db->where("nome like '%$pesquisa%' or email like '%$pesquisa%' or cpf like '%$pesquisa%' ");
        if($limite!=NULL)$this->db->limit($limite);
        $this->db->group_by('pessoa.id');
        return $this->db->get();
    }

   
    public function retornaCliente($id_cliente = NULL) {


        if ($id_cliente != NULL) {
            
            $this->db->where('id', $id_cliente);
            $this->db->limit(1);
            $cliente = $this->db->get('cliente')->row();
            
            $this->db->where('id', $cliente->id_pessoa);
            $this->db->limit(1);
            $pessoa = $this->db->get('pessoa')->row();

            $this->db->where('id_cliente', $id_cliente);
            $this->db->limit(1);
            $endereco = $this->db->get('endereco')->row();

            $this->db->where('id_pessoa', $cliente->id_pessoa);
            $telefone = $this->db->get('telefone')->result();

            $dados = array(
                'pessoa' => $pessoa,
                'cliente' => $cliente,
                'endereco' => $endereco,
                'telefone' => $telefone,
            );
            return $dados;
        }
    }
    
 
    public function atualizaCliente($dados = NULL, $condicao = NULL) {

        if ($dados != null || $condicao != null) {

            $this->db->trans_start();
            
            //Inicio de Update Pessoa
            $pessoa = array(
                'nome' => element('nome', $dados),
                'email' => element('email', $dados),
            );

            $condicao_pessoa = array(
                'id' => $condicao['id_pessoa'],
            );
            $this->db->update('pessoa', $pessoa, $condicao_pessoa);
            //Final de Update pessoa
            //Inicio de Update cliente
            $cliente = array(
                'cpf' => element('cpf', $dados),
                'data_nascimento' => element('data_nascimento', $dados),
            );

            $condicao_cliente = array(
                'id_pessoa' => $condicao['id_pessoa'],
            );
            $this->db->update('cliente', $cliente, $condicao_cliente);
            //Final de Update Cliente
            //Inicio de Update Endereço
            $endereco = array(
                'bairro' => element('bairro', $dados),
                'cep' => element('cep', $dados),
                'cidade' => element('cidade', $dados),
                'complemento' => element('complemento', $dados),
                'estado' => element('estado', $dados),
                'logradouro' => element('rua', $dados),
            );

            $condicao_endereco = array(
                'id_cliente' => $condicao['id_cliente'],
            );
            $this->db->update('endereco', $endereco, $condicao_endereco);
            //Final de Update Endereco
            //Inicio de Update Telefone
            $telefone_fixo = array(
                'num_telefone' => element('num_telefone1', $dados),
            );
            $condicao_telefone_fixo = array(
                'id_pessoa' => $condicao['id_pessoa'],
                'id_tipo_telefone' => 1,
            );
            $this->db->update('telefone', $telefone_fixo, $condicao_telefone_fixo);
            //Final de Update Telefone
            //Inicio de Update Telefone
            $telefone_celular = array(
                'num_telefone' => element('num_telefone2', $dados),
            );
            $condicao_telefone_celular = array(
                'id_pessoa' => $condicao['id_pessoa'],
                'id_tipo_telefone' => 2,
            );
            $this->db->update('telefone', $telefone_celular, $condicao_telefone_celular);
            //Final de Update Telefone
              if($this->db->trans_complete()){
                  $this->session->set_flashdata('statusUpdate', 'Alterado com sucesso');
              }else{
                  $this->session->set_flashdata('statusUpdate', 'Não foi possível alterar o cliente');
              }
             
            //retorna para a pagina que chamou a função
            redirect(current_url());
        }
            redirect('cliente/listarClientes');

    }
    
    public function deleteCliente($id=null){
            
                 if($id !=null){
                     
                     $this->db->where('id',$id);
                     $this->db->delete('pessoa');
                     return true;
                 }
                 
                 return false;
            
        }
    
    
}

