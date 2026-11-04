<?php

namespace App\Models\Administrator;



class Payment_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_payment_setting_list(){
        
        $this->db->select('PS.*, S.branch_name');
        $this->db->from('payment_settings AS PS');
        $this->db->join('schools AS S', 'S.id = PS.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('PS.branch_id', $this->session->userdata('branch_id'));
        }
        
        $this->db->where('S.status', 1);
        return $this->db->get()->result();
        
    }
    
     public function get_single_payment_setting($setting_id){
        
        $this->db->select('PS.*, S.branch_name');
        $this->db->from('payment_settings AS PS');
        $this->db->join('schools AS S', 'S.id = PS.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('PS.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('PS.id', $setting_id);
        return $this->db->get()->row();
        
    }
    
    
    function duplicate_check($branch_id, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);
        return $this->db->get('payment_settings')->num_rows();            
    }

}
