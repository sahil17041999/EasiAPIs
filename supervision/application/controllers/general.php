<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class general extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    function __construct()
    {
        // Call the Model constructor
        
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
        $this->load->model('email_config_model');
        $this->load->helper('string');
       
    }
    public function index()
    {
     
        
        $this->isLoggedIn();
    }

    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            $this->load->view('admin/login');
        } else {
            redirect('/dashboard');
        }
    }



    public function login()
    {
        

        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            $result = $this->user_model->loginMe($email, $password);
           //debug($result);die;

            if($result->status == ''){
                $this->session->set_flashdata('error', 'you dont have account please contact with admin');
                redirect('general/index');
            } else if ($result->status != '1') {
                $this->session->set_flashdata('error', 'Your account deactived Please contact with admin');
                redirect('general/index');
            }
            if (!empty($result)) {
                if ($result->isAdmin != SYSTEM_ADMIN && ($result->roleStatus == 2 || $result->isRoleDeleted == 1)) {
                    $this->session->set_flashdata('error', 'The user doesn\'t have any role or the role is deactivated');
                    redirect('general/index');
                }

                $lastLogin = $this->user_model->lastLoginInfo($result->userId);

                $accessInfo = $this->accessInfo($result->roleId);

                $sessionArray = array(
                    'userId' => $result->userId,
                    // 'role'=>$result->roleId,
                    'image' => $result->image,
                    'roleText' => 'subadmin',
                    'name' => $result->name,
                    'isAdmin' => $result->isAdmin,
                    'accessInfo' => $accessInfo,
                    'lastLogin' => empty($lastLogin->createdDtm) ? '' : $lastLogin->createdDtm,
                    'updated_at' => empty($lastLogin->updated_at) ? '' : $lastLogin->updated_at,
                    'isLoggedIn' => TRUE
                );

                $this->session->set_userdata($sessionArray);

                unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin'], $sessionArray['accessInfo']);

                if ($result->userId == '1') {
                    $loginInfo = '';
                } else {
                    $loginInfo = array("userId" => $result->userId, "sessionData" => json_encode($sessionArray), "machineIp" => $_SERVER['REMOTE_ADDR'], "userAgent" => getBrowserAgent(), "agentString" => $this->agent->agent_string(), "platform" => $this->agent->platform());
                    $this->user_model->lastLogin($loginInfo);
                }

                redirect('/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Email or password invalid');
                redirect('general/index');
            }
        }
    }



    public function logout()
    {
       
        $this->session->sess_destroy();
        redirect('general/index');
    }


    private function accessInfo($roleId)
    {
        $finalMatrixArray = [];
        $matrix = $this->user_model->getRoleAccessMatrix($roleId);

        if (!empty($matrix)) {
            $accessMatrix = json_decode($matrix->access);
            foreach ($accessMatrix as $moduleMatrix) {
                $finalMatrixArray[$moduleMatrix->module] = (array) $moduleMatrix;
            }
        }

        return $finalMatrixArray;
    }


    public function forgot_password()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            $this->load->view('admin/forgot_password');
        } else {
            redirect('/dashboard');
        }
    }

    public function reset_password_user()
    {
        $this->form_validation->set_rules('login_email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->forgot_password();
        } else {
            $email = strtolower($this->security->xss_clean($this->input->post('login_email')));
            if ($this->user_model->checkEmailExist($email)) {
                $encoded_email = urlencode($email);
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum', 15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();
                $save = $this->user_model->resetPasswordUser($data);

                if ($save) {
                    $data1['reset_link'] = base_url() . "general/resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->user_model->getCustomerInfoByEmail($email);

                    if (!empty($userInfo)) {
                        $data1["name"] = $userInfo->name;
                        $data1["email"] = $userInfo->email;
                        $data1["message"] = "Reset Your Password";
                    }


                    // $sendStatus = resetPasswordEmail($data1);
                    $link = $data1['reset_link'];
                    $na = $data1["name"];
                    $mail_template = $this->load->view('email/resetPassword', $data1);
                    $template = "<html><body>
                    <h4>Hello,$na</h4>
                    <a href='$link' >Rest passowrd link</a>
                    </body></html>";

                    //debug($mail_template);die;
                    $this->load->library('provab_mailer');
                    $gmail =  $userInfo->email;

                    $sendStatus =  $this->provab_mailer->send_mail($gmail, 'Rest password link', $template);

                    if ($sendStatus) {
                        $status = "send";
                        setFlashData($status, "Reset password link sent successfully, please check your mails.");
                        redirect('general/reset_password_user');
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Email has been failed, try again.");
                        redirect('general/reset_password_user');
                    }
                } else {
                    $status = 'unable';
                    setFlashData($status, "It seems an error while sending your details, try again.");
                    redirect('general/reset_password_user');
                }
            } else {
                $status = 'invalid';
                setFlashData($status, "This email is not registered with us.");
                redirect('general/reset_password_user');
            }
        }
    }


    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);

        // Check activation id in database
        $is_correct = $this->user_model->checkActivationDetails($email, $activation_id);

        $data['email'] = $email;
        $data['activation_code'] = $activation_id;

        if ($is_correct == 1) {
            $this->load->view('admin/newpassword', $data);
        } else {
            //redirect('/login');
        }
    }


    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = strtolower($this->input->post("email"));
        $activation_id = $this->input->post("activation_code");

        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        } else {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');

            // Check activation id in database
            $is_correct = $this->user_model->checkActivationDetails($email, $activation_id);

            if ($is_correct == 1) {
                $this->user_model->createPasswordUser($email, $password);

                $status = 'success';
                $message = 'Password reset successfully';
                redirect('general');
            } else {
                $status = 'error';
                $message = 'Password reset failed';
                redirect('general/createPasswordUser');
            }

            setFlashData($status, $message);

            //redirect("/login");
        }
    }
}
