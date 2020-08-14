<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }
    
     public function employee_login_select($username, $password) {
        $password = md5($password);
        $resemployee = $this->db->query("SELECT * FROM `employee` WHERE ( user_email_id = '$username') AND user_email_password = '$password' AND user_status = 'ACTIVE' AND user_locked_status=0");
        $employee_data = $resemployee->row_array();
        if (isset($employee_data)) {                     
           if (($username == $employee_data['user_email_id']) && ($password == $employee_data['user_email_password'])) {               

                $this->db->query("UPDATE employee SET user_attempt =0,user_locked_status=0 WHERE employee_user_id = '{$employee_data['employee_user_id']}'");
                
                $this->db->query("UPDATE employee SET user_login_active = 1 WHERE employee_user_id='" . $employee_data['employee_user_id'] . "' ");
                sessionEmployee($employee_data);
                
                $token=generateToken();                
                $_SESSION['tokencheck'] = $token;
                $uid=$employee_data['employee_user_id'];
                                                
                $result_token = $this->db->query("select count(*) as allcount from employee_token");
                $row_token = $result_token->row_array();                
                if ($row_token['allcount'] > 0) {                    
                    $this->db->query("update employee_token set token='$token' where employee_user_id='$uid'");
                } else {
                    $this->db->query("insert into employee_token(employee_user_id,token) values('$uid','$token')");
                }
                return true;
            }
        } else {
            $get_user = $this->db->query("SELECT * FROM employee WHERE user_email_id = '$username' ");
            $check = $get_user->row_array();
            if (is_array($check)) {
                $attempt=$check['user_attempt'];
                if ($attempt == 0 || $attempt == 1) {
                    $msgAttempt=2-$attempt;
                    $this->db->query("UPDATE employee SET user_attempt = user_attempt+1 WHERE employee_user_id = '{$check['employee_user_id']}'");
                    successOrErrorMessage("Invalid Username & Password. Account will be locked after $msgAttempt unsuccessful attempts", 'error');
                }
                if ($attempt >= 2) {
                    $this->db->query("UPDATE employee SET user_attempt=user_attempt+1,user_locked_status=1 WHERE employee_user_id = '{$check['employee_user_id']}'");                  
                    successOrErrorMessage('Your account is locked after consecutive failure attempts. Please contact your school with your email id to unlock', 'error');
                }
            }
        }
        return false;
    }
        
    public function getTokenAndCheck($table,$user_id) {
        $table=$table.'_token';
        $result = $this->db->query("SELECT token FROM $table where employee_user_id='$user_id'");
        $data = $result->row_array();        
        if($data){
            return $data;
        }
        return false;
    }
    public function update_logout_status($user_id) {
        $query_res = $this->db->query("UPDATE employee SET user_login_active = 0 WHERE employee_user_id='" . $user_id . "' ");
        if ($query_res) {
            return true;
        }
    }
    
    public function check_current_password($current_password) {
        $current_password = md5($current_password);
        $employee_user_id = $_SESSION['user_id'];
        $check = $this->db->query("SELECT * FROM employee
                                       WHERE employee_user_id = '" . $employee_user_id . "'
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
        $employee_user_id = $_SESSION['user_id'];
        $result = $this->db->query("UPDATE employee
                              SET user_email_password = '" . $new_password . "'
                              WHERE employee_user_id = '" . $employee_user_id . "'");
        return $result; //return true/false
    }
}
