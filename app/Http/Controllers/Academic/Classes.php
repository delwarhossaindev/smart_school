<?php

namespace App\Http\Controllers\Academic;


/* * *****************Classes.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Classes
 * @description     : Manage academic class.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Classes extends \App\Legacy\MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
        $this->load->model('Classes_Model', 'classes', true);
       
    }

    
    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : load "class listing" in user interface
     *                       
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
    public function index($branch_id = null) {
        
        $this->output->delete_cache();
        
        check_permission(VIEW);
        $this->data['classes'] = $this->classes->get_class_list($branch_id);  
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');        
            $this->data['teachers'] = $this->classes->get_list('teachers', $condition, '','', '', 'id', 'ASC');
        }   
        
        $this->data['filter_branch_id'] = $branch_id;
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_class'). ' | ' . SMS);
        $this->layout->view('class/index', $this->data);            
       
    }

     /*****************Function add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : load "add new class" user interface and 
                          process to save "new class" into database
     *                       
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
    public function add() {
        
        check_permission(ADD);
        
        if ($_POST) {
            $this->_prepare_class_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_class_data();

                $insert_id = $this->classes->insert('classes', $data);
                if ($insert_id) {
                    
                    create_log('Has been created a class :'.$data['name']);                    
                    success($this->lang->line('insert_success'));
                    $this->__create_default_section($insert_id);
                    ci_redirect($this->is_supper_admin ? 'academic/classes/index/'.$data['branch_id'] : 'academic/classes/index');
                    
                } else {
                    error($this->lang->line('insert_failed'));
                    ci_redirect($this->is_supper_admin ? 'academic/classes/add/'.$data['branch_id'] : 'academic/classes/add');
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
        $this->data['classes'] = $this->classes->get_class_list($branch_id);      
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');        
            $this->data['teachers'] = $this->classes->get_list('teachers', $condition, '','', '', 'id', 'ASC');
        }        
        $this->data['filter_branch_id'] = $branch_id;
        
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add'). ' | ' . SMS );
        $this->layout->view('class/index', $this->data);
    }

     /*****************Function edit**********************************
     * @type            : Function
     * @function name   : edit
     * @description     : load "update class" user interface and
                          process to update "class" into database 
     *                       
     * @param           : $id integetr value 
     * @return          : null 
     * ********************************************************** */
    public function edit($id = null) {       
       
        check_permission(EDIT);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
           ci_redirect('academic/classes/index');  
        }
        
        if ($_POST) {
            $this->_prepare_class_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_class_data();
                $updated = $this->classes->update('classes', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    create_log('Has been updated a class :'.$data['name']);                    
                    success($this->lang->line('update_success'));
                    ci_redirect($this->is_supper_admin ? 'academic/classes/index/'.$data['branch_id'] : 'academic/classes/index');                   
                } else {
                    error($this->lang->line('update_failed'));
                    ci_redirect('academic/classes/edit/' . $this->input->post('id'));
                }
            } else {
                error($this->lang->line('update_failed'));
                $this->data['class'] = $this->classes->get_single('classes', array('id' => $this->input->post('id')));
            }
        }
        
        if ($id) {
            $this->data['class'] = $this->classes->get_single('classes', array('id' => $id));

            if (!$this->data['class']) {
                 ci_redirect('academic/classes/index');
            }
        }

        $this->data['classes'] = $this->classes->get_class_list($this->data['class']->branch_id);   
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');        
            $this->data['teachers'] = $this->classes->get_list('teachers', $condition, '','', '', 'id', 'ASC');
        } 
        
        $this->data['branch_id'] = $this->data['class']->branch_id;
        $this->data['filter_branch_id'] = $this->data['class']->branch_id;
        
        $this->data['edit'] = TRUE;       
        $this->layout->title($this->lang->line('edit').' | ' . SMS );
        $this->layout->view('class/index', $this->data);
    }

    /*****************Function _prepare_class_validation**********************************
     * @type            : Function
     * @function name   : _prepare_class_validation
     * @description     : Process "class" user input data validation
     *                       
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
    private function _prepare_class_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('branch_id', $this->lang->line('branch_name'), 'trim|required');   
        $this->form_validation->set_rules('teacher_id', $this->lang->line('class_teacher'), 'trim|required');   
        $this->form_validation->set_rules('numeric_name', $this->lang->line('numeric_name'), 'trim');     
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|callback_name');
    }
    
    /*****************Function name**********************************
     * @type            : Function
     * @function name   : name
     * @description     : unique check for "Class name"
     *                       
     * @param           : null 
     * @return          : boolean true/flase 
     * ********************************************************** */
    public function name()
   {             
      if($this->input->post('id') == '')
      {   
          $name = $this->classes->duplicate_check($this->input->post('branch_id'), $this->input->post('name')); 
          if($name){
                $this->form_validation->set_message('name', $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }          
      }else if($this->input->post('id') != ''){   
         $name = $this->classes->duplicate_check($this->input->post('branch_id'), $this->input->post('name'), $this->input->post('id')); 
          if($name){
                $this->form_validation->set_message('name', $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }
      }   
   }


     /*****************Function _get_posted_class_data**********************************
     * @type            : Function
     * @function name   : _get_posted_class_data
     * @description     : Prepare "Class" user input data to save into database 
     *                       
     * @param           : null 
     * @return          : $data array() value 
     * ********************************************************** */
    private function _get_posted_class_data() {

        $items = array();
        $items[] = 'branch_id';
        $items[] = 'teacher_id';
        $items[] = 'name';
        $items[] = 'numeric_name';        
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
     * @description     : delete "class" data from database
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function delete($id = null) {
        
        check_permission(DELETE);
        
        if(!is_numeric($id)){
             error($this->lang->line('unexpected_error'));
             ci_redirect('academic/classes/index');    
        }
        
        $class = $this->classes->get_single('classes', array('id' => $id));
        
         // will check following database tables is class is used or not
        $tables = array(
            'admissions', 'assignments','assignment_submissions', 'ebooks', 'enrollments','invoices',
            'study_materials', 'subjects', 'suggestions', 'syllabuses', 'video_lectures', 'subjects',
            'exam_attendances','exam_results','exam_schedules', 'fees_amount','final_results','marks','results',
        );
        
        foreach ($tables as $table) {
            
            $exist = $this->classes->get_single($table, array('class_id' => $id)); 
            if(!empty($exist)){
                error($this->lang->line('this_class_already_used'));
                ci_redirect($this->is_supper_admin ? 'academic/classes/index/'.$class->branch_id : 'academic/classes/index');
            }
        }
         
        
        if ($this->classes->delete('classes', array('id' => $id))) {            
            
             // remove some data related to class                        
            $tables = array(
                'book_issues','complains','leave_applications', 'live_classes', 'mark_emails','mark_smses', 'routines',
                'student_activities', 'student_attendances', 'visitors', 'sections'
            );

            foreach ($tables as $table) {
                $this->classes->delete($table, array('class_id' => $id));
            }
            create_log('Has been deleted a class : '. $class->name);            
            success($this->lang->line('delete_success'));
            
        } else {
            error($this->lang->line('delete_failed'));
        }
        
        ci_redirect($this->is_supper_admin ? 'academic/classes/index/'.$class->branch_id : 'academic/classes/index');
        
    }
    
    /*****************Function __create_default_section**********************************
     * @type            : Function
     * @function name   : __create_default_section
     * @description     : create default section while create a new class
     *                       
     * @param           : $insert_id integer value
     * @return          : null 
     * ********************************************************** */
    private function __create_default_section($insert_id){
        
       
        $data = array();
        $data['branch_id']  = $this->input->post('branch_id');
        $data['class_id']    = $insert_id;
        $data['teacher_id']  = $this->input->post('teacher_id');
        $data['name']       = 'A';
        $data['note']       = 'Default Section';
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();
        $data['status']     = 1; 
        $this->classes->insert('sections', $data);
    }
}
