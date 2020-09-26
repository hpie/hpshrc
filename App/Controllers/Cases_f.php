<?php
namespace App\Controllers;

use App\Models\Adminm\Login_m;
use App\Models\Employeem\Cases_m;

class Cases_f extends BaseController {
    private $Login_m;
    private $Cases_m;
    private $security;     
    public function __construct() {
        helper('url');
        helper('functions');
        $this->security = \Config\Services::security(); 
//        print_r($_SESSION);die;
//        sessionCheckCustomer();     
        $this->Login_m = new Login_m();  
        $this->Cases_m = new Cases_m();        
        if (isset($_SESSION['customer']['customer_id'])) {            
                $result = $this->Login_m->getTokenAndCheck('customer', $_SESSION['customer']['customer_id']);
                if ($result) {
                    $token = $result['token'];
                    if ($_SESSION['customer']['customer_tokencheck'] != $token) {                         
                            logoutUser('employee');
                            header('Location: ' . FRONT_LOGIN_LINK);
                            exit();                        
                    }   
                }            
        } 
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
}
