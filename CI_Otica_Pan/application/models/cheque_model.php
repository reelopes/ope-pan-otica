<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cheque_model extends CI_Model {

    public function listaChequesPendentes() {
        $this->db->select('*');
        $this->db->where('status', '0');
        $this->db->from('cheque');
        return $this->db->get()->result();
    }
    
    public function baixaCheque($id = null,$status = null) {
        if ($id != null && $status!=null) {
            $this->db->update('cheque', array('status'=>$status), array('id'=>$id));
            return true;
        }
        return false;
    }
}
?>
