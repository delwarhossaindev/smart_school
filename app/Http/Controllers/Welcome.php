<?php

namespace App\Http\Controllers;


/* * *****************Welcome.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Welcome
 * @description     : This is default class of the application.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Welcome extends \App\Legacy\CI_Controller {
    /*     * **************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : this function load login view page            
     * @param           : null; 
     * @return          : null 
     * ********************************************************** */
    public $global_setting = array();
    public function index() {
       
        if (logged_in_user_id()) {
            ci_redirect('dashboard/index');
        }
                        
        $this->global_setting = $this->db->get_where('global_setting', array('status'=>1))->row();
        
        if(!empty($this->global_setting) && $this->global_setting->language){             
            $this->lang->load($this->global_setting->language, 'english');            
        }else{
           $this->lang->load('english');
        }        
        
        if($this->global_setting){ 
            define('SMS', $this->global_setting->brand_title);
        }else{
            define('SMS', 'Global - Multi Branch School Management System'); 
        }
        
        $this->load->view('login-demo');
    }

}