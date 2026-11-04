<?php

namespace App\Models\Administrator;



class School_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
        
    function duplicate_check($branch_name, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('branch_name', $branch_name);
        return $this->db->get('schools')->num_rows();            
    }
}
