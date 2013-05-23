<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Receita_model extends CI_Model {

    public function retornaReceita($id_receita = NULL) {
        if ($id_receita != NULL) {

            //Captura a receita
            $this->db->where('id', $id_receita);
            $this->db->limit(1);
            $receita = $this->db->get('receita')->row();

            //captura o cliente
            $this->db->where('id', $receita->id_cliente);
            $this->db->limit(1);
            $cliente = $this->db->get('cliente')->row();

            $this->db->where('id', $cliente->id_pessoa);
            $this->db->limit(1);
            $pessoa = $this->db->get('pessoa')->row();
            
            $this->db->where('id', $receita->id_dependente);
            $this->db->limit(1);
            $dependente = $this->db->get('dependente')->row();            
            
            $this->db->where('id_cliente', $receita->id_cliente);
            $this->db->limit(1);
            $endereco = $this->db->get('endereco')->row();

            $this->db->where('id_pessoa', $pessoa->id);
            $telefone = $this->db->get('telefone')->result();

            //Captura o diagnostico e informações do olho
            $this->db->select('cilindrico,eixo,esferico,dnp,distancia,lado');
            $this->db->from('diagnostico');
            $this->db->join('informacoes_olho', 'informacoes_olho.id_diagnostico = diagnostico.id');
            $this->db->where("id_receita = ".$id_receita);
            $dianostico = $this->db->get()->result();




            $dados = array(
                'receita'=>$receita,
                'cliente'=>$cliente,
                'pessoa' => $pessoa,
                'dependente'=>$dependente,
                'endereco' => $endereco,
                'telefone' => $telefone,
                'diagnostico'=>$dianostico,
            );
            
            return $dados;//Retorna um array com todos os dados
        }
    }
    
    public function receitasCliente($id_cliente = NULL) {
        if ($id_cliente != NULL) {
            //Captura a receita
            $this->db->where('id_cliente', $id_cliente);
            $this->db->from('receita');
            return $this->db->get()->result();
        }
    }
    
    public function diagnosticoReceita($id_receita = null) {
        //Captura o diagnostico e informações do olho
        $this->db->select('cilindrico,eixo,esferico,dnp,distancia,lado');
        $this->db->from('diagnostico');
        $this->db->join('informacoes_olho', 'informacoes_olho.id_diagnostico = diagnostico.id');
        $this->db->where("id_receita = ".$id_receita);
        return $this->db->get()->result();
    }
}

?>