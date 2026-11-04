<?php

namespace App\Http\Controllers\Administrator;


/* * *****************Year.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Year
 * @description     : Manage academic year.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Year extends \App\Legacy\MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
         $this->load->model('Year_Model', 'year', true);
    }

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Academic Year List" user interface                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {
        
        check_permission(VIEW);
        
        $this->data['years'] = $this->year->get_year_list();
        $this->data['schools'] = $this->schools;       
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_academic_year'). ' | ' . SMS);
        $this->layout->view('year/index', $this->data);            
       
    }

    
    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Academic Year" user interface                 
    *                    and store "Academic Year" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);
        
        if ($_POST) {
            $this->_prepare_year_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_year_data();

                $insert_id = $this->year->insert('academic_years', $data);
                if ($insert_id) {
                    
                    create_log('Has been created a academic Year : '.$data['session_year']); 
                    success($this->lang->line('insert_success'));
                    ci_redirect('administrator/year/index');
                    
                } else {
                    error($this->lang->line('insert_failed'));
                    ci_redirect('administrator/year/add');
                }
            } else {
                error($this->lang->line('insert_failed'));
                $this->data = $_POST;
            }
        }

        $this->data['years'] = $this->year->get_year_list();
        $this->data['schools'] = $this->schools;
        
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add') . ' | ' . SMS);
        $this->layout->view('year/index', $this->data);
    }

    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Academic Year" user interface                 
    *                    with populated "Academic Year" value 
    *                    and update "Academic Year" database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {   
        
        check_permission(EDIT);
       
        if ($_POST) {
            $this->_prepare_year_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_year_data();
                $updated = $this->year->update('academic_years', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    create_log('Has been updated a academic Year : '.$data['session_year']); 
                    success($this->lang->line('update_success'));
                    ci_redirect('administrator/year/index');    
                    
                } else {
                    error($this->lang->line('update_failed'));
                    ci_redirect('administrator/year/edit/' . $this->input->post('id'));
                }
            } else {
                error($this->lang->line('update_failed'));
                $this->data['year'] = $this->year->get_single('academic_years', array('id' => $this->input->post('id')));
            }
        } else {
            if ($id) {
                $this->data['year'] = $this->year->get_single('academic_years', array('id' => $id));
 
                if (!$this->data['year']) {
                     ci_redirect('administrator/year/index');
                }
                $arr = explode('-', $this->data['year']->session_year);
                $this->data['session_start'] = rtrim($arr[0]);
                $this->data['session_end'] = ltrim($arr[1]);
            }
        }
              
        
        $this->data['years'] = $this->year->get_year_list();
        $this->data['schools'] = $this->schools;        
        $this->data['edit'] = TRUE;       
        $this->layout->title($this->lang->line('edit') . ' | ' . SMS);
        $this->layout->view('year/index', $this->data);
    }

    
    /*****************Function _prepare_year_validation**********************************
    * @type            : Function
    * @function name   : _prepare_year_validation
    * @description     : Process "Academic Year" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_year_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        $this->form_validation->set_rules('session_year', $this->lang->line('academic_year'), 'trim|callback_session_year');
        $this->form_validation->set_rules('session_start', $this->lang->line('session_start'), 'trim|required');
        $this->form_validation->set_rules('session_end', $this->lang->line('session_end'), 'trim|required');
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
    }

            
    /*****************Function session_year**********************************
    * @type            : Function
    * @function name   : session_year
    * @description     : Unique check for "academic year" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function session_year() {
        
        $session_year = $this->input->post('session_start') .' - '. $this->input->post('session_end');
        
        if(strtotime($this->input->post('session_start')) > strtotime($this->input->post('session_end'))){
            $this->form_validation->set_message('session_year', 'Invalid '. $this->lang->line('academic_year'));
            return FALSE;
        }
        
        if ($this->input->post('id') == '') {
            $year = $this->year->duplicate_check($session_year);
            if ($year) {
                $this->form_validation->set_message('session_year', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $year = $this->year->duplicate_check($session_year, $this->input->post('id'));
            if ($year) {
                $this->form_validation->set_message('session_year', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
    
    /*****************Function _get_posted_year_data**********************************
     * @type            : Function
     * @function name   : _get_posted_year_data
     * @description     : Prepare "Academic Year" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_year_data() {

        $items = array();
        $items[] = 'note';
        $data = elements($items, $_POST);     
             
        $data['start_year'] = preg_replace('/\D/', '', $this->input->post('session_start'));
        $data['end_year']   = preg_replace('/\D/', '', $this->input->post('session_end'));
        $data['session_year']   = $this->input->post('session_start') .' - '. $this->input->post('session_end');
        
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['is_running'] = 0;
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
   * @description     : delete "Academic Year" from database                  
   *                       
   * @param           : $id integer value
   * @return          : null 
   * ********************************************************** */
    public function delete($id = null) {
        
        
        check_permission(DELETE);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            ci_redirect('administrator/year/index');              
        }
        
        $academic_year = $this->year->get_single('academic_years', array('id' => $id));
        
        
        // will check following database tables is academic year already used or not
         $tables = array(
             'assignments','assignment_submissions','book_issues','complains','emails','employee_attendances','enrollments',
             'exams','exam_attendances','exam_results','exam_schedules','expenditures','final_results','invoices',
             'leave_applications','live_classes','mark_emails','marks','mark_smses','messages','results','routines',
             'salary_payments','student_activities','student_attendances','suggestions','syllabuses','teacher_attendances',
             'text_messages','transactions','video_lectures','visitors'
            );
        
        foreach ($tables as $table) {
            
            $exist = $this->year->get_single($table, array('academic_year_id' => $id)); 
            if(!empty($exist)){
                error($this->lang->line('this_academic_year_already_used'));
                ci_redirect('administrator/year/index');
            }
        }   
        
        if ($this->year->delete('academic_years', array('id' => $id))) {  
            
            create_log('Has been deleted a academic Year : '.$academic_year->session_year); 
            success($this->lang->line('delete_success'));
            
        } else {
            error($this->lang->line('delete_failed'));
        }
        
        ci_redirect('administrator/year/index');
    }
    
     /*     * **************Function activate**********************************
     * @type            : Function
     * @function name   : activate
     * @description     : this function used to activate current session       *                                
     * @param           : $id integer value; 
     * @return          : null 
     * ********************************************************** */

    public function activate($id = null) {

        check_permission(EDIT);

        if ($id == '') {
            error($this->lang->line('update_failed'));
            ci_redirect('administrator/year');
        }
        
        $this->year->update('academic_years', array('is_running' => 0), array());
        $this->year->update('academic_years', array('is_running' => 1), array('id' => $id));       
         
        create_log('Has been activated a academic Year :( id )'. $id);
        success($this->lang->line('update_success'));
        ci_redirect('administrator/year/index');
    }

}
