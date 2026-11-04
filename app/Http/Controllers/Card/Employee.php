<?php

namespace App\Http\Controllers\Card;


/* * *****************Employee.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Generate
 * @description     : Manage all type of system employee listing.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Employee extends \App\Legacy\MY_Controller {

    public $data = array();
      
   public function __construct() {
        parent::__construct();
                
        $this->load->model('Employee_Model', 'employee', true);                
    }

  

   

    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load user filtering interface                 
     *                      
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function index(){
        
        
        check_permission(VIEW);
        
        $this->data['employees'] = '';
        
         if ($_POST) {
             
            $branch_id = $this->input->post('branch_id'); 
            $employee_id = $this->input->post('employee_id');
            $this->data['cards'] = $this->employee->get_employee_list($branch_id, $employee_id);
            $this->data['school'] = $this->employee->get_school_by_id($branch_id);
            $this->data['setting'] = $this->employee->get_single('id_card_settings', array('branch_id'=>$branch_id));
            $this->data['branch_id'] = $branch_id;
            $this->data['employee_id'] = $employee_id;
            
            if(empty($this->data['setting'])){
                error($this->lang->line('unexpected_error'));
                ci_redirect($this->is_supper_admin ? 'card/idsetting/index' : 'card/schoolidsetting/index');
            }
            
         }
         
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');             
            $this->data['employees'] = $this->employee->get_list('employees', $condition, '','', '', 'id', 'ASC');
        }
        
        $this->layout->title($this->lang->line('generate_employee_id_card') .' ' . $this->lang->line('card') .' | ' . SMS);
        $this->layout->view('employee/index', $this->data);         
    }    

}
