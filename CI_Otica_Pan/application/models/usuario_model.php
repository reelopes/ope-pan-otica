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

		$this -> db -> select('usuario.id as id_usuario, usuario.nome as nome_usuario, usuario.login, usuario.senha, usuario.lembrete_senha, usuario.email, usuario.id_nivel, nivel.id, nivel.nome as nome_nivel, nivel.descricao');
		$this -> db -> from('usuario');
                $this -> db -> join('nivel', 'nivel.id = usuario.id_nivel');
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
                    $this -> db -> update('usuario', $dados, $condicao);
                    $this -> db -> trans_complete();
		}
                
		redirect('usuario/lista');
	}

}