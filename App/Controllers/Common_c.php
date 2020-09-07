<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Adminm\Login_m;
use App\Models\Common_m;
use App\ThirdParty\smtp_mail\SMTP_mail;

class Common_c extends Controller {

    private $Login_m;
    private $Common_m;
    private $security;

    public function __construct() {
        helper('functions');
        helper('url');
        $this->Login_m = new Login_m();
        $this->Common_m = new Common_m();
        $this->security = \Config\Services::security();                        
//        if (isset($_SESSION['employee_user_id'])) {            
//                $result = $this->Login_m->getTokenAndCheck('employee', $_SESSION['employee_user_id']);
//                if ($result) {
//                    $token = $result['token'];
//                    if ($_SESSION['employee_tokencheck'] != $token) {                                                                       
//                            logoutUser('admin');
//                            header('Location: ' . EMPLOYEE_LOGIN_LINK);
//                            exit();                        
//                    }   
//                }            
//        }         
//        if (isset($_SESSION['admin_user_id'])) {            
//                $result = $this->Login_m->getTokenAndCheck('admin', $_SESSION['admin_user_id']);
//                if ($result) {
//                    $token = $result['token'];
//                    if ($_SESSION['admin_tokencheck'] != $token) {                                                                       
//                            logoutUser('admin');
//                            header('Location: ' . ADMIN_LOGIN_LINK);
//                            exit();                        
//                    }   
//                }            
//        }                
    }

    public function create_customer() {
        include APPPATH . 'ThirdParty/smtp_mail/smtp_send.php';                         
        $_SESSION['exist_email'] = 0;
        if (isset($_POST['customer_first_name'])) {
            $_SESSION['post_data']=$_POST;            
            if(!isset($_POST['customer_email_password'])){
                $_POST['customer_email_password']=generateStrongPassword();
            }
            if(isset($_POST['user_confirm_password'])){
                unset($_POST['user_confirm_password']); 
            }                                   
            if (($_FILES['customer_photo_path']['name']) != '') {
                $fileRes = singleImageUpload('customer_photo_path');
                if (!empty($fileRes[2]['file_name'])) {
                    $_POST['customer_photo_path'] = $fileRes[2]['file_name'];
                }
            }
            $res =  $this->Common_m->register_customer($_POST);                       
            $result = array();
            $send_email_error = 0;
            if ($res['success'] == true) {
                $result['success'] = 'success';
                $link_code = gen_uuid($res['customer_id '], 'e');
                $email_active_link = CUSTOMER_ACTIVE_EMAIL_LINK . 'customer/' . $link_code;
                $result['success'] = 'success';
                $data = array(
                    'username' => $res['email'],
                    'password' => $_POST['customer_email_password'],
                    'template' => 'studentRegistrationTemplate.html',
                    'activationlink' => $email_active_link
                );
                $sendmail = new \SMTP_mail();
                $resMail = $sendmail->sendRegistrationDetails($res['email'], $data);
//                log_message('info',print_r($resMail,TRUE));        
                if ($resMail['success'] == 1) {
                    $params = array();
                    $params['user_id'] = $res['customer_id '];
                    $params['link_code'] = $link_code;
                    $params['user_type'] = 'customer';
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
        $data['title'] = CUSTOMER_REGISTRATION_TITLE;        
       
        if($_SESSION['employee']['employee_usertype']=='employee'){
            sessionCheckEmployee();               
            echo employee_view('employee/user_registration', $data);
            die;
        }
        
        if($_SESSION['admin']['admin_usertype']=='admin'){
            sessionCheckAdmin();
            echo admin_view('adminside/customer/user_registration', $data);
            die;
        }               
        echo front_view('frontside/user_registration', $data);
        if(isset($_SESSION['post_data'])){
            unset($_SESSION['post_data']);
        }
        die;                      
    }
    
    public function edit_customer($customer_id) {                                
        if (isset($_POST['customer_first_name'])) {
            unset($_POST['g-recaptcha-response']);
            if (($_FILES['customer_photo_path']['name']) != '') {
                $fileRes = singleImageUpload('customer_photo_path');
                if (!empty($fileRes[2]['file_name'])) {
                    $_POST['customer_photo_path'] = $fileRes[2]['file_name'];
                }
            }
            $res =  $this->Common_m->edit_customer($_POST,$customer_id);                       
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
        $data['single_customer']=$this->Common_m->get_single_customer($customer_id);
        $data['customer_id'] = $customer_id;        
        $data['title'] = EDIT_CUSTOMER_TITLE;        
        
            if($_SESSION['employee']['employee_usertype']=='employee'){
                sessionCheckEmployee();               
                echo employee_view('employee/edit_customer', $data);
            }
            if($_SESSION['admin']['admin_usertype']=='admin'){
                sessionCheckAdmin();
                echo admin_view('adminside/customer/edit_customer', $data);
            }                       
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
