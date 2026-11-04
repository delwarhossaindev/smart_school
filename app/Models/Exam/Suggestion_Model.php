<?php

namespace App\Models\Exam;




class Suggestion_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_suggestion_list($class_id = null, $branch_id = null, $academic_year_id = null, $exam_id = null){
         
        if(!$class_id){
           $class_id = $this->session->userdata('class_id');
        } 
        
        $this->db->select('SU.*, SC.branch_name, E.title AS exam_title, C.name AS class_name, S.name AS subject, AY.session_year');
        $this->db->from('suggestions AS SU');
        $this->db->join('classes AS C', 'C.id = SU.class_id', 'left');
        $this->db->join('subjects AS S', 'S.id = SU.subject_id', 'left');
        $this->db->join('exams AS E', 'E.id = SU.exam_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = SU.academic_year_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = SU.branch_id', 'left');
        
        $this->db->where('SU.class_id', $class_id);
        
        if($exam_id){
            $this->db->where('SU.exam_id', $exam_id);
        } 
        
        if($academic_year_id){
          $this->db->where('SU.academic_year_id', $academic_year_id);
        }
        
        if($this->session->userdata('role_id') == TEACHER){
            $this->db->where('S.teacher_id', $this->session->userdata('profile_id'));
        } 
               
        if($branch_id && $this->session->userdata('role_id') == SUPER_ADMIN){
            $this->db->where('SU.branch_id', $branch_id); 
        } 
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('SU.branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->where('SC.status', 1);
        $this->db->order_by('SU.id', 'DESC');
        
        return $this->db->get()->result();
        
    }
     public function get_single_suggestion($id){
        
        $this->db->select('SU.*, SC.branch_name, E.title AS exam_title, C.name AS class_name, S.name AS subject, AY.session_year');
        $this->db->from('suggestions AS SU');
        $this->db->join('classes AS C', 'C.id = SU.class_id', 'left');
        $this->db->join('subjects AS S', 'S.id = SU.subject_id', 'left');
        $this->db->join('exams AS E', 'E.id = SU.exam_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = SU.academic_year_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = SU.branch_id', 'left');
        $this->db->where('SU.id', $id);
        return $this->db->get()->row();
        
    }
    
     function duplicate_check($branch_id, $academic_year_id, $exam_id, $class_id, $subject_id, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        
        $this->db->where('branch_id', $branch_id);
        $this->db->where('academic_year_id', $branch_id);
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);        
        return $this->db->get('suggestions')->num_rows();            
    }
 
}
