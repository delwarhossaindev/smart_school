<?php

namespace App\Models;




class Dashboard_Model extends \App\Legacy\MY_Model {

    function __construct() {
        parent::__construct();
  
    }

    public function get_message_list($type) {

        $this->db->select('MR.*, M.*');
        $this->db->from('message_relationships AS MR');
        $this->db->join('messages AS M', 'M.id = MR.message_id', 'left');

        if ($type == 'draft') {
            $this->db->where('MR.status', 1);
            $this->db->where('MR.is_draft', 1);
            $this->db->where('MR.owner_id', logged_in_user_id());
            $this->db->where('MR.sender_id', logged_in_user_id());
        }
        if ($type == 'inbox') {
            $this->db->where('MR.status', 1);
            $this->db->where('MR.owner_id', logged_in_user_id());
            $this->db->where('MR.receiver_id', logged_in_user_id());
        }
        if ($type == 'new') {
            $this->db->where('MR.status', 1);
            $this->db->where('MR.owner_id', logged_in_user_id());
            $this->db->where('MR.is_read', 0);
            $this->db->where('MR.receiver_id', logged_in_user_id());
        }
        if ($type == 'trash') {
            $this->db->where('MR.status', 1);
            $this->db->where('MR.is_trash', 1);
            $this->db->where('MR.owner_id', logged_in_user_id());
        }
        if ($type == 'sent') {
            $this->db->where('MR.status', 1);
            $this->db->where('MR.is_draft', 0);
            $this->db->where('MR.is_trash', 0);
            $this->db->where('MR.sender_id', logged_in_user_id());
            $this->db->where('MR.owner_id', logged_in_user_id());
        }

        return $this->db->get()->result();
    }

    public function get_user_by_role($branch_id = null) {

        $this->db->select('COUNT(U.role_id) AS total_user, R.name');
        $this->db->from('users AS U');
        $this->db->join('roles AS R', 'R.id = U.role_id', 'left');
        $this->db->group_by('U.role_id');
        $this->db->where('U.status', 1);
        if ($branch_id) {
            $this->db->where('U.branch_id', $branch_id);
        }
        return $this->db->get()->result();
    }

    public function get_student_by_class($branch_id = null) {

        $this->db->select('COUNT(E.student_id) AS total_student, C.name AS class_name');
        $this->db->from('enrollments AS E');
        $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
        $this->db->group_by('E.class_id');
        $this->db->where('E.status', 1);
        $this->db->where('E.status', 1);
        if ($branch_id) {
            $this->db->where('E.branch_id', $branch_id);
        }
        return $this->db->get()->result();
    }

    public function get_total_student($branch_id = null) {

        if ($this->session->userdata('role_id') == STUDENT) {
            
            $class_id = $this->session->userdata('class_id');            
            
            $this->db->select('COUNT(E.id) AS total_student');
            $this->db->from('enrollments AS E');
            $this->db->join('students AS S', 'S.id = E.student_id', 'left');
            
            if ($branch_id) {
                $this->db->where('E.branch_id', $branch_id);
            }
            if ($class_id) {
                $this->db->where('E.class_id', $class_id);
            }
           $this->db->where('S.status_type', 'regular');
           $this->db->where('E.academic_year_id', $this->academic_year_id);
           
            

        }else if ($this->session->userdata('role_id') == GUARDIAN) {
            
            $this->db->select('COUNT(S.id) AS total_student');
            $this->db->from('students AS S');
            $this->db->where('S.status', 1);
            $this->db->where('S.status_type', 'regular');
            if ($branch_id) {
                $this->db->where('S.branch_id', $branch_id);
            }
            $this->db->where('S.guardian_id',  $this->session->userdata('profile_id'));
          
            
        } else {            
          
            $this->db->select('COUNT(S.id) AS total_student');
            $this->db->from('students AS S');
            $this->db->where('S.status_type', 'regular');
            if ($branch_id) {
                $this->db->where('S.branch_id', $branch_id);
            }            
        }

        return $this->db->get()->row()->total_student;
    }

    public function get_total_guardian($branch_id = null) {

        if ($this->session->userdata('role_id') == STUDENT) {

            $profile_id = $this->session->userdata('profile_id');
            $student = $this->get_single('students', array('id' => $profile_id));

            $this->db->select('COUNT(G.id) AS total_guardian');
            $this->db->from('guardians AS G');
            $this->db->where('G.id', $student->guardian_id);
           
        } else {

            $this->db->select('COUNT(G.id) AS total_guardian');
            $this->db->from('guardians AS G');
        }

         $this->db->where('G.status', 1);
        if ($branch_id) {
            $this->db->where('G.branch_id', $branch_id);
        }
        return $this->db->get()->row()->total_guardian;
    }

