<?php

namespace App\Models\Frontend;




class Slider_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_slider_list($branch_id = null){
        
        $this->db->select('S.*, SC.branch_name');
        $this->db->from('sliders AS S');
        $this->db->join('schools AS SC', 'SC.id = S.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('S.branch_id', $this->session->userdata('branch_id'));
        }
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('S.branch_id', $branch_id);
        }
        $this->db->where('SC.status', 1);
        $this->db->order_by('S.id', 'DESC');
        
        return $this->db->get()->result();
        
    }
    
    public function get_single_slider($news_id){
        
        $this->db->select('S.*, SC.branch_name');
        $this->db->from('sliders AS S');
        $this->db->join('schools AS SC', 'SC.id = S.branch_id', 'left');
        $this->db->where('S.id', $news_id);
        return $this->db->get()->row();
        
    }
      
}