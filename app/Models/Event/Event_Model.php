<?php

namespace App\Models\Event;




class Event_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_event_list($branch_id = null){
        
        $this->db->select('E.*, S.branch_name, R.name');
        $this->db->from('events AS E');
        $this->db->join('roles AS R', 'R.id = E.role_id', 'left');
        $this->db->join('schools AS S', 'S.id = E.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('E.branch_id', $this->session->userdata('branch_id'));
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('E.branch_id', $branch_id);
        }
        $this->db->where('S.status', 1);
        $this->db->order_by('E.id', 'DESC');
        
        return $this->db->get()->result();
        
    }
    
    public function get_single_event($id){
        
        $this->db->select('E.*, S.branch_name, R.name');
        $this->db->from('events AS E');
        $this->db->join('roles AS R', 'R.id = E.role_id', 'left');
        $this->db->join('schools AS S', 'S.id = E.branch_id', 'left');
        $this->db->where('E.id', $id);
        return $this->db->get()->row();
        
    }
    
     function duplicate_check($branch_id, $title, $event_from, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);
        $this->db->where('title', $title);
        $this->db->where('event_from', date('Y-m-d', strtotime($event_from)));
        return $this->db->get('events')->num_rows();            
    }

}
