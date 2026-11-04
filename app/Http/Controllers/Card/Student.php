<?php

namespace App\Http\Controllers\Card;


/* * *****************Student.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Generate
 * @description     : Manage all type of system student listing.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Student extends \App\Legacy\MY_Controller {

    public $data = array();
      
   public function __construct() {
        parent::__construct();
                
        $this->load->model('Student_Model', 'student', true);                
    }

  

   

    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load user filtering interface                 
     *                      
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function index(){
        
        
        check_permission(VIEW);
        
        $this->data['students'] = '';
        
         if ($_POST) {
             
            $branch_id = $this->input->post('branch_id'); 
            $class_id = $this->input->post('class_id'); 
            $section_id = $this->input->post('section_id'); 
            $student_id = $this->input->post('student_id');            
            $this->data['school'] = $this->student->get_school_by_id($branch_id);
            
            $this->data['cards'] = $this->student->get_student_list($branch_id, $class_id, $section_id, $student_id, $this->academic_year_id);
            $this->data['setting'] = $this->student->get_single('id_card_settings', array('branch_id'=>$branch_id));
            $this->data['branch_id'] = $branch_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['student_id'] = $student_id;   
            
            if(empty($this->data['setting'])){
                error($this->lang->line('unexpected_error'));
                ci_redirect($this->is_supper_admin ? 'card/idsetting/index' : 'card/schoolidsetting/index');
            }
            
         }
         
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');             
            $this->data['classes'] = $this->student->get_list('classes', $condition, '','', '', 'id', 'ASC');
        }
        
        $this->layout->title($this->lang->line('generate_student_id_card') .' | ' . SMS);
        $this->layout->view('student/index', $this->data);         
    } 
}
