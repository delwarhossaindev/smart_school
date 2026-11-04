<?php

namespace App\Models\Accounting;




class Feetype_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
     
    public function get_fee_type($branch_id = null){
        
        $this->db->select('IH.*, S.branch_name');
        $this->db->from('income_heads AS IH'); 
        $this->db->join('schools AS S', 'S.id = IH.branch_id', 'left');
        $this->db->where('IH.head_type !=', 'income'); 
        //$this->db->or_where('IH.head_type', 'hostel'); 
        //$this->db->or_where('IH.head_type', 'transport'); 
       
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('IH.branch_id', $this->session->userdata('branch_id'));
        } 
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('IH.branch_id', $branch_id);
        }
        $this->db->where('S.status', 1);
        $this->db->order_by('IH.id', 'DESC');
        
        return $this->db->get()->result();  
    }
    
    public function get_single_feetype($feetype_id){
        
        $this->db->select('IH.*, S.branch_name');
        $this->db->from('income_heads AS IH'); 
        $this->db->join('schools AS S', 'S.id = IH.branch_id', 'left');        
        $this->db->where('IH.id', $feetype_id);
        return $this->db->get()->row();  
    }
    
            
    function duplicate_check($branch_id, $title, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);
        $this->db->where('title', $title);
        return $this->db->get('income_heads')->num_rows();            
    }

}
