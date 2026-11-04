<?php

namespace App\Models\Exam;




class Grade_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }

    public function get_garde_list(){
        
        $this->db->select('G.*');
        $this->db->from('grades AS G');      
              
        return $this->db->get()->result();
    }
   
    
    function duplicate_check($field, $value, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where($field, $value);       
        return $this->db->get('grades')->num_rows();            
    }

}
