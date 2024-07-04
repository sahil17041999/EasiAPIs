<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    function get_user($q)
    {
        return $this->db->get_where('authentication', $q,array('status' => 1));
    }


    function APIS_permission($user_id)
{
    $this->db->select('*');
    $this->db->from('api_permission');
    $this->db->where('user_id',$user_id);
    $query = $this->db->get();
    return $query->row();
}


function sub_category_by_id($id)
{
    $this->db->select('*');
    $this->db->from('sub_category');
    $this->db->where('origin',$id);
    $query = $this->db->get();
    $response = $query->result();
    //print_r($response);die;
    return $response;
}
    
}
