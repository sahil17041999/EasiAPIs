<?php
class User_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    

    function loginMe($email, $password)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.password, BaseTbl.name, BaseTbl.isAdmin,BaseTbl.status,BaseTbl.image');
        $this->db->from('tbl_users as BaseTbl');
        // $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.email', $email);
        // $this->db->where('BaseTbl.status', 1);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        $user = $query->row();
        // debug($user);die;
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    function lastLogin($loginInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_last_login', $loginInfo);
        $this->db->trans_complete();
    }

   //  last login info  sahil shaikh
    function lastLoginInfo($userId)
    {
        $this->db->select('BaseTbl.createdDtm,BaseTbl.updated_at');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_last_login as BaseTbl');

        return $query->row();
    }

    function getRoleAccessMatrix($roleId)
    {
        $this->db->select('roleId, access');
        $this->db->from('tbl_access_matrix');
        $this->db->where('roleId', $roleId);
        $query = $this->db->get();
        
        $result = $query->row();
        return $result;
    }

   

    function userListing()
    {
        $this->db->select('BaseTbl.status,BaseTbl.userId, BaseTbl.email, BaseTbl.name,BaseTbl.phone_code,BaseTbl.phone_code,BaseTbl.mobile,BaseTbl.address, BaseTbl.isAdmin, BaseTbl.createdDtm, 
        Role.role, Role.status as roleStatus');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.userId', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
  
    // get phone code    sahil shaikh
    function phone_code(){
        $this->db->select('phone_code.phonecode as code,phone_code.country_name	 as country');
        $this->db->from('country_code as phone_code');
        $query = $this->db->get();
        $phone_code = $query->result();        
        return $phone_code;
    }
    

    // add new user sahil shaikh

    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    // edit user sahil shaikh
    function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return TRUE;
    }

    function editUserProfile($userInfo_profile, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo_profile);
        
        return TRUE;
    }

    public function update_profile_image($fileName) {
        $data = array(
            'image' => $fileName
        );

        $this->db->where('userId', $this->session->userdata('userId'));
        $this->db->update('tbl_users', $data);
    }

    //delete user sahil shaikh

    function deleteUser($userId)
    {
        $this->db->where('userId', $userId);
        //$this->db->update('tbl_users');
        $this->db->delete('tbl_users');
        
        // return $this->db->affected_rows();
    }

    function getUserInfo($userId)
    {
        $this->db->select('userId, name, email, mobile, isAdmin, roleId,phone_code,address,image');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }
    



     // check Exitts email


     function checkEmailExist($email)
     {
         $this->db->select('userId');
         $this->db->where('email', $email);
         $this->db->where('isDeleted', 0);
         $query = $this->db->get('tbl_users');
 
         if ($query->num_rows() > 0){
             return true;
         } else {
             return false;
         }
     }

     function resetPasswordUser($data)
     {
         $result = $this->db->insert('tbl_reset_password', $data);
         //debug($result);die;
         if($result) {
             return TRUE;
         } else {
             return FALSE;
         }
     }

     function getCustomerInfoByEmail($email)
     {
         $this->db->select('userId, email, name');
         $this->db->from('tbl_users');
         $this->db->where('isDeleted', 0);
         $this->db->where('email', $email);
         $query = $this->db->get();
 
         return $query->row();
     } 
     

    function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email");
        $this->db->from("tbl_users");
        $this->db->where("email", $email);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }


   // match old password sahil shaikh
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
   
    // change password sahil shaikh

    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function getUserInfoWithRole($userId)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.address, BaseTbl.isAdmin,BaseTbl.image');
        $this->db->from('tbl_users as BaseTbl');
        // $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

    public function update_client_status($userId,$status)
           {
              $data['status'] = $status;
              $this->db->where('userId', $userId);
              $this->db->update('tbl_users',$data);
            }

//     public function update_user_status($userId){
//         //$value =  1;
//         $value = $this->input->get('status');
        
       

//         if($value == '1'){
//             $statuss = 0;
//         }else{
//             $statuss = 1;
//         }
//         $data = array(
//             'status'=>$statuss
//         );
//         // debug($data);die;

//         $this->db->where('userId', $userId);
//         $this->db->update('tbl_users',$data );
//   }

function checkActivationDetails($email, $activation_id)
{
    $this->db->select('id');
    $this->db->from('tbl_reset_password');
    $this->db->where('email', $email);
    $this->db->where('activation_id', $activation_id);
    $query = $this->db->get();
    return $query->num_rows();
}

function createPasswordUser($email, $password)
{
    $this->db->where('email', $email);
    $this->db->where('isDeleted', 0);
    $this->db->update('tbl_users', array('password'=>getHashedPassword($password)));
    $this->db->delete('tbl_reset_password', array('email'=>$email));
}
	
	
public function get_subscribed_emails($domain_key, $email='')
	{
		if(isset($email)){
			$query = $this->db->get_where('email_subscribtion',array('domain_list_fk'=>$domain_key,'email_id' => $email));
		}
		else{
			$query = $this->db->get_where('email_subscribtion',array('domain_list_fk'=>$domain_key));
		}
	
		return $query->result();
	}
	
	 public function status_subscribe($id, $status)
    {
        $data['status'] = $status;
        $this->db->where('id', $id);
        $this->db->update('email_subscribtion', $data);
    }
	
	public function auth_status($id, $status)
    {
        $data['status'] = $status;
        $this->db->where('id', $id);
        $this->db->update('authentication', $data);
    }
	
	
    public function is_email_exists($username) {
        $query = $this->db->get_where('authentication', array('username' => $username));
        return $query->num_rows() > 0;
    }

    public function insert_auth($data) {
        $this->db->insert('authentication', $data);
        return $this->db->insert_id(); // Return the inserted ID
    }
	public function role($data) {
        return $this->db->insert('api_permission', $data);
    }

    public function update_auth($user_id, $data) {
        $this->db->where('id', $user_id);
        $this->db->update('authentication', $data);
    }

    // Update data in the second table
    public function update_role($user_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->update('api_permission', $data);
    }
	
}
?>