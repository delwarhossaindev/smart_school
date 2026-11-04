<?php

namespace App\Models\Transport;




class Route_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_route_list($branch_id = null){
        
        $this->db->select('R.*, S.branch_name');
        $this->db->from('routes AS R');
        $this->db->join('schools AS S', 'S.id = R.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('R.branch_id', $this->session->userdata('branch_id'));
        }
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('R.branch_id', $branch_id);
        }
        $this->db->where('S.status', 1);
        $this->db->order_by('R.id', 'DESC');
        return $this->db->get()->result();
    }
    
    public function get_single_route($route_id){
        
        $this->db->select('R.*, S.branch_name');
        $this->db->from('routes AS R');
        $this->db->join('schools AS S', 'S.id = R.branch_id', 'left');
        $this->db->where('R.id', $route_id);
        return $this->db->get()->row();
    }
    
    
     public function get_vehicle_list($branch_id = null, $route_id = null ){
         
        $route = $this->route->get_single('routes', array('id' => $route_id, 'branch_id'=>$branch_id));
        
        if(isset($route->vehicle_ids) && $route->vehicle_ids != '' && $route_id){
            $sql = "SELECT * FROM `vehicles` WHERE `id` IN($route->vehicle_ids) OR status = 1 AND branch_id = $branch_id";
        } else {
            $sql = "SELECT * FROM `vehicles` WHERE status = 1 AND branch_id = $branch_id";
        }
        
        return $this->db->query($sql)->result();
    }

    function duplicate_check($branch_id, $number, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);
        $this->db->where('title', $number);
        return $this->db->get('routes')->num_rows();            
    }

}
