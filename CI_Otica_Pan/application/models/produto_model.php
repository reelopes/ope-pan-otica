<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class produto_model extends CI_Model {

    public function do_insert($dados = null) {
        if ($dados != null) {
            $this->db->trans_start();

            $produto = array(
                'cod_barra' => '' . element('cod_barra', $dados),
                'nome' => '' . element('nome', $dados),
                'descricao' => '' . element('descricao', $dados),
                'preco_custo' => $this->util->virgulaParaPonto(element('preco_custo', $dados)),
                'preco_venda' => $this->util->virgulaParaPonto(element('preco_venda', $dados)),
                'quantidade' => '' . element('quantidade', $dados),
                'validade' => element('validade', $dados),
                'categoria' => '' . element('produto', $dados),
            );

            $this->db->insert('produto', $produto);

            $id_produto = $this->db->insert_id();

            if (element('produto', $dados) == 1) {
                $armacao = array(
                    'largura_lente' => '' . element('largura_lente', $dados),
                    'largura_ponte' => '' . element('largura_ponte', $dados),
                    'comprimento_haste' => '' . element('comprimento_haste', $dados),
                    'modelo' => '' . element('modelo', $dados),
                    'id_fornecedor' => '' . element('id_fornecedor', element('fornecedor', $dados)),
                    'id_produto' => $id_produto,
                    'id_grife' => '' . element('id', element('grife', $dados))
                );
                $this->db->insert('armacao', $armacao);
            }

            $this->db->trans_complete();
            $this->session->set_flashdata('cadastrook', 'Cadastro efetuado com sucesso\n\nO código do produto é: '.$id_produto);

            redirect('produto/adiciona');
        }
    }

    public function getAll() {
        $this->db->select('id as id_produto, cod_barra, nome, 
                    descricao, preco_custo, preco_venda,
                    quantidade, status, validade, categoria');
        $this->db->from('produto');
        $produto = $this->db->get();

        return $produto;
    }

    public function do_select($campo,$parametro) {

        $this->db->select
                ('cod_barra, nome, descricao, preco_custo, preco_venda,
                          quantidade, status, validade, categoria, id as id_produto');
        $this->db->from('produto');
        $this->db->where($campo,$parametro);
        $this->db->where('status','1');

        return $this->db->get();
    }

    public function get_byid($id_produto = NULL) {
        if ($id_produto != NULL) {
            $this->db->where('id', $id_produto);
            $this->db->limit(1);
            $produto = $this->db->get('produto')->row();

            if ($produto->categoria == 1) {
                $this->db->where('id_produto', $id_produto);
                $this->db->limit(1);
                $armacao = $this->db->get('armacao')->row();

                $this->db->where('id', $armacao->id_fornecedor);
                $this->db->limit(1);
                $fornecedorE = $this->db->get('fornecedor')->row();

                $this->db->where('id', $fornecedorE->id_pessoa);
                $this->db->limit(1);
                $dadosForn = $this->db->get('pessoa')->row();

                $this->db->where('id', $armacao->id_grife);
                $this->db->limit(1);
                $grife = $this->db->get('grife')->row();

                $dados = array('produto' => $produto, 'armacao' => $armacao, 'fornecedor' => $dadosForn, 'fornecedorE' => $fornecedorE, 'grife' => $grife);
            } else {
                $dados = array('produto' => $produto);
            }

            return $dados;
        }
    }

    public function do_update($dados = NULL, $condicao = NULL) {
        if ($dados != null || $condicao != null) {
            $this->db->trans_start();

            $ativo = 0;
            if (element('status', $dados) == 'on') {
                $ativo = 1;
            }

            $produto = array(
                'cod_barra' => '' . element('cod_barra', $dados),
                'nome' => '' . element('nome', $dados),
                'descricao' => '' . element('descricao', $dados),
                'preco_custo' => $this->util->virgulaParaPonto(element('preco_custo', $dados)),
                'preco_venda' => $this->util->virgulaParaPonto(element('preco_venda', $dados)),
                'quantidade' => '' . element('quantidade', $dados),
                'status' => $ativo,
                'validade' => element('validade', $dados),
                'quantidade' => '' . element('quantidade', $dados));

            $this->db->update('produto', $produto, 'id = ' . $condicao);

            if (element('produto', $dados) == 1) {
                $tipoProduto = array(
                    'largura_lente' => '' . element('largura_lente', $dados),
                    'largura_ponte' => '' . element('largura_ponte', $dados),
                    'comprimento_haste' => '' . element('comprimento_haste', $dados),
                    'modelo' => '' . element('modelo', $dados),
                    'id_fornecedor' => '' . element('id_fornecedor', element('fornecedor', $dados)),
                    'id_produto' => $condicao,
                    'id_grife' => '' . element('id', element('grife', $dados))
                );
                $this->db->update('armacao', $tipoProduto, 'id_produto = ' . $condicao);
            }

            if ($this->db->trans_complete()) {
                $this->session->set_flashdata('statusUpdate', 'Produto alterado com sucesso');
            } else {
                $this->session->set_flashdata('statusUpdate', 'Não foi possível alterar o produto');
            }
            redirect(current_url());
        }
        redirect('produto/lista');
    }

    public function do_delete($id = null) {
        if ($id != null) {

            $this->db->where('id_produto', $id);
            $this->db->delete('armacao');

            $this->db->where('id', $id);
            $this->db->delete('produto');

            return $this->db->_error_number();
        }
        return false;
    }

}