<?php

namespace App\Models\Hrm;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth_Model
 *
 * @author Nafeesa
 */


class Designation_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_designation(){        
        
        $this->db->select('D.*');
        $this->db->from('designations AS D');                 
        $this->db->order_by('D.id', 'DESC');
        
        return $this->db->get()->result();
    }
    
    
    function duplicate_check($name, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('name', $name);
        return $this->db->get('designations')->num_rows();            
    }
}
