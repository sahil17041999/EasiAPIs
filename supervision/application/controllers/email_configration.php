<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Email_configration extends BaseController {


    
    function __construct()
    {
       parent::__construct();
       $this->load->model('email_config_model');
       
    }


    public function index() {
        $encrypt_method = "AES-256-CBC";
        $secret_iv = PROVAB_SECRET_IV;
        $md5_key = PROVAB_MD5_SECRET;
        $encrypt_key = PROVAB_ENC_KEY;
        $page_data = array();

        $email_data= $this->email_config_model->get_email_config_data();
        // debug($email_data->username);die;
        

        if ($email_data->status == SUCCESS_STATUS) {
            // $email_data = $email_data['data'][0];
            $page_data['user_name'] = provab_decrypt($email_data->username);
            
            $page_data['from'] = $email_data->from;
            $page_data['host'] = provab_decrypt($email_data->host);
            $page_data['port'] = provab_decrypt($email_data->port);
            $page_data['cc'] =   provab_decrypt($email_data->cc);
            $page_data['bcc'] =  provab_decrypt($email_data->bcc);
           // debug($page_data);die;
        }
        if (empty($_POST) == false) {
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            $data['from'] = $_POST['from'];
            $data['host'] = $_POST['host'];
            $data['port'] = $_POST['port'];
            $data['cc'] = $_POST['cc_email'];
            $data['bcc'] = $_POST['bcc_email'];

            $decrypt_password = $this->db->query("SELECT AES_DECRYPT($encrypt_key,SHA2('" . $md5_key . "',512)) AS decrypt_data");

            $db_data = $decrypt_password->row();

            $secret_key = trim($db_data->decrypt_data);

            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
            $username = openssl_encrypt($data['username'], $encrypt_method, $key, 0, $iv);
            $username = base64_encode($username);

            $password = openssl_encrypt($data['password'], $encrypt_method, $key, 0, $iv);
            $password = base64_encode($password);

            $host = openssl_encrypt($data['host'], $encrypt_method, $key, 0, $iv);
            $host = base64_encode($host);

            $cc = openssl_encrypt($data['cc'], $encrypt_method, $key, 0, $iv);
            $cc = base64_encode($cc);

            $port = openssl_encrypt($data['port'], $encrypt_method, $key, 0, $iv);
            $port = base64_encode($port);

            $bcc = openssl_encrypt($data['bcc'], $encrypt_method, $key, 0, $iv);
            $bcc = base64_encode($bcc);

            $data1['username'] = $username;
            $data1['password'] = $password;
            $data1['from'] = $data['from'];
            $data1['host'] = $host;
            $data1['port'] = $port;
            $data1['cc'] = $cc;
            $data1['bcc'] = $bcc;
            $condition['origin'] = 1;
            // debug($data1);
            // debug($condition['origin']);die;
            // $page_data['message'] = 'Updated Successfully';
           $da=  $this->email_config_model->update_email_config($data1, $condition);
           if($da > 0)
           {
            $this->session->set_flashdata('success', 'Email configration updated');
            redirect('email_configration/index');
           }
        }
        
        $this->loadViews("email_configration/email_configration",$page_data);
    }

}