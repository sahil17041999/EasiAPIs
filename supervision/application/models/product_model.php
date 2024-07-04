<?php

class Product_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

   

    function get_category_info($origin)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('origin', $origin);
        $query = $this->db->get();
        return $query->row();
    }

    function edit_category($category_record, $origin)
    {
        $this->db->where('origin', $origin);
        $this->db->update('category', $category_record);
        return TRUE;
    }
    public function category_status($origin, $status)
    {
        $data['status'] = $status;
        $this->db->where('origin', $origin);
        $this->db->update('category', $data);
    }

}?>