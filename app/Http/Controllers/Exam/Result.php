<?php

namespace App\Http\Controllers\Exam;


/* * *****************Result.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Result
 * @description     : Manage exam final result and prepare promotion to next class.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Result extends \App\Legacy\MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Result_Model', 'result', true);
    }

    
        
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Exam result sheet" user interface                 
    *                    with class/section wise filtering option    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        check_permission(VIEW);

        if ($_POST) {

            $branch_id = $this->input->post('branch_id');
            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            
            
            if(!$this->academic_year_id){
                error($this->lang->line('please_set_academic_year'));
                ci_redirect('exam/result');
            }            
             
            $this->data['students'] = $this->result->get_student_list($branch_id, $exam_id, $class_id, $section_id, $this->academic_year_id);

            $condition = array(
                'branch_id' => $branch_id,
                'exam_id' => $exam_id,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'academic_year_id' => $this->academic_year_id
            );

            $data = $condition;
            if (!empty($this->data['students'])) {

                foreach ($this->data['students'] as $obj) {

                    $condition['student_id'] = $obj->id;
                    $result = $this->result->get_single('results', $condition);

                    if (empty($result)) {
                        $data['student_id'] = $obj->id;
                        $data['status'] = 1;
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $data['created_by'] = logged_in_user_id();
                        $this->result->insert('results', $data);
                    }
                }
            }

            $this->data['grades'] = $this->result->get_list('grades', array('status' => 1, 'branch_id'=>$branch_id), '', '', '', 'id', 'ASC');
            
            $this->data['branch_id'] = $branch_id;
            $this->data['exam_id'] = $exam_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
        }
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){ 
            
            $condition['branch_id'] = $this->session->userdata('branch_id');
            
            
            $this->data['classes'] = $this->result->get_list('classes', $condition, '','', '', 'id', 'ASC');
            $condition['academic_year_id'] = $this->academic_year_id;
            $this->data['exams'] = $this->result->get_list('exams', array('status' => 1, 'academic_year_id' => $this->academic_year_id), '', '', '', 'id', 'ASC');
        } 

        $this->layout->title($this->lang->line('manage_exam_result') . ' | ' . SMS);
        $this->layout->view('result/index', $this->data);
    }

    
    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Process exam result and save into database                  
    *                    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);

        if ($_POST) {

            $branch_id = $this->input->post('branch_id');
            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            
             
            $condition = array(
                'branch_id' => $branch_id,
                'exam_id' => $exam_id,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'academic_year_id' => $this->academic_year_id,
            );

            $data = $condition;

            if (!empty($_POST['students'])) {

                foreach ($_POST['students'] as $key => $value) {

                    $condition['student_id'] = $value;
                    $data['exam_total_mark'] = $_POST['exam_total_mark'][$value];
                    $data['obtain_total_mark'] = $_POST['obtain_total_mark'][$value];
                    $data['avg_grade_point'] = $_POST['avg_grade_point'][$value];
                    $data['remark'] = $_POST['remark'][$value];
                    $data['status'] = 1;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['created_by'] = logged_in_user_id();
                    $this->result->update('results', $data, $condition);
                }
            }
            success($this->lang->line('insert_success'));
            ci_redirect('exam/result');
        }

        $this->layout->title($this->lang->line('manage_exam_result') . ' | ' . SMS);
        $this->layout->view('result/index', $this->data);
    }

}
