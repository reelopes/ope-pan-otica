<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agendamento_model extends CI_Model {

public function listarConsultasDia($data){
    
    $this->db->select('agendamento.id as id_agendamento,nome,cpf,email,data_consulta,horario_consulta');
    $this->db->join('cliente','cliente.id = agendamento.id_cliente');
    $this->db->join('pessoa','pessoa.id = cliente.id_pessoa');
    $this->db->where("data_consulta = '$data'");
    $this->db->order_by('horario_consulta');
    return $this->db->get('agendamento');
    
   

        

   
}

public function cadastrarAgendamento($agendamento = NULL) {
            if ($agendamento != null) {
               
            //Trata os elementos do cliente
            $dadosAgendamento = array(
                'id_cliente' => element('idCliente', $agendamento),
                'horario_consulta' => element('horario', $agendamento),
                'data_consulta' => $this->util->data_user_para_mysql (element('data', $agendamento)),
            );
            $this->db->insert('agendamento', $dadosAgendamento);
            
            $this->session->set_flashdata('msgCadastro', 'Cliente Agendado com Sucesso'); //Adiciona na sessão temporaria o status do cadastro
                 redirect('agendamento/horarioConsulta/'.$this->util->data_user_para_mysql (element('data', $agendamento)));
            
}

}
}


?>