    public function get_total_class($branch_id = null) {

        $this->db->select('COUNT(C.id) AS total_class');
        $this->db->from('classes AS C');
        $this->db->where('C.status', 1);
        if ($branch_id) {
            $this->db->where('C.branch_id', $branch_id);
        }
        return $this->db->get()->row()->total_class;
    }

    public function get_total_teacher($branch_id = null) {

        $this->db->select('COUNT(T.id) AS total_teacher');
        $this->db->from('teachers AS T');
        $this->db->where('T.status', 1);
        if ($branch_id) {
            $this->db->where('T.branch_id', $branch_id);
        }
        return $this->db->get()->row()->total_teacher;
    }

    public function get_total_employee($branch_id = null) {

        $this->db->select('COUNT(E.id) AS total_employee');
        $this->db->from('employees AS E');
        $this->db->where('E.status', 1);
        if ($branch_id) {
            $this->db->where('E.branch_id', $branch_id);
        }
        return $this->db->get()->row()->total_employee;
    }

    public function get_total_expenditure($branch_id = null) {

        $this->db->select('SUM(E.amount) AS total_expenditure');
        $this->db->from('expenditures AS E');
        if ($branch_id) {
            $this->db->where('E.branch_id', $branch_id);
        }
        return $this->db->get()->row()->total_expenditure;
    }

    public function get_total_income($branch_id = null) {
             
        $this->db->select('SUM(T.amount) AS total_income');
        $this->db->from('transactions AS T');

        if ($branch_id) {
            $this->db->where('T.branch_id', $branch_id);
        }
        return $this->db->get()->row()->total_income;
    }
    
    
    
    
    public function get_search_student($branch_id, $keyword){
         
        
        $this->db->select('S.id, S.name, S.photo, S.dob, E.roll_no, C.name AS class_name, SE.name AS section, AY.session_year');
        $this->db->from('enrollments AS E');
        $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
        $this->db->join('sections AS SE', 'SE.id = E.section_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');
        
        if ($branch_id) {
            $this->db->where('E.branch_id', $branch_id);
        }
        
        $this->db->where('E.academic_year_id', $this->academic_year_id);
        
        $this->db->like('S.name', $keyword);
        $this->db->or_like('S.email', $keyword, 'after');
        $this->db->or_like('S.phone', $keyword, 'after');
        $this->db->or_like('S.present_address', $keyword, 'after');
        $this->db->or_like('S.permanent_address', $keyword, 'after');
        $this->db->or_like('C.name', $keyword, 'after');
        $this->db->or_like('SE.name', $keyword, 'after');
        
       return $this->db->get()->result();
        
    }
    
    public function get_search_guardian($branch_id, $keyword){
        
        $this->db->select('G.*');
        $this->db->from('guardians AS G');
        $this->db->where('G.status', 1);
        if ($branch_id) {
            $this->db->where('G.branch_id', $branch_id);
        }
        
        $this->db->like('G.name', $keyword);
        $this->db->or_like('G.email', $keyword, 'after');
        $this->db->or_like('G.phone', $keyword, 'after');
        $this->db->or_like('G.profession', $keyword, 'after');
        $this->db->or_like('G.present_address', $keyword, 'after');
        $this->db->or_like('G.permanent_address', $keyword, 'after');
        
       return $this->db->get()->result();
       
    }
    
    public function get_search_teacher($branch_id, $keyword){
        
        $this->db->select('T.*');
        $this->db->from('teachers AS T');
        $this->db->where('T.status', 1);
        if ($branch_id) {
            $this->db->where('T.branch_id', $branch_id);
        }
        
        $this->db->like('T.name', $keyword);
        $this->db->or_like('T.email', $keyword, 'after');
        $this->db->or_like('T.phone', $keyword, 'after');
        $this->db->or_like('T.responsibility', $keyword);
        $this->db->or_like('T.present_address', $keyword, 'after');
        $this->db->or_like('T.permanent_address', $keyword, 'after');
        
       return $this->db->get()->result();
       
    }
    
    public function get_search_employee($branch_id, $keyword){
     
        $this->db->select('E.*, D.name AS designation');
        $this->db->from('employees AS E');
        $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
        
        $this->db->where('E.status', 1);
        if ($branch_id) {
            $this->db->where('E.branch_id', $branch_id);
        }
        
        $this->db->like('E.name', $keyword);
        $this->db->or_like('D.name', $keyword);
        $this->db->or_like('E.email', $keyword, 'after');
        $this->db->or_like('E.phone', $keyword, 'after');
        $this->db->or_like('E.present_address', $keyword, 'after');
        $this->db->or_like('E.permanent_address', $keyword, 'after');
        
       return $this->db->get()->result();
    }

}
