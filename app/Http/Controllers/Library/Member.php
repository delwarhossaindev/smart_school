<?php

namespace App\Http\Controllers\Library;


/* * *****************Member.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Member
 * @description     : Manage library member, from the student whose are library member.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Member extends \App\Legacy\MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Book_Model', 'book', true);        
    }

        
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Library Member List" user interface                 
    *                        
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function index($class_id = null) {

        check_permission(VIEW);
        
          // for super admin 
        $branch_id = '';
        if($_POST){
            
            $branch_id = $this->input->post('branch_id');
            $class_id  = $this->input->post('class_id');           
        }
        
        if($class_id && !$branch_id){
          $class = $this->book->get_single('classes', array('id' => $class_id));  
          $branch_id = $class->branch_id;
        }
                      
        $this->data['members'] = $this->book->get_library_member_list($is_library_member = 1, $branch_id, $class_id); 
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');
        }        
        $this->data['classes'] = $this->book->get_list('classes', $condition, '','', '', 'id', 'ASC');
        
        $this->data['class_id'] = $class_id;
        $this->data['filter_class_id'] = $class_id;
        $this->data['filter_branch_id'] = $branch_id;
        $this->data['schools'] = $this->schools;
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('library_member') . ' | ' . SMS);
        $this->layout->view('member/member', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Library Member" user interface                 
    *                    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
   public function add($class_id = null) {

        check_permission(ADD);        
      
         // for super admin 
        $branch_id = '';
        if($_POST){
            
            $branch_id = $this->input->post('branch_id');
            $class_id  = $this->input->post('class_id');           
        }
        
        if($class_id && !$branch_id){
          $class = $this->book->get_single('classes', array('id' => $class_id));  
          $branch_id = $class->branch_id;
        } 
        
        $this->data['non_members'] = $this->book->get_library_member_list($is_library_member = 0, $branch_id, $class_id);       
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['branch_id'] = $this->session->userdata('branch_id');
        }        
        $this->data['classes'] = $this->book->get_list('classes', $condition, '','', '', 'id', 'ASC');
        
        $this->data['class_id'] = $class_id;
        $this->data['filter_class_id'] = $class_id;
        $this->data['filter_branch_id'] = $branch_id;
        $this->data['schools'] = $this->schools;
        
        $this->data['non_list'] = TRUE;
        $this->layout->title($this->lang->line('non_member') . ' | ' . SMS);
        $this->layout->view('member/non_member', $this->data);
        
    }

        
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Library member" data from library member list                  
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        check_permission(DELETE);

        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            ci_redirect('library/member/index');
        }
        
        $member = $this->book->get_single('library_members', array('id' => $id));
        if ($this->book->delete('library_members', array('id' => $id))) {
            
            //delete all issue book for this library menber            
            $this->book->delete('book_issues', array('library_member_id' => $id));
            
            // Update student liberary member status
            $this->book->update('students', array('is_library_member' => 0), array('user_id' => $member->user_id));
            
            $student = $this->book->get_single('students', array('user_id' => $member->user_id));
            create_log('Has been deleted a Library Member : '.$student->name);
            
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        ci_redirect('library/member/index');
    }


    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : Process to add/store "Library Member" into database                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */
    public function add_to_library() {

        $user_id = $this->input->post('user_id');

        if ($user_id) {
            
            $user   = $this->book->get_single('users', array('id' => $user_id));
            $member = $this->book->get_single('library_members', array('user_id' => $user_id));
            
            if (empty($member)) {

                $data['branch_id'] = $user->branch_id;
                $data['user_id'] = $user_id;
                $data['custom_member_id'] = $this->book->get_custom_id('library_members', 'LM');
                $data['status'] = 1;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = logged_in_user_id();

                $insert_id = $this->book->insert('library_members', $data);
                $this->book->update('students', array('is_library_member' => 1), array('user_id' => $user_id));
                echo TRUE;
            } else {
                echo FALSE;
            }
        } else {
            echo FALSE;
        }
    }

}
