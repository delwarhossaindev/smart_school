<?php

namespace App\Models\Assignment;




class Submission_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function get_submission_list($branch_id = null, $class_id = null , $section_id = null){
         
        if(!$branch_id){ return; }
        
        $this->db->select('ASU.*, E.roll_no, ST.name, S.branch_name,  A.title, A.deadline, C.name AS class_name, SE.name AS section, SU.name AS subject, AY.session_year');
        $this->db->from('assignment_submissions AS ASU');
        $this->db->join('enrollments AS E', 'E.student_id = ASU.student_id', 'left');
        $this->db->join('assignments AS A', 'A.id = ASU.assignment_id', 'left');
        $this->db->join('schools AS S', 'A.branch_id = S.id', 'left');
        $this->db->join('classes AS C', 'C.id = ASU.class_id', 'left');
        $this->db->join('sections AS SE', 'SE.id = ASU.section_id', 'left');
        $this->db->join('subjects AS SU', 'SU.id = A.subject_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = ASU.academic_year_id', 'left');
        $this->db->join('students AS ST', 'ST.id = ASU.student_id', 'left');
         
        $this->db->where('E.academic_year_id', $this->academic_year_id);
        
        if($class_id > 0){
             $this->db->where('ASU.class_id', $class_id);
        }
        
        if($section_id > 0){
             $this->db->where('ASU.section_id', $section_id);
        }
                
        if($branch_id && $this->session->userdata('role_id') == SUPER_ADMIN){
            $this->db->where('ASU.branch_id', $branch_id); 
        }
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('ASU.branch_id', $this->session->userdata('branch_id'));
        }
        
        if($this->session->userdata('role_id') == TEACHER){
            //$this->db->where('C.teacher_id', $this->session->userdata('profile_id'));
        }
        
        if($this->session->userdata('role_id') == STUDENT){
            $this->db->where('ASU.student_id', $this->session->userdata('profile_id'));
        }        
       
        $this->db->order_by('ASU.id', 'DESC');
        
        return $this->db->get()->result();
        
    }
    
    public function get_single_submission($id){
        
        $this->db->select('ASU.*, S.branch_name, E.roll_no, ST.name AS student_name,  A.title, A.deadline, C.name AS class_name, SE.name AS section, SU.name AS subject, SU.teacher_id, AY.session_year');
        $this->db->from('assignment_submissions AS ASU');
        $this->db->join('enrollments AS E', 'E.student_id = ASU.student_id', 'left');
        $this->db->join('assignments AS A', 'A.id = ASU.assignment_id', 'left');
        $this->db->join('schools AS S', 'A.branch_id = S.id', 'left');
        $this->db->join('classes AS C', 'C.id = ASU.class_id', 'left');
        $this->db->join('sections AS SE', 'SE.id = ASU.section_id', 'left');
        $this->db->join('subjects AS SU', 'SU.id = A.subject_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = ASU.academic_year_id', 'left');
        $this->db->join('students AS ST', 'ST.id = ASU.student_id', 'left');
        $this->db->where('ASU.id', $id); 
        return $this->db->get()->row();        
    } 
}
