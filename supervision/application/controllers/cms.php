<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Cms extends BaseController
{


    function __construct()
    {

        parent::__construct();
        $this->load->model('cms_model');
        $this->load->model('module_model');
		
    }

    public function index()
    {
        ini_set('display_errors', 1);
        echo "test";
    }

    public function  static_page_content()
    {
        $cols = ' * ';
        $tmp_data = $this->custom_db->single_table_records('cms_pages', $cols);
        $page_data['page_content'] = '';
        $page_data['page_content'] = $tmp_data['data'];
        // debug($page_data ['page_content']);die;
        $this->loadViews("cms/static_page_content", $page_data);
    }

    public function  add_page_content()
    {

        $this->form_validation->set_rules('page_title', 'Page Title', 'required');
        $this->form_validation->set_rules('page_description', 'Page Description', 'required');
        $this->form_validation->set_rules('page_seo_title', 'Page SEO Title', 'required');
        $this->form_validation->set_rules('page_seo_keyword', 'Page SEO Keyword', 'required');
        $this->form_validation->set_rules('page_seo_description', 'Page SEO Description', 'required');
        $this->form_validation->set_rules('page_position', 'Page Position', 'required');

        if ($this->form_validation->run() == FALSE) {
        } else {
            $data['page_title'] = $title = $this->input->post('page_title');
            $data['page_description'] = $this->input->post('page_description');
            $data['page_seo_title'] = $this->input->post('page_seo_title');
            $data['page_seo_keyword'] = $this->input->post('page_seo_keyword');
            $data['page_seo_description'] = $this->input->post('page_seo_description');
            $data['page_position'] = $this->input->post('page_position');
            $data['page_label'] = $this->uniqueLabel(substr($title, 0, 100));
            $page_content = $this->custom_db->insert_record('cms_pages', $data);
            if ($page_content > 0) {
                $this->session->set_flashdata('success', 'Static page content added successfully');
                redirect('cms/static_page_content');
            } else {
                $this->session->set_flashdata('error', 'Static page content not added please try again!');
                redirect('cms/static_page_content');
            }
        }
        $this->loadViews("cms/add_page_content");
    }


    public function  edit_pages_content()
    {
        $page_id = $this->input->post('page_id');
        //debug($page_id);die;
        $this->form_validation->set_rules('page_title', 'Page Title', 'required');
        $this->form_validation->set_rules('page_description', 'Page Description', 'required');
        $this->form_validation->set_rules('page_seo_title', 'Page SEO Title', 'required');
        $this->form_validation->set_rules('page_seo_keyword', 'Page SEO Keyword', 'required');
        $this->form_validation->set_rules('page_seo_description', 'Page SEO Description', 'required');
        $this->form_validation->set_rules('page_position', 'Page Position', 'required');
        if ($this->form_validation->run() == FALSE) {
            // $this->session->set_flashdata('error', 'Static page content not updated please try again!');
            // redirect ( 'cms/edit_page_content' );

        } else {
            $page_title = $this->input->post('page_title');
            $page_seo_title = $this->input->post('page_description');
            $page_description = $this->input->post('page_description');
            $page_seo_keyword = $this->input->post('page_seo_keyword');
            $page_seo_description = $this->input->post('page_seo_description');
            $page_position = $this->input->post('page_position');
            // debug($page_id);die;
            $static_page_Info = array();
            $static_page_Info = array(
                'page_title' => $page_title, 'page_seo_title' => $page_seo_title,
                'page_description' => $page_description, 'page_seo_keyword' => $page_seo_keyword,
                'page_seo_description' => $page_seo_description,
                'page_position' => $page_position,
            );

            $static_page_content_data = $this->cms_model->edit_static_page_content($static_page_Info, $page_id);

            if ($static_page_content_data == true) {
                $this->session->set_flashdata('success', 'static page content updated successfully');
                redirect('cms/static_page_content');
            } else {
                $this->session->set_flashdata('error', 'static page content not updated');
                redirect('cms/edit_page_content/<?=' . $page_id . '?>');
            }
        }
    }

    function  edit_page_content($page_id)
    {
        if ($page_id == NULL) {
        } else {
            $page_data['static_page_Info'] = $this->cms_model->get_static_page_Info($page_id);
            $this->loadViews("cms/edit_page_content", $page_data);
        }
    }





    function delete_page_content($page_id)
    {
        $this->custom_db->delete_record('cms_pages', array('page_id' => $page_id));
        $this->session->set_flashdata('error', 'Static page content deleted successfully');
        redirect('cms/static_page_content');
    }


    function pages_content_status($page_id)
    {
        $status = $this->input->post('page_status');
        $this->cms_model->page_content_status($page_id, $status);
    }

    public function social_network()
    {
        $temp = $this->custom_db->single_table_records('social_links');
        $page_data['social_links'] = $temp['data'];
        //  debug($page_data ['social_links']);die;
        $this->loadViews("cms/social_network", $page_data);
    }

    function edit_social_url()
    {
        $post_data = $this->input->post();
        $id = $post_data['origin'];
        $url = $post_data['social_url'];
        $info = $this->module_model->update_social_url($url, $id);
        $this->session->set_flashdata('success', 'social network updated successfully');
        redirect('cms/social_network');
    }

    public function social_link_status($origin)
    {
         $status = $this->input->post('status');
         $this->module_model->social_link_status($origin,$status);
        
     }

    public function social_logins(){
        $temp = $this->custom_db->single_table_records ( 'social_login' );
		$page_data ['social_login'] = $temp ['data'];
       ///s debug($page_data ['social_login']);die;
        $this->loadViews("cms/social_login", $page_data);
    }

    public function social_login_update(){
        $post_data = $this->input->post();
        $id = $post_data['origin'];
        $value = $post_data['config'];
        $info = $this->module_model->update_social_config ( $value, $id );
        $this->session->set_flashdata('success', 'social login updated successfully');
        redirect('cms/social_logins');
    }

    public function social_login_status($origin)
    {
         $status = $this->input->post('status');
       //  debug($status);die;
         $this->module_model->social_login_status($origin,$status);
        
     }
	
	
	public function banner_images(){
		$cols = ' * ';
        $tmp_data = $this->custom_db->single_table_records('banner_images', $cols);
        $page_data['banner_image_data'] = '';
        $page_data['banner_image_data'] = $tmp_data['data'];
		$this->loadViews("cms/banner_images",$page_data);
	}
	
	public function add_banner_images(){
		
		$this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('subtitle', 'Subtitle', 'required');
        $this->form_validation->set_rules('banner_order', 'Please select banner order', 'required');
	  //  $this->form_validation->set_rules('banner_image', 'Banner image', 'required');
		
		if ($this->form_validation->run() == TRUE) {
			
			if(!empty($_FILES['banner_image']['name'])){
				
				$config['upload_path'] = 'assets/img/banner_image';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['banner_image']['name'];
				$config['max_size'] = '1000000';
				$config['max_width']  = '';
				$config['max_height']  = '';
				$config['remove_spaces']  = false;
				
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
				
				if(!$this->upload->do_upload('banner_image')){
					//$upload_error = $this->upload->display_errors();
					
                }else{
					
					$uploadData = $this->upload->data();
                    $banner_images = $uploadData['file_name'];	  
                }
			}else{
				    //$upload_error = $this->upload->display_errors();
					$this->session->set_flashdata('error', 'Please upload Banner image ');
                    redirect('cms/add_banner_images');
			}
			 $title =  $this->input->post('title');
			 $subtitle =  $this->input->post('subtitle');
			 $banner_order =  $this->input->post('banner_order');
			
			 $banner_img_data = array(
				 'title'=>$title,
				 'subtitle'=>$subtitle,
				 'banner_order'=>$banner_order,
				 'added_by'=>1,
				 'banner_image'=>$banner_images
			 );
			
		    $banner_image_record = $this->custom_db->insert_record('banner_images', $banner_img_data);
			if($banner_image_record > 0){
				 $this->session->set_flashdata('success', 'Banner image data added successfully');
                 redirect('cms/banner_images');
			}else{
				 $this->session->set_flashdata('error', 'Banner image not data added please try again');
                 redirect('cms/add_banner_images');
			}
           
        } else{
			$this->loadViews("cms/add_banner_images");
		}
	}
	
	
	 public function  edit_info_banner_images($origin){
		 
	   // $origin = $this->input->post('origin');
		$this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('subtitle', 'Subtitle', 'required');
        $this->form_validation->set_rules('banner_order', 'Please select banner order', 'required');
	   // $this->form_validation->set_rules('banner_image', 'Banner image', 'required');
		 if ($this->form_validation->run() == TRUE) {
			// echo 'hi';
			if(!empty($_FILES['banner_image']['name'])){
				$config['upload_path'] = 'assets/img/banner_image';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['banner_image']['name'];
				$config['max_size'] = '';
				$config['max_width']  = '';
				$config['max_height']  = '';
				$config['remove_spaces']  = false;
				//debug($config);die;
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
				if($this->upload->do_upload('banner_image')){
                    $uploadData = $this->upload->data();
                    $banner_images = $uploadData['file_name'];
                }else{
					//$upload_error = $this->upload->display_errors();	  
                }
			}else{
				// $upload_error = $this->upload->display_errors();
			}
			 
			 $title =  $this->input->post('title');
			 $subtitle =  $this->input->post('subtitle');
			 $banner_order =  $this->input->post('banner_order');
			 $edit_banner_images =  $this->input->post('banner_images');
			 if($edit_banner_images !='' && !$banner_images)
			 {

				$banner_img_data = array(
					'title'=>$title,
					'subtitle'=>$subtitle,
					'banner_order'=>$banner_order,
					'added_by'=>1,
					'banner_image'=>$edit_banner_images
				);
			 }else{
			
			 $banner_img_data = array(
				 'title'=>$title,
				 'subtitle'=>$subtitle,
				 'banner_order'=>$banner_order,
				 'added_by'=>1,
				 'banner_image'=>$banner_images
			 );
			}
			 $edit_banner_images = $this->module_model->edit_banner_image($banner_img_data, $origin);
			 if($edit_banner_images > 0){
				 $this->session->set_flashdata('success', 'Banner image data Updated successfully');
                 redirect('cms/banner_images');
			}else{
				// $this->session->set_flashdata('error', 'Banner image not data updated please try again');
                 $page_data['banner_imga_data'] = $this->module_model->banner_img_edit_Info($origin);
			     $this->loadViews("cms/edit_banner_image",$page_data);
			}
		 } 
		 else {
            $page_data['banner_imga_data'] = $this->module_model->banner_img_edit_Info($origin);
			 //debug($page_data['banner_imga_data']);die;
		    $this->loadViews("cms/edit_banner_image",$page_data);
	    }
	 }
	
	public function edit_banner_imge()
	{
		 //debug($origin);die;
		$origin = $this->input->post('origin');
		$this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('subtitle', 'Subtitle', 'required');
        $this->form_validation->set_rules('banner_order', 'Please select banner order', 'required');
	   // $this->form_validation->set_rules('banner_image', 'Banner image', 'required');
		 if ($this->form_validation->run() == TRUE) {
			 echo 'hi';
			if(!empty($_FILES['banner_image']['name'])){
				$config['upload_path'] = 'assets/img/banner_image';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['banner_image']['name'];
				$config['max_size'] = '';
				$config['max_width']  = '';
				$config['max_height']  = '';
				$config['remove_spaces']  = false;
				//debug($config);die;
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
				if($this->upload->do_upload('banner_image')){
                    $uploadData = $this->upload->data();
                    $banner_images = $uploadData['file_name'];
                }else{
					$upload_error = $this->upload->display_errors();	  
                }
			}else{
				 $upload_error = $this->upload->display_errors();
			}
			 
			 $title =  $this->input->post('title');
			 $subtitle =  $this->input->post('subtitle');
			 $banner_order =  $this->input->post('banner_order');
			
			 $banner_img_data = array(
				 'title'=>$title,
				 'subtitle'=>$subtitle,
				 'banner_order'=>$banner_order,
				 'added_by'=>1,
				 'banner_image'=>$banner_images
			 );
			//debug($banner_img_data);die;
			 $edit_banner_images = $this->module_model->edit_banner_image($banner_img_data, $origin);
			 if($edit_banner_images > 0){
				 $this->session->set_flashdata('success', 'Banner image data Updated successfully');
                 redirect('cms/banner_images');
			}else{
				 $this->session->set_flashdata('error', 'Banner image not data updated please try again');
                 //redirect('cms/add_banner_images');
			}
		 }
		 else{
			 
		 }
	}
	
	function delete_banner_image($origin)
    {
        $this->custom_db->delete_record('banner_images', array('origin' => $origin));
        $this->session->set_flashdata('error', 'Banner image deleted successfully');
        redirect('cms/banner_images');
    }
	
	function banner_image_status($origin)
    {
        $status = $this->input->post('status');
        $this->module_model->banner_image_status($origin, $status);
    }
	
	public function manage_domain(){
		$temp_details = $this->custom_db->single_table_records('domain_address', '*', array('origin' => 1));
		if($temp_details['status'] == true) {
			$page_data['data']         = $temp_details['data'][0];
		} 
		$this->loadViews("cms/manage_domain",$page_data);
	}
	public function update_manage_domain(){
		$post_data = $this->input->post();
		if($post_data == true && isset($post_data['origin']) == true) {
			if(intval($post_data['origin']) == 1 && 1 > 0) {
				$domain_origin = 1;
				$this->custom_db->update_record('domain_address', 
												array('domain_name'=>$post_data['domain_name'],
												'email'=>$post_data['email'],
											    'address' => $post_data['address'],
												'phone' => $post_data['phone'],
											    'alternatve_no' => $post_data['alternatve_no'],
													 ),
												array('origin' => $domain_origin));
				$this->session->set_flashdata('success', 'manage domain Updated successfully');
				redirect('cms/manage_domain');
			}
			         else{
					$this->custom_db->update_record('domain_address',
											  array('domain_name'=>$post_data['domain_name'],  
													'email'=>$post_data['email'],
													'address' => $post_data['address'],
													'phone' => $post_data['phone'],
													'alternatve_no' => $post_data['alternatve_no'],
												   ),
													 array('origin' => $domain_origin));
				 $this->session->set_flashdata('success', 'manage domain Updated successfully');
				redirect('cms/manage_domain');
					 }
			refresh();
		}
	}


	 public function seo(){
		$page_data['data_list'] = $this->custom_db->single_table_records('seo');
		//debug($page_data['data_list']);die;
		$this->loadViews("cms/seo",$page_data);
		//$this->template->view ( 'cms/seo', $data );
	}
	
	public function edit_seo($id){
		$page_data = array ();
		$filter = ['id'=>$id];
		$data_list = $this->custom_db->single_table_records ( 'seo', '*', $filter, 0, 100000 );
		$page_data ['data_list'] = @$data_list ['data'];
		$this->loadViews("cms/seo_edit",$page_data);
		//$this->template->view ( 'cms/seo_edit', $page_data );

	}
	
	public function update_seo_action(){
		$insert_data = [];
		$post_data = $this->input->post();
		//debug($post_data);exit;
		$BID = $post_data['BID'];
		if($post_data == true) {

			//POST DATA formating to update
			$insert_data = array(
				'description'=>$post_data['description'],
				'title'=>$post_data['title'],
				'keyword'=>$post_data['keyword']
			);
		}
		/*UPDATING OTHER FIELDS*/
		$this->custom_db->update_record('seo',$insert_data,array('id' => $BID));
		$this->session->set_flashdata('success', 'Seo Updated successfully');
		redirect('cms/seo');
		$this->seo();
	}
	
	
	function why_choose_us(){
		$page_data = array ();
		//$data_list = $this->custom_db->single_table_records ( 'why_choose_us', '*', '', 0, 100000 );
		//$page_data ['data_list'] = @$data_list ['data'];
		$why_choose_list = $this->cms_model->why_choose_us_list();
		$page_data ['why_choose_list'] =$why_choose_list;
		$this->loadViews("cms/why_choose_us",$page_data);
	}
	
	function add_why_choose_us(){
		
		$page_data =  array();
	    $data = array();
		
		$this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('icon_id', 'Icon', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
		
		if ($this->form_validation->run() == TRUE) {
			  $page_data =  array();
			  $data = array();
			  $data = $this->input->post();
			  $page_data['title'] = $data['title'];
			  //$page_data['icon'] = $data['icon'];
			  $page_data['icon_id'] = $data['icon_id'];
			  $page_data['description'] = $data['description'];
			  $page_data['status'] = $data['status'];
			//echo 'h';
			  $why_choose_record = $this->custom_db->insert_record('why_choose_us', $page_data);
			 if($why_choose_record > 0){
				 $this->session->set_flashdata('success', 'why choose us data added successfully');
                 redirect('cms/why_choose_us');
			  }else{
				 $this->session->set_flashdata('error', 'Why choose us not data added please try again');
                 redirect('cms/add_why_choose_us');
			 }
		}
		else{
	    $data_list = $this->custom_db->single_table_records ( 'icon', '*', '', 0, 100000 );
		$data['icon_list'] = @$data_list ['data'];
		$this->loadViews("cms/add_why_choose_us",$data);
		}	
	}
	
	public function edit_why_choose_us($origin){
		
		$this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('icon_id', 'Icon', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
		
		if ($this->form_validation->run() == TRUE) {
			  $page_data =  array();
			  $data = array();
			  $data = $this->input->post();
			  $origin = $this->input->post('origin');
			  $page_data['title'] = $data['title'];
			 // $page_data['icon'] = $data['icon'];
			  $page_data['icon_id'] = $data['icon_id'];
			  $page_data['description'] = $data['description'];
			  $page_data['status'] = $data['status'];
			
			  $edit_why_choose_record =   $this->custom_db->update_record('why_choose_us', $page_data,array('origin' => $origin));
			 if($edit_why_choose_record > 0){
				 $this->session->set_flashdata('success', 'why choose us data  successfully');
                 redirect('cms/why_choose_us');
			  }else{
				 $data['edit_why_choose_us'] = $this->cms_model->edit_why_choose_us($origin);
		         $data_list = $this->custom_db->single_table_records ( 'icon', '*', '', 0, 100000 );
		         $data['icon_list'] = @$data_list ['data'];
		         $this->loadViews("cms/edit_why_choose_us",$data);
			 }
		}else{
		
		$data['edit_why_choose_us'] = $this->cms_model->edit_why_choose_us($origin);
		$data_list = $this->custom_db->single_table_records ( 'icon', '*', '', 0, 100000 );
		$data['icon_list'] = @$data_list ['data'];
		$this->loadViews("cms/edit_why_choose_us",$data);
		}
	}
	
	
	
	
	function why_choose_delete($origin)
    {
        $this->custom_db->delete_record('why_choose_us', array('origin' => $origin));
        $this->session->set_flashdata('error', 'why choose us deleted successfully');
        redirect('cms/why_choose_us');
    }
	
	function why_choose_status($origin)
    {
        $status = $this->input->post('status');
        $this->cms_model->why_choose_status($origin, $status);
    }
    



    public function uniqueLabel($string)
    {
        //Lower case everything
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }
}
