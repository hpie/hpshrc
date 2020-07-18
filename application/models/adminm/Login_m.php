<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }
    
     public function admin_login_select($username, $password) {
        $password = md5($password);
        $resAdmin = $this->db->query("SELECT * FROM `admin` WHERE ( user_email_id = '$username') AND user_email_password = '$password' AND user_status = 'ACTIVE' AND user_locked_status=0");
        $admin_data = $resAdmin->row_array();
        if (isset($admin_data)) {                     
           if (($username == $admin_data['user_email_id']) && ($password == $admin_data['user_email_password'])) {               

                $this->db->query("UPDATE admin SET user_attempt =0,user_locked_status=0 WHERE user_id = '{$admin_data['user_id']}'");
                
                $this->db->query("UPDATE admin SET user_login_active = 1 WHERE user_id='" . $admin_data['user_id'] . "' ");
                sessionAdmin($admin_data);
                
                $token=generateToken();                
                $_SESSION['tokencheck'] = $token;
                $uid=$admin_data['user_id'];
                                                
                $result_token = $this->db->query("select count(*) as allcount from admin_token");
                $row_token = $result_token->row_array();                
                if ($row_token['allcount'] > 0) {                    
                    $this->db->query("update admin_token set token='$token' where user_id='$uid'");
                } else {
                    $this->db->query("insert into admin_token(user_id,token) values('$uid','$token')");
                }
                return true;
            }
        } else {
            $get_user = $this->db->query("SELECT * FROM admin WHERE user_email_id = '$username' ");
            $check = $get_user->row_array();
            if (is_array($check)) {

                if ($check['user_attempt'] == 0 || $check['user_attempt'] == 1) {
                    $this->db->query("UPDATE admin SET user_attempt = user_attempt+1 WHERE user_id = '{$check['user_id']}'");
                }
                if ($check['user_attempt'] >= 2) {
                    $this->db->query("UPDATE admin SET user_attempt=user_attempt+1 WHERE user_id = '{$check['user_id']}'");
                    $this->db->query("UPDATE admin SET user_locked_status=1 WHERE user_id = '{$check['user_id']}'");
                    $_SESSION['invalidAttempt'] = 1;
                }
            }
        }
        return false;
    }
        
    public function getTokenAndCheck($table,$user_id) {
        $table=$table.'_token';
        $result = $this->db->query("SELECT token FROM $table where user_id='$user_id'");
        $data = $result->row_array();        
        if($data){
            return $data;
        }
        return false;
    }
    public function update_logout_status($user_id) {
        $query_res = $this->db->query("UPDATE admin SET user_login_active = 0 WHERE user_id='" . $user_id . "' ");
        if ($query_res) {
            return true;
        }
    }
}
