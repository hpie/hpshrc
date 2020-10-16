<?php

namespace App\Controllers;

use App\Models\Employeem\Customers_m;
use App\Models\Adminm\Login_m;
use App\Models\Common_m;

class Employee_a extends BaseController {

    private $Customers_m;
    private $Login_m;
    private $security;
    private $Common_m;

    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->security = \Config\Services::security();        
        sessionCheckAdmin();
        $this->Common_m = new Common_m();
        $this->Customers_m = new Customers_m();
        $this->Login_m = new Login_m();
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
    public function employee_list() {
        $data['title'] = ADMIN_EMPLOYEE_LIST_TITLE;
        echo admin_view('adminside/employee/employee_list', $data);
    }

    public function approve_status() {
        if (isset($_REQUEST['table_id'])) {
            $res = $this->Customers_m->approve_status($_REQUEST);
             if ($res) {
                $data = array(
                    'suceess' => true
                );
            }
//            $data['token'] = $this->security->getCSRFHash();
            echo json_encode($data);
        }
    }
    
    
     public function create_employee() {
        include APPPATH . 'ThirdParty/smtp_mail/smtp_send.php';                         
        $_SESSION['exist_email'] = 0;
        if (isset($_POST['user_firstname'])) {
            $_SESSION['post_data']=$_POST;
            $userRoll=$_POST['employee_roll'];
            unset($_POST['employee_roll']);
            if(!isset($_POST['user_email_password'])){
                $_POST['user_email_password']=generateStrongPassword();
            }
            if(isset($_POST['user_confirm_password'])){
                unset($_POST['user_confirm_password']); 
            }                                               
            $res =  $this->Common_m->register_employee($_POST);                       
            $result = array();
            $send_email_error = 0;
            if ($res['success'] == true) {
                $this->Common_m->remove_employee_roll($res['employee_user_id']);
                $roll_params=array();
                $roll_params['refUser_id']=$res['employee_user_id'];                
                for ($i=0;$i<count($userRoll);$i++){                
                    $roll_params['roll_title']=$userRoll[$i];
                    $this->Common_m->add_employee_roll($roll_params);                    
                } 
                $result['success'] = 'success';
                $link_code = gen_uuid($res['employee_user_id'], 'e');
                $email_active_link = EMPLOYEE_ACTIVE_EMAIL_LINK . $link_code;                
                $data = array(
                    'username' => $res['email'],
                    'password' => $_POST['user_email_password'],
                    'template' => 'employeeRegistrationTemplate.html',
                    'activationlink' => $email_active_link
                );
                $sendmail = new \SMTP_mail();
                $resMail = $sendmail->sendRegistrationDetails($res['email'], $data);       
                if ($resMail['success'] == 1) {
                    $params = array();
                    $params['user_id'] = $res['employee_user_id'];
                    $params['link_code'] = $link_code;
                    $params['user_type'] = 'employee';
                    $this->Common_m->user_email_link($params);
                } else {
                    $_SESSION['send_email_error'] = 1;
                    $send_email_error = 1;
                }
            } else {
                if (isset($res['email_exist'])) {
                    if ($res['email_exist'] == true) {
                        $_SESSION['exist_email'] = 1;
                        $result['exist_email'] = 1;
                    }
                }
                $result['success'] = 'fail';
            }
            if ($result['success'] == 'success' && $send_email_error == 1) {
                $_SESSION['registration'] = 1;
            }
            if ($result['success'] == 'success' && $send_email_error == 0) {
                $_SESSION['registration'] = 2;
            } 
            if ($result['success'] == 'fail') {                
                $_SESSION['registration'] = 3;
            }
            if($result['success']=="success"){
                if(isset($_SESSION['post_data'])){
                    unset($_SESSION['post_data']);
                }
            }
        }
        
        helper('form');
        $data['title'] = ADMIN_EMPLOYEE_REGISTRATION_TITLE;              
        echo admin_view('adminside/employee/employee_registration', $data);
        
        if(isset($_SESSION['post_data'])){
            unset($_SESSION['post_data']);
        }                              
    }
    
    public function edit_employee($employee_id) {                                
        if (isset($_POST['user_firstname'])) {
            $userRoll=$_POST['employee_roll'];            
            unset($_POST['employee_roll']);
            $this->Common_m->remove_employee_roll($employee_id);
            $roll_params=array();
            $roll_params['refUser_id']=$employee_id;                        
            for ($i=0;$i<count($userRoll);$i++){                  
                $roll_params['roll_title']=$userRoll[$i];
                $this->Common_m->add_employee_roll($roll_params);                
            }             
            $res =  $this->Common_m->edit_employee($_POST,$employee_id);                       
            $result = array();
            $send_email_error = 0;
            if ($res['success'] == true) {
                successOrErrorMessage("Data updated successfully", "success");          
            } else {
                if (isset($res['email_exist'])) {
                    if ($res['email_exist'] == true) {
                        successOrErrorMessage("Email allready exist", "error");
                    }
                }                
            }            
        }
        helper('form');
        $data['employee_roll']=$this->Common_m->get_employee_roll($employee_id);       
        $data['single_employee']=$this->Common_m->get_single_employee($employee_id);
        $data['employee_id'] = $employee_id;        
        $data['title'] = ADMIN_EDIT_EMPLOYEE_TITLE;            
        echo admin_view('adminside/employee/edit_employee', $data);                                  
    }
    
    
    public function verify_email($user_type, $link_code) {
        $user_id = gen_uuid($link_code, 'd');
        $res = $this->Common_m->chek_code_exist($user_id, $link_code, $user_type);
        $data['success'] = 0;
        if ($res) {
            $data['success'] = 1;
        }
        echo single_page('frontside/thankyou', $data);
    }

}
