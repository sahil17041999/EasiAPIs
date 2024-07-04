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
        $this->load->model('module_model');
        $this->isLoggedIn();
    }


    public function admin()
    {

        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $page_data['userRecords'] = $this->user_model->userListing();
            $page_data['pageTitle'] = 'User Listing';
            $this->loadViews("admin/admin_info", $page_data);
        }
    }
    function add_user()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            // $this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[usr_user.user_email]',
            //     array('is_unique' => 'This %s already exists.')
            // );
            $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
            // $this->form_validation->set_rules('roleId','RoleId','trim|required|numeric');
            // $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            // $this->form_validation->set_rules('phone_code','Phone_coder','required');

            if ($this->form_validation->run() == FALSE) {
                // $this->admin();
            } else {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                // $roleId = $this->input->post('roleId');
                // $mobile = $this->security->xss_clean($this->input->post('mobile'));
                $isAdmin = $this->input->post('isAdmin');
                $address = $this->input->post('address');
                // $phone_code = $this->input->post('phone_code');

                $userInfo = array(
                    'email' => $email,
                    'password' => getHashedPassword($password),
                    //  'roleId'=>$roleId,
                    'name' => $name,
                    //  'mobile'=>$mobile,
                    'isAdmin' => $isAdmin,
                    'address' => $address,
                    //  'phone_code'=>$phone_code,
                    'createdBy' => $this->vendorId,
                    'createdDtm' => date('Y-m-d H:i:s')
                );
                $result = $this->user_model->addNewUser($userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New User added successfully');
                    redirect('user/admin');
                } else {
                    $this->session->set_flashdata('error', 'User creation failed');
                    redirect('user/admin');
                }
            }
            $page_data['phone_code'] = $this->user_model->phone_code();
            $this->loadViews("admin/add_admin", $page_data);
        }
    }


    function editOld($userId = NULL)
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            if ($userId == null) {
                //  redirect('admin');
            }

            $page_data['userInfo'] = $this->user_model->getUserInfo($userId);
            $page_data['phone_code'] = $this->user_model->phone_code();
            $this->loadViews("admin/edit_admin", $page_data);
        }
    }




    function editUser()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $userId = $this->input->post('userId');
            // debug($userId);die;
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
            } else {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $isAdmin = $this->input->post('isAdmin');
                $address = $this->input->post('address');
                $userInfo = array();

                $userInfo = array(
                    'email' => $email, 'name' => $name,
                    'isAdmin' => $isAdmin, 'updatedBy' => $this->vendorId, 'address' => $address, 'updatedDtm' => date('Y-m-d H:i:s')
                );

                $result = $this->user_model->editUser($userInfo, $userId);
                if ($result == true) {
                    $this->session->set_flashdata('success', 'User updated successfully');
                    redirect('user/admin');
                } else {
                    $this->session->set_flashdata('error', 'User updation failed');
                    redirect('user/admin');
                }
            }
        }
    }




    function change_password($active = "changepass")
    {
        $this->form_validation->set_rules('oldPassword', 'Old password', 'required|max_length[20]');
        $this->form_validation->set_rules('newPassword', 'New password', 'required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword', 'Confirm new password', 'required|matches[newPassword]|max_length[20]');
        if ($this->form_validation->run() == FALSE) {
            /// $this->profile($active);
        } else {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            if (empty($resultPas)) {
                $this->session->set_flashdata('mismatch', 'Your old password is not correct');
                redirect('user/change_password');
            } else {
                $usersData = array(
                    'password' => getHashedPassword($newPassword), 'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s')
                );
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Your password change successful');
                    redirect('user/change_password');
                } else {
                    $this->session->set_flashdata('error', 'Password updation failed');
                    redirect('user/change_password');
                }
            }
        }
        $this->loadViews("admin/change_password");
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



    public function update_profile_image()
    {
        $config['upload_path'] = 'assets/img/user_images';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = 'profile_' . uniqid();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $uploadData = $this->upload->data();
            $fileName = $uploadData['file_name'];

            $this->user_model->update_profile_image($fileName);
            echo json_encode(['newImageName' => $fileName]);
        } else {
            echo json_encode(['error' => $this->upload->display_errors()]);
        }
    }



    public function update_status($userId)
    {
        $status = $this->input->post('status');
        $this->user_model->update_client_status($userId, $status);
    }




    public function login_histoy($userId = NULL)
    {

        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $userId = ($userId == NULL ? 0 : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->login_history_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;

            $this->load->library('pagination');

            $count = $this->login_history_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress("login-history/" . $userId . "/", $count, 10, 3);

            $data['userRecords'] = $this->login_history_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = ' User Login History';
            $this->loadViews("admin/login_history", $this->global, $data, NULL);
        }
    }

    function deleteUser($userId = 0)
    {
        if (!$this->isAdmin()) {
            //echo(json_encode(array('status'=>'access')));
        } else {
            if ($userId > 0) {
                $result = $this->user_model->deleteUser($userId);
                $this->session->set_flashdata('error', 'User deleted successfuly');
                redirect('user/admin');
            } else {
                redirect('user/admin');
            }
        }
    }


    function emailExists($email)
    {
        $userId = $this->vendorId;
        $return = false;

        if (empty($userId)) {
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if (empty($result)) {
            $return = true;
        } else {
            $this->form_validation->set_message('emailExists', 'The {field} already taken');
            $return = false;
        }

        return $return;
    }

    public function view_subscribed_emails()
    {
        $params = $this->input->get();
        $domain_key = 1;
        if (intval($domain_key) > 0) {
            $data['domain_admin_exists'] = true;
        } else {
            $data['domain_admin_exists'] = false;
        }
        $data['subscriber_list'] = $this->user_model->get_subscribed_emails($domain_key, @$params['email']);
        //debug($data['subscriber_list']);die;
        $this->loadViews("admin/subscribed_email", $data);
    }

    public function delete_subscribed_emails($id)
    {
        $this->custom_db->delete_record('email_subscribtion', array('id' => $id));
        $this->session->set_flashdata('error', 'subscribed email deleted successfully');
        redirect('user/view_subscribed_emails');
    }
    public function status_subscribed($id)
    {

        $status = $this->input->post('status');
        $this->user_model->status_subscribe($id, $status);
    }

    public function auth()
    {
        $cols = ' * ';

        $tmp_data = $this->custom_db->single_table_records('authentication', $cols);
        $page_data['authentication_data'] = '';
        $page_data['authentication_data'] = $tmp_data['data'];
        //debug(json_decode($page_data['authentication_data'][0]['Module']));die;
        $this->loadViews("Auth/api_auth", $page_data);
    }

    public function add_auth()
    {

        $this->form_validation->set_rules('domain', 'domain name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $Auth_data = $this->input->post();
            $username =   $Auth_data['username'];
            //debug($username);die;
            if ($this->user_model->is_email_exists($username)) {

                $page_data['error_msg'] = "Email already registered";
                // $this->session->set_flashdata('error', 'Email already registered');
                $this->loadViews("Auth/add_api_auth", $page_data);
                // redirect('user/add_auth');
            } else {

                $page_data['domain'] =  $Auth_data['domain'];
                $page_data['username'] =  $Auth_data['username'];
                $page_data['password'] =  $Auth_data['password'];
                $page_data['status'] =  $Auth_data['status'];

                //$page_data['Module'] = json_encode($Auth_data['Module']);	
                $user_id = $this->user_model->insert_auth($page_data);
                if ($user_id) {
                    $permission = array();
                    $permission['modules'] = implode(",", $Auth_data['modules']);
                    $permission['user_id'] = $user_id;

                    $authenticatopn_data =   $this->user_model->role($permission);

                    if ($authenticatopn_data > 0) {
                        $this->session->set_flashdata('success', 'Authentication added successfully');
                        redirect('user/auth');
                    } else {
                        $this->session->set_flashdata('error', 'Authentication not added please try again!');
                        redirect('user/auth');
                    }
                }
            }
        } else {
            $cols = ' * ';
            $tmp_data = $this->custom_db->single_table_records('profession', $cols);
            $page_data['modules_data'] = '';
            $page_data['modules_data'] = $tmp_data['data'];
            $this->loadViews("Auth/add_api_auth", $page_data);
        }
    }


    public function edit_auth($user_id)
    {
      
        $this->form_validation->set_rules('domain', 'domain name', 'required');
        // $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == TRUE) {
            $Auth_data = $this->input->post();
           
            // $permission = array();
            // $page_data['password'] =  $Auth_data['password'];
            // $page_data['domain'] =  $Auth_data['domain'];
            // $permission['modules'] = implode(",", $Auth_data['modules']);

            $data1 = array(
                'password' => $Auth_data['password'],
                'domain' => $Auth_data['domain']
            );
           // debug($data1);
            $edit_auth =   $this->user_model->update_auth($user_id,$data1);

            $data2 = array(
                'modules' => implode(",", $Auth_data['modules'])
            );
           // debug($data2);die;

             $this->user_model->update_role($user_id,$data2);
             $this->session->set_flashdata('success', 'Authentication data updated successfully');
                redirect('user/auth');
        } else {
        }
        //$page_data['edit_auth_info'] = $this->module_model->get_auth($id);
        $page_data['update_auth_data'] = $this->module_model->update_auth_data($user_id);
       // debug($page_data['update_auth_data']);die;



        $cols = ' * ';
        $tmp_data = $this->custom_db->single_table_records('profession', $cols);
        $page_data['modules_data'] = '';
        $page_data['modules_data'] = $tmp_data['data'];
        $this->loadViews("Auth/edit_api_auth", $page_data);
    }


    function delete_auth($id)
    {
        $this->custom_db->delete_record('authentication', array('id' => $id));
        $this->session->set_flashdata('error', 'Authentication deleted successfully');
        redirect('user/auth');
    }


    function auth_status($id)
    {
        $status = $this->input->post('status');
        $this->user_model->auth_status($id, $status);
    }
}
