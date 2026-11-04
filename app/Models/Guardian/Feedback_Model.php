<?php

namespace App\Models\Guardian;




class Feedback_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_feedback_list(){
        
        $this->db->select('GF.*, S.branch_name');
        $this->db->from('guardian_feedbacks AS GF');
        $this->db->join('schools AS S', 'S.id = GF.branch_id', 'left');
        $this->db->where('GF.guardian_id', $this->session->userdata('profile_id'));
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('GF.branch_id', $this->session->userdata('branch_id'));
        }
        return $this->db->get()->result();        
    }
    
    public function get_single_feedback($id){
        
        $this->db->select('GF.*, S.branch_name');
        $this->db->from('guardian_feedbacks AS GF');
        $this->db->join('schools AS S', 'S.id = GF.branch_id', 'left');
        $this->db->where('GF.id', $id);        
        return $this->db->get()->row();
        
    }
}