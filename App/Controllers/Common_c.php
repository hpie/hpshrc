<?php

namespace App\Controllers;

use App\Models\Adminm\Login_m;
use App\Models\Common_m;
use App\Models\Employeem\Cases_m;
use App\ThirdParty\smtp_mail\SMTP_mail;

class Common_c extends BaseController {

    private $Login_m;
    private $Common_m;
    private $security;
    private $Cases_m;

    public function __construct() {
        helper('functions');
        helper('url');            
        $this->Login_m = new Login_m();
        $this->Common_m = new Common_m();
        $this->Cases_m = new Cases_m(); 
        $this->security = \Config\Services::security();                
    }
    public function add_cases() {               
         if (isset($_POST['cases_title'])) { 
            if(isset($_SESSION['customer']['customer_id'])){
                $customer_id=$_SESSION['customer']['customer_id'];
            }else{
                $params=array();
                $params['customer_email_id']=$_POST['customer_email'];
                $params['customer_mobile_no']=$_POST['customer_contact'];
                $params['customer_email_password']=generateStrongPassword(); 
                $customer_id =  $this->Cases_m->create_customer($params);  
            }
            $params=array();                        
            $params['cases_title']=$_POST['cases_title'];
            $params['cases_message']=$_POST['cases_message'];            
            $params['cases_dt_created']=date("Y-m-d H:i:s");
            $params['refCustomer_id']=$customer_id;
            $params['createdby_user_type']='customer';
            $params['created_by']=$customer_id;
            
            if(isset($_POST['howtocontact'])){
                if($_POST['howtocontact']=='Email'){
                    $params['customer_email']=$_POST['customer_email'];
                }  
                if($_POST['howtocontact']=='Mobile'){
                    $params['customer_contact']=$_POST['customer_contact'];
                }
                if($_POST['howtocontact']=='Both'){
                    $params['customer_email']=$_POST['customer_email'];
                    $params['customer_contact']=$_POST['customer_contact'];
                }   
            }
            $res =  $this->Cases_m->create_case($params);             
            if ($res) {
                 if (($_FILES['case_files_file']['name'][0]) != '') {                   
                    $cases_files = multiFileUpload('case_files_file',$res.'/');                                        
                    foreach ($cases_files as $row) {
                        $params = array();
                        $params['refCases_id'] = $res;
                        $params['case_files_name'] = $row[2]['original_file_name'];
                        $params['case_files_unique_name'] = $row[2]['file_name'];
                        $params['case_files_size'] = $row[2]['file_size'];
                        $params['case_files_type'] ="main";                                                
                        $this->Cases_m->add_cases_files($params);
                    }
                } 
                $params=array();
                $params['refCases_id']=$res;
                $params['comment_type']='create';
                $params['comment_from']=$customer_id;
                $params['comment_to']=$customer_id;
                $params['comment_from_usertype']='customer';
                $params['comment_to_usertype']='customer';
                $params['comment_datetime']=date("Y-m-d H:i:s");
                $this->Cases_m->add_cases_comment($params);                
                successOrErrorMessage("Request sent successfully",'success');                
            } else {                
                successOrErrorMessage("Somthing happen wrong plz try again",'error');
            }          
        }
        helper('form');        
        $data['title'] = REQUEST_CASES_TITLE;        
        echo front_view('frontside/case_request',$data);
    } 
    
    public function create_customer() {
        if(isset($_SESSION['customer']['customer_id'])){
            return redirect()->to(BASE_URL); 
        }       
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
            $res =  $this->Common_m->register_customer($_POST);                       
            $result = array();
            $send_email_error = 0;
            if ($res['success'] == true) {
                $result['success'] = 'success';
                $link_code = gen_uuid($res['customer_id'], 'e');
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
                if ($resMail['success'] == 1) {
                    $params = array();
                    $params['user_id'] = $res['customer_id'];
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
        echo front_view('frontside/user_registration', $data);
        if(isset($_SESSION['post_data'])){
            unset($_SESSION['post_data']);
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
