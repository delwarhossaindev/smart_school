<?php

namespace App\Models\Accounting;




class Income_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
 
    public function get_income_list($branch_id = null){
        
        $this->db->select('I.*, S.branch_name, IH.title AS head, AY.session_year');
        $this->db->from('invoices AS I');        
        $this->db->join('invoice_detail AS ID', 'ID.invoice_id = I.id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = ID.income_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->join('schools AS S', 'S.id = I.branch_id', 'left');
        $this->db->where('I.invoice_type', 'income'); 
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('I.branch_id', $this->session->userdata('branch_id'));
        }
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('I.branch_id', $branch_id);
        }
        $this->db->where('S.status', 1);
         $this->db->order_by('I.id', 'DESC');
        
        return $this->db->get()->result();        
    }
    
    public function get_single_income($id){
        
        $this->db->select('I.*, S.branch_name, IH.title AS head, IH.id as income_head_id, AY.session_year, T.payment_method, T.bank_name, T.cheque_no');
        $this->db->from('invoices AS I'); 
        $this->db->join('invoice_detail AS ID', 'ID.invoice_id = I.id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = ID.income_head_id', 'left');
        $this->db->join('transactions AS T', 'T.invoice_id = I.id', 'left');     
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->join('schools AS S', 'S.id = I.branch_id', 'left');
        $this->db->where('I.id', $id);       
       
        return $this->db->get()->row();        
    }
}
