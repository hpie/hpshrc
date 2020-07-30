<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_c extends CI_Controller {

    public function __construct() {        
        parent::__construct();   
        $this->load->helper(array('url','functions'));            
        $this->load->model('adminm/Login_m');                                                           
        if (isset($_SESSION['user_id'])) {           
            $result = $this->Login_m->getTokenAndCheck($_SESSION['usertype'],$_SESSION['user_id']);            
            if ($result) {                
                $token = $result['token'];
                if($_SESSION['tokencheck'] != $token) {
                    session_destroy(); 
                    redirect(ADMIN_LOGIN_LINK);
                }
            }
        }
    }           
    public function index() {     
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['user_id'] > 0) {
                redirect(ADMIN_DASHBOARD_LINK);
            }
        } 
        $_SESSION['invalid_login'] = 0;
        if (isset($_POST['username']) && isset($_POST['password'])) {            
            $result = $this->Login_m->admin_login_select($_POST['username'], $_POST['password']);
            if ($result == true) {
                $userId=$_SESSION['user_id'];
                $userType=$_SESSION['usertype']; 
                log_message('info', "$userType id $userId logged into the system");
                redirect(ADMIN_DASHBOARD_LINK);
            }
            if ($result == false) {
                $_SESSION['invalid_login'] = 1;
            }
        }                       
        $data['title'] = ADMIN_LOGIN_TITLE;        
        $this->load->single_page('adminside/login',$data);
    }
    public function logout() {          
//        $res = $this->Student_model->update_logout_status($_SESSION['st_rmsa_user_id']);
        sessionDestroy();        
//        if($res){
            redirect(ADMIN_LOGIN_LINK);
//        }        
    }
}
