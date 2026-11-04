<?php

namespace App\Models\Accounting;




class Discount_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
     
     public function get_discount_list($branch_id = null){
        
        $this->db->select('D.*, S.branch_name');
        $this->db->from('discounts AS D');        
        $this->db->join('schools AS S', 'S.id = D.branch_id', 'left');
       
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('D.branch_id', $this->session->userdata('branch_id'));
        }
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('D.branch_id', $branch_id);
        }
        $this->db->where('S.status', 1);
        $this->db->order_by('D.id', 'DESC');
        return $this->db->get()->result();        
    }
    
    public function get_single_discount($id){
        
        $this->db->select('D.*, S.branch_name');
        $this->db->from('discounts AS D');        
        $this->db->join('schools AS S', 'S.id = D.branch_id', 'left');
        $this->db->where('D.id', $id);
        return $this->db->get()->row();        
    }
    
     function duplicate_check($branch_id, $title, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);
        $this->db->where('title', $title);
        return $this->db->get('discounts')->num_rows();            
    }

}
