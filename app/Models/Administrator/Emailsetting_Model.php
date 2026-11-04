<?php

namespace App\Models\Administrator;



class Emailsetting_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_email_setting_list(){
        
        $this->db->select('ES.*, S.branch_name');
        $this->db->from('email_settings AS ES');
        $this->db->join('schools AS S', 'S.id = ES.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('ES.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('S.status', 1);
        return $this->db->get()->result();
        
    }
    
     public function get_single_email_setting($setting_id){
        
        $this->db->select('ES.*, S.branch_name');
        $this->db->from('email_settings AS ES');
        $this->db->join('schools AS S', 'S.id = ES.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('ES.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('ES.id', $setting_id);
        return $this->db->get()->row();
        
    }
    
    
        
    function duplicate_check($branch_id, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);
        return $this->db->get('email_settings')->num_rows();            
    }

}
