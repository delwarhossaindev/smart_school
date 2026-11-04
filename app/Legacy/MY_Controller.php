<?php

namespace App\Legacy;


class MY_Controller extends \App\Legacy\CI_Controller {
    // CI Version: 3.1.5
    public $academic_year_id = '';
    public $is_supper_admin = FALSE;
    public $schools = array();
    public $academic_years = array();
    public $global_setting = array();
    public $branch_setting = array();
    public $lang_path = '../lang/english/';
  
    
    public function __construct() {
        parent::__construct();
        if (!logged_in_user_id()) {
            ci_redirect('login');
            ci_exit();
        }
       
        // Get all schools
        $this->schools = $this->db->get_where('schools', array('status'=>1))->result();
        $this->academic_years = $this->db->get_where('academic_years', array('status'=>1))->result();
        $this->academic_year_id = $this->db->get_where('academic_years', array('status'=>1, 'is_running'=>1))->row()->id;
        $this->global_setting = $this->db->get_where('global_setting', array('status'=>1))->row();       
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->branch_setting = $this->db->get_where('schools', array('status'=>1, 'id'=>$this->session->userdata('branch_id')))->row();
        }
        
        if($this->global_setting){           
            date_default_timezone_set($this->global_setting->time_zone);
            define('SMS', $this->global_setting->brand_title);
        }else{
            define('SMS', 'Global - Multi Branch School Management System'); 
        }
        
                
        header("HTTP/1.0 200 OK");
        header("HTTP/1.1 200 OK");
        header("Expires: Tue, 01 Jan 2020 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        clearstatcache();
               
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && !empty($this->global_setting)){
             $this->lang->load($this->global_setting->language);
             //$this->lang->load($this->global_setting->language, 'english');
             
        }else if($this->session->userdata('role_id') != SUPER_ADMIN && !empty($this->branch_setting)){
            $this->lang->load($this->branch_setting->language);
            //$this->lang->load($this->global_setting->language, 'english');
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN){ 
            $this->is_supper_admin = TRUE;
        } 
        
    }
    
    public function index(){
        
    }

    public function update_lang() {
        
        $data = array();
        
        if($this->session->userdata('role_id') == SUPER_ADMIN){  
           $language = $this->db->get_where('global_setting', array('status'=>1))->row()->language; 
        }else{
           $language = $this->db->get_where('schools', array('status'=>1, 'id'=>$this->session->userdata('branch_id')))->row()->language;  
        } 
        
        if(!$language){
           error($this->lang->line('please_set_language'));
           ci_redirect('dashboard/index');
        }
        
        $this->lang_path = '../lang/english/'.$language.'_lang.php';
        
        $this->db->select("id, label, $language");
        $this->db->from('languages');        
        $this->db->order_by('id' , 'ASC');
        $languages = $this->db->get()->result(); 
        
        foreach($languages as $obj){
            $data[$obj->label] = $obj->$language;
        }        
        if (!is_array($data) && count($data) == 0) {
            return FALSE;
        }

        @chmod($this->lang_path, FILE_WRITE_MODE);

        // Is the config file writable?
        if (!is_really_writable($this->lang_path)) {
            show_error($this->lang_path . ' does not appear to have the proper file permissions.  Please make the file writeable.');
        } 
        // Read the config file as PHP
        require $this->lang_path;  

        // load the file helper
        $this->CI = & get_instance();
        $this->CI->load->helper('file');

        // Read the config data as a string
        //$lang_file = read_file($this->lang_path);
        // Trim it
        //$lang_file = trim($lang_file);

        $lang_file = '<?php ';

        // Do we need to add totally new items to the config file?
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                //$pattern = '/\$lang\[\\\'' . $key . '\\\'\]\s+=\s+[^\;]+/';  
                $lang_file .= "\n";
                //$lang_file .= "\$lang['$key'] = '".$val."';"; 
                $lang_file .= "\$lang['$key'] = ".'"'.$val.'";';    
                //$config_file = preg_replace($pattern, $replace, $config_file);
            }
        }
        
        if (!$fp = fopen($this->lang_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
            return FALSE;
        }
        
        flock($fp, LOCK_EX);
        fwrite($fp, $lang_file, strlen($lang_file));
        flock($fp, LOCK_UN);
        fclose($fp);

        
        @chmod($this->lang_path, FILE_READ_MODE);
  
        return TRUE;
    }
    
}
