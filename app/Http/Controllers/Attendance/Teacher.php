<?php

namespace App\Http\Controllers\Attendance;


/* * *****************Teacher.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Teacher
 * @description     : Manage teacher daily attendance.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Teacher extends \App\Legacy\MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Teacher_Model', 'teacher', true);
    }

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Teacher Attendance" user interface                 
    *                    and Process to manage daily Teacher attendance    
    * @param           : null
    * @return          : null 
    * ********************************************************** */ 
    public function index() {

        check_permission(VIEW);

        if ($_POST) {

            $date = $this->input->post('date');
            $month = date('m', strtotime($this->input->post('date')));
            $year = date('Y', strtotime($this->input->post('date')));
            $branch_id = $this->input->post('branch_id');
            
            if(!$this->academic_year_id){
                error($this->lang->line('please_set_academic_year'));
                ci_redirect('attendance/teacher/index');
            }
            $academic_year_id = $this->academic_year_id;            
            
            $this->data['teachers'] = $this->teacher->get_teacher_list($branch_id);


            $condition = array(
                'branch_id' => $branch_id,
                'month' => $month,
                'year' => $year
            );

            $data = $condition;
            if (!empty($this->data['teachers'])) {

                foreach ($this->data['teachers'] as $obj) {

                    $condition['teacher_id'] = $obj->id;

                    $attendance = $this->teacher->get_single('teacher_attendances', $condition);

                    if (empty($attendance)) {                       
                        $data['academic_year_id'] = $academic_year_id;
                        $data['teacher_id'] = $obj->id;
                        $data['status'] = 1;
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $data['created_by'] = logged_in_user_id();
                        $this->teacher->insert('teacher_attendances', $data);
                    }
                }
            }

            $this->data['branch_id'] = $branch_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['day'] = date('d', strtotime($this->input->post('date')));
            $this->data['month'] = date('m', strtotime($this->input->post('date')));
            $this->data['year'] = date('Y', strtotime($this->input->post('date')));

            $this->data['date'] = $date;
            create_log('Has been process Teacher Attendance'); 
        }

        $this->layout->title($this->lang->line('teacher_attendance') . ' | ' . SMS);
        $this->layout->view('teacher/index', $this->data);
    }



    /*****************Function update_single_attendance**********************************
    * @type            : Function
    * @function name   : update_single_attendance
    * @description     : Process to update single teacher attendance status               
    *                        
    * @param           : null
    * @return          : null 
    * ********************************************************** */ 
    public function update_single_attendance() {

        $status = $this->input->post('status');
        $condition['branch_id'] = $this->input->post('branch_id');      
        $condition['teacher_id'] = $this->input->post('teacher_id');      
        $condition['month'] = date('m', strtotime($this->input->post('date')));
        $condition['year'] = date('Y', strtotime($this->input->post('date')));
        
        if(!$this->academic_year_id){
           echo 'ay';
           ci_exit();
        }
        $condition['academic_year_id'] = $this->academic_year_id;

        $field = 'day_' . abs(date('d', strtotime($this->input->post('date'))));
        if ($this->teacher->update('teacher_attendances', array($field => $status, 'modified_at'=>date('Y-m-d H:i:s')), $condition)) {
            echo TRUE;
        } else {
            echo FALSE;
        }
    }

    
    
    /*****************Function update_all_attendance**********************************
    * @type            : Function
    * @function name   : update_all_attendance
    * @description     : Process to update all teacher attendance status                 
    *                        
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function update_all_attendance() {

        $status = $this->input->post('status');

        $condition['branch_id'] = $this->input->post('branch_id');
        $condition['month'] = date('m', strtotime($this->input->post('date')));
        $condition['year'] = date('Y', strtotime($this->input->post('date')));
        
        if(!$this->academic_year_id){
           echo 'ay';
           ci_exit();
        }
        $condition['academic_year_id'] = $this->academic_year_id;

        $field = 'day_' . abs(date('d', strtotime($this->input->post('date'))));
        if ($this->teacher->update('teacher_attendances', array($field => $status, 'modified_at'=>date('Y-m-d H:i:s')), $condition)) {
            echo TRUE;
        } else {
            echo FALSE;
        }
    }

}
