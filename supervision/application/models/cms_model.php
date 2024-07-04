<?php

class Cms_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function page_content_status($page_id, $status)
    {
        $data['page_status'] = $status;
        $this->db->where('page_id', $page_id);
        $this->db->update('cms_pages', $data);
    }

    function get_static_page_Info($page_id)
    {
        $this->db->select('*');
        $this->db->from('cms_pages');
        $this->db->where('page_id', $page_id);
        $query = $this->db->get();
        return $query->row();
    }

    function edit_static_page_content($static_page_Info, $page_id)
    {
        $this->db->where('page_id', $page_id);
        $this->db->update('cms_pages', $static_page_Info);
        return TRUE;
    }
     function why_choose_us_list()
    {
        $this->db->select('WHY_CHO.status,WHY_CHO.origin,WHY_CHO.title,WHY_CHO.icon_id,WHY_CHO.description,
		ION.icon_name,ION.name');
        $this->db->from('why_choose_us as WHY_CHO');
        $this->db->join('icon as ION', 'ION.origin = WHY_CHO.icon_id');
		$this->db->order_by("WHY_CHO.origin","desc");
        $query = $this->db->get();
        $result = $query->result(); 
        return $result;
    }


function edit_why_choose_us($origin)
    {
        $this->db->select('*');
        $this->db->from('why_choose_us');
        $this->db->where('origin', $origin);
        $query = $this->db->get();
        return $query->row();
    }

public function why_choose_status($origin, $status)
	{
		$data['status'] = $status;
        $this->db->where('origin', $origin);
        $this->db->update('why_choose_us', $data);
	}
   
}
