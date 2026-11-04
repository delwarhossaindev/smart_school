<?php

namespace App\Models\Card;




class Teacher_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }

    
    public function get_teacher_list($branch_id = null, $teacher_id = null) {

        $this->db->select('T.*, U.username, U.role_id, U.status AS login_status ');
        $this->db->from('teachers AS T');
        $this->db->join('users AS U', 'U.id = T.user_id', 'left');
        $this->db->where('T.branch_id', $branch_id);

        if($teacher_id){
            $this->db->where('T.id', $teacher_id);
        }           

         $this->db->order_by('T.id', 'ASC');
        return $this->db->get()->result();
    }
   
}
