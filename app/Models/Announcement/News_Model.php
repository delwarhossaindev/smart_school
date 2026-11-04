<?php

namespace App\Models\Announcement;




class News_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_news_list($branch_id = null){
        
        $this->db->select('N.*, S.branch_name');
        $this->db->from('news AS N');
        $this->db->join('schools AS S', 'S.id = N.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('N.branch_id', $this->session->userdata('branch_id'));
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('N.branch_id', $branch_id);
        }
        $this->db->where('S.status', 1);
        $this->db->order_by('N.id', 'DESC');
        
        return $this->db->get()->result();
        
    }
    
    public function get_single_news($news_id){
        
        $this->db->select('N.*, S.branch_name');
        $this->db->from('news AS N');
        $this->db->join('schools AS S', 'S.id = N.branch_id', 'left');
        $this->db->where('N.id', $news_id);
        return $this->db->get()->row();
        
    }
        
     function duplicate_check($branch_id, $title, $date, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_id', $branch_id);
        $this->db->where('title', $title);
        $this->db->where('date', date('Y-m-d', strtotime($date)));
        return $this->db->get('news')->num_rows();            
    }

}
