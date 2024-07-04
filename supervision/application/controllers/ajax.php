<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Ajax extends BaseController
{



    function __construct()
    {
        parent::__construct();
    }


          public function get_sub_category_list()
         {
          $category_id = $this->input->post('category_id');
          $get_resulted_data =  $this->custom_db->single_table_records('sub_category', '*',array('category_id' => $category_id), 0, 100000000,          array('origin' => 'asc'));
		   if(!empty($get_resulted_data['data'])){ 
		       $html = "<option value=''>Select Sub Category</option>";
		        foreach( $get_resulted_data['data'] as  $get_resulted_data_sub){
		         if($get_resulted_data_sub['status']  == '1'){
		         $html= $html."<option value=".$get_resulted_data_sub['origin'].">".$get_resulted_data_sub['sub_category_name']."</option>";
		        } 
				}
		    }else{
		         $html = "<option value=''>Sub Category Not Found</option>";
		    }
		     echo $html;
		     exit;
		 }	
}