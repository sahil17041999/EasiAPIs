<?php
class Email_config_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }


    function get_email_config_data()
    {
        $this->db->select('*');
        $this->db->where('origin','1');
        $this->db->limit(1);
        $query = $this->db->get('email_configuration');
        //return TRUE;
        return $query->row();
    }


    
    function get_email_config_datas()
    {

        $sql = 'SELECT * FROM email_configuration WHERE origin = "1";';
        $query = $this->db->query($sql);
        $data = $query->result();
         return $data;

        // $this->db->select('*');
        // $this->db->where('origin','1');
        // $this->db->limit(1);
        // $query = $this->db->get('email_configuration');
        // return TRUE;
        // return $query->row();
    }

    // function update_email_config()
    // {
    //     $this->db->set('origin');
    //     $this->db->where('origin', 1);
    //     $this->db->update('email_configuration');
    //     return $this->db->affected_rows();
    // }

    function update_email_config($data1)
    {
        $userId = 1;
        $this->db->where('origin', $userId);
        $this->db->update('email_configuration',$data1);
        return TRUE;
    }


}