<?php

namespace App\Models\Administrator;



class Year_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_year_list(){
        
        $this->db->select('AY.*');
        $this->db->from('academic_years AS AY');
        $this->db->order_by('AY.id', 'ASC');
        return $this->db->get()->result();
        
    }
        
    function duplicate_check($session_year, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('session_year', $session_year);
        return $this->db->get('academic_years')->num_rows();            
    }
}
