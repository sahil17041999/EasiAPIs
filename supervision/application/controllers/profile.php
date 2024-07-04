<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class User extends BaseController
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('login_history_model');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->isLoggedIn();
    }


    public function profile()
    {
        $page_data["userInfo"] = $this->user_model->getUserInfoWithRole($this->vendorId);
        $this->loadViews("admin/profile", $page_data);
    }





    public function profile_Update()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');


        $userId = $this->input->post('userId');
        if ($this->form_validation->run() == FALSE) {
            // $this->profile($active);
        } else {

            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
            $address = $this->input->post('address');
            $userInfo_profile = array(
                'name' => $name,
                'address' => $address,
            );

            $profile_data = $this->user_model->editUserProfile($userInfo_profile, $userId);
            if ($profile_data == true) {
                $this->session->set_flashdata('success', 'User profile updated successfully');
                redirect('user/profile');
            } else {
                $this->session->set_flashdata('error', 'User profile updation failed');
                redirect('user/profile');
            }
        }
        $page_data["userInfo"] = $this->user_model->getUserInfoWithRole($this->vendorId);
        $this->loadViews("admin/edit_profile", $page_data);
    }
}
