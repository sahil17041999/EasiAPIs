<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class General extends BaseController
{


	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//print_r(base_url());die;
		
		$this->template("general/index");
	}
	
}