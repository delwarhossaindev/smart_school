<?php

namespace App\Models\Hrm;




class Employee_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_employee_list($branch_id = null){
        
        $this->db->select('E.*, S.branch_name, U.username, U.role_id, D.name AS designation');
        $this->db->from('employees AS E');
        $this->db->join('users AS U', 'U.id = E.user_id', 'left');
        $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
        $this->db->join('schools AS S', 'S.id = E.branch_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('E.branch_id', $this->session->userdata('branch_id'));
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('E.branch_id', $branch_id);
        }
        
        $this->db->where('S.status', 1);
        $this->db->order_by('E.display_order', 'ASC');
        
        return $this->db->get()->result();
        
    }
    
    public function get_single_employee($id){
        
        $this->db->select('E.*, S.branch_name, U.username, U.role_id, R.name AS role, D.name AS designation, SG.grade_name');
        $this->db->from('employees AS E');
        $this->db->join('users AS U', 'U.id = E.user_id', 'left');
        $this->db->join('roles AS R', 'R.id = U.role_id', 'left');
        $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
        $this->db->join('schools AS S', 'S.id = E.branch_id', 'left');
        $this->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');
        $this->db->where('E.id', $id);
        return $this->db->get()->row();
        
    }
    
     function duplicate_check($username, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('username', $username);
        return $this->db->get('users')->num_rows();            
    }
}
