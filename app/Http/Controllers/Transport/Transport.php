<?php

namespace App\Http\Controllers\Transport;



class Transport extends \App\Legacy\CI_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Vehicle_Model', 'vehicle', true);       
    }

    
    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Vehicle List" user interface                 
    *                     
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index($value) {
       
        if ($_POST) {
            $this->_prepare_vehicle_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_vehicle_data();

                $insert_id = $this->vehicle->insert('vehicles', $data);
                if ($insert_id) {
                    success($this->lang->line('insert_success'));
                    ci_redirect('transport/vehicle/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    ci_redirect('transport/vehicle/add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }
        
        $this->session->unset_userdata($value);
               
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('transport') . ' | ' . SMS);
        $this->layout->view('vehicle/index', $this->data);
    }

}
