<?php

namespace App\Models\Administrator;


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


class Setting_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }

    public function get_operation_list(){
        $this->db->select('O.*, M.module_name');
        $this->db->from('operations AS O');
        $this->db->join('modules AS M', 'M.id = O.module_id', 'left');
        $this->db->order_by('M.id');
        return $this->db->get()->result();
    }
}
