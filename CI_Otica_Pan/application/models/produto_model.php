<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class produto_model extends CI_Model {
	public function do_insert($dados = null) {
            if ($dados != null) {
                
		$this -> db -> trans_start();
		$produto = array('cod_barra' => element('cod_barra', $dados), 'data_entrega' => element('data_entrega', $dados), 'descricao' => element('descricao', $dados), 'preco' => element('preco', $dados), 'quantidade' => element('quantidade', $dados), 'status' => element('status', $dados), 'validade' => element('validade', $dados), );
		$this -> db -> insert('produto', $produto);

		$id_produto = $this -> db -> insert_id();

		$this -> db -> trans_complete();
                
                if (element('aro', $dados) != null) {
                    $this -> db -> trans_start();
                    $tipoProduto = array('aro', 'marca_armacao', 'modelo', 'preco_custo');
                    $this -> db -> insert('armacao', $tipoProduto, 'id_produto', $id_produto, 'id_fornecedor', 1);
                    $this -> db -> trans_complete();
                } else {
                    $this -> db -> trans_start();
                    $tipoProduto = array('referencia');
                    $this -> db -> insert('lente', $tipoProduto, 'id_produto', $id_produto, 'id_tipo_lente', 1);

                    $this -> db -> trans_complete();
                }

		$this -> session -> set_flashdata('cadastrook', 'Cadastro efetuado com sucesso');

		redirect('produto');
            }
	}

	public function getAll() {

		$this -> db -> select('id as id_produto, cod_barra, data_entrega, descricao, preco, quantidade, status, validade');
		$this -> db -> from('produto');
		return $this -> db -> get();
	}

	public function do_select($pesquisa = null) {

		$pesq = element('nome', $pesquisa);

		$this -> db -> select('cod_barra, data_entrega, descricao, preco, quantidade, status, validade');
		$this -> db -> from('produto');
		$this -> db -> like('cod_barra', $pesq);
		$this -> db -> or_like('data_entrega', $pesq);
		$this -> db -> or_like('descricao', $pesq);
		$this -> db -> or_like('status', $pesq);

		return $this -> db -> get();
	}

	public function get_byid($id_produto = NULL) {
	
		if ($id_produto != NULL) {
		
			$this -> db -> where('id', $id_produto);
			$this -> db -> limit(1);
			$produto = $this -> db -> get('produto') -> row();
			
			$dados = array('produto' => $produto);
			return $dados;
		}
	}

	public function do_update($dados = NULL, $condicao = NULL) {

		if ($dados != null || $condicao != null) {

			$this -> db -> trans_start();

			$produto = array('cod_barra' => element('cod_barra', $dados), 'data_entrega' => element('data_entrega', $dados),
			 'descricao' => element('descricao', $dados), 'preco' => element('preco', $dados),
			  'quantidade' => element('quantidade', $dados), 'status' => element('status', $dados),
			   'validade' => element('validade', $dados), );

			$condicao_pessoa = array('id' => $condicao['id_produto'], );
			$this -> db -> update('produto', $produto, $condicao_pessoa);

			if ($this -> db -> trans_complete()) {
				$this -> session -> set_flashdata('statusUpdate', 'Alterado com sucesso');
			} else {
				$this -> session -> set_flashdata('statusUpdate', 'Não foi possível alterar o fornecedor');
			}

			redirect(current_url());
		}
		redirect('produto/lista');
	}

	public function do_delete($id = null) {

		if ($id != null) {

			$this -> db -> where('id', $id);
			$this -> db -> delete('produto');
			$this -> session -> set_flashdata('deleteok', 'Dados deletados com sucesso');
			redirect('produto/delete');
		}
		return false;
	}

}
