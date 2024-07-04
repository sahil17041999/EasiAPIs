<?php

require APPPATH . 'core/BD_Controller.php';
use \Firebase\JWT\JWT;

class Auth extends BD_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('user_model');
    }

    public function index_post()
    {

      
       // print_r($password);die;
        $getHeaders = apache_request_headers();
        $username  =  $getHeaders['Username'];
        $password  =  $getHeaders['Password'];
        $q = array('username' => $username,'status'=>1); //For where query condition
        //print_r($q);die;
        $kunci = $this->config->item('thekey');
        //print_r($kunci);die;
        $invalidLogin = ['status' => 'Invalid Login']; //Respon if login invalid
       // print_r($invalidLogin);die;
        $val = $this->user_model->get_user($q)->row(); //Model to get single data row from database base on username
     //  print_r($this->user_model->get_user($q)->num_rows());die;
        if($this->user_model->get_user($q)->num_rows() == 0){
            $this->response($invalidLogin);
          //  $this->response($invalidLogin, REST_Controller::HTTP_NOT_FOUND);
        }
		$match = $val->password;   //Get password for user from database
        if($password == $match){  //Condition if password matched
        	$token['id'] = $val->id;  //From here
            $token['username'] = $username;
            $date = new DateTime();
            $token['iat'] = $date->getTimestamp();
            $token['exp'] = $date->getTimestamp() + 60*60*5; //To here is to generate token
            $output['token'] = JWT::encode($token,$kunci ); //This is the output token
            //$this->set_response($output, REST_Controller::HTTP_OK); //This is the respon if success
            $this->set_response($output);
        }
        else {
            $this->set_response($invalidLogin); //This is the respon if failed
        }
    }
}
