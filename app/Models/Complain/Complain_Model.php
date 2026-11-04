<?php

namespace App\Models\Complain;




class Complain_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_complain_list($branch_id = null){
         
        $this->db->select('C.*, T.type,  R.name AS role_name, S.branch_name, AY.session_year');
        $this->db->from('complains AS C');
        $this->db->join('complain_types AS T', 'T.id = C.type_id', 'left'); 
        $this->db->join('roles AS R', 'R.id = C.role_id', 'left');
        $this->db->join('schools AS S', 'S.id = C.branch_id', 'left'); 
        $this->db->join('academic_years AS AY', 'AY.id = C.academic_year_id', 'left');
         
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('C.branch_id', $branch_id);
        }       
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('C.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('S.status', 1);
        $this->db->order_by('C.id','DESC');
        return $this->db->get()->result();
        
    }
    
    public function get_single_complain($id){
        
        $this->db->select('C.*, T.type,  R.name AS role_name, S.branch_name, AY.session_year');
        $this->db->from('complains AS C');
        $this->db->join('complain_types AS T', 'T.id = C.type_id', 'left'); 
        $this->db->join('roles AS R', 'R.id = C.role_id', 'left');
        $this->db->join('schools AS S', 'S.id = C.branch_id', 'left'); 
        $this->db->join('academic_years AS AY', 'AY.id = C.academic_year_id', 'left');
        $this->db->where('C.id', $id);
        return $this->db->get()->row();        
    } 
}
