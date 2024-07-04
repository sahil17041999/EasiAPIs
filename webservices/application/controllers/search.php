<?php

require APPPATH . 'core/BD_Controller.php';

class Search extends BD_Controller
{

  public function __construct()
  {

    parent::__construct();
    $this->load->model('api_model');
    $this->load->model('user_model');
    $this->auth();
  }


  public function index_post()
  {
      $search_params = json_decode(file_get_contents('php://input'), true);
   
      $theCredential = $this->user_data;
      $user_id = $theCredential->id;
      $res = $this->user_model->APIS_permission($user_id);
      $modules = explode(",",$res->modules);
      // $category = $this->user_model->category();
      $sub_category  = $this->user_model->sub_category_by_id($search_params['sub_category_id']);

     if(in_array($sub_category[0]->category_id,$modules)){
      
      $data = $this->api_model->api_list($search_params);
      if (count($data) > 0) {
        $this->response(array(
          "status" => 1,
          "message" => "search list found",
          "data" => $data
        ));
      } else {
        $this->response(array(
          "status" => 0,
          "message" => "No search list found",
          "data" => $data
        ));
      }
    }else{
      $this->response(array(
        "status" => 0,
        "message" => "No permission to access this APIS",
        "data" => array()
      ));
    }
     
    
  }
}
