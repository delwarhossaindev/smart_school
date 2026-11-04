<?php

namespace App\Models\Frontoffice;




class Dispatch_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_dispatch($schol_id = null){        
        
        $this->db->select('D.*, S.branch_name');
        $this->db->from('postal_dispatches AS D');
        $this->db->join('schools AS S', 'S.id = D.branch_id', 'left');
         
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('D.branch_id', $this->session->userdata('branch_id'));
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $schol_id){
            $this->db->where('D.branch_id', $schol_id);
        }
        $this->db->where('S.status', 1);
        
        $this->db->order_by('D.id', 'DESC');
        
        return $this->db->get()->result();
    } 
    
    public function get_single_dispatch($dispatch_id){        
        
        $this->db->select('D.*, S.branch_name');
        $this->db->from('postal_dispatches AS D');
        $this->db->join('schools AS S', 'S.id = D.branch_id', 'left');      
        $this->db->where('D.id', $dispatch_id);  
        
        return $this->db->get()->row();
    } 
}
