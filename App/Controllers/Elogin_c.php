<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Employeem\Login_m;

class Elogin_c extends Controller {

    private $Login_m;     
    public function __construct() {
        helper('functions');
        helper('cookie');
        $this->Login_m = new Login_m();       
    }

    public function index() {         
        helper('form');        
        if (isset($_SESSION['employee_user_id'])) {            
            if ($_SESSION['employee_user_id'] > 0) {                
                logoutUser('employee'); 
                unset($_SESSION['employee_user_id']);
                return redirect()->to(EMPLOYEE_LOGIN_LINK);
            }
        }
        $_SESSION['invalid_login'] = 0;
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $result = $this->Login_m->employee_login_select($_POST['username'], $_POST['password']);
            if ($result == true) {                
                $userId = $_SESSION['admin_user_id'];
                $userType = $_SESSION['employee_usertype'];
                log_message('info', "$userType id $userId logged into the system");
                return redirect()->to(EMPLOYEE_DASHBOARD_LINK);
            }
            if ($result == false) {
                $_SESSION['invalid_login'] = 1;
            }
        }
        
        $data['title'] = EMPLOYEE_LOGIN_TITLE;
        echo single_page('employee/login', $data);
    }

    public function logout() {
        logoutUser('employee');
        return redirect()->to(EMPLOYEE_LOGIN_LINK);
    }

}
