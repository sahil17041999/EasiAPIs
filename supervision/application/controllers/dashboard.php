<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Dashboard extends BaseController {


    function __construct()
    {
       parent::__construct();
       
       $this->load->model('module_model');
      

    }

    public function index()
	{
		$total_category= $this->module_model->total_category();
		$page_data['total_category'] = $total_category;
		
		$total_sub_category= $this->module_model->total_sub_category();
		$page_data['total_sub_category'] = $total_sub_category;
		
        $this->loadViews("admin/dashboard",$page_data);
    }

}



?>