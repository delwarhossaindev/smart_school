<?php

namespace App\Http\Controllers\Accounting;


/* * *****************Expenditure.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Expenditure
 * @description     : Manage all kind of expenditure of the school.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Expenditure extends \App\Legacy\MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
         $this->load->model('Expenditure_Model', 'expenditure', true);              
    }

    
    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load "Expenditure Listing" user interface                 
     *                    
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function index($branch_id = null) {
        
        check_permission(VIEW);
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');        
            $this->data['expenditure_heads'] = $this->expenditure->get_list('expenditure_heads', $condition);  
            $this->data['payments'] = get_payment_methods($condition['branch_id']);
        }       
        
       
        $this->data['expenditures'] = $this->expenditure->get_expenditure_list($branch_id); 
        $this->data['filter_branch_id'] = $branch_id;
        $this->data['schools'] = $this->schools;
        
        $this->data['list'] = TRUE;
        $this->layout->title( $this->lang->line('manage_expenditure'). ' | ' . SMS);
        $this->layout->view('expenditure/index', $this->data);            
       
    }

    
     /*****************Function add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : Load "Add new Expenditure" user interface                 
     *                    and store "Expenditure" into database 
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function add() {
        
        check_permission(ADD);
        if ($_POST) {
            $this->_prepare_expenditure_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_expenditure_data();

                $insert_id = $this->expenditure->insert('expenditures', $data);
                if ($insert_id) {
                    
                    create_log('Has been added expenditure : '.$data['amount']);                    
                    success($this->lang->line('insert_success'));
                    ci_redirect($this->is_supper_admin ? 'accounting/expenditure/index/'.$data['branch_id'] : 'accounting/expenditure/index');
                    
                } else {
                    error($this->lang->line('insert_failed'));
                    ci_redirect($this->is_supper_admin ? 'accounting/expenditure/add/'.$data['branch_id'] : 'accounting/expenditure/add');
                }
            } else {
                error($this->lang->line('insert_failed'));
                $this->data['post'] = $_POST;
            }
        }

        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');        
            $this->data['expenditure_heads'] = $this->expenditure->get_list('expenditure_heads', $condition);  
            $this->data['payments'] = get_payment_methods($condition['branch_id']);
        }
        
        $branch_id = $this->uri->segment(4);
        if(!$branch_id){
          $branch_id = $this->input->post('branch_id');
        }
        
        $this->data['expenditures'] = $this->expenditure->get_expenditure_list($branch_id); 
        $this->data['schools'] = $this->schools;
         
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add'). ' | ' . SMS);
        $this->layout->view('expenditure/index', $this->data);
    }

    
        
    /*****************Function edit**********************************
     * @type            : Function
     * @function name   : edit
     * @description     : Load Update "Expenditure" user interface                 
     *                    with populated "Expenditure" value 
     *                    and update "Expenditure" database    
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function edit($id = null) {  
        
       check_permission(EDIT);
       
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            ci_redirect('accounting/expenditure/index');
        }
        
        if ($_POST) {
            $this->_prepare_expenditure_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_expenditure_data();
                $updated = $this->expenditure->update('expenditures', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    create_log('Has been updated expenditure : '.$data['amount']);                    
                    success($this->lang->line('update_success'));
                    ci_redirect($this->is_supper_admin ? 'accounting/expenditure/index/'.$data['branch_id'] : 'accounting/expenditure/index');     
                    
                } else {
                    error($this->lang->line('update_failed'));
                    ci_redirect('accounting/expenditure/edit/' . $this->input->post('id'));
                }
            } else {
                error($this->lang->line('update_failed'));
                $this->data['expenditure'] = $this->expenditure->get_single('expenditures', array('id' => $this->input->post('id')));
            }
        }
        
        if ($id) {
            $this->data['expenditure'] = $this->expenditure->get_single('expenditures', array('id' => $id));

            if (!$this->data['expenditure']) {
                 ci_redirect('accounting/expenditure/index');
            }
        }
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');        
            $this->data['expenditure_heads'] = $this->expenditure->get_list('expenditure_heads', $condition);    
            $this->data['payments'] = get_payment_methods($condition['branch_id']);
        }
        
        $this->data['expenditures'] = $this->expenditure->get_expenditure_list($this->data['expenditure']->branch_id);
        $this->data['branch_id'] = $this->data['expenditure']->branch_id;
        $this->data['filter_branch_id'] = $this->data['expenditure']->branch_id;
        $this->data['schools'] = $this->schools;
        
        $this->data['edit'] = TRUE;       
        $this->layout->title($this->lang->line('edit'). ' | ' . SMS);
        $this->layout->view('expenditure/index', $this->data);
    }
    
    
     /*****************Function view**********************************
     * @type            : Function
     * @function name   : view
     * @description     : Load user interface with specific expenditure data                 
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function view($id = null){
        
        check_permission(VIEW);
        
         
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            ci_redirect('accounting/expenditure/index');
        }
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');        
            $this->data['expenditure_heads'] = $this->expenditure->get_list('expenditure_heads', $condition);        
        }
        
        $this->data['expenditures'] = $this->expenditure->get_expenditure_list();  
        $this->data['expenditure'] = $this->expenditure->get_single_expenditure($id);
        $this->data['detail'] = TRUE;       
        $this->layout->title($this->lang->line('view'). ' | ' . SMS);
        $this->layout->view('expenditure/index', $this->data); 
    }

               
     /*****************Function get_single_expenditure**********************************
     * @type            : Function
     * @function name   : get_single_slider
     * @description     : "Load single expenditure information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_expenditure(){
        
       $expenditure_id = $this->input->post('expenditure_id');       
       $this->data['expenditure'] = $this->expenditure->get_single_expenditure($expenditure_id);
       echo $this->load->view('expenditure/get-single-expenditure', $this->data);
    }
    
    
     /*****************Function _prepare_expenditure_validation**********************************
     * @type            : Function
     * @function name   : _prepare_expenditure_validation
     * @description     : Process "expenditure" user input data validation                 
     *                       
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    private function _prepare_expenditure_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('branch_id', $this->lang->line('branch_name'), 'trim|required');   
        $this->form_validation->set_rules('expenditure_head_id', $this->lang->line('expenditure_head'), 'trim|required');   
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|numeric');   
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required');   
        $this->form_validation->set_rules('expenditure_via', $this->lang->line('expenditure_method'), 'trim|required');   
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');   
    }


     /*****************Function _get_posted_expenditure_data**********************************
     * @type            : Function
     * @function name   : _get_posted_expenditure_data
     * @description     : Prepare "expenditure" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_expenditure_data() {

        $items = array();
        $items[] = 'branch_id';
        $items[] = 'expenditure_head_id';
        $items[] = 'amount';
        $items[] = 'expenditure_via';
        $items[] = 'reference';
        $items[] = 'note';
        
        $data = elements($items, $_POST);  
        
        $data['date'] = date('Y-m-d', strtotime($this->input->post('date')));
        
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            
            $data['status'] = 1;
            $data['expenditure_type'] = 'general';
            
            if(!$this->academic_year_id){
                error($this->lang->line('please_set_academic_year'));
                ci_redirect('accounting/expenditure/index');
            }
            
            $data['academic_year_id'] = $this->academic_year_id;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id(); 
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
            
        }

        return $data;
    }

    
    /*****************Function delete**********************************
     * @type            : Function
     * @function name   : delete
     * @description     : delete "Expenditure" from database                  
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function delete($id = null) {
        
        check_permission(DELETE);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            ci_redirect('accounting/expenditure/index');
        }
        
        $expenditure = $this->expenditure->get_single('expenditures', array('id' => $id));
         
        // get salary payment
        $exist = $this->expenditure->get_list('salary_payments', array('expenditure_id' => $id));         
        if(!empty($exist)){
            error($this->lang->line('this_expenditure_already_used'));
            ci_redirect($this->is_supper_admin  ? 'accounting/expenditure/index/'.$expenditure->branch_id : 'accounting/expenditure/index');
        }
            
        if ($this->expenditure->delete('expenditures', array('id' => $id))) {  
            
            create_log('Has been deleted expenditure : '.$expenditure->amount);             
            success($this->lang->line('delete_success'));
            
        } else {
            error($this->lang->line('delete_failed'));
        }
        
        ci_redirect($this->is_supper_admin  ? 'accounting/expenditure/index/'.$expenditure->branch_id : 'accounting/expenditure/index');
        
    } 
    
    
    
    /*****************Function get_expenditure_head_by_school**********************************
     * @type            : Function
     * @function name   : get_expenditure_head_by_school
     * @description     : Load "Expenditure Head Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_expenditure_head_by_school() {
        
        $branch_id  = $this->input->post('branch_id');
        $expenditure_head_id  = $this->input->post('expenditure_head_id');
         
        $expenditure_heads = $this->expenditure->get_list('expenditure_heads', array('branch_id'=>$branch_id));  
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($expenditure_heads)) {
            foreach ($expenditure_heads as $obj) {   
                
                $selected = $expenditure_head_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->title . '</option>';
                
            }
        }

        echo $str;
    }
    
     public function get_payment_method_by_school(){
        
        $branch_id  = $this->input->post('branch_id');
        $expenditure_via  = $this->input->post('expenditure_via');
        $payments = get_payment_methods($branch_id);
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        
        if (!empty($payments)) {
            foreach ($payments as $key=>$value) {
                $selected = $key == $expenditure_via ? $select : '';
                $str .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
            }
        }
        echo $str;
        
    }
    
   
}
