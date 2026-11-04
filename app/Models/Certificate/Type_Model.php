<?php

namespace App\Models\Certificate;




class Type_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function get_certificate_list(){
        
        $this->db->select('C.*');
        $this->db->from('certificates AS C');  
        return $this->db->get()->result();
    }
    
    function duplicate_check( $name, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('name', $name);
        return $this->db->get('certificates')->num_rows();            
    }
    
    public function get_student_list($branch_id = null, $class_id = null , $academic_year_id = null) {

            $this->db->select('S.*, U.username, U.role_id, U.status AS login_status ');
            $this->db->from('enrollments AS E');
            $this->db->join('students AS S', 'S.id = E.student_id', 'left');
            $this->db->join('users AS U', 'U.id = S.user_id', 'left');
            $this->db->where('E.academic_year_id', $academic_year_id);
            $this->db->where('S.branch_id', $branch_id);
            
            if($class_id){
                $this->db->where('E.class_id', $class_id);
            }            
             
            return $this->db->get()->result();
    }
    
    public function get_student($student_id = null, $class_id = null, $academic_year_id = null ) {

            $this->db->select('S.*, U.username, U.role_id, U.status AS login_status ');
            $this->db->from('enrollments AS E');
            $this->db->join('students AS S', 'S.id = E.student_id', 'left');
            $this->db->join('users AS U', 'U.id = S.user_id', 'left');
            $this->db->where('E.academic_year_id', $academic_year_id);
            $this->db->where('S.id', $student_id);
            $this->db->where('E.class_id', $class_id);
                   
             
            return $this->db->get()->row();
    }
}
