<?php

namespace App\Models\Academic;




class Syllabus_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_syllabus_list($class_id = null, $branch_id = null){
        
        if(!$class_id){
           $class_id = $this->session->userdata('class_id');
        }
         
        $this->db->select('SY.*, SC.branch_name, C.name AS class_name, AY.session_year');
        $this->db->from('syllabuses AS SY');
        $this->db->join('classes AS C', 'C.id = SY.class_id', 'left');       
        $this->db->join('academic_years AS AY', 'AY.id = SY.academic_year_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = SY.branch_id', 'left');
                
        if($class_id){
            $this->db->where('SY.class_id', $class_id);
        }
        
        if($branch_id && $this->session->userdata('role_id') == SUPER_ADMIN){
            $this->db->where('SY.branch_id', $branch_id); 
        } 
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('SY.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('SC.status', 1);
        $this->db->order_by('SY.id', 'DESC');
       
        return $this->db->get()->result();
        
    }
    
    public function get_single_syllabus($id){
        
        $this->db->select('SY.*, SC.branch_name, C.name AS class_name, AY.session_year');
        $this->db->from('syllabuses AS SY');
        $this->db->join('classes AS C', 'C.id = SY.class_id', 'left');       
        $this->db->join('academic_years AS AY', 'AY.id = SY.academic_year_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = SY.branch_id', 'left');
        $this->db->where('SY.id', $id);
        return $this->db->get()->row();
        
    } 
}
