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
        if (isset($_SESSION['employee']['employee_user_id'])) {            
                $result = $this->Login_m->getTokenAndCheck('employee', $_SESSION['employee']['employee_user_id']);
                if ($result) {
                    $token = $result['token'];
                    if ($_SESSION['employee']['employee_tokencheck'] != $token) {                                                                       
                            logoutUser('employee');
                            header('Location: ' . EMPLOYEE_LOGIN_LINK);
                            exit();                        
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
