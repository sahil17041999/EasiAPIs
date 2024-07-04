<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Api_list extends BaseController
{



    function __construct()
    {
        parent::__construct();
	
        $this->load->model('module_model');
		$this->load->model('db_cache_api');
		
		
		
    }

    public function index()
    {
		$record = $this->module_model->api_list();
		$page_data['Api_data'] = '';
        $page_data['Api_data'] = $record;
		//debug($page_data['Api_data']);die;
		$this->loadViews("Api/api_list",$page_data);
	}
	
	public function add_api_list()
    {
		
		$this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        //$this->form_validation->set_rules('phone_code', 'Phone code', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('location', 'Location', 'required');
		$this->form_validation->set_rules('category_id', 'Category', 'required');
		$this->form_validation->set_rules('sub_category_id', 'Sub category', 'required');
		$this->form_validation->set_rules('information', 'Information', 'required');
		
		if ($this->form_validation->run() == TRUE) {
		   
			$page_data =  array();
            $data  = array();
			$api_data =  array();
			if(!empty($_FILES['image_url']['name'])){
				
			    $config['upload_path'] = 'assets/img/api_images';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['image_url']['name'];
				$config['max_size'] = '';
				$config['max_width']  = '';
				$config['max_height']  = '';
				$config['remove_spaces']  = false;
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
			    if(!$this->upload->do_upload('image_url')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('api_list/add_api_list');
                }else{
					$uploadData = $this->upload->data();
                    $images = $uploadData['file_name'];
					$image_path = base_url().'assets/img/api_images/'.$images;
						  
                }
			}else
			{
				$this->session->set_flashdata('error','Please upload image');
                 redirect('api_list/add_api_list');
			}
			
		    $api_data = $this->input->post();
			$data['name'] = $api_data['name'];
			$data['image_url'] = $images;
			$data['phone'] = $api_data['phone'];
			//$data['phone_code'] = $api_data['phone_code'];
			$data['email'] = $api_data['email'];
			$data['location'] = $api_data['location'];
		    $data['category_id'] = $api_data['category_id'];
			$data['sub_category_id'] = $api_data['sub_category_id'];
			$data['information'] = $api_data['information'];
			$data['qualification'] = $api_data['qualification'];
			$data['experience'] = $api_data['experience'];
			$data['images_url'] = $image_path;
			$data = $this->custom_db->insert_record('api_list', $data);
			if($data > 0){
			 $this->session->set_flashdata('success', 'Api data added successfully');
                 redirect('api_list/add_api_list');
			  }else{
		     $this->session->set_flashdata('error', 'Api data not added please try again');
               redirect('api_list/add_api_list');
			 }
		
		}else{
	
		$cols = ' * ';
        $tmp_data = $this->custom_db->single_table_records('profession', $cols);
        $page_data['category_list'] = '';
        $page_data['category_list'] = $tmp_data['data'];
			
		$country_code = $this->db_cache_api->get_country_code_list_profile();
			//$mobile_code = $this->db_cache_api->get_mobile_code($page_data['form_data']['country_code']);
			//$page_data['mobile_code'] = $mobile_code;
		//debug($country_code);die;
		$phone_code_array = array();
		foreach($country_code['data'] as $c_key => $c_value){
			$phone_code_array[$c_value['country_code']] = $c_value['name'].' '.$c_value['country_code'];
			
		}
		$page_data['phone_code_array'] = $phone_code_array;
	    $phone_code = $this->custom_db->single_table_records('country_code', $cols);
		$page_data['phone_code_list'] = '';
        $page_data['phone_code_list'] = $phone_code['data'];
		$this->loadViews("Api/add_api_list",$page_data);
		}
	}
	
	public function edit_api_list($origin){
		
		
		$page_data =  array();
		
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('location', 'Location', 'required');
		$this->form_validation->set_rules('information', 'Information', 'required');
		
		if ($this->form_validation->run() == TRUE) {
			
			$api_data =  array();
		    $api_data = $this->input->post();
		
			if(!empty($_FILES['image_url']['name'])){
				$config['upload_path'] = 'assets/img/banner_image';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['banner_image']['name'];
				$config['max_size'] = '';
				$config['max_width']  = '';
				$config['max_height']  = '';
				$config['remove_spaces']  = false;
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
				if(!$this->upload->do_upload('image_url')){
					$this->session->set_flashdata('error',$this->upload->display_errors());	
				    redirect('cms/edit_api_list/'.$origin.'');
                }else{
					$uploadData = $this->upload->data();
                    $images = $uploadData['file_name'];
                }
			}
			if($api_data['image_urlss'] !='' && !$images)
			{
			$page_data['name'] = $api_data['name'];
			$page_data['image_url'] = $api_data['image_urlss'];
			$page_data['phone'] = $api_data['phone'];
		//	$page_data['phone_code'] = $api_data['phone_code'];
			$page_data['email'] = $api_data['email'];
			$page_data['location'] = $api_data['location'];
			$page_data['information'] = $api_data['information'];
			$page_data['qualification'] = $api_data['qualification'];
			$page_data['experience'] = $api_data['experience'];
			}else{
	
			$page_data['name'] = $api_data['name'];
			$page_data['image_url'] = $images;
			$page_data['phone'] = $api_data['phone'];
			//$page_data['phone_code'] = $api_data['phone_code'];
			$page_data['email'] = $api_data['email'];
			$page_data['location'] = $api_data['location'];
			$page_data['information'] = $api_data['information'];
			$page_data['qualification'] = $api_data['qualification'];
			$page_data['experience'] = $api_data['experience'];
			}
			$edit_api_data =   $this->custom_db->update_record('api_list', $page_data,array('origin' => $origin));
			//debug($edit_api_data);die;
			if($edit_api_data > 0){
			 $this->session->set_flashdata('success', 'Api data updated successfully');
                redirect('api_list');
			  }else{
		           $this->session->set_flashdata('error', 'Api data not updated please try again');
                 redirect('api_list');
			}
			
		}else{
		$cols = ' * ';
        $tmp_data = $this->custom_db->single_table_records('profession', $cols);
        $page_data['category_list'] = '';
        $page_data['category_list'] = $tmp_data['data'];
			
		$cols = ' * ';
        $tmp_data = $this->custom_db->single_table_records('sub_category', $cols);
        $page_data['sub_category_list'] = '';
        $page_data['sub_category_list'] = $tmp_data['data'];
		
		$phone_code = $this->custom_db->single_table_records('country_code', $cols);
		$page_data['phone_code_list'] = '';
        $page_data['phone_code_list'] = $phone_code['data'];
		$page_data['edit_api_data'] = $this->module_model->edit_api_list($origin);
		//debug($page_data['edit_api_data']);die;
		$this->loadViews("Api/edit_api_list",$page_data);
		}

	}

	public function view_info($origin){
		$page_data['information'] = $this->module_model->edit_api_list($origin);
		//debug($page_data['information']);die;
		$this->loadViews("Api/view_info",$page_data);
	}
	
	public function uplaod_multiple_images($origin)
	{
		//debug($origin);die;
		$data = [];
   
      $count = count($_FILES['image_url']['name']);
    
      for($i=0;$i<$count;$i++){
    
        if(!empty($_FILES['image_url']['name'][$i])){
    
          $_FILES['file']['name'] = $_FILES['image_url']['name'][$i];
          $_FILES['file']['type'] = $_FILES['image_url']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['image_url']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['image_url']['error'][$i];
          $_FILES['file']['size'] = $_FILES['image_url']['size'][$i];
  
          $config['upload_path'] = 'assets/img/banner_image';
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '5000';
          $config['file_name'] = $_FILES['image_url']['name'][$i];
   
          $this->load->library('upload',$config); 
    
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
            $file_path = base_url().'assets/img/banner_image/'.$filename;
            $data['image_url'][] = $filename;
			 // debug($data);die;
			$data['file_path'] = $file_path;
          }
			//$api_list_id = $this->input->post('origin');
			$edit_api_data =   $this->custom_db->insert_record('api_images',$origin,$data);
        }
   
      }
		$this->loadViews("Api/multiple_images");
	}
	
	public function delete_api_list($origin)
	{
		$this->custom_db->delete_record('api_list', array('origin' => $origin));
        $this->session->set_flashdata('error', 'Api data deleted successfully');
        redirect('api_list');
	}
	
	
}
