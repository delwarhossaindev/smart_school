<?php

namespace App\Models\Library;




class Book_Model extends \App\Legacy\MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_book_list($branch_id = null){
        
        $this->db->select('B.*, S.branch_name');
        $this->db->from('books AS B');
        $this->db->join('schools AS S', 'S.id = B.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('B.branch_id', $this->session->userdata('branch_id'));
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('B.branch_id', $branch_id);
        }          
        $this->db->where('S.status', 1);
        $this->db->order_by('B.id', 'DESC');
        
        return $this->db->get()->result();        
    }
    
    public function get_single_book($book_id){
        
        $this->db->select('B.*, S.branch_name');
        $this->db->from('books AS B');
        $this->db->join('schools AS S', 'S.id = B.branch_id', 'left');
        $this->db->where('B.id', $book_id);
   
        return $this->db->get()->row();        
    }
    
    public function get_book_issued_list($branch_id = null, $class_id = null) {
        
        if(!$class_id){
            return;
        }
        
        $this->db->select('B.*, SC.branch_name, BI.id AS issue_id, BI.is_returned, BI.due_date, BI.return_date, BI.issue_date, S.name, S.photo, S.phone, C.name AS class_name');
        $this->db->from('book_issues AS BI');
        $this->db->join('books AS B', 'B.id = BI.book_id', 'left');
        $this->db->join('library_members AS LM', 'LM.id = BI.library_member_id', 'left');
        $this->db->join('students AS S', 'S.user_id = LM.user_id', 'left');
        $this->db->join('classes AS C', 'C.id = BI.class_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = BI.branch_id', 'left');
        
        
        $this->db->where('BI.class_id', $class_id); 
               
        $this->db->where('BI.academic_year_id', $this->academic_year_id);        
        
        if($this->session->userdata('role_id') == STUDENT){
            $this->db->where('S.user_id', $this->session->userdata('user_id'));
        }
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('B.branch_id', $this->session->userdata('branch_id'));
        }
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('BI.branch_id', $branch_id);
        }
        
        $this->db->where('SC.status', 1);
        $this->db->order_by('BI.is_returned', 'ASC');
        return $this->db->get()->result();
    }

    public function get_library_member_list($is_library_member = 1, $branch_id = null , $class_id = null) {

        
        $this->db->select('ST.*, SC.branch_name, LM.id AS lm_id, LM.custom_member_id, E.roll_no, C.name AS class_name, S.name AS section');
        $this->db->from('students AS ST');
        $this->db->join('enrollments AS E', 'E.student_id = ST.id', 'left');
        $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
        $this->db->join('sections AS S', 'S.id = E.section_id', 'left');
        $this->db->join('library_members AS LM', 'LM.user_id = ST.user_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = ST.branch_id', 'left');
        
         if(!$is_library_member){
             $this->db->where('ST.status_type', 'regular');
        } 
        $this->db->where('ST.is_library_member', $is_library_member);
        
        //if($class_id){
            $this->db->where('E.class_id', $class_id); 
        //}
        
        $this->db->where('E.academic_year_id', $this->academic_year_id);
                
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('ST.branch_id', $this->session->userdata('branch_id'));
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('ST.branch_id', $branch_id);
        }
        
        $this->db->where('ST.status_type', 'regular');
        
        $this->db->order_by('LM.id', 'DESC');
        
        if($is_library_member){
            $this->db->group_by('LM.user_id', 'DESC');
        }else{
            $this->db->group_by('E.student_id', 'DESC');
        }
        return $this->db->get()->result();
    }
    
    public function update_qty($book_id, $type = null){
        
        if($type == 'issue'){
            $sql = "UPDATE books SET qty = qty - 1 WHERE id = $book_id";
        }else{
            $sql = "UPDATE books SET qty = qty + 1 WHERE id = $book_id";
        }
        
        $this->db->query($sql);
    }

}
