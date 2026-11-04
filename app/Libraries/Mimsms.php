<?php

namespace App\Libraries;




class Mimsms {

    public $api_key = "";
    public $type = "";
    public $senderId = "";
    public $url = "http://esms.mimsms.com/smsapi?";

    function __construct() {

        $ci = & get_instance();
        $branch_id = '';
        if ($ci->session->userdata('branch_id')) {
            $branch_id = $ci->session->userdata('branch_id');
        } else {
            $branch_id = $ci->input->post('branch_id');
        }

        $ci->db->select('S.*');
        $ci->db->from('sms_settings AS S');
        $ci->db->where('S.branch_id', $branch_id);
        $setting = $ci->db->get()->row();

        $this->api_key = $setting->mim_api_key;
        $this->type = $setting->mim_type;
        $this->senderId = $setting->mim_sender_id;
    }

    function sendSMS($mobile, $message) {
       

        ////sending sms
        $url = $this->url."api_key=".$this->api_key."&type=".$this->type."&contacts=".$mobile."&senderid=".$this->senderId."&msg=".$message;
        $ch = curl_init();
        $timeout = 10; // set to zero for no timeout
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $result = curl_exec($ch);
         curl_close($ch);
        echo $result;
    }
}

?>