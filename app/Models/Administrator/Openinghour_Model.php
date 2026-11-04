<?php

namespace App\Models\Administrator;



class Openinghour_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_opening_hour_list(){

       $this->db->select('OH.*, S.branch_name');
       $this->db->from('opening_hours AS OH');
       $this->db->join('schools AS S', 'S.id = OH.branch_id', 'left');

       if($this->session->userdata('role_id') != SUPER_ADMIN){
           $this->db->where('OH.branch_id', $this->session->userdata('branch_id'));
       }
       $this->db->where('S.status', 1);
       return $this->db->get()->result();

   }

    public function get_single_opening_hour($hour_id){
        
        $this->db->select('OH.*, S.branch_name');
        $this->db->from('opening_hours AS OH');
        $this->db->join('schools AS S', 'S.id = OH.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('OH.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('OH.id', $hour_id);
        return $this->db->get()->row();
        
    }
                
    function duplicate_check($branch_id, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);
        return $this->db->get('opening_hours')->num_rows();            
    }

}
