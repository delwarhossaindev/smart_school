<?php

namespace App\Http\Controllers\Payroll;


/* * *****************History.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : History
 * @description     : Manage Employee and Teacher Salary History.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class History extends \App\Legacy\MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
         $this->load->model('Payment_Model', 'payment', true);              
    }

       
    
    
    
    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load "Employee & Teacher Payment History" user interface                 
     *                    
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function index() {
        
        check_permission(VIEW);
        
        $this->data['users'] = '';
        
         if ($_POST) {
             
            $branch_id  = $this->input->post('branch_id');
            $user_type  = $this->input->post('user_type');
            $user_id  = $this->input->post('user_id');
        
            $this->data['branch_id'] = $branch_id;
            $this->data['user_type'] = $user_type;
            $this->data['user_id'] = $user_id;
            
            $this->data['payments'] = $this->payment->get_payment_list($branch_id, $user_id, $user_type);
            
         }
        
        $this->data['list'] = TRUE;       
        $this->layout->title( $this->lang->line('manage_payment'). ' | ' . SMS);
        $this->layout->view('history/index', $this->data);            
       
    }
    
    
    
     /*****************Function get_single_payment**********************************
     * @type            : Function
     * @function name   : get_single_payment
     * @description     : "Load single salary payment information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_payment(){
        
       $payment_id = $this->input->post('payment_id');
       $user_type = $this->input->post('user_type');
       
       $this->data['payment'] = $this->payment->get_single_payment($payment_id, $user_type);
       echo $this->load->view('get-single-payment', $this->data);
    }

     
    /*****************Function delete**********************************
     * @type            : Function
     * @function name   : delete
     * @description     : delete "Ppaid Salry" from database                  
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function delete($id = null) {
        
        check_permission(DELETE);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            ci_redirect('payroll/history/index');
        }        
        
        $payment = $this->payment->get_single('salary_payments', array('id' => $id));
              
        if ($this->payment->delete('salary_payments', array('id' => $id))) {   
            
            // now will delete expenditure table data for this salary payment
            $this->payment->delete('expenditures', array('id' => $payment->expenditure_id));             
            success($this->lang->line('delete_success'));
            
        } else {
            
            error($this->lang->line('delete_failed'));
        }
        
        ci_redirect('payroll/history/index');
    }
   
}
