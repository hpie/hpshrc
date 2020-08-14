<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_c extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'functions', 'form'));
        $this->load->library('session');
        $this->load->model('employeem/Login_m');
        if (isset($_SESSION['user_id'])) {
            $result = $this->Login_m->getTokenAndCheck($_SESSION['usertype'], $_SESSION['user_id']);
            if ($result) {
                $token = $result['token'];
                if ($_SESSION['tokencheck'] != $token) {
                    session_destroy();
                    redirect(EMPLOYEE_LOGIN_LINK);
                }
            }
        }
        $method=$this->router->fetch_method();
        visitLog($method,"Employee Login_c");
    }

    public function index() {       
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['user_id'] > 0) {
                redirect(EMPLOYEE_DASHBOARD_LINK);
            }
        }
        $_SESSION['invalid_login'] = 0;
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $result = $this->Login_m->employee_login_select($_POST['username'], $_POST['password']);
            if ($result == true) {
                $userId = $_SESSION['user_id'];
                $userType = $_SESSION['usertype'];
                log_message('info', "$userType id $userId logged into the system");
                redirect(EMPLOYEE_DASHBOARD_LINK);
            }
            if ($result == false) {
                $_SESSION['invalid_login'] = 1;
            }
        }
        $data['title'] = EMPLOYEE_LOGIN_TITLE;
        $this->load->single_page('employee/login', $data);
    }

    public function logout() {
        sessionDestroy();
        redirect(EMPLOYEE_LOGIN_LINK);
    }

}
