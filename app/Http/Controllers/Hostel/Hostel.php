<?php

namespace App\Http\Controllers\Hostel;


/* * *****************Hostel.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Hostel
 * @description     : Manage student residential hostel/dormitory.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

Class Hostel extends \App\Legacy\MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Hostel_Model', 'hostel', true);        
    }

        
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Hostel List" user interface                 
    *                    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index($branch_id = null) {

        check_permission(VIEW);
        
        $this->data['filter_branch_id'] = $branch_id;
        $this->data['schools'] = $this->schools;
        $this->data['hostels'] = $this->hostel->get_hostel_list($branch_id);
                
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_hostel') . ' | ' . SMS);
        $this->layout->view('hostel/index', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Hostel" user interface                 
    *                    and process to store "Hostel" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_hostel_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_hostel_data();

                $insert_id = $this->hostel->insert('hostels', $data);
                if ($insert_id) {
                    
                    create_log('Has been added a Hostel : '.$data['name']);
                    success($this->lang->line('insert_success'));
                    ci_redirect($this->is_supper_admin ? 'hostel/index/'.$data['branch_id'] : 'hostel/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    ci_redirect($this->is_supper_admin ? 'hostel/add/'.$data['branch_id'] : 'hostel/add');
                }
            } else {
                error($this->lang->line('insert_failed'));
                $this->data['post'] = $_POST;
            }
        }
        
        $branch_id = $this->uri->segment(4);
        if(!$branch_id){
          $branch_id = $this->input->post('branch_id');
        }

        $this->data['hostels'] = $this->hostel->get_hostel_list($branch_id);
        $this->data['schools'] = $this->schools;
        
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add') . ' | ' . SMS);
        $this->layout->view('hostel/index', $this->data);
    }

        
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Hostel" user interface                 
    *                    with populate "Hostel" value 
    *                    and process to update "Hostel" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

        check_permission(EDIT);

        if(!is_numeric($id)){
          error($this->lang->line('unexpected_error'));
          ci_redirect('hostel/index');
        }
        
        if ($_POST) {
            $this->_prepare_hostel_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_hostel_data();
                $updated = $this->hostel->update('hostels', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    create_log('Has been updated a Hostel : '.$data['name']);
                    success($this->lang->line('update_success'));
                    ci_redirect($this->is_supper_admin ? 'hostel/index/'.$data['branch_id'] : 'hostel/index');
                } else {
                    error($this->lang->line('update_failed'));
                    ci_redirect('hostel/edit/' . $this->input->post('id'));
                }
            } else {
                error($this->lang->line('update_failed'));
                $this->data['hostel'] = $this->hostel->get_single('hostels', array('id' => $this->input->post('id')));
            }
        }

        if ($id) {
            $this->data['hostel'] = $this->hostel->get_single('hostels', array('id' => $id));

            if (!$this->data['hostel']) {
                ci_redirect('hostel/index');
            }
        }

        $this->data['hostels'] = $this->hostel->get_hostel_list($this->data['hostel']->branch_id);
        $this->data['branch_id'] = $this->data['hostel']->branch_id;
        $this->data['filter_branch_id'] = $this->data['hostel']->branch_id;
        $this->data['schools'] = $this->schools;
        
        
        $this->data['edit'] = TRUE;
        $this->layout->title($this->lang->line('edit') . ' | ' . SMS);
        $this->layout->view('hostel/index', $this->data);
    }

    
        
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific Hostel data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($id = null) {

        check_permission(VIEW);
        
        if(!is_numeric($id)){
         error($this->lang->line('unexpected_error'));
          ci_redirect('hostel/index');
        }
        
        
        $this->data['hostels'] = $this->hostel->get_hostel_list();
        
        $this->data['hostel'] = $this->hostel->get_single('hostels', array('id' => $id));
        
        $this->data['detail'] = TRUE;
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('hostel') . ' | ' . SMS);
        $this->layout->view('hostel/index', $this->data);
    }

        
               
    /*****************Function get_single_hostel**********************************
     * @type            : Function
     * @function name   : get_single_hostel
     * @description     : "Load single hostel information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_hostel(){
        
        $hostel_id = $this->input->post('hostel_id');
       
        $this->data['hostel'] = $this->hostel->get_single_hostel($hostel_id);
        echo $this->load->view('hostel/get-single-hostel', $this->data);
    }
        
    /*****************Function _prepare_hostel_validation**********************************
    * @type            : Function
    * @function name   : _prepare_hostel_validation
    * @description     : Process "Hostel" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_hostel_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('name', $this->lang->line('hostel') . ' ' . $this->lang->line('name'), 'trim|required|callback_name');
        $this->form_validation->set_rules('branch_id', $this->lang->line('branch_name'), 'trim|required');
        $this->form_validation->set_rules('type', $this->lang->line('hostel_type'), 'trim|required');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'trim|required');
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
    }

    
        
    /*****************Function name**********************************
    * @type            : Function
    * @function name   : name
    * @description     : Unique check for "hostel name" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function name() {
        if ($this->input->post('id') == '') {
            $hostel = $this->hostel->duplicate_check($this->input->post('branch_id'), $this->input->post('name'));
            if ($hostel) {
                $this->form_validation->set_message('name', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $hostel = $this->hostel->duplicate_check($this->input->post('branch_id'), $this->input->post('name'), $this->input->post('id'));
            if ($hostel) {
                $this->form_validation->set_message('name', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    
       
   
    /*****************Function _get_posted_hostel_data**********************************
    * @type            : Function
    * @function name   : _get_posted_hostel_data
    * @description     : Prepare "Hostel" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_hostel_data() {

        $items = array();
        $items[] = 'branch_id';
        $items[] = 'name';
        $items[] = 'type';
        $items[] = 'address';
        $items[] = 'note';
        $data = elements($items, $_POST);

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
    * @description     : delete "Hostel" data from database                  
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        check_permission(DELETE);

        if(!is_numeric($id)){
          error($this->lang->line('unexpected_error'));
          ci_redirect('hostel/index');
        }
        
        $hostel = $this->hostel->get_single('hostels', array('id' => $id));
        
         // will check following database tables are used hostel or not
        $tables = array(
            'rooms','hostel_members'
        );
        
        foreach ($tables as $table) {
            
            $exist = $this->hostel->get_single($table, array('hostel_id' => $id)); 
            if(!empty($exist)){
                error($this->lang->line('this_hostel_already_used'));
                ci_redirect('hostel/index');
            }
        } 
        
        if ($this->hostel->delete('hostels', array('id' => $id))) {
            
            create_log('Has been deleted a Hostel : '.$hostel->name);   
            success($this->lang->line('delete_success'));
            
        } else {
            error($this->lang->line('delete_failed'));
        }
        
        ci_redirect($this->is_supper_admin ? 'hostel/index/'.$hostel->branch_id : 'hostel/index');
    }

}