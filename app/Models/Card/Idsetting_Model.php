<?php

namespace App\Models\Card;



class Idsetting_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_setting_list(){
        
        $this->db->select('CS.*, S.branch_name');
        $this->db->from('id_card_settings AS CS');
        $this->db->join('schools AS S', 'S.id = CS.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('CS.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('S.status', 1);
        return $this->db->get()->result();
        
    }
    
     public function get_single_id_setting($setting_id){
        
        $this->db->select('CS.*');
        $this->db->from('id_card_settings AS CS');
        $this->db->join('schools AS S', 'S.id = CS.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('CS.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('CS.id', $setting_id);
        return $this->db->get()->row();
        
    }
    
    function duplicate_check($branch_id, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);
        return $this->db->get('id_card_settings')->num_rows();            
    }

}
