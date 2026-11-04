<?php

namespace App\Http\Controllers\Leave;


/* * *****************Waiting.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Waiting
 * @description     : Manage waiting.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Waiting extends \App\Legacy\MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Application_Model', 'waiting', true);        
    }

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Waiting List" user interface                 
    *                    listing    
    * @param           : integer value
    * @return          : null 
    * ********************************************************** */
    public function index($branch_id = null) {

        check_permission(VIEW);
                         
        $this->data['applications'] = $this->waiting->get_application_list($branch_id, $waiting = 1);          
        $this->data['branch_id'] = $branch_id;        
        $this->data['filter_branch_id'] = $branch_id;        
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_waiting_application') .' | ' . SMS);
        $this->layout->view('waiting/index', $this->data);
        
    }

           
    /*****************Function get_single_application**********************************
     * @type            : Function
     * @function name   : get_single_application
     * @description     : "Load single application information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_application(){
        
       $application_id = $this->input->post('application_id');       
       $this->data['application'] = $this->waiting->get_single_application($application_id);
       $this->data['school'] = $this->waiting->get_school_by_id($this->data['application']->branch_id);
       echo $this->load->view('get-single-application', $this->data);
    }
    
    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Waiting" from database                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    
    public function delete($id = null) {

        check_permission(VIEW);
        
        if(!is_numeric($id)){
             error($this->lang->line('unexpected_error'));
             ci_redirect('leave/waiting/index');
        }
        
        $application = $this->waiting->get_single_application($id);
        
        if ($this->waiting->delete('leave_applications', array('id' => $id))) {
            
             // delete teacher resume and image
            $destination = 'assets/uploads/';
            if (file_exists($destination . '/leave/' . $application->attachment)) {
                @unlink($destination . '/leave/' . $application->attachment);
            }            
            
            create_log('Has been deleted a waiting application');
            success($this->lang->line('delete_success'));
            
        } else {
            error($this->lang->line('delete_failed'));
        }
        
         ci_redirect($this->is_supper_admin ? 'leave/waiting/index/'.$application->branch_id : 'leave/waiting/index');
    }
    

}
