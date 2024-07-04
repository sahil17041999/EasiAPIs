<?php

class Module_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function update_social_url($url, $id)
    {
        $data = array(
            'url_link' => $url
        );
        $this->db->where('origin', $id);
        $this->db->update('social_links', $data);
        //echo $this->db->last_query();exit;
    }

    public function social_link_status($origin, $status)
    {
        $data['status'] = $status;
        $this->db->where('origin', $origin);
        $this->db->update('social_links', $data);
    }

    function profession_get_info($origin)
    {
        $this->db->select('*');
        $this->db->from('profession');
        $this->db->where('origin', $origin);
        $query = $this->db->get();
        return $query->row();
    }

    function edit_profession($profession_record, $origin)
    {
        $this->db->where('origin', $origin);
        $this->db->update('profession', $profession_record);
        return TRUE;
    }
    public function profession_status($origin, $status)
    {
        $data['status'] = $status;
        $this->db->where('origin', $origin);
        $this->db->update('profession', $data);
    }

    function update_social_config($url, $id)
    {
        $data = array(
            'config' => $url
        );
        $this->db->where('origin', $id);
        $this->db->update('social_login', $data);
        //echo $this->db->last_query();exit;
    }
    public function social_login_status($origin, $status)
    {
        $data['status'] = $status;
        $this->db->where('origin', $origin);
        $this->db->update('social_login', $data);
    }



    function sub_category_list()
    {
        $this->db->select('SUB_CAT.status,SUB_CAT.origin,SUB_CAT.sub_category_name,SUB_CAT.category_id,CAT.profession_name as category');
        $this->db->from('sub_category as SUB_CAT');
        $this->db->join('profession as CAT', 'CAT.origin = SUB_CAT.category_id');
        $this->db->order_by("SUB_CAT.origin", "desc");
        $query = $this->db->get();
        $result = $query->result();
        // debug($result);die;
        return $result;
        //return $query->row();
    }
    function qualification_category_list()
    {
        $this->db->select('CAL_CAT.status,CAL_CAT.origin,CAL_CAT.qualification_name,CAL_CAT.category_id,CAT.profession_name as category');
        $this->db->from('qualification as CAL_CAT');
        $this->db->join('profession as CAT', 'CAT.origin = CAL_CAT.category_id');
        $this->db->order_by("CAL_CAT.origin", "desc");
        $query = $this->db->get();
        $result = $query->result();
        // debug($result);die;
        return $result;
        //return $query->row();
    }

    function api_list()
    {
        $this->db->select('API.title,API.origin,API.qualification,API.experience,API.name,
		API.phone,API.email,API.image_url,
		API.phone_code,API.information,API.location,
    API.category_id,API.sub_category_id,SUB.sub_category_name,CAT.profession_name as category,CAT.service_icon');
        $this->db->from('api_list as API');
        $this->db->join('profession as CAT', 'CAT.origin = API.category_id');
        $this->db->join('sub_category as SUB', 'SUB.origin  = API.sub_category_id');
        $this->db->order_by("API.origin", "desc");
        $query = $this->db->get();
        // debug($query);die;
        $result = $query->result();
        return $result;
    }

    function delete_sub_category($origin)
    {
        try {
            $this->db->where('origin', $origin);
            $this->db->delete('sub_category');

            //debug($this->db->affected_rows());die;
            // Check if any rows were affected
            if ($this->db->affected_rows() == 0) {
                throw new Exception('No rows affected');
            }
        } catch (Exception $e) {
            // Re-throw the exception to be caught in the controller
            throw $e;
        }
    }



    function edit_api_list($origin)
    {
        $this->db->select('*');
        $this->db->from('api_list');
        $this->db->where('origin', $origin);
        $query = $this->db->get();
        return $query->row();
    }





    function get_sub_category_info($origin)
    {
        $this->db->select('*');
        $this->db->from('sub_category');
        $this->db->where('origin', $origin);
        $query = $this->db->get();
        return $query->row();
    }
    function get_qualification_category_info($origin)
    {
        $this->db->select('*');
        $this->db->from('qualification');
        $this->db->where('origin', $origin);
        $query = $this->db->get();
        return $query->row();
    }

    function get_auth($id)
    {
        $this->db->select('*');
        $this->db->from('authentication');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function update_auth_data($id)
    {
        
        $this->db->select('Auth.id,Auth.domain,Auth.username,Auth.password,ROLE.modules');
        $this->db->from('api_permission as ROLE');
        $this->db->join('authentication AS Auth', 'Auth.id = ROLE.user_id');
        $this->db->where('Auth.id', $id);
        $query = $this->db->get();
        $response = $query->result();
        return $response;
    }

    function edit_sub_category($sub_category_record, $origin)
    {
        $this->db->where('origin', $origin);
        $this->db->update('sub_category', $sub_category_record);
        return TRUE;
    }
    function edit_quali_category($quali_category_record, $origin)
    {
        $this->db->where('origin', $origin);
        $this->db->update('qualification', $quali_category_record);
        return TRUE;
    }

    public function sub_category_status($origin, $status)
    {
        $data['status'] = $status;
        $this->db->where('origin', $origin);
        $this->db->update('sub_category', $data);
    }
    public function quali_category_status($origin, $status)
    {
        $data['status'] = $status;
        $this->db->where('origin', $origin);
        $this->db->update('qualification', $data);
    }

    function banner_img_edit_Info($origin)
    {
        $this->db->select('*');
        $this->db->from('banner_images');
        $this->db->where('origin', $origin);
        $query = $this->db->get();
        return $query->row();
    }

    function edit_banner_image($banner_img_data, $origin)
    {
        $this->db->where('origin', $origin);
        $this->db->update('banner_images', $banner_img_data);
        return TRUE;
    }

    public function banner_image_status($origin, $status)
    {
        $data['status'] = $status;
        $this->db->where('origin', $origin);
        $this->db->update('banner_images', $data);
    }

    function total_category()
    {
        $total_category = $this->db->count_all('profession');
        return $data['total_category'] = $total_category;
    }
    function total_sub_category()
    {
        $total_sub_category = $this->db->count_all('sub_category');
        return $data['total_sub_category'] = $total_sub_category;
    }
}
