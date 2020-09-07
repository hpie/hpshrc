<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Adminm\Login_m;

class Admin_c extends Controller {

    private $Login_m;
    private $security;     
    public function __construct() {         
        helper('functions');
        helper('url');
        echo '5';
        sessionCheckAdmin();
        echo '8';
        $this->Login_m = new Login_m();
        $this->security = \Config\Services::security();
        if (isset($_SESSION['admin_user_id'])) { 
                echo '9';
                $result = $this->Login_m->getTokenAndCheck('admin', $_SESSION['admin_user_id']);
                if ($result) {
                    echo '10';
                    $token = $result['token'];
                    if ($_SESSION['admin_tokencheck'] != $token) {
                            echo '11';die;
                            logoutUser('admin');
                            header('Location: ' . ADMIN_LOGIN_LINK);
                            exit();                        
                    }   
                }            
        }        
    }
    public function dashboard() {
        echo 'success';die;
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
            $result['token'] = $this->security->getCSRFHash();
            echo json_encode($result);
            die;
        }
        $data['title'] = ADMIN_UPDATE_PROFILE_TITLE;
        echo admin_view('adminside/update_profile', $data);
    }

}
