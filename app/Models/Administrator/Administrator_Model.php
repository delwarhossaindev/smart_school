<?php

namespace App\Models\Administrator;




class Administrator_Model extends \App\Legacy\MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_user_list($branch_id, $role_id, $class_id, $user_id) {
        
        
        if ($role_id == STUDENT) {
            
            $this->db->select('S.*, SC.branch_name, U.username, U.temp_password, U.role_id, U.status AS login_status ');
            $this->db->from('enrollments AS E');
            $this->db->join('students AS S', 'S.id = E.student_id', 'left');
            $this->db->join('users AS U', 'U.id = S.user_id', 'left');
            $this->db->join('schools AS SC', 'SC.id = S.branch_id', 'left');
            $this->db->where('E.academic_year_id', $this->academic_year_id);
            $this->db->where('S.branch_id', $branch_id);
            
            if($class_id){
                $this->db->where('E.class_id', $class_id);
            } 
            
            if($user_id){
               $this->db->where('S.user_id', $user_id);                 
            }
            
            $this->db->where('S.status_type', 'regular');
            $this->db->where('SC.status', 1);
            
            return $this->db->get()->result();
            
        } elseif ($role_id == TEACHER) {
            
            $this->db->select('T.*, S.branch_name, U.username, U.temp_password, U.role_id, U.status AS login_status ');
            $this->db->from('teachers AS T');
            $this->db->join('users AS U', 'U.id = T.user_id', 'left');
            $this->db->join('schools AS S', 'S.id = T.branch_id', 'left');
            $this->db->where('T.branch_id', $branch_id);
            
            if($user_id){
               $this->db->where('T.user_id', $user_id);                 
            }
             
            $this->db->where('S.status', 1);
             
            return $this->db->get()->result();
            
        } elseif ($role_id == GUARDIAN) {
            
            $this->db->select('G.*, S.branch_name, U.username, U.temp_password, U.role_id, U.status AS login_status ');
            $this->db->from('guardians AS G');
            $this->db->join('users AS U', 'U.id = G.user_id', 'left');
            $this->db->join('schools AS S', 'S.id = G.branch_id', 'left');
            $this->db->where('G.branch_id', $branch_id);
            if($user_id){                 
               $this->db->where('G.user_id', $user_id);
            }
            $this->db->where('S.status', 1);
            
            return $this->db->get()->result();
            
        } else {
            
            $this->db->select('E.*, S.branch_name, U.username, U.temp_password, U.role_id, D.name AS designation, U.status AS login_status ');
            $this->db->from('employees AS E');
            $this->db->join('users AS U', 'U.id = E.user_id', 'left');
            $this->db->join('schools AS S', 'S.id = E.branch_id', 'left');
            $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
            $this->db->where('E.branch_id', $branch_id);
            if($user_id){
                $this->db->where('E.user_id', $user_id);
            }
            $this->db->where('U.role_id', $role_id);
            $this->db->where('S.status', 1);
            
            return $this->db->get()->result();
        }
    }
    
        
    public function get_activity_log($branch_id, $role_id, $class_id = null, $user_id = null) {
                    
        $this->db->select('L.*, S.branch_name');
        $this->db->from('activity_logs AS L');
        $this->db->join('users AS U', 'U.id = L.user_id', 'left');
        $this->db->join('schools AS S', 'S.id = L.branch_id', 'left');
        
        if($role_id){
            $this->db->where('L.role_id', $role_id);
        } 
        
        if($class_id){
            $this->db->where('L.class_id', $class_id);
        } 
        
        if($user_id){
           $this->db->where('L.user_id', $user_id);                 
        }
        if($branch_id){
          $this->db->where('L.branch_id', $branch_id);                 
        }
        
        $this->db->order_by('L.id', 'DESC');   
        return $this->db->get()->result();
    }
    
}