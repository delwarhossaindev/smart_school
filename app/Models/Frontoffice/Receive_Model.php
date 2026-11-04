<?php

namespace App\Models\Frontoffice;




class Receive_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_receive($schol_id = null){        
        
        $this->db->select('R.*, S.branch_name');
        $this->db->from('postal_receives AS R');
        $this->db->join('schools AS S', 'S.id = R.branch_id', 'left');
         
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('R.branch_id', $this->session->userdata('branch_id'));
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $schol_id){
            $this->db->where('R.branch_id', $schol_id);
        }
       
        $this->db->where('S.status', 1);
        
        $this->db->order_by('R.id', 'DESC');
        
        return $this->db->get()->result();
    } 
    
    public function get_single_receive($receive_id){        
        
        $this->db->select('R.*, S.branch_name');
        $this->db->from('postal_receives AS R');
        $this->db->join('schools AS S', 'S.id = R.branch_id', 'left');      
        $this->db->where('R.id', $receive_id);  
        
        return $this->db->get()->row();
    } 
}
