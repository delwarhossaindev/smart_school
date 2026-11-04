<?php

namespace App\Models\Attendance;




class Teacher_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_teacher_list($branch_id = null){
        
        $this->db->select('T.*, U.username, U.role_id');
        $this->db->from('teachers AS T');
        $this->db->join('users AS U', 'U.id = T.user_id', 'left');
        $this->db->where('T.status', 1);
        $this->db->where('T.branch_id', $branch_id);
       
        return $this->db->get()->result();        
    } 
}
