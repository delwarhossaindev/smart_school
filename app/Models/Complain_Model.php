<?php

namespace App\Models;




class Complain_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_complain_list(){
         
        $this->db->select('C.*, T.type, S.branch_name, AY.session_year');
        $this->db->from('complains AS C');
        $this->db->join('complain_types AS T', 'T.id = C.type_id', 'left'); 
        $this->db->join('schools AS S', 'S.id = C.branch_id', 'left'); 
        $this->db->join('academic_years AS AY', 'AY.id = C.academic_year_id', 'left');
              
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('C.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('C.user_id', logged_in_user_id());
        $this->db->order_by('C.id', 'DESC');
        return $this->db->get()->result();
        
    }
    
    public function get_single_complain($id){
        
        $this->db->select('C.*, T.type, S.branch_name, AY.session_year');
        $this->db->from('complains AS C');
        $this->db->join('complain_types AS T', 'T.id = C.type_id', 'left'); 
        $this->db->join('schools AS S', 'S.id = C.branch_id', 'left'); 
        $this->db->join('academic_years AS AY', 'AY.id = C.academic_year_id', 'left');
        $this->db->where('C.id', $id);
       
        
        return $this->db->get()->row();        
    } 
}
