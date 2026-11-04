<?php

namespace App\Models\Announcement;




class Holiday_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_holiday_list($branch_id = null){
        
        $this->db->select('H.*, S.branch_name');
        $this->db->from('holidays AS H');
        $this->db->join('schools AS S', 'S.id = H.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('H.branch_id', $this->session->userdata('branch_id'));
        }
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('H.branch_id', $branch_id);
        }
        $this->db->where('S.status', 1);
        $this->db->order_by('H.id', 'DESC');
        
        return $this->db->get()->result();
        
    }
    
    public function get_single_holiday($holiday_id){
        
        $this->db->select('H.*, S.branch_name');
        $this->db->from('holidays AS H');
        $this->db->join('schools AS S', 'S.id = H.branch_id', 'left');
        $this->db->where('H.id', $holiday_id);
        return $this->db->get()->row();
        
    }
     function duplicate_check($branch_id, $title, $date_from, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);
        $this->db->where('title', $title);
        $this->db->where('date_from', date('Y-m-d', strtotime($date_from)));
        return $this->db->get('holidays')->num_rows();            
    }

}
