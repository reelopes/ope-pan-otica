<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class tipo_lente_model extends CI_Model {
	public function do_insert($dados = null) {
            if ($dados != null) {
                
		$this -> db -> trans_start();
		$tipo_lente = array('descricao' => element('descricao', $dados));
		$this -> db -> insert('tipo_lente', $tipo_lente);

		$id_tipo_lente = $this -> db -> insert_id();

		$this -> db -> trans_complete();

		$this -> session -> set_flashdata('cadastrook', 'Cadastro efetuado com sucesso');

		redirect('tipo_lente');
            }
	}

	public function getAll() {

		$this -> db -> select('id as id_tipo_lente, descricao');
		$this -> db -> from('tipo_lente');
		return $this -> db -> get();
	}

	public function do_select($pesquisa = null) {

		$pesq = element('nome', $pesquisa);

		$this -> db -> select('id as id_tipo_lente, descricao');
		$this -> db -> from('tipo_lente');
		$this -> db -> like('descricao', $pesq);

		return $this -> db -> get();
	}

	public function get_byid($id_tipo_lente = NULL) {
	
		if ($id_tipo_lente != NULL) {
		
			$this -> db -> where('id', $id_tipo_lente);
			$this -> db -> limit(1);
			$tipo_lente = $this -> db -> get('tipo_lente') -> row();
			
			$dados = array('tipo_lente' => $tipo_lente);
			return $dados;
		}
	}

	public function do_update($dados = NULL, $condicao = NULL) {

		if ($dados != null || $condicao != null) {

			$this -> db -> trans_start();

			$tipo_lente = array('descricao' => element('descricao', $dados));
                        $condicao_tipo_lente = array('id' => $condicao['id_tipo_lente']);
			$this -> db -> update('tipo_lente', $tipo_lente, $condicao_tipo_lente);

			if ($this -> db -> trans_complete()) {
				$this -> session -> set_flashdata('statusUpdate', 'Alterado com sucesso');
			} else {
				$this -> session -> set_flashdata('statusUpdate', 'Não foi possível alterar o fornecedor');
			}

			redirect(current_url());
		}
		redirect('tipo_lente/lista');
	}

	public function do_delete($id = null) {

		if ($id != null) {

			$this -> db -> where('id', $id);
			$this -> db -> delete('tipo_lente');
			$this -> session -> set_flashdata('deleteok', 'Dados deletados com sucesso');
			redirect('tipo_lente/delete');
		}
		return false;
	}

}
