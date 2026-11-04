<?php

namespace App\Models\Card;



class Admitsetting_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_setting_list(){
        
        $this->db->select('AC.*, S.branch_name');
        $this->db->from('admit_card_settings AS AC');
        $this->db->join('schools AS S', 'S.id = AC.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('AC.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('S.status', 1);
        return $this->db->get()->result();
        
    }
    
     public function get_single_admit_setting($setting_id){
        
        $this->db->select('AC.*');
        $this->db->from('admit_card_settings AS AC');
        $this->db->join('schools AS S', 'S.id = AC.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('AC.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('AC.id', $setting_id);
        return $this->db->get()->row();
        
    }
    
    function duplicate_check($branch_id, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);
        return $this->db->get('admit_card_settings')->num_rows();            
    }

}
