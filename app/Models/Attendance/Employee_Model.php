<?php

namespace App\Models\Attendance;




class Employee_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_employee_list($branch_id = null){
        
        $this->db->select('E.*, U.username, U.role_id, D.name AS designtion');
        $this->db->from('employees AS E');
        $this->db->join('users AS U', 'U.id = E.user_id', 'left');
        $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');      
        $this->db->where('E.status', 1);       
        $this->db->where('E.branch_id', $branch_id);       
       
        return $this->db->get()->result();        
    } 
}
