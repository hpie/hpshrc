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

                $this->db->query("UPDATE admin SET user_attempt =0,user_locked_status=0 WHERE admin_user_id = '{$admin_data['admin_user_id']}'");
                
                $this->db->query("UPDATE admin SET user_login_active = 1 WHERE admin_user_id='" . $admin_data['admin_user_id'] . "' ");
                sessionAdmin($admin_data);
                
                $token=generateToken();                
                $_SESSION['tokencheck'] = $token;
                $uid=$admin_data['admin_user_id'];
                                                
                $result_token = $this->db->query("select count(*) as allcount from admin_token");
                $row_token = $result_token->row_array();                
                if ($row_token['allcount'] > 0) {                    
                    $this->db->query("update admin_token set token='$token' where admin_user_id='$uid'");
                } else {
                    $this->db->query("insert into admin_token(admin_user_id,token) values('$uid','$token')");
                }
                return true;
            }
        } else {
            $get_user = $this->db->query("SELECT * FROM admin WHERE user_email_id = '$username' ");
            $check = $get_user->row_array();
            if (is_array($check)) {

                if ($check['user_attempt'] == 0 || $check['user_attempt'] == 1) {
                    $this->db->query("UPDATE admin SET user_attempt = user_attempt+1 WHERE admin_user_id = '{$check['admin_user_id']}'");
                }
                if ($check['user_attempt'] >= 2) {
                    $this->db->query("UPDATE admin SET user_attempt=user_attempt+1 WHERE admin_user_id = '{$check['admin_user_id']}'");
                    $this->db->query("UPDATE admin SET user_locked_status=1 WHERE admin_user_id = '{$check['admin_user_id']}'");
                    $_SESSION['invalidAttempt'] = 1;
                }
            }
        }
        return false;
    }
        
    public function getTokenAndCheck($table,$user_id) {
        $table=$table.'_token';
        $result = $this->db->query("SELECT token FROM $table where admin_user_id='$user_id'");
        $data = $result->row_array();        
        if($data){
            return $data;
        }
        return false;
    }
    public function update_logout_status($user_id) {
        $query_res = $this->db->query("UPDATE admin SET user_login_active = 0 WHERE admin_user_id='" . $user_id . "' ");
        if ($query_res) {
            return true;
        }
    }
    
    public function check_current_password($current_password) {
        $current_password = md5($current_password);
        $rmsa_user_id = $_SESSION['user_id'];
        $check = $this->db->query("SELECT * FROM admin
                                       WHERE admin_user_id = '" . $rmsa_user_id . "'
                                       AND user_email_password ='" . $current_password . "'");
        $row = $check->row_array();
        if (isset($row)) {
            if ($current_password == $row['user_email_password']) {
                return true; //matched
            }
        }
        return false; //not matched
    }

    public function update_password($params) {
        $new_password = md5($params['user_new_password']);
        $rmsa_user_id = $_SESSION['user_id'];
        $result = $this->db->query("UPDATE admin
                              SET user_email_password = '" . $new_password . "'
                              WHERE admin_user_id = '" . $rmsa_user_id . "'");
        return $result; //return true/false
    }
}
