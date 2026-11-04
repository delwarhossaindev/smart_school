<?php

namespace App\Models\Gallery;




class Image_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
      
    public function get_image_list($branch_id = null){
        
        $this->db->select('GI.*, S.branch_name, G.title');
        $this->db->from('gallery_images AS GI');
        $this->db->join('galleries AS G', 'G.id = GI.gallery_id', 'left');
         $this->db->join('schools AS S', 'S.id = GI.branch_id', 'left');
         
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('GI.branch_id', $this->session->userdata('branch_id'));
        }
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('GI.branch_id', $branch_id);
        }  
        $this->db->where('S.status', 1);
        $this->db->order_by('GI.id', 'DESC');
        
        
        return $this->db->get()->result();        
    }
    
    public function get_single_image($id){
        
        $this->db->select('GI.*, S.branch_name, G.title');
        $this->db->from('gallery_images AS GI');
        $this->db->join('galleries AS G', 'G.id = GI.gallery_id', 'left');
          $this->db->join('schools AS S', 'S.id = GI.branch_id', 'left');
        $this->db->where('GI.id', $id);
        return $this->db->get()->row();        
    }

}