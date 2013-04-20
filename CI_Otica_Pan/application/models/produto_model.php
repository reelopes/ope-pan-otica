<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class produto_model extends CI_Model {
	public function do_insert($dados = null) {
            if ($dados != null) {
		$this -> db -> trans_start();
                
		$produto = array(
                    'referencia' => element('referencia', $dados),
                    'nome' => element('nome', $dados),
                    'descricao' => element('descricao', $dados),
                    'preco_custo' => element('preco_custo', $dados),
                    'preco_venda' => element('preco_venda', $dados),
                    'quantidade'  => element('quantidade', $dados),
                    'status' => element('status', $dados),
                    'validade' => element('validade', $dados),
                    'quantidade' => element('quantidade', $dados),
                    'status' => element('status', $dados),
                    'validade' => $this->util->data_user_para_mysql(element('validade', $dados)),
                    'categoria' => element('produto', $dados),
                    );
		$this -> db -> insert('produto', $produto);

		$id_produto = $this -> db -> insert_id();
                
                if (element('produto', $dados) == 1) {
                    $tipoProduto = array(
                        'largura_lente' => element('largura_lente', $dados),
                        'largura_ponte' => element('largura_ponte', $dados),
                        'comprimento_haste' => element('comprimento_haste', $dados),
                        'modelo' => element('modelo', $dados),
                        'id_fornecedor' => element('id_fornecedor' ,element('fornecedor', $dados)),
                        'id_produto' => $id_produto,
                        'id_grife' => element('id' ,element('grife', $dados))
                        );
                    $this -> db -> insert('armacao', $tipoProduto);
                } else if(element('produto', $dados) == 2) {
                    $tipoProduto = array(
                        'id_tipo_lente' => element('id', element('lista_tipo_lente', $dados)),
                        'id_produto' => $id_produto
                        );
                    $this -> db -> insert('lente', $tipoProduto);
                }
                
                $this -> db -> trans_complete();
		$this -> session -> set_flashdata('cadastrook', 'Cadastro efetuado com sucesso');

		redirect('produto/adiciona');
            }
	}

	public function getAll() {

		$this -> db -> select('id as id_produto, referencia, nome, 
                    descricao, preco_custo, preco_venda,
                    quantidade, status, validade, categoria');
		$this -> db -> from('produto');
                
		return $this -> db -> get();
		//$produto = $this -> db -> get('produto') -> row();
                
//                if ($produto -> categoria == 1) {
//                    
//                    $armacao = $this -> db -> get('armacao') -> row();
//                    
//                    
//                    $fornecedorE = $this -> db -> get('fornecedor') -> row();
//                    
//                    $dadosForn = $this -> db -> get('pessoa') -> row();
//                    
//                    $grife = $this -> db -> get('grife') -> row();
//                }
//                
//                $dados = array('produto' => $produto, 'armacao' => $armacao, 'fornecedor' => $dadosForn, 'fornecedorE' => $fornecedorE, 'grife' => $grife);
//                
//		return $dados;
	}

	public function do_select($pesquisa = null) {

		$this -> db -> select
                        ('referencia, nome, descricao, preco_custo, preco_venda,
                          quantidade, status, validade, id as id_produto');
		$this -> db -> from('produto');
		$this -> db -> like('referencia', $pesquisa);
		$this -> db -> or_like('nome', $pesquisa);
                $this -> db -> or_like('descricao', $pesquisa);
                $this -> db -> or_like('preco_custo', $pesquisa);
                $this -> db -> or_like('preco_venda', $pesquisa);
                $this -> db -> or_like('quantidade', $pesquisa);
		$this -> db -> or_like('status', $pesquisa);
                $this -> db -> or_like('validade', $pesquisa);

		return $this -> db -> get();
	}

	public function get_byid($id_produto = NULL) {
            if ($id_produto != NULL) {
                $this -> db -> where('id', $id_produto);
		$this -> db -> limit(1);
		$produto = $this -> db -> get('produto') -> row();
                
                if ($produto -> categoria == 1) {
                    $this -> db -> where('id_produto', $id_produto);
                    $this -> db -> limit(1);
                    $armacao = $this -> db -> get('armacao') -> row();
                    
                    $this -> db -> where('id', $armacao -> id_fornecedor);
                    $this -> db -> limit(1);
                    $fornecedorE = $this -> db -> get('fornecedor') -> row();
                    
                    $this -> db -> where('id', $fornecedorE -> id_pessoa);
                    $this -> db -> limit(1);
                    $dadosForn = $this -> db -> get('pessoa') -> row();
                    
                    $this -> db -> where('id', $armacao -> id_grife);
                    $this -> db -> limit(1);
                    $grife = $this -> db -> get('grife') -> row();
                    
                    $dados = array('produto' => $produto, 'armacao' => $armacao, 'fornecedor' => $dadosForn, 'fornecedorE' => $fornecedorE, 'grife' => $grife);
                } else {
                    $dados = array('produto' => $produto);
                }
                
		return $dados;
            }
	}

	public function do_update($dados = NULL, $condicao = NULL) {
            if ($dados != null || $condicao != null) {
                $this -> db -> trans_start();
                
                $produto = array(
                'referencia' => element('referencia', $dados),
                'nome' => element('nome', $dados),
                'descricao' => element('descricao', $dados),
                'preco_custo' => element('preco_custo', $dados),
                'preco_venda' => element('preco_venda', $dados),
                'quantidade'  => element('quantidade', $dados),
                'status' => element('status', $dados),
                'validade' => element('validade', $dados),
                'quantidade' => element('quantidade', $dados),
                'status' => element('status', $dados),
                'validade' => element('validade', $dados));
                
                $this->db->update('produto', $produto, 'id = '.$condicao);
                
            if (element('produto', $dados) == 1) {
                $tipoProduto = array(
                        'largura_lente' => element('largura_lente', $dados),
                        'largura_ponte' => element('largura_ponte', $dados),
                        'comprimento_haste' => element('comprimento_haste', $dados),
                        'modelo' => element('modelo', $dados),
                        'id_fornecedor' => element('id_fornecedor' ,element('fornecedor', $dados)),
                        'id_produto' => $condicao,
                        'id_grife' => element('id' ,element('grife', $dados))
                        );
                    $this -> db ->update('armacao', $tipoProduto, 'id_produto = '.$condicao);
            }
            
            if ($this -> db -> trans_complete()) {
                $this -> session -> set_flashdata('statusUpdate', 'Alterado com sucesso');
            } else {
                $this -> session -> set_flashdata('statusUpdate', 'Não foi possível alterar o produto');
            }
                redirect(current_url());
            }
            redirect('produto/lista');
	}

	public function do_delete($id = null) {
            if ($id != null) {
                
                $this -> db -> where('id_produto', $id);
                $this -> db -> delete('armacao');
                
                $this -> db -> where('id', $id);
                $this -> db -> delete('produto');
                
                $this -> session -> set_flashdata('deleteok', 'Dados deletados com sucesso');
                redirect('produto/delete');
                
            }
            return false;
	}
}