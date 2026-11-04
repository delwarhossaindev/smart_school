<?php

namespace App\Models\Frontend;




class Frontend_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    } 
    
     public function get_page_list($branch_id = null){
        
        $this->db->select('P.*, S.branch_name');
        $this->db->from('pages AS P');
        $this->db->join('schools AS S', 'S.id = P.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('P.branch_id', $this->session->userdata('branch_id'));
        }
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('P.branch_id', $branch_id);
        }
        $this->db->where('S.status', 1);
        $this->db->order_by('P.id', 'DESC');
        
        return $this->db->get()->result();
        
    }
    
    public function get_single_page($news_id){
        
        $this->db->select('P.*, S.branch_name');
        $this->db->from('pages AS P');
        $this->db->join('schools AS S', 'S.id = P.branch_id', 'left');
        $this->db->where('P.id', $news_id);
        return $this->db->get()->row();
        
    }
    
     function duplicate_check($branch_id, $page_title, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);      
        $this->db->where('page_title', $page_title);      
        return $this->db->get('pages')->num_rows();            
    }

}
