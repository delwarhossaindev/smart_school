<?php

namespace App\Models\Academic;




class Classes_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_class_list($branch_id = null){
        
        $this->db->select('C.*, S.branch_name, T.name AS teacher');
        $this->db->from('classes AS C');
        $this->db->join('teachers AS T', 'T.id = C.teacher_id', 'left');
        $this->db->join('schools AS S', 'S.id = C.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('C.branch_id', $this->session->userdata('branch_id'));
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('C.branch_id', $branch_id);
        }
        
        $this->db->where('S.status', 1);
        
        return $this->db->get()->result();
        
    }
    

    
    function duplicate_check($branch_id, $name, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('name', $name);
        $this->db->where('branch_id', $branch_id);
        return $this->db->get('classes')->num_rows();            
    }
}
