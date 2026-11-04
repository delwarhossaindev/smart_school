<?php

namespace App\Models\Exam;




class Marksheet_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_subject_list($branch_id, $exam_id, $class_id, $section_id, $student_id,$academic_year_id)
    {
        $this->db->select('M.*,S.name AS subject, G.point, G.name');
        $this->db->from('marks AS M');        
        $this->db->join('subjects AS S', 'S.id = M.subject_id', 'left');
        $this->db->join('grades AS G', 'G.id = M.grade_id', 'left');
        $this->db->join('students AS ST', 'ST.id = M.student_id', 'left');
        $this->db->where('M.academic_year_id', $academic_year_id); 
        $this->db->where('M.class_id', $class_id);
        $this->db->where('M.section_id', $section_id);
        $this->db->where('M.student_id', $student_id);
        $this->db->where('M.exam_id', $exam_id);
        $this->db->where('M.branch_id', $branch_id);
        $this->db->where('ST.status_type', 'regular');
       
        return $this->db->get()->result();     
    }

}
