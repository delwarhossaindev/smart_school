<?php

namespace App\Http\Controllers\Exam;


/* * *****************Meritlist.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Meritlist
 * @description     : Manage exam merit list.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Meritlist extends \App\Legacy\MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Meritlist_Model', 'merit', true);        
    }

    
        
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Exam final result sheet" user interface                 
    *                    with class/section wise filtering option    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        check_permission(VIEW);

        if ($_POST) {
           
            $branch_id = $this->input->post('branch_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
           
            $this->data['branch_id'] = $branch_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['class_id'] = $class_id;         
            $this->data['section_id'] = $section_id; 
            
            if(!$this->academic_year_id){
                error($this->lang->line('please_set_academic_year'));
                ci_redirect('exam/meritlist');
            }

            $this->data['class'] = $this->db->get_where('classes', array('id'=>$class_id))->row()->name;
            if($section_id){
                $this->data['section'] = $this->db->get_where('sections', array('id'=>$section_id))->row()->name;
            }
            
            $this->data['examresult'] = $this->merit->get_merit_list($branch_id, $academic_year_id, $class_id, $section_id);
            $this->data['school'] = $this->merit->get_school_by_id($branch_id);
        }
        
        
        $condition = array();
        $condition['status'] = 1;  
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            
            $condition['branch_id'] = $this->session->userdata('branch_id');
            $this->data['classes'] = $this->merit->get_list('classes', $condition, '','', '', 'id', 'ASC');
            $condition['academic_year_id'] = $this->academic_year_id;
            $this->data['exams'] = $this->merit->get_list('exams', array('status'=>1, 'academic_year_id'=>$this->academic_year_id), '', '', '', 'id', 'ASC');
        }
        
        $this->layout->title($this->lang->line('manage_merit_list') . ' | ' . SMS);
        $this->layout->view('merit_list/index', $this->data);
        
    }
}