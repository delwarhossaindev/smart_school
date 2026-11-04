<?php

namespace App\Models\Student;




class Activity_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_activity_list($class_id = null, $branch_id = null){
        
        if(!$class_id){
           $class_id = $this->session->userdata('class_id');
        }
         
        $this->db->select('SA.*, SC.branch_name, ST.name AS student, ST.phone, C.name AS class_name, S.name as section, AY.session_year');
        $this->db->from('student_activities AS SA');
        $this->db->join('students AS ST', 'ST.id = SA.student_id', 'left');
        $this->db->join('classes AS C', 'C.id = SA.class_id', 'left');
        $this->db->join('sections AS S', 'S.id = SA.section_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = SA.academic_year_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = SA.branch_id', 'left');
        
        if($class_id){
            $this->db->where('SA.class_id', $class_id);
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
              $this->db->where('SA.branch_id', $branch_id);
        }
        
        if($this->session->userdata('role_id') == GUARDIAN){
           $this->db->where('ST.guardian_id', $this->session->userdata('profile_id'));
        }
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('SA.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('SC.status', 1);
        $this->db->order_by('SA.id', 'DESC');
       
        return $this->db->get()->result();
        
    }
    
    public function get_single_activity($id){
        
        $this->db->select('SA.*,  SC.branch_name,ST.name AS student, ST.phone, C.name AS class_name, S.name as section, AY.session_year');
        $this->db->from('student_activities AS SA');
        $this->db->join('students AS ST', 'ST.id = SA.student_id', 'left');
        $this->db->join('classes AS C', 'C.id = SA.class_id', 'left');
        $this->db->join('sections AS S', 'S.id = SA.section_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = SA.academic_year_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = SA.branch_id', 'left');
        $this->db->where('SA.id', $id);
        return $this->db->get()->row();
        
    } 
}
