<?php

namespace App\Http\Controllers\Administrator;


/* * *****************Openinghour.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Sms
 * @description     : Manage school Email setting.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Openinghour extends \App\Legacy\MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
        $this->load->model('Openinghour_Model', 'openinghour', true);

        if($this->session->userdata('role_id') != SUPER_ADMIN){ 
            error($this->lang->line('permission_denied'));
            ci_redirect('dashboard/index');
        }        
    }

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "School Opening Hour Listing" user interface                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {
        
        check_permission(VIEW);
        
        $this->data['opening_hours'] = $this->openinghour->get_opening_hour_list();
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_opening_hour') . ' | ' . SMS);
        $this->layout->view('opening_hour/index', $this->data);            
       
    }

    
    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Opening Hour" user interface                 
    *                    and store "Sms Setting" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);
        
        if ($_POST) {
            $this->_prepare_opening_hour_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_opening_hour_data();

                $insert_id = $this->openinghour->insert('opening_hours', $data);
                if ($insert_id) {
                    
                    $school = $this->openinghour->get_single('schools', array('id' => $data['branch_id']));
                    create_log('Has been created opening hour for : '.$school->branch_name); 
                    
                    success($this->lang->line('insert_success'));
                    ci_redirect('administrator/openinghour/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    ci_redirect('administrator/openinghour/add');
                }
            } else {
                error($this->lang->line('insert_failed'));
                $this->data = $_POST;
            }
        }

        $this->data['opening_hours'] = $this->openinghour->get_opening_hour_list();
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add') . ' | ' . SMS);
        $this->layout->view('opening_hour/index', $this->data);
    }

    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Opening Hour" user interface                 
    *                    with populated "Opening Hour" value 
    *                    and update "Opening Hour" database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {   
        
        check_permission(EDIT);
       
        if ($_POST) {
            $this->_prepare_opening_hour_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_opening_hour_data();
                $updated = $this->openinghour->update('opening_hours', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    $school = $this->openinghour->get_single('schools', array('id' => $data['branch_id']));
                    create_log('Has been updated opening hour for : '.$school->branch_name); 
                    
                    success($this->lang->line('update_success'));
                    ci_redirect('administrator/openinghour/index');    
                    
                } else {
                    error($this->lang->line('update_failed'));
                    ci_redirect('administrator/openinghour/edit/' . $this->input->post('id'));
                }
            } else {
                error($this->lang->line('update_failed'));
                $this->data['opening_hour'] = $this->openinghour->get_single('opening_hours', array('id' => $this->input->post('id')));
            }
        } else {
            if ($id) {
                $this->data['opening_hour'] = $this->openinghour->get_single('opening_hours', array('id' => $id));
 
                if (!$this->data['opening_hour']) {
                     ci_redirect('administrator/openinghour/index');
                }
            }
        }

        $this->data['opening_hours'] = $this->openinghour->get_opening_hour_list();
        $this->data['branch_id'] = $this->data['opening_hour']->branch_id;
        
        $this->data['edit'] = TRUE;       
        $this->layout->title($this->lang->line('edit') . ' | ' . SMS);
        $this->layout->view('opening_hour/index', $this->data);
    }

            
        
    /*****************Function get_single_email**********************************
     * @type            : Function
     * @function name   : get_single_email
     * @description     : "Load single email setting information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_opening_hour(){
        
       $hour_id = $this->input->post('hour_id');       
       $this->data['opening_hour'] = $this->openinghour->get_single_opening_hour($hour_id);
       echo $this->load->view('opening_hour/get-single-opening-hour', $this->data);
    }

    
    /*****************Function _prepare_opening_hour_validation**********************************
    * @type            : Function
    * @function name   : _prepare_opening_hour_validation
    * @description     : Process "opening_hour" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_opening_hour_validation() {
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
      
        $this->form_validation->set_rules('branch_id', $this->lang->line('branch_name'), 'trim|required|callback_branch_id');     
        
        $this->form_validation->set_rules('monday',  $this->lang->line('monday'), 'trim');
        $this->form_validation->set_rules('tuesday',  $this->lang->line('tuesday'), 'trim');
        $this->form_validation->set_rules('wednesday',  $this->lang->line('wednesday'), 'trim');
        $this->form_validation->set_rules('thursday', $this->lang->line('thursday'), 'trim');        
        $this->form_validation->set_rules('friday', $this->lang->line('friday'), 'trim');        
        $this->form_validation->set_rules('saturday', $this->lang->line('saturday'), 'trim');        
        $this->form_validation->set_rules('sunday', $this->lang->line('sunday'), 'trim');        
    }

        /*****************Function branch_id**********************************
    * @type            : Function
    * @function name   : branch_id
    * @description     : Unique check for "branch_id" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */  
    public function branch_id() {
        if ($this->input->post('id') == '') {
            $openinghour = $this->openinghour->duplicate_check($this->input->post('branch_id'));
            if ($openinghour) {
                $this->form_validation->set_message('branch_id', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $openinghour = $this->openinghour->duplicate_check($this->input->post('branch_id'), $this->input->post('id'));
            if ($openinghour) {
                $this->form_validation->set_message('branch_id', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }
    
    /*****************Function _get_posted_opening_hour_data**********************************
     * @type            : Function
     * @function name   : _get_posted_opening_hour_data
     * @description     : Prepare "School opening hour" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_opening_hour_data() {

        $items = array();
       
        $items[] = 'branch_id';
        
        $data = elements($items, $_POST);     
        
        if($this->input->post('monday_1') && $this->input->post('monday_2')){
            $data['monday'] = $this->input->post('monday_1') . ' - ' . $this->input->post('monday_2'); 
        }else{
            $data['monday'] = '';
        }
        
        if($this->input->post('tuesday_1') && $this->input->post('tuesday_2')){
            $data['tuesday'] = $this->input->post('tuesday_1') . ' - ' . $this->input->post('tuesday_2'); 
        }else{
            $data['tuesday'] = '';
        }  
        
        if($this->input->post('wednesday_1') && $this->input->post('wednesday_2')){
            $data['wednesday'] = $this->input->post('wednesday_1') . ' - ' . $this->input->post('wednesday_2'); 
        }else{
            $data['wednesday'] = '';
        }
        
        if($this->input->post('thursday_1') && $this->input->post('thursday_2')){
            $data['thursday'] = $this->input->post('thursday_1') . ' - ' . $this->input->post('thursday_2');
        }else{
            $data['thursday'] = '';
        }
        
        if($this->input->post('friday_1') && $this->input->post('friday_2')){
           $data['friday'] = $this->input->post('friday_1') . ' - ' . $this->input->post('friday_2'); 
        }else{
            $data['friday'] = '';
        }
        
        if($this->input->post('saturday_1') && $this->input->post('saturday_2')){
            $data['saturday'] = $this->input->post('saturday_1') . ' - ' . $this->input->post('saturday_2');
        }else{
            $data['saturday'] = '';
        } 
        
        if($this->input->post('sunday_1') && $this->input->post('sunday_2')){
            $data['sunday'] = $this->input->post('sunday_1') . ' - ' . $this->input->post('sunday_2'); 
        }else{
            $data['sunday'] = '';
        }        
        
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }       

        return $data;
    }
    
     
    /*****************Function delete**********************************
   * @type            : Function
   * @function name   : delete
   * @description     : delete "School Opening Hours" from database                  
   *                       
   * @param           : $id integer value
   * @return          : null 
   * ********************************************************** */
    public function delete($id = null) {
        
        
        check_permission(DELETE);
        
        if(!is_numeric($id)){
             error($this->lang->line('unexpected_error'));
             ci_redirect('administrator/openinghour/index');              
        }
        
        $email = $this->openinghour->get_single('opening_hours', array('id' => $id));
        
        if ($this->openinghour->delete('opening_hours', array('id' => $id))) {  
            
            $school = $this->openinghour->get_single('schools', array('id' => $email->branch_id));
            create_log('Has been deleted opening hour for : '.$school->branch_name);             
            success($this->lang->line('delete_success'));
            
        } else {
            error($this->lang->line('delete_failed'));
        }
        
        ci_redirect('administrator/openinghour/index');
    }
}