<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Venda_model extends CI_Model {

    public function cadastrarOrcamento($dados = null) {
        if ($dados != null && 
           $dados['itens']!= null || 
           $dados['lentes'] != null || 
           $dados['servicos'] != null) {

            $this->db->trans_start(); //Começa uma transação em diversas tabelas
            
            //Trata os elementos do orçamento
            $orcamento = array(
                'data' => $dados['data'],
                'id_forma_pgto' => $dados['forma_pagamento'],
                'vendedor' => $dados['vendedor'],
                'desconto' => $dados['desconto'],
                'status' => '1',
                'id_cliente'=> $dados['id_cliente'],
            );
            $this->db->insert('orcamento', $orcamento); //insere no BD
            
            $id_orcamento = $this->db->insert_id();//Captura o ID do orçamento
            
            //processo de insert na tabela itens
            if($dados['itens']!=null){
            foreach ($dados['itens'] as $item) {//captura cada item do array
                
                $item = array(
                'nome' => $item['nomeProduto'],
                'id_produto' => $item['idProduto'],
                'preco_unitario' => $this->util->virgulaParaPonto($item["precoVenda"]),
                'quantidade' => $item['quantidadeProduto'],
                'id_orcamento' => $id_orcamento
            );
             $this->db->insert('itens', $item);//Insere is itens na tabeka
            }
            }
            if($dados['servicos']!=null){
            foreach ($dados['servicos'] as $servico) {//captura cada item do array
                
                $servico = array(
                'nome' => $servico['nome'],
                'preco_venda' => $this->util->virgulaParaPonto($servico['preco']),
                'id_orcamento' => $id_orcamento,
                'descricao'=> $servico['descricao'],
            );
             $this->db->insert('servico', $servico);//Insere is itens na tabeka
            }
            }
           if($dados['lentes']!=null){
            foreach ($dados['lentes'] as $lente) {//captura cada item do array
                
                $lente = array(
                'nome' => $lente['nome_lente'],
                'referencia' => $lente['referencia'],
                'preco_venda' => $this->util->virgulaParaPonto($lente['preco_venda']),
                'id_orcamento' => $id_orcamento
            );
             $this->db->insert('lente', $lente);//Insere is itens na tabeka
            }
            }
          
            $this->db->trans_complete();
           
            
            $this->session->set_flashdata('orcamentoOk','Orçamento salvo com sucesso!\n\nDeseja Imprimir o Orçamento?');
            $this->session->set_flashdata('id_orcamento', $id_orcamento);

            redirect('venda/limparVenda');
            
            }else{
            $this->session->set_flashdata('msg','Não foi possível salvar o orçamento, verifique todos os dados e tente novamente.');
            redirect('venda/cadastrarVenda');

            }
        }
    
   public function retornaOrcamento($id_orcamento = NULL) {


        if ($id_orcamento != NULL) {

            $this->db->where('id', $id_orcamento);
            $this->db->limit(1);
            $orcamento = $this->db->get('orcamento')->row();

            $this->db->where('id_orcamento', $id_orcamento);
            $itens = $this->db->get('itens')->result();

            $this->db->where('id_orcamento', $id_orcamento);
            $servicos = $this->db->get('servico')->result();


            $this->db->where('id_orcamento', $id_orcamento);
            $lentes = $this->db->get('lente')->result();
            
            //captura o cliente
            $this->db->where('id', $orcamento->id_cliente);
            $this->db->limit(1);
            $cliente = $this->db->get('cliente')->row();

            $this->db->where('id', $cliente->id_pessoa);
            $this->db->limit(1);
            $pessoa = $this->db->get('pessoa')->row();
            
            $this->db->where('id', $orcamento->id_forma_pgto);
            $this->db->limit(1);
            $formaPgo = $this->db->get('forma_pgto')->row();

            $dados = array(
                'orcamento' => $orcamento,
                'servicos' => $servicos,
                'lentes' => $lentes,
                'itens' => $itens,
                'cliente' => $cliente,
                'pessoa' => $pessoa,
                'formaPgto'=>$formaPgo,
            );
            return $dados;
        }
    }
   
        public function cadastrarVenda($dados = null) {
        if ($dados != null && 
           $dados['itens']!= null || 
           $dados['lentes'] != null || 
           $dados['servicos'] != null) {

            $this->db->trans_start(); //Começa uma transação em diversas tabelas
            
            //Trata os elementos do orçamento
            $orcamento = array(
                'data' => $dados['data'],
                'id_forma_pgto' => $dados['forma_pagamento'],
                'vendedor' => $dados['vendedor'],
                'desconto' => $dados['desconto'],
                'status' => '1',
                'id_cliente'=> $dados['id_cliente'],
            );
            $this->db->insert('orcamento', $orcamento); //insere no BD
            
            $id_orcamento = $this->db->insert_id();//Captura o ID do orçamento
            
            //processo de insert na tabela itens
            if($dados['itens']!=null){
            foreach ($dados['itens'] as $item) {//captura cada item do array
                
                $item = array(
                'nome' => $item['nomeProduto'],
                'id_produto' => $item['idProduto'],
                'preco_unitario' => $this->util->virgulaParaPonto($item["precoVenda"]),
                'quantidade' => $item['quantidadeProduto'],
                'id_orcamento' => $id_orcamento
            );
             $this->db->insert('itens', $item);//Insere is itens na tabeka
            }
            }
            if($dados['servicos']!=null){
            foreach ($dados['servicos'] as $servico) {//captura cada item do array
                
                $servico = array(
                'nome' => $servico['nome'],
                'preco_venda' => $this->util->virgulaParaPonto($servico['preco']),
                'id_orcamento' => $id_orcamento,
                'descricao'=> $servico['descricao'],
            );
             $this->db->insert('servico', $servico);//Insere is itens na tabeka
            }
            }
           if($dados['lentes']!=null){
            foreach ($dados['lentes'] as $lente) {//captura cada item do array
                
                $lente = array(
                'nome' => $lente['nome_lente'],
                'referencia' => $lente['referencia'],
                'preco_venda' => $this->util->virgulaParaPonto($lente['preco_venda']),
                'id_orcamento' => $id_orcamento
            );
             $this->db->insert('lente', $lente);//Insere is itens na tabeka
            }
            }
          
            $this->db->trans_complete();
           
            
            $this->session->set_flashdata('orcamentoOk','Orçamento salvo com sucesso!\n\nDeseja Imprimir o Orçamento?');
            $this->session->set_flashdata('id_orcamento', $id_orcamento);

            redirect('venda/limparVenda');
            
            }else{
            $this->session->set_flashdata('msg','Não foi possível salvar o orçamento, verifique todos os dados e tente novamente.');
            redirect('venda/cadastrarVenda');

            }
        }
    
    
                       }





