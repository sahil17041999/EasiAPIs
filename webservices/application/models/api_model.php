<?php

class Api_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

 
	 function api_list($search)
    {
		$response = array();
		$api_response	= array();
        $this->db->select('API.origin,API.qualification,API.experience,API.name,API.phone_code,API.phone,API.email,API.image_url as image,API.images_url as image_url,
		API.information,API.location,
    API.category_id,API.sub_category_id,SUB.sub_category_name,CAT.profession_name as category');
        $this->db->from('api_list as API');
		$this->db->join('profession as CAT', 'CAT.origin = API.category_id');
        $this->db->join('sub_category as SUB', 'SUB.origin  = API.sub_category_id');
		if($search['sub_category_id'] != ''){
			$this->db->where('API.sub_category_id',$search['sub_category_id']);
		}
		// if($search['location'] != ''){
		// 	$this->db->where('API.location',$search['location']);
		// }
		$this->db->order_by("API.origin","desc");
        $query = $this->db->get();
        $api_response = $query->result(); 
		$response['Details'] = $api_response;
        return $response;
    }

  

	
	function api_auth($api_key,$username,$password)
	{
		 $this->db->select('*');
		 $this->db->from('api_keys');
		 $this->db->where(['api_key'=>$api_key,'username'=>$username,'password'=>$password]);
		 $query = $this->db->get();
         $result = $query->result(); 
         return $result;
	}

   
    

}?>