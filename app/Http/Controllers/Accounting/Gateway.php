<?php

namespace App\Http\Controllers\Accounting;


/* * *****************Gateway.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Gateway
 * @description     : Process payment gateway notiication.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Gateway extends \App\Legacy\CI_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Payment_Model', 'payment', true);
        $this->load->model('Invoice_Model', 'invoice', true);

        $this->config->load('custom');
        $this->load->library("paypal");
    }

    /*     * ***************Function paypal_notify**********************************
     * @type            : Function
     * @function name   : paypal_notify
     * @description     : paypal peyment processing notify url                 
     *                    internally paypal send some post data
      which are procesing here.
     * @param           : null
     * @return          : null
     * ********************************************************** */

    public function paypal_notify() {

        //mail('yousuf361@gmail.com', 'Paypal notify out', json_encode($_POST));

        if (isset($_POST['ipn_track_id']) && !empty($_POST['ipn_track_id'])) {


            // mail('yousuf361@gmail.com', 'Paypal notify in', json_encode($_POST));
            /* $ipn_response = '';
              foreach ($_POST as $key => $value) {
              $value = urlencode(stripslashes($value));
              $ipn_response .= "\n$key=$value";
              } */

            $invoice = $this->invoice->get_single_invoice($_POST['custom']);
            $payment = $this->payment->get_invoice_amount($_POST['custom']);

            $data['branch_id'] = $invoice->branch_id;
            $data['invoice_id'] = $_POST['custom'];
            $data['amount'] = $invoice->temp_amount;
            ;
            $data['payment_method'] = 'Paypal';
            $data['transaction_id'] = $_POST['txn_id'];
            $data['note'] = $_POST['item_name'];
            $data['status'] = 1;
            $data['academic_year_id'] = $this->academic_year_id;
            $data['payment_date'] = date('Y-m-d');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();

            $this->payment->insert('transactions', $data);
            $due_amount = $invoice->net_amount - $payment->paid_amount;

            if (floatval($data['amount']) < floatval($due_amount)) {
                $update = array('paid_status' => 'partial');
            } else {
                $update = array('paid_status' => 'paid', 'modified_at' => date('Y-m-d H:i:s'));
            }
            $this->payment->update('invoices', $update, array('id' => $data['invoice_id']));
        }
    }

    public function dbbl() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $dbbl_txn_id = '';
            $invoice_id = '';

            if (isset($_SESSION['dbbl_txn_id']) && !empty($_SESSION['dbbl_txn_id'])) {

                $dbbl_txn_id = $_SESSION['dbbl_txn_id'];
                $invoice_id = $_SESSION['invoice_id'];
                
            } else if (isset($_COOKIE['dbbl_txn_id']) && !empty($_COOKIE['dbbl_txn_id'])) {

                $dbbl_txn_id = $_COOKIE['dbbl_txn_id'];
                $invoice_id = $_COOKIE['invoice_id'];
            }
            
            $invoice = $this->invoice->get_single_invoice($invoice_id);
            $payment_setting   = $this->payment->get_single('payment_settings', array('status'=>1, 'school_id'=>$invoice->school_id));

            $response = $this->get_dbbl_transaction($dbbl_txn_id, $payment_setting->dbbl_userid, $payment_setting->dbbl_password);
            // print_r($response);
            $status = $response['status'];
            $description = implode(",", $response);

            if ($status == 'OK') {

                // save to database
                // send sms to guardian
                // transaction sttaus update

                $note = "Online fees deposit through DBBL:- DBBL txn ID: " . $dbbl_txn_id . ", DBBL Detail Info: " . $description;

                
                $payment = $this->payment->get_invoice_amount($invoice_id);
                $school = $this->invoice->get_school_by_id($invoice->school_id);

                $data = array();

                $data['school_id'] = $invoice->school_id;
                $data['invoice_id'] = $invoice_id;
                $data['amount'] = $invoice->temp_amount;
                ;
                $data['payment_method'] = 'DBBL';
                $data['transaction_id'] = $dbbl_txn_id;
                $data['note'] = $note;
                $data['status'] = 1;
                $data['academic_year_id'] = $school->academic_year_id;
                $data['payment_date'] = date('Y-m-d');
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = logged_in_user_id();

                $this->payment->insert('transactions', $data);
                $due_amount = $invoice->net_amount - $payment->paid_amount;

                if (floatval($data['amount']) < floatval($due_amount)) {
                    $update = array('paid_status' => 'partial');
                } else {
                    $update = array('paid_status' => 'paid', 'modified_at' => date('Y-m-d H:i:s'));
                }

                $this->payment->update('invoices', $update, array('id' => $data['invoice_id']));

                ci_redirect(base_url('accounting/payment/dbbl_success/' . $invoice_id));
            } else {

                ci_redirect(base_url('accounting/payment/dbbl_failed/' . $invoice_id));
            }
        }
    }

    private function get_dbbl_transaction($dbbl_txn_id, $userid, $password) {

        $url = "https://ecom1.dutchbanglabank.com/ecomws/dbblecomtxn?wsdl";
        $url2 = "https://demo.l1nda.nl/api/webservice/?wsdl";
    
        $params = array(
            "userid" => $userid,
            "pwd" => $password,
            "transid" => $dbbl_txn_id,
            "clientip" => $_SERVER['REMOTE_ADDR']
        );

        try {

            $opts = array(
                'http' => array(
                    'user_agent' => 'PHPSoapClient'
                )
            );
            $context = stream_context_create($opts);

            $wsdlUrl = $url;
            $soapClientOptions = [
                'cache_wsdl' => WSDL_CACHE_NONE,
                'trace' => 1,
                'stream_context' => stream_context_create(
                        [
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            ]
                        ]
                )
            ];

            $client = new \SoapClient($wsdlUrl, $soapClientOptions);

            $result = $client->__soapCall("getresult", array($params));
            $return = $result->return;
            $trx = explode("^", $return);
            $status = $trx[0];
            $rs = explode(">", $status);

            $codeA = $trx[1];
            $cd = explode(">", $codeA);
            $secureA = $trx[2];
            $sc = explode(">", $secureA);

            $rpnA = $trx[3];
            $rp = explode(">", $rpnA);

            $acodeA = $trx[4];
            $ac = explode(">", $acodeA);

            $cardA = $trx[5];
            $crd = explode(">", $cardA);

            $amountA = $trx[6];
            $amt = explode(">", $amountA);

            $cardNameA = $trx[7];
            $crdn = explode(">", $cardNameA);

            $descA = $trx[8];
            $ds = explode(">", $descA);

            $timeA = $trx[9];
            $tm = explode(">", $timeA);

            $status1 = $rs[1];
            $code = $cd[1];
            $secoreCode = $sc[1];
            $rpn = $rp[1];
            $approval_code = $ac[1];
            $cardNumber = $crd[1];
            $amount = $amt[1];
            $cardname = $crdn[1];
            $description = $ds[1];
            $time = $tm[1];

            $array = array(
                'status' => $status1,
                'code' => $code,
                'secure_code' => $secoreCode,
                'rpn' => $rpn,
                'approval_code' => $approval_code,
                'card_number' => $cardNumber,
                'amount' => $amount,
                'card_name' => $cardname,
                'description' => $description,
                'time' => $time,
            );

            return $array;
        } catch (\Exception $e) {

            $array = array(
                'status' => "SystemError",
                'code' => 0,
                'description' => $e
            );
            return $array;
        }
    }

}
