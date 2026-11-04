<?php

namespace App\Http\Controllers\Card;


/* * *****************Teacher.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Generate
 * @description     : Manage all type of system teacher listing.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Teacher extends \App\Legacy\MY_Controller {

    public $data = array();
      
   public function __construct() {
        parent::__construct();
                
        $this->load->model('Teacher_Model', 'teacher', true);                
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
        
        $this->data['teachers'] = '';
        
         if ($_POST) {
             
            $branch_id = $this->input->post('branch_id'); 
            $teacher_id = $this->input->post('teacher_id');
            $this->data['cards'] = $this->teacher->get_teacher_list($branch_id, $teacher_id);
            $this->data['school'] = $this->teacher->get_school_by_id($branch_id);
            $this->data['setting'] = $this->teacher->get_single('id_card_settings', array('branch_id'=>$branch_id));
            $this->data['branch_id'] = $branch_id;
            $this->data['teacher_id'] = $teacher_id;
            
            if(empty($this->data['setting'])){
                error($this->lang->line('unexpected_error'));
                ci_redirect($this->is_supper_admin ? 'card/idsetting/index' : 'card/schoolidsetting/index');
            }            
         }
         
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');             
            $this->data['teachers'] = $this->teacher->get_list('teachers', $condition, '','', '', 'id', 'ASC');
        }
        
        $this->layout->title( $this->lang->line('generate_teacher_id_card') .' | ' . SMS);
        $this->layout->view('teacher/index', $this->data);         
    }   

}
