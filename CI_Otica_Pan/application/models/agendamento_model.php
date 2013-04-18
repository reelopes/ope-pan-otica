<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agendamento_model extends CI_Model {

    public function listarConsultasDia($data) {

        $this->db->select('agendamento.id as id_agendamento,pessoa.nome as nome_cliente,dependente.nome as nome_dependente,cpf,email,data_consulta,horario_consulta,id_dependente,agendamento.status');
        $this->db->join('cliente', 'cliente.id = agendamento.id_cliente');
        $this->db->join('pessoa', 'pessoa.id = cliente.id_pessoa');
        $this->db->join('dependente', 'agendamento.id_dependente = dependente.id','left');
        $this->db->where("data_consulta = '$data'");
        $this->db->order_by('horario_consulta');
        return $this->db->get('agendamento');
    }
    public function listarConsultasPendentes() {
        
                       
        $this->db->select('agendamento.id as id_agendamento,pessoa.nome as nome_cliente,dependente.nome as nome_dependente,cpf,email,data_consulta,horario_consulta,id_dependente,agendamento.status');
        $this->db->join('cliente', 'cliente.id = agendamento.id_cliente');
        $this->db->join('pessoa', 'pessoa.id = cliente.id_pessoa');
        $this->db->join('dependente', 'agendamento.id_dependente = dependente.id','left');
        $this->db->where("status = 'Pendente'");
        $this->db->order_by('data_consulta,horario_consulta');
        return $this->db->get('agendamento')->result();
    }
    public function cadastrarAgendamento($agendamento = NULL) {
        if ($agendamento != null) {

            $dataAgendamento = explode("/", element('data', $agendamento)); //Captura a data do agendamento sem as /
            //Verifica se a data do agendamento é menor que a data atual
            if ($dataAgendamento[2] . $dataAgendamento[1] . $dataAgendamento[0] < date('Y') . date('m') . date('d')) {

                $this->session->set_flashdata('msg', 'Não é possível agendar um cliente com uma data retroativa'); //Adiciona na sessão temporaria o status do cadastro
                redirect('agendamento/horarioConsulta/' . $this->util->data_user_para_mysql(element('data', $agendamento)));
            }
            //Valida se o cliente digitou algum horario
            if (element('horario', $agendamento)==NULL) {

                $this->session->set_flashdata('msg', 'É necessário escolher um horário de agendamento!'); //Adiciona na sessão temporaria o status do cadastro
                redirect('agendamento/horarioConsulta/' . $this->util->data_user_para_mysql(element('data', $agendamento)));
            }
            
            

            $validaData = date("w", mktime(0, 0, 0, substr(element('data', $agendamento), 3, 2), substr(element('data', $agendamento), 0, 2), substr(element('data', $agendamento), 6, 4)));

            if ($validaData == 0 || $validaData == 6) {
                $this->session->set_flashdata('msg', 'Não é possível agendar um cliente nos finais de semana'); //Adiciona na sessão temporaria o status do cadastro
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
                if (element('dependente', $agendamento) == "0") {
                    $idDependente = null;//Sem dependente
                }else{
                    $idDependente = element('dependente', $agendamento);//Com dependente
                }
                    $dadosAgendamento = array(
                    'id_cliente' => element('idCliente', $agendamento),
                    'horario_consulta' => element('horario', $agendamento),
                    'data_consulta' => $this->util->data_user_para_mysql(element('data', $agendamento)),
                    'id_dependente' => $idDependente,
                    'status'=>'Pendente',
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
