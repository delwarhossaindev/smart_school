<?php

namespace App\Http\Controllers\Exam;


/* * *****************Marksheet.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Marksheet
 * @description     : Manage exam mark sheet.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Marksheet extends \App\Legacy\MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Marksheet_Model', 'mark', true);
    }

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Mark sheet" user interface                 
    *                    with data filter option
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        check_permission(VIEW);

        if ($_POST) {

            if($this->session->userdata('role_id') == STUDENT){
                
                $student = get_user_by_role($this->session->userdata('role_id'), $this->session->userdata('id'));
                
                $branch_id = $student->branch_id;
                $class_id = $student->class_id;
                $section_id = $student->section_id;
                $student_id = $student->id;
                
            }else{
                
                $branch_id = $this->input->post('branch_id');
                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $student_id = $this->input->post('student_id');
                
                $std = $this->mark->get_single('students', array('id'=>$student_id));
                $student = get_user_by_role(STUDENT, $std->user_id);
            }
            
            $exam_id = $this->input->post('exam_id');
            $exam = $this->mark->get_single('exams', array('id'=>$exam_id));
            
            $school = $this->mark->get_school_by_id($branch_id);
            
            if(!$this->academic_year_id){
                error($this->lang->line('please_set_academic_year'));
                ci_redirect('exam/marksheet');
            }
            
            $this->data['subjects'] = $this->mark->get_subject_list($branch_id, $exam_id, $class_id, $section_id, $student_id, $this->academic_year_id);
            $this->data['grades'] = $this->mark->get_list('grades', array('status' => 1), '', '', '', 'id', 'ASC');

            $this->data['school'] = $school;
            $this->data['exam'] = $exam;
            $this->data['student'] = $student;
            $this->data['branch_id'] = $branch_id;
            $this->data['exam_id'] = $exam_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['student_id'] = $student_id;
            $this->data['academic_year_id'] = $this->academic_year_id;
            
            $class = $this->mark->get_single('classes', array('id'=>$class_id));
            create_log('Has been filter exam mark sheet for class: '. $class->name);
            
        }
        
       
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){ 
            
            $this->data['exams'] = $this->mark->get_list('exams', array('status'=>1, 'academic_year_id'=>$this->academic_year_id), '', '', '', 'id', 'ASC');
            $condition['branch_id'] = $this->session->userdata('branch_id');
            
            $this->data['classes'] = $this->mark->get_list('classes', $condition, '','', '', 'id', 'ASC');            
            $condition['academic_year_id'] = $this->academic_year_id;
        }        

        $this->layout->title( $this->lang->line('manage_mark_sheet') . ' | ' . SMS);
        $this->layout->view('mark_sheet/index', $this->data);
    }

}