<?php

namespace App\Http\Controllers;


/* * ***************Ajax.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Ajax
 * @description     : This class used to handle ajax call from view file 
 *                    of whole application.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Ajax extends \App\Legacy\MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('Ajax_Model', 'ajax', true);
    }

    /**     * *************Function get_user_by_role**********************************
     * @type            : Function
     * @function name   : get_user_by_role
     * @description     : this function used to manage user role list for user interface   
     * @param           : null 
     * @return          : $str string value with user role list 
     * ********************************************************** */
    public function get_user_by_role() {

        $role_id = $this->input->post('role_id');
        $branch_id = $this->input->post('branch_id');
        $class_id = $this->input->post('class_id');
        $user_id = $this->input->post('user_id');
        $message = $this->input->post('message');
        //$type = $this->input->post('type');

         
        $users = array();
        if ($role_id == SUPER_ADMIN) {
            $users = $this->ajax->get_list('system_admin', array('status' => 1), '', '', '', 'id', 'ASC');
        }elseif ($role_id == TEACHER) {
            $users = $this->ajax->get_list('teachers', array('status' => 1,'branch_id'=>$branch_id), '', '', '', 'id', 'ASC');
        } elseif ($role_id == GUARDIAN) {
            $users = $this->ajax->get_list('guardians', array('status' => 1,'branch_id'=>$branch_id), '', '', '', 'id', 'ASC');
        } elseif ($role_id == STUDENT) {
            $users = $this->ajax->get_student_list($class_id, $branch_id, $this->academic_year_id);
        } else {

            $this->db->select('E.*');
            $this->db->from('employees AS E');
            $this->db->join('users AS U', 'U.id = E.user_id', 'left');
            $this->db->where('U.role_id', $role_id);
            $this->db->where('E.branch_id', $branch_id);
            $users = $this->db->get()->result();            
        }

        echo $this->db->last_query();
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        if (!$message && !empty($users)) {
            $str .= '<option value="0">' . $this->lang->line('all') . '</option>';
        }

        $select = 'selected="selected"';
        if (!empty($users)) {
            foreach ($users as $obj) {
                
                if(logged_in_user_id() == $obj->user_id && $message){continue;}
                
                $selected = $user_id == $obj->user_id ? $select : '';
                $str .= '<option value="' . $obj->user_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->id . ')</option>';
            }
        }

        echo $str;
    }

    /*     * **************Function get_tag_by_role**********************************
     * @type            : Function
     * @function name   : get_tag_by_role
     * @description     : this function used to manage user role tag list for user interface   
     * @param           : null 
     * @return          : $str string value with user role tag list 
     * ********************************************************** */

    public function get_tag_by_role() {

        $role_id = $this->input->post('role_id');
        $tags = get_template_tags($role_id);
        $str = '';
        foreach ($tags as $value) {
            $str .= $value.' ';
        }

        echo $str;
    }

    /**     * *************Function update_user_status**********************************
     * @type            : Function
     * @function name   : update_user_status
     * @description     : this function used to update user status   
     * @param           : null 
     * @return          : boolean true/false 
     * ********************************************************** */
    public function update_user_status() {

        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');
        if ($this->ajax->update('users', array('status' => $status), array('id' => $user_id))) {
            echo TRUE;
        } else {
            echo FALSE;
        }
    }

    /**     * *************Function get_student_by_class**********************************
     * @type            : Function
     * @function name   : get_student_by_class
     * @description     : this function used to populate student list by class 
      for user interface
     * @param           : null 
     * @return          : $str string  value with student list
     * ********************************************************** */
    public function get_student_by_class() {

        $branch_id = $this->input->post('branch_id');
        $class_id = $this->input->post('class_id');
        $student_id = $this->input->post('student_id');
        $is_bulk = $this->input->post('is_bulk');
         
        $students = $this->ajax->get_student_list($class_id, $branch_id, $this->academic_year_id);

        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        if($is_bulk){
             $str .= '<option value="all">' . $this->lang->line('all') . '</option>';
        }
        
        $select = 'selected="selected"';
        if (!empty($students)) {
            foreach ($students as $obj) {
                $selected = $student_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . ' [' . $obj->roll_no . ']</option>';
            }
        }

        echo $str;
    }

    
    
    /**     * *************Function get_section_by_class**********************************
     * @type            : Function
     * @function name   : get_section_by_class
     * @description     : this function used to populate section list by class 
      for user interface
     * @param           : null 
     * @return          : $str string  value with section list
     * ********************************************************** */
      public function get_section_by_class() {

        $branch_id = $this->input->post('branch_id');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        
        $sections = $this->ajax->get_list('sections', array('status' => 1, 'branch_id'=>$branch_id, 'class_id' => $class_id), '', '', '', 'id', 'ASC');
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
    
        $guardian_section_data = get_guardian_access_data('section');
        $teacher_access_data = get_teacher_access_data();
        
        $select = 'selected="selected"';
        if (!empty($sections)) {
            foreach ($sections as $obj) {
                
               if ($this->session->userdata('role_id') == GUARDIAN && !in_array($obj->id, $guardian_section_data)) { continue; } 
                elseif ($this->session->userdata('role_id') == TEACHER && !in_array($obj->class_id, $teacher_access_data)) { continue; } 
               
                $selected = $section_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . '</option>';
            }
        }

        echo $str;
    }

    /*     * **************Function get_student_by_section**********************************
     * @type            : Function
     * @function name   : get_student_by_section
     * @description     : this function used to populate student list by section 
      for user interface
     * @param           : null 
     * @return          : $str string  value with student list
     * ********************************************************** */

    public function get_student_by_section() {

        $student_id = $this->input->post('student_id');
        $section_id = $this->input->post('section_id');
        $branch_id = $this->input->post('branch_id');
        $is_all = $this->input->post('is_all');

        $students = $this->ajax->get_student_list_by_section($branch_id, $section_id, 'regular');
        echo $this->db->last_query();
        if($is_all){
            $str = '<option value="0">' . $this->lang->line('all_student') . '</option>';    
        }else{
            $str = '<option value="">--' . $this->lang->line('select') . '--</option>';            
        }
        
        $select = 'selected="selected"';
        if (!empty($students)) {
            foreach ($students as $obj) {
                $selected = $student_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . ' [' . $obj->roll_no . ']</option>';
            }
        }

        echo $str;
    }

    /**     * *************Function get_subject_by_class**********************************
     * @type            : Function
     * @function name   : get_subject_by_class
     * @description     : this function used to populate subject list by class 
      for user interface
     * @param           : null 
     * @return          : $str string  value with subject list
     * ********************************************************** */
    public function get_subject_by_class() {

        $branch_id = $this->input->post('branch_id');
        $class_id = $this->input->post('class_id');
        $subject_id = $this->input->post('subject_id');
       
        if($this->session->userdata('role_id') == TEACHER){
            $subjects = $this->ajax->get_list('subjects', array('status' => 1, 'class_id' => $class_id, 'branch_id'=>$branch_id,  'teacher_id'=>$this->session->userdata('profile_id')), '', '', '', 'id', 'ASC');
        }else{
            $subjects = $this->ajax->get_list('subjects', array('status' => 1, 'class_id' => $class_id, 'branch_id'=>$branch_id), '', '', '', 'id', 'ASC');
        }
       
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
       
        $select = 'selected="selected"';
        if(!empty($subjects)) {
            foreach ($subjects as $obj) {
                $selected = $subject_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . '</option>';
            }
        }

        echo $str;
    }

    /**     * *************Function get_assignment_by_subject**********************************
     * @type            : Function
     * @function name   : get_assignment_by_subject
     * @description     : this function used to populate assignment list by subject 
      for user interface
     * @param           : null 
     * @return          : $str string  value with assignment list
     * ********************************************************** */
    public function get_assignment_by_subject() {

        $subject_id = $this->input->post('subject_id');
        echo $assignment_id = $this->input->post('assignment_id');

        $assignments = $this->ajax->get_list('assignments', array('status' => 1, 'subject_id' => $subject_id, 'academic_year_id' => $this->academic_year_id), '', '', '', 'id', 'ASC');
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($assignments)) {
            foreach ($assignments as $obj) {
                $selected = $assignment_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->title . '</option>';
            }
        }

        echo $str;
    }

    /**     * *************Function get_guardian_by_id**********************************
     * @type            : Function
     * @function name   : get_guardian_by_id
     * @description     : this function used to populate guardian information/value by id 
      for user interface
     * @param           : null 
     * @return          : $guardina json  value
     * ********************************************************** */
    public function get_guardian_by_id() {

        header('Content-Type: application/json');
        $guardian_id = $this->input->post('guardian_id');

        $guardian = $this->ajax->get_single('guardians', array('id' => $guardian_id));
        echo json_encode($guardian);
        ci_exit();
    }

    /**     * *************Function get_room_by_hostel**********************************
     * @type            : Function
     * @function name   : get_room_by_hostel
     * @description     : this function used to populate room list by hostel  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_room_by_hostel() {

        $hostel_id = $this->input->post('hostel_id');

        $hostels = $this->ajax->get_list('rooms', array('status' => 1, 'hostel_id' => $hostel_id), '', '', '', 'id', 'ASC');
        $str = '<option value="">--.' . $this->lang->line('select_room_no') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($hostels)) {
            foreach ($hostels as $obj) {
                $selected = $subject_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->room_no . ' [' . $this->lang->line($obj->room_type) . '] [ ' . $obj->cost . ' ]</option>';
            }
        }

        echo $str;
    }
    
    
    /*****************Function get_user_list_by_type**********************************
     * @type            : Function
     * @function name   : get_user_list_by_type
     * @description     : Load "Employee or Teacher Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_user_list_by_type() {
        
         $branch_id  = $this->input->post('branch_id');
         $user_type  = $this->input->post('user_type');
         $user_id  = $this->input->post('user_id');
         
         $users = $this->ajax->get_user_list($branch_id, $user_type );
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($users)) {
            foreach ($users as $obj) {   
                $selected = $user_id == $obj->user_id ? $select : '';
                $str .= '<option value="' . $obj->user_id . '" ' . $selected . '>' . $obj->name .' [ '. $obj->designation . ' ]</option>';
            }
        }

        echo $str;
    }
    
  
    /*--------------START -------------------------*/
    
    /*****************Function get_designation_by_school**********************************
     * @type            : Function
     * @function name   : get_designation_by_school
     * @description     : Load "Designation Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_designation_by_school() {
        
         $designation_id  = $this->input->post('designation_id');
         
        $designations = $this->ajax->get_list('designations', array('status'=>1), '','', '', 'id', 'ASC'); 
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($designations)) {
            foreach ($designations as $obj) {   
                
                $selected = $designation_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name .' </option>';
                
            }
        }

        echo $str;
    }
    
    
    /*****************Function get_salary_grade_by_school**********************************
     * @type            : Function
     * @function name   : get_salary_grade_by_school
     * @description     : Load "Salary grade Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_salary_grade_by_school() {
        
         $branch_id  = $this->input->post('branch_id');
         $salary_grade_id  = $this->input->post('salary_grade_id');
         
        $salary_grades = $this->ajax->get_list('salary_grades', array('status'=>1, 'branch_id'=>$branch_id), '','', '', 'id', 'ASC'); 
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($salary_grades)) {
            foreach ($salary_grades as $obj) {   
                
                $selected = $salary_grade_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->grade_name .' </option>';
                
            }
        }

        echo $str;
    }
    
    
    /*****************Function get_teacher_by_school**********************************
     * @type            : Function
     * @function name   : get_teacher_by_school
     * @description     : Load "Teacher Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_teacher_by_school() {
        
         $branch_id  = $this->input->post('branch_id');
         $teacher_id  = $this->input->post('teacher_id');
         $is_all  = $this->input->post('is_all');
         
        $teachers = $this->ajax->get_list('teachers', array('status'=>1, 'branch_id'=>$branch_id), '','', '', 'id', 'ASC'); 
         
        if($is_all){
            $str = '<option value="0">' . $this->lang->line('all_teacher') . '</option>';    
        }else{
            $str = '<option value="">--' . $this->lang->line('select') . '--</option>';            
        }
        
        $select = 'selected="selected"';
        if (!empty($teachers)) {
            foreach ($teachers as $obj) {   
                
                $selected = $teacher_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name .' [ '. $obj->responsibility . ' ]</option>';
                
            }
        }

        echo $str;
    }
    
    /*****************Function get_employee_by_school**********************************
     * @type            : Function
     * @function name   : get_employee_by_school
     * @description     : Load "Employee Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_employee_by_school() {
        
         $branch_id  = $this->input->post('branch_id');
         $employee_id  = $this->input->post('employee_id');
         $is_all  = $this->input->post('is_all');
         
        $employees = $this->ajax->get_list('employees', array('status'=>1, 'branch_id'=>$branch_id), '','', '', 'id', 'ASC'); 
         
         if($is_all){
            $str = '<option value="0">' . $this->lang->line('all_employee') . '</option>';    
        }else{
            $str = '<option value="">--' . $this->lang->line('select') . '--</option>';            
        }
        
        $select = 'selected="selected"';
        if (!empty($employees)) {
            foreach ($employees as $obj) {   
                
                $selected = $employee_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name .'</option>';
                
            }
        }

        echo $str;
    }
    
    
    /*****************Function get_guardian_by_school**********************************
     * @type            : Function
     * @function name   : get_guardian_by_school
     * @description     : Load "Guardian Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_guardian_by_school() {
        
         $branch_id  = $this->input->post('branch_id');
         $guardian_id  = $this->input->post('guardian_id');
         
        $guardinas = $this->ajax->get_list('guardians', array('status'=>1, 'branch_id'=>$branch_id), '','', '', 'id', 'ASC'); 
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($guardinas)) {
            foreach ($guardinas as $obj) {   
                
                $selected = $guardian_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . '</option>';
                
            }
        }

        echo $str;
    }
    
    
    /*****************Function get_discount_by_school**********************************
     * @type            : Function
     * @function name   : get_discount_by_school
     * @description     : Load "Discount Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_discount_by_school() {
        
         $branch_id  = $this->input->post('branch_id');
         $discount_id  = $this->input->post('discount_id');
         
        $discounts = $this->ajax->get_list('discounts', array('status'=>1, 'branch_id'=>$branch_id), '','', '', 'id', 'ASC'); 
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($discounts)) {
            foreach ($discounts as $obj) {   
                
                $selected = $discount_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->title . ' [' . $this->lang->line($obj->discount_type.'_amount'). ']</option>';
                
            }
        }

        echo $str;
    }
    
    
    
    /*****************Function get_student_type_by_school**********************************
     * @type            : Function
     * @function name   : get_student_type_by_school
     * @description     : Load "Student type Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_student_type_by_school() {
        
        $type_id  = $this->input->post('type_id');
         
        $types = $this->ajax->get_list('student_types', array('status'=>1), '','', '', 'id', 'ASC'); 
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($types)) {
            foreach ($types as $obj) {   
                
                $selected = $type_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->type . '</option>';
                
            }
        }

        echo $str;
    }
    
    
    /*****************Function get_class_by_school**********************************
     * @type            : Function
     * @function name   : get_class_by_school
     * @description     : Load "Class Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_class_by_school() {
        
        $branch_id  = $this->input->post('branch_id');
        $class_id  = $this->input->post('class_id');
         
        $classes = $this->ajax->get_list('classes', array('status'=>1, 'branch_id'=>$branch_id), '','', '', 'id', 'ASC'); 
         
        $teacher_access_data  = get_teacher_access_data();
        $guardian_class_data = get_guardian_access_data('class');  
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($classes)) {
            foreach ($classes as $obj) { 
                
                if ($this->session->userdata('role_id') == GUARDIAN && !in_array($obj->id, $guardian_class_data)) { continue; } 
                elseif ($this->session->userdata('role_id') == TEACHER && !in_array($obj->id, $teacher_access_data)) { continue; } 
                elseif ($this->session->userdata('role_id') == STUDENT && $obj->id != $this->session->userdata('class_id')) { continue; } 
                
                $selected = $class_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . '</option>';
                
            }
        }

        echo $str;
    }
    
    
    /*****************Function get_exam_by_school**********************************
     * @type            : Function
     * @function name   : get_exam_by_school
     * @description     : Load "Exam Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_exam_by_school() {
                
        $exam_id  = $this->input->post('exam_id');         
        $exams = $this->ajax->get_list('exams', array('status' => 1, 'academic_year_id' => $this->academic_year_id), '','', '', 'id', 'ASC'); 
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($exams)) {
            foreach ($exams as $obj) {   
                
                $selected = $exam_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->title . '</option>';
                
            }
        }

        echo $str;
    }
    
    
    

    /*****************Function get_gallery_by_school**********************************
     * @type            : Function
     * @function name   : get_gallery_by_school
     * @description     : Load "Gallery Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_gallery_by_school() {
        
         $branch_id  = $this->input->post('branch_id');
         $gallery_id  = $this->input->post('gallery_id');
         
        $galleries = $this->ajax->get_list('galleries', array('status'=>1, 'branch_id'=>$branch_id), '','', '', 'id', 'ASC'); 
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($galleries)) {
            foreach ($galleries as $obj) {   
                
                $selected = $gallery_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->title . '</option>';
                
            }
        }

        echo $str;
    }
    
    /*****************Function get_leave_type_by_school**********************************
     * @type            : Function
     * @function name   : get_leave_type_by_school
     * @description     : Load "Leave type Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_leave_type_by_school() {
        
         $role_id  = $this->input->post('role_id');
         $type_id  = $this->input->post('type_id');
         
        $types = $this->ajax->get_list('leave_types', array('status'=>1, 'role_id'=>$role_id), '','', '', 'id', 'ASC'); 
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($types)) {
            foreach ($types as $obj) {   
                
                $selected = $type_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->type . '</option>';
                
            }
        }

        echo $str;
    }
    
    /*****************Function get_visitor_purpose_by_school**********************************
     * @type            : Function
     * @function name   : get_visitor_purpose_by_school
     * @description     : Load "Visitor purpose Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_visitor_purpose_by_school() {
        
         $purpose_id  = $this->input->post('purpose_id');
         
        $purposes = $this->ajax->get_list('visitor_purposes', array('status'=>1), '','', '', 'id', 'ASC'); 
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($purposes)) {
            foreach ($purposes as $obj) {   
                
                $selected = $purpose_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->purpose . '</option>';
                
            }
        }

        echo $str;
    }
    
    
    /*****************Function get_complain_type_by_school**********************************
     * @type            : Function
     * @function name   : get_complain_type_by_school
     * @description     : Load "Complain type Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_complain_type_by_school() {
        
         $type_id  = $this->input->post('type_id');
         
        $types = $this->ajax->get_list('complain_types', array('status'=>1), '','', '', 'id', 'ASC'); 
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($types)) {
            foreach ($types as $obj) {   
                
                $selected = $type_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->type . '</option>';
                
            }
        }

        echo $str;
    }
    
    
    /*****************Function get_user_single_payment**********************************
     * @type            : Function
     * @function name   : get_user_single_payment
     * @description     : validate the paymeny to user already paid for selected month               
     *                    
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_user_single_payment() {
        
         $user_type  = $this->input->post('user_type');
         $user_id  = $this->input->post('user_id');
         $salary_month  = $this->input->post('salary_month');
         
         $exist = $this->ajax->get_single('salary_payments',array('user_id'=>$user_id, 'salary_month'=>$salary_month, 'user_type'=>$user_type ));
         
         if($exist){
             echo 1;
         }else{
             echo 2;
         }         
    }
    
    /*****************Function get_school_info_by_id**********************************
     * @type            : Function
     * @function name   : get_school_info_by_id
     * @description     : validate the paymeny to user already paid for selected month               
     *                    
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_school_info_by_id() {
        
         $branch_id  = $this->input->post('branch_id');
         
         $school = $this->ajax->get_single('schools',array('id'=>$branch_id));         
         echo $school->final_result_type;        
    }
    
    /*****************Function get_sms_gateways**********************************
     * @type            : Function
     * @function name   : get_sms_gateways
     * @description     : Load "SMS Settings" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_sms_gateways() {
        
        $branch_id  = $this->input->post('branch_id');
         
        $gateways = get_sms_gateways($branch_id);
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        if (!empty($gateways)) {
            foreach ($gateways as $key=>$value) {   
                
                $str .= '<option value="' . $key . '" >' . $value . '</option>';
                
            }
        }

        echo $str;
    }
    
    
    

        
    /** * *************Function get_email_template_by_role**********************************
     * @type            : Function
     * @function name   : get_email_template_by_role
     * @description     : this function used to populate template by role  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_email_template_by_role() {

        $role_id = $this->input->post('role_id');

        $templates = $this->ajax->get_list('email_templates', array('status' => 1, 'role_id' => $role_id), '', '', '', 'id', 'ASC');
        
        $str = '<option value="">-- ' . $this->lang->line('template') . ' --</option>';
        if (!empty($templates)) {
            foreach ($templates as $obj) {
                $str .= '<option itemid="'.$obj->id.'" value="' . $obj->id . '">' . $obj->title . '</option>';
            }
        }

        echo $str;
    }
    
        
    /** * *************Function get_email_template_by_id**********************************
     * @type            : Function
     * @function name   : get_email_template_by_id
     * @description     : this function used to populate template by role  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_email_template_by_id() {

        $template_id = $this->input->post('template_id');

        $template = $this->ajax->get_single('email_templates', array('status' => 1, 'id' => $template_id), '', '', '', 'id', 'ASC');
        if (!empty($template)) {
           echo $template->template;
        }else{
            echo FALSE;
        }
    }
   
    
        
    /** * *************Function get_sms_template_by_role**********************************
     * @type            : Function
     * @function name   : get_sms_template_by_role
     * @description     : this function used to populate template by role  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_sms_template_by_role() {

        $role_id = $this->input->post('role_id');

        $templates = $this->ajax->get_list('sms_templates', array('status' => 1, 'role_id' => $role_id), '', '', '', 'id', 'ASC');       
        $str = '<option value="">-- ' . $this->lang->line('template') . ' --</option>';
        if (!empty($templates)) {
            foreach ($templates as $obj) {
                $str .= '<option itemid="'.$obj->id.'" value="' . $obj->template . '">' . $obj->title . '</option>';
            }
        }

        echo $str;
    }
    
    

    /*****************Function update_status_type**********************************
     * @type            : Function
     * @function name   : update_status_type
     * @description     : update_status_type               
     *                    
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function update_student_status_type() {
        
         $student_id = $this->input->post('student_id');
         $status     = $this->input->post('status');
         
         // every where need to update status...................
         $other_status = 1;
         if($status != 'regular'){ $other_status = 0;}
         
         // other table update..................
         
         // student table update.................         
         echo $this->ajax->update('students', array('modified_at'=>date('Y-m-d H:i:s'), 'status_type'=>$status), array('id'=>$student_id));         
    }

}
