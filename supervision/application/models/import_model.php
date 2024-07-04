<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
    class Import_model extends CI_Model {
 
        public function __construct()
        {
           
        }
		
		public function import_category_data($data) {
            $response = $this->db->insert_batch('profession',$data);
            if($response){
                return TRUE;
            }else{
                return FALSE;
            }
		 }
		
		public function import_sub_category_data($data) {
            $response = $this->db->insert_batch('sub_category',$data);
            if($response){
                return TRUE;
            }else{
                return FALSE;
            }
		 }
		
		public function import_api_list_data($data) {
            $response = $this->db->insert_batch('api_list',$data);
            if($response){
                return TRUE;
            }else{
                return FALSE;
            }
		 }
	
	
	}

?>