<?php

namespace App\Models\Accounting;




class Expenditure_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
 
    public function get_expenditure_list($branch_id = null){
        
        $this->db->select('E.*, S.branch_name, H.title AS head, AY.session_year');
        $this->db->from('expenditures AS E');        
        $this->db->join('expenditure_heads AS H', 'H.id = E.expenditure_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
        $this->db->join('schools AS S', 'S.id = E.branch_id', 'left');
       
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('E.branch_id', $this->session->userdata('branch_id'));
        }
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('E.branch_id', $branch_id);
        }
        
        $this->db->where('S.status', 1);
        $this->db->order_by('E.id', 'DESC');
        
        return $this->db->get()->result();        
    }
    
    public function get_single_expenditure($id){
        
        $this->db->select('E.*, S.branch_name,  H.title AS head, AY.session_year');
        $this->db->from('expenditures AS E');        
        $this->db->join('expenditure_heads AS H', 'H.id = E.expenditure_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
        $this->db->join('schools AS S', 'S.id = E.branch_id', 'left');
        $this->db->where('E.id', $id); 
        return $this->db->get()->row();        
    }
}
