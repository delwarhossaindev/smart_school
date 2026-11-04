<?php

namespace App\Models\Gallery;




class Gallery_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }  
    
    public function get_gallery_list($branch_id = null){
        
        $this->db->select('G.*, S.branch_name');
        $this->db->from('galleries AS G');
        $this->db->join('schools AS S', 'S.id = G.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('G.branch_id', $this->session->userdata('branch_id'));
        }
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('G.branch_id', $branch_id);
        }   
        $this->db->where('S.status', 1);
        $this->db->order_by('G.id', 'DESC');
        
        return $this->db->get()->result();
        
    }
     function duplicate_check($title, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('title', $title);      
        return $this->db->get('galleries')->num_rows();            
    }

}
