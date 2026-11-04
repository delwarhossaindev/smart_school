<?php

namespace App\Http\Controllers\Gallery;


/* * *****************Gallery.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Gallery
 * @description     : Manage school Gallery for guardian, student, teacher and employee.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Gallery extends \App\Legacy\MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Gallery_Model', 'gallery', true);       
    }


    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Gallery List" user interface                 
    *                      
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index($branch_id = null) {

        check_permission(VIEW);

        $this->data['galleries'] = $this->gallery->get_gallery_list($branch_id);
        $this->data['filter_branch_id'] = $branch_id;
        $this->data['schools'] = $this->schools;
        
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_gallery') . ' | ' . SMS);
        $this->layout->view('gallery/index', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Gallery" user interface                 
    *                    and process to store "Gallery" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_gallery_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_gallery_data();

                $insert_id = $this->gallery->insert('galleries', $data);
                if ($insert_id) {
                    
                     create_log('Has been created a Gallery : '.$data['title']);
                     
                    success($this->lang->line('insert_success'));
                    ci_redirect($this->is_supper_admin ? 'gallery/index/'.$data['branch_id'] : 'gallery/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    ci_redirect($this->is_supper_admin ? 'gallery/add/'.$data['branch_id'] : 'gallery/add');
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
        
        $this->data['galleries'] = $this->gallery->get_gallery_list($branch_id);
        $this->data['schools'] = $this->schools;

        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add') . ' | ' . SMS);
        $this->layout->view('gallery/index', $this->data);
    }

    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Gallery" user interface                 
    *                    with populated "Gallery" value 
    *                    and process to update "Gallery" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

        check_permission(EDIT);
        
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            ci_redirect('gallery/index');
        }
        
        if ($_POST) {
            $this->_prepare_gallery_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_gallery_data();
                
                // get gallery for update gallery image
                $updated = $this->gallery->update('galleries', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    $this->gallery->update('gallery_images', array('branch_id'=>$data['branch_id']), array('gallery_id' => $this->input->post('id')));
                    
                    create_log('Has been updated a Gallery : '.$data['title']);                    
                    success($this->lang->line('update_success'));
                    ci_redirect($this->is_supper_admin ? 'gallery/index/'.$data['branch_id'] : 'gallery/index');
                    
                } else {
                    
                    error($this->lang->line('update_failed'));
                    ci_redirect('gallery/edit/' . $this->input->post('id'));
                    
                }
            } else {
                $this->data['gallery'] = $this->gallery->get_single('galleries', array('id' => $this->input->post('id')));
            }
        }

        if ($id) {
            $this->data['gallery'] = $this->gallery->get_single('galleries', array('id' => $id));

            if (!$this->data['gallery']) {
                ci_redirect('gallery/index');
            }
        }

        $this->data['galleries'] = $this->gallery->get_gallery_list($this->data['gallery']->branch_id);
        
        $this->data['branch_id'] = $this->data['gallery']->branch_id;
        $this->data['filter_branch_id'] = $this->data['gallery']->branch_id;
        $this->data['schools'] = $this->schools;
        
        $this->data['edit'] = TRUE;
        $this->layout->title($this->lang->line('edit') . ' | ' . SMS);
        $this->layout->view('gallery/index', $this->data);
    }

    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific gallery data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($id) {

        check_permission(VIEW);

        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            ci_redirect('gallery/index');
        }
        
        
       $this->data['galleries'] = $this->gallery->get_gallery_list();
        
        
        $this->data['gallery'] = $this->gallery->get_single('galleries', array('id' => $id));        
        
        $this->data['detail'] = TRUE;
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('gallery') . ' | ' . SMS);
        $this->layout->view('gallery/index', $this->data);
    }

    
    /*****************Function _prepare_gallery_validation**********************************
    * @type            : Function
    * @function name   : _prepare_gallery_validation
    * @description     : Process "gallery" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_gallery_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('branch_id', $this->lang->line('branch_name'), 'trim|required');
        $this->form_validation->set_rules('title', $this->lang->line('title'), 'trim|required|callback_title');
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
    }

    
    /*****************Function title**********************************
    * @type            : Function
    * @function name   : title
    * @description     : Unique check for "gallery title" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */  
    public function title() {
        if ($this->input->post('id') == '') {
            $gallery = $this->gallery->duplicate_check($this->input->post('branch_id'), $this->input->post('title'));
            if ($gallery) {
                $this->form_validation->set_message('title', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $gallery = $this->gallery->duplicate_check($this->input->post('branch_id'), $this->input->post('title'), $this->input->post('id'));
            if ($gallery) {
                $this->form_validation->set_message('title', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    
    /*****************Function _get_posted_gallery_data**********************************
    * @type            : Function
    * @function name   : _get_posted_gallery_data
    * @description     : Prepare "gallery" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_gallery_data() {

        $items = array();
        $items[] = 'branch_id';
        $items[] = 'title';
        $items[] = 'note';
        $items[] = 'is_view_on_web';

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
    * @description     : delete "gallery" from database                  
    *                    and unlink gallery image from server   
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        check_permission(DELETE);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            ci_redirect('gallery/index');
        }
        
        
        $gallery = $this->gallery->get_single('galleries', array('id' => $id));
        
        if ($this->gallery->delete('galleries', array('id' => $id))) {

            // deleting all images of this gallery
            $images = $this->gallery->get_list('gallery_images', array('gallery_id'=>$id), '', '', '', 'id', 'ASC');        
            if(!empty($images)){
                
                foreach($images as $obj){
                
                    $destination = 'assets/uploads/';
                    if (file_exists($destination . '/gallery/' . $obj->image)) {
                        @unlink($destination . '/gallery/' . $obj->image);
                    }
                }
                
                $this->gallery->delete('gallery_images', array('gallery_id' => $id));
            }
            
            create_log('Has been deleted a Gallery : '.$gallery->title);
            success($this->lang->line('delete_success'));
            
        } else {
            error($this->lang->line('delete_failed'));
        }
        
        ci_redirect($this->is_supper_admin ? 'gallery/index/'.$gallery->branch_id : 'gallery/index');
    }

}