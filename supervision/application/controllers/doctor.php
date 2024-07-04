<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Doctor extends REST_Controller{


    public function index(){
        
        echo  "i m webservices";
    }

}

?>