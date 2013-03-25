<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agendamento_model extends CI_Model {

    public function listarConsultasDia($data) {

        $this->db->select('agendamento.id as id_agendamento,nome,cpf,email,data_consulta,horario_consulta');
        $this->db->join('cliente', 'cliente.id = agendamento.id_cliente');
        $this->db->join('pessoa', 'pessoa.id = cliente.id_pessoa');
        $this->db->where("data_consulta = '$data'");
        $this->db->order_by('horario_consulta');
        return $this->db->get('agendamento');
    }

    public function cadastrarAgendamento($agendamento = NULL) {
        if ($agendamento != null) {


            $validaData = date("w", mktime(0, 0, 0, substr(element('data', $agendamento), 3, 2), substr(element('data', $agendamento), 0, 2), substr(element('data', $agendamento), 6, 4)));

            if ($validaData == 0 || $validaData == 6) {
                $this->session->set_flashdata('msgCadastro', 'Não é possível agendar um cliente no final de semana'); //Adiciona na sessão temporaria o status do cadastro
                redirect('agendamento/horarioConsulta/' . $this->util->data_user_para_mysql(element('data', $agendamento)));
            }

            $hora1 = $this->util->subtraiHora(element('horario', $agendamento), '00:29');
            $hora2 = $this->util->somaHora(element('horario', $agendamento), '00:29');

            $validaHorario = $this->db->query("select * from agendamento where data_consulta = '
                    " . $this->util->data_user_para_mysql(element('data', $agendamento)) . "'and 
                        horario_consulta >= '$hora1' and 
                            horario_consulta <='$hora2'")->num_rows();
            if ($validaHorario == 0) {

                //Trata os elementos do cliente
                $dadosAgendamento = array(
                    'id_cliente' => element('idCliente', $agendamento),
                    'horario_consulta' => element('horario', $agendamento),
                    'data_consulta' => $this->util->data_user_para_mysql(element('data', $agendamento)),
                );
                $this->db->insert('agendamento', $dadosAgendamento);

                $this->session->set_flashdata('msg', 'Cliente Agendado com Sucesso'); //Adiciona na sessão temporaria o status do cadastro
            } else {

                $this->session->set_flashdata('msg', 'Não foi possível agendar o cliente. \nJá existe um cliente agendando próximo a este horário'); //Adiciona na sessão temporaria o status do cadastro
            }
            redirect('agendamento/horarioConsulta/' . $this->util->data_user_para_mysql(element('data', $agendamento)));
        }
    }

    public function deleteAgendamento($id = null) {

        if ($id != null) {

            $this->db->where('id', $id);
            $this->db->delete('agendamento');
            return true;
        }

        return false;
    }

}

?>
