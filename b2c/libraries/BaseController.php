<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 


class BaseController extends CI_Controller {
	

	
	
	public function __construct() {
		parent::__construct();
	}
	
	function loadThis() {
		$this->global ['pageTitle'] = 'CodeInsect : Access Denied';
		$this->load->view ( 'template/header', $this->global );
       // $this->load->view ( 'admin/includes/menu' );
		$this->load->view ( 'template/footer' );
		//$this->load->view ( 'admin/includes/script' );
	}
	
	function template($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){
		// pre($this->global); die;
        $this->load->view('template/header', $headerInfo);
		//$this->load->view ( 'admin/includes/menu' );
        $this->load->view($viewName, $pageInfo);
        $this->load->view('template/footer', $footerInfo);
		//$this->load->view ( 'admin/includes/script' );
    }
}