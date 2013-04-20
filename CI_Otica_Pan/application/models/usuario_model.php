<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	public function do_insert($dados = null) {
		
            if ($dados != null) {
                $this -> db -> trans_start();
                $this -> db -> insert('usuario', $dados);
                $this -> db -> trans_complete();

                $this -> session -> set_flashdata('cadastrook', 'Cadastro efetuado com sucesso');
                redirect('usuario');
            }
	}

	public function getAll() {

		$this -> db -> select('usuario.id, usuario.login, usuario.senha, usuario.lembrete_senha, usuario.email, usuario.id_nivel, nivel.id, nivel.nome, nivel.descricao');
		$this -> db -> from('usuario');
                $this -> db -> join('nivel', 'nivel.id = usuario.id_nivel');
                $this -> db -> group_by('nivel.id');
		return $this -> db -> get();
	}

	public function do_select($pesquisa = null) {
                
		$this -> db -> select('id, login, senha, lembrete_senha, email, id_nivel');
		$this -> db -> from('usuario');
		$this -> db -> like('login', $pesquisa);
		$this -> db -> or_like('email', $pesquisa);
		$this -> db -> or_like('id_nivel', $pesquisa);
		$this -> db -> group_by('id');

		return $this -> db -> get();
	}

	public function get_byid($id = NULL) {
		if ($id != NULL) {
			$this -> db -> where('id', $id);
			$this -> db -> limit(1);
			$user = $this -> db -> get('usuario') -> row();
                        
                        $this -> db -> where('id', $user->id_nivel);
			$this -> db -> limit(1);
                        $nivel = $this -> db -> get('nivel') -> row();
                        
                        $dados = array('usuario' => $user, 'nivel' => $nivel);
                        
			return $dados;
		}
	}

	public function do_update($dados = NULL, $condicao = NULL) {

		if ($dados != null || $condicao != null) {

			$this -> db -> trans_start();

			$pessoa = array('nome' => element('nome', $dados), 'email' => element('email', $dados), );

			$condicao_pessoa = array('id' => $condicao['id_pessoa'], );
			$this -> db -> update('pessoa', $pessoa, $condicao_pessoa);

			$fornecedor = array('cnpj' => element('cnpj', $dados));

			$condicao_fornecedor = array('id_pessoa' => $condicao['id_pessoa'], );
			$this -> db -> update('fornecedor', $fornecedor, $condicao_fornecedor);

			$telefone_fixo = array('num_telefone' => element('num_telefone1', $dados), );
			$condicao_telefone_fixo = array('id_pessoa' => $condicao['id_pessoa'], 'id_tipo_telefone' => 1, );
			$this -> db -> update('telefone', $telefone_fixo, $condicao_telefone_fixo);

			$telefone_celular = array('num_telefone' => element('num_telefone2', $dados), );
			$condicao_telefone_celular = array('id_pessoa' => $condicao['id_pessoa'], 'id_tipo_telefone' => 2, );
			$this -> db -> update('telefone', $telefone_celular, $condicao_telefone_celular);

			if ($this -> db -> trans_complete()) {
				$this -> session -> set_flashdata('statusUpdate', 'Alterado com sucesso');
			} else {
				$this -> session -> set_flashdata('statusUpdate', 'Não foi possível alterar o fornecedor');
			}

			redirect(current_url());
		}
		redirect('fornecedor/lista');
	}

	public function do_delete($id = null) {

		if ($id != null) {

			$this -> db -> where('id', $id);
			$this -> db -> delete('pessoa');
			$this -> session -> set_flashdata('deleteok', 'Dados deletados com sucesso');
			redirect('fornecedor/delete');
		}
		return false;
	}

}