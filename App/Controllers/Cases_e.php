<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Adminm\Login_m;
use App\Models\Employeem\Cases_m;

class Cases_e extends Controller {
    private $Login_m;
    private $Cases_m;
    private $security;     
    public function __construct() {
        helper('url');
        $this->security = \Config\Services::security();           
        helper('functions');
        sessionCheckEmployee();       
        $this->Login_m = new Login_m();  
        $this->Cases_m = new Cases_m();  
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'employee') {
                $result = $this->Login_m->getTokenAndCheck($_SESSION['usertype'], $_SESSION['user_id']);
                if ($result) {
                    $token = $result['token'];
                    if ($_SESSION['tokencheck'] != $token) {
                        
                        if ($_SESSION['usertype'] == 'employee') {
                            sessionDestroy();
                            header('Location: ' . EMPLOYEE_LOGIN_LINK);
                        }
                        if ($_SESSION['usertype'] == 'admin') {
                            sessionDestroy();
                            header('Location: ' . ADMIN_LOGIN_LINK);
                        }
                    }
                }
            }
        }
    }           
    public function add_cases() { 
        
//        echo '<pre>';print_r($_POST);die;
        
        helper('form');
        $data['res_employee']=$this->Cases_m->get_employee();
        $data['title'] = EMPLOYEE_ADD_CASES_TITLE;        
        echo employee_view('employee/add_cases',$data);
    }
    public function cases_list() {                     
        $data['title'] = EMPLOYEE_LIST_CASES_TITLE;        
        echo employee_view('employee/cases_list',$data);
    }    
}
