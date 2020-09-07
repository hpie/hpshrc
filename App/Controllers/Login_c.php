<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Adminm\Login_m;

class Login_c extends Controller
{
    private $Login_m;        
    public function __construct() {  
        helper('functions');    
        $this->Login_m = new Login_m();        
    }    
    public function index() {
        helper('form');
        echo '1';
        if (isset($_SESSION['admin_user_id'])) {
            echo '2';
            if ($_SESSION['admin_user_id'] > 0) {
                echo '3';die;
                logoutUser('admin');
                unset($_SESSION['admin_user_id']);
                return redirect()->to(ADMIN_LOGIN_LINK); 
            }
        }       
        $_SESSION['invalid_login'] = 0;
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $result = $this->Login_m->admin_login_select($_POST['username'], $_POST['password']);
            if ($result == true) {
                $userId = $_SESSION['admin_user_id'];
                $userType = $_SESSION['admin_usertype'];
                log_message('info', "$userType id $userId logged into the system"); 
                echo '4';
                return redirect()->to(ADMIN_DASHBOARD_LINK); 
            }
            if ($result == false) {
                $_SESSION['invalid_login'] = 1;
            }
        } 
        $data['title']=ADMIN_LOGIN_TITLE;
        echo single_page('adminside/login', $data);
    }
    public function logout() {
        logoutUser('admin');
        return redirect()->to(ADMIN_LOGIN_LINK); 
    }
}
