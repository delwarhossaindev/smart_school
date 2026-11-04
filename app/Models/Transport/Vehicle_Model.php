<?php

namespace App\Models\Transport;




class Vehicle_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_vehicle_list($branch_id = null){
        
        $this->db->select('V.*, S.branch_name');
        $this->db->from('vehicles AS V');
        $this->db->join('schools AS S', 'S.id = V.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('V.branch_id', $this->session->userdata('branch_id'));
        }
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('V.branch_id', $branch_id);
        }
        $this->db->where('S.status', 1);
        $this->db->order_by('V.id', 'DESC');
        return $this->db->get()->result();
        
    }
    
    public function get_single_vehicle($vehicle_id){
        
        $this->db->select('V.*, S.branch_name');
        $this->db->from('vehicles AS V');
        $this->db->join('schools AS S', 'S.id = V.branch_id', 'left');
        $this->db->where('V.id', $vehicle_id);
        
        return $this->db->get()->row();
        
    }
    
    function duplicate_check($branch_id, $number, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);
        $this->db->where('number', $number);
        return $this->db->get('vehicles')->num_rows();            
    }

}
