<?php

namespace App\Http\Controllers\Accounting;


/* * *****************Receipt.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Receipt
 * @description     : Manage invoice Receipt for all type of student payment.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Receipt extends \App\Legacy\MY_Controller {

    public $data = array();    
    
    function __construct() {
        
        parent::__construct();
         $this->load->model('Receipt_Model', 'receipt', true);
         $this->load->model('Payment_Model', 'payment', true);
    }

    
    /*****************Function duereceipt**********************************
    * @type            : Function
    * @function name   : duereceipt
    * @description     : Load "DUE Receipt List" user interface                
    *                        
    * @param           : null
    * @return          : null 
    * ***********************************************************/
    public function duereceipt() {    
        
        check_permission(VIEW);
         
        $this->data['receipts'] = '';
        if ($_POST) {
             
            $branch_id = $this->input->post('branch_id'); 
            $class_id = $this->input->post('class_id');            
            $student_id = $this->input->post('student_id');
            
            $this->data['school'] = $this->receipt->get_school_by_id($branch_id);            
            $this->data['receipts'] = $this->receipt->get_due_receipt_list($branch_id, $class_id, $student_id, $this->academic_year_id);
            
            $this->data['branch_id'] = $branch_id;
            $this->data['class_id'] = $class_id;           
            $this->data['student_id'] = $student_id;
            
         }
        
         if($this->session->userdata('role_id') == STUDENT){
             
            $branch_id = $this->session->userdata('branch_id');
            $class_id = $this->session->userdata('class_id');           
            $student_id = $this->session->userdata('profile_id');
                       
            $this->data['receipts'] = $this->receipt->get_due_receipt_list($branch_id, $class_id, $student_id, $this->academic_year_id);
          
         }
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');             
            $this->data['classes'] = $this->receipt->get_list('classes', $condition, '','', '', 'id', 'ASC');
        }
        
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_due_receipt') . ' | ' . SMS);
        $this->layout->view('receipt/due-receipt', $this->data);            
       
    }
    
    
    /*****************Function get_single_due_receipt**********************************
    * @type            : Function
    * @function name   : due
    * @description     : Load "get_single_due_receipt" user interface                
    *                        
    * @param           : null
    * @return          : null 
    * ***********************************************************/
    public function get_single_due_receipt() {    
        
        check_permission(VIEW);
        
        $inv_id = $this->input->post('inv_id'); 
        $branch_id = $this->input->post('branch_id'); 
        $class_id = $this->input->post('class_id');             
        $student_id = $this->input->post('student_id');

        $txn_amount                = $this->payment->get_invoice_amount($inv_id);        
        $this->data['paid_amount'] = $txn_amount->paid_amount;
        $this->data['school'] = $this->receipt->get_school_by_id($branch_id);
        $this->data['invoice'] = $this->receipt->get_single('invoices', array('id'=>$inv_id)); 
        $this->data['student'] = $this->receipt->get_single_student($branch_id, $class_id, $student_id, $this->academic_year_id);
        
        $this->data['receipt_items'] = $this->receipt->get_invoice_item($inv_id);
        echo $this->load->view('receipt/get-single-due-receipt', $this->data);
    }    
   
    
    /*****************Function paidreceipt**********************************
    * @type            : Function
    * @function name   : paidreceipt
    * @description     : Load "PAID Receipt List" user interface                
    *                        
    * @param           : null
    * @return          : null 
    * ***********************************************************/
    public function paidreceipt() {    
        
        check_permission(VIEW);
         
        $this->data['receipts'] = '';
        if ($_POST) {
             
            $branch_id = $this->input->post('branch_id'); 
            $class_id = $this->input->post('class_id');      
            $student_id = $this->input->post('student_id');
            
            $this->data['school'] = $this->receipt->get_school_by_id($branch_id);            
            $this->data['receipts'] = $this->receipt->get_paid_receipt_list($branch_id, $class_id, $student_id, $this->academic_year_id);
            
            $this->data['branch_id'] = $branch_id;
            $this->data['class_id'] = $class_id;           
            $this->data['student_id'] = $student_id;
            
         }
         
         if($this->session->userdata('role_id') == STUDENT){
             
            $branch_id = $this->session->userdata('branch_id');
            $class_id = $this->session->userdata('class_id');           
            $student_id = $this->session->userdata('profile_id');
                       
            $this->data['receipts'] = $this->receipt->get_paid_receipt_list($branch_id, $class_id, $student_id, $this->academic_year_id);
              
         }
        
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');             
            $this->data['classes'] = $this->receipt->get_list('classes', $condition, '','', '', 'id', 'ASC');
        }
        
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_paid_receipt') . ' | ' . SMS);
        $this->layout->view('receipt/paid-receipt', $this->data);            
       
    }
    
    
    /*****************Function get_single_paid_receipt**********************************
    * @type            : Function
    * @function name   : paid
    * @description     : Load "get_single_paid_receipt" user interface                
    *                        
    * @param           : null
    * @return          : null 
    * ***********************************************************/
    public function get_single_paid_receipt() {    
        
        check_permission(VIEW);
        
        $inv_id = $this->input->post('inv_id'); 
        $branch_id = $this->input->post('branch_id'); 
        $class_id = $this->input->post('class_id');        
        $student_id = $this->input->post('student_id');

        $txn_amount                = $this->payment->get_invoice_amount($inv_id);        
        $this->data['paid_amount'] = $txn_amount->paid_amount;
        $this->data['school'] = $this->receipt->get_school_by_id($branch_id);            
        $this->data['invoice'] = $this->receipt->get_single('invoices', array('id'=>$inv_id));            
        $this->data['student'] = $this->receipt->get_single_student($branch_id, $class_id, $student_id, $this->academic_year_id);            
        $this->data['receipt_items'] = $this->receipt->get_invoice_item($inv_id);
        echo $this->load->view('receipt/get-single-paid-receipt', $this->data);
    }    
   
}
