<?php namespace App\Controllers;

use App\Models\Adminm\Login_m;

class Login_c extends BaseController
{
    private $Login_m; 
    private $security;  
    public function __construct() {  
        helper('functions');
        helper('url');        
        $this->security = \Config\Services::security();       
        $this->Login_m = new Login_m();        
    }    
    public function index() {
        helper('form');
        $result = false;

        if (isset($_SESSION['admin']['admin_user_id'])) {            
            if ($_SESSION['admin']['admin_user_id'] > 0) {                
                logoutUser('admin');               
                return redirect()->to(ADMIN_LOGIN_LINK); 
            }
        }               
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $result = $this->Login_m->admin_login_select($_POST['username'], $_POST['password']);
            if ($result == true) {
                $userId = $_SESSION['admin']['admin_user_id'];
                $userType = $_SESSION['admin']['admin_usertype'];
//                log_message('info', "$userType id $userId logged into the system");                
                return redirect()->to(ADMIN_DASHBOARD_LINK); 
            }       
        }

        if ($result == false) {
            $data['title']=ADMIN_LOGIN_TITLE;
            echo single_page('adminside/login', $data);
        }

    }
    public function logout() {
        logoutUser('admin');
        return redirect()->to(ADMIN_LOGIN_LINK); 
    }
}
