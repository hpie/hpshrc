<?php
namespace App\Controllers;

use App\Models\Adminm\Login_m;

class Admin_c extends BaseController {
    private $Login_m;
    private $security;     
    public function __construct() {         
        helper('url');
        helper('functions');
        sessionCheckAdmin();        
        $this->Login_m = new Login_m();
        $this->security = \Config\Services::security();
        if (isset($_SESSION['admin']['admin_user_id'])) {            
                $result = $this->Login_m->getTokenAndCheck('admin', $_SESSION['admin']['admin_user_id']);
                if ($result) {
                    $token = $result['token'];
                    if ($_SESSION['admin']['admin_tokencheck'] != $token) {                                                                       
                            logoutUser('admin');
                            header('Location: ' . ADMIN_LOGIN_LINK);
                            exit();                        
                    }   
                }            
        }        
    }
    public function dashboard() {
        $data['totaluser']=$this->Login_m->count_data1('hpshrc_customer','customer_id');
        $data['totalactiveuser']=$this->Login_m->count_data('hpshrc_customer','customer_id','customer_status','ACTIVE');
        $data['totalinactiveuser']=$this->Login_m->count_data('hpshrc_customer','customer_id','customer_status','REMOVED');
        
        $data['totalcases']=$this->Login_m->count_data1('cases','cases_id');
        $data['totalopencases']=$this->Login_m->count_data('cases','cases_id','cases_status','open');
        $data['totalclosedcases']=$this->Login_m->count_data('cases','cases_id','cases_status','closed');  
        
        $data['title'] = ADMIN_DASHBOARD_TITLE;
        echo admin_view('adminside/dashboard', $data);                
    }
    public function update_profile() {
        $result = array();
        if (isset($_POST['user_current_password']) && $_POST['user_current_password'] != '') {
            if ($this->Login_m->check_current_password($_POST['user_current_password'])) {
                $res = $this->Login_m->update_password($_POST);
                if ($res) {
                    successOrErrorMessage("Password changed successfully", 'success');
                    $result['success'] = "success";
                }
            } else {
                $result['success'] = "fail";
            }
//            $result['token'] = $this->security->getCSRFHash();
            echo json_encode($result);
            die;
        }
        helper('form');
        $data['title'] = ADMIN_UPDATE_PROFILE_TITLE;
        echo admin_view('adminside/update_profile', $data);
    }

}
