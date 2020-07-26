<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_c extends CI_Controller {

    public function __construct() {
        parent::__construct();
        securityToken1();
        sessionCheckAdmin();                
//        include APPPATH . 'third_party/image-resize/imageresize.php';
//        include APPPATH . 'third_party/smtp_mail/smtp_send.php';                                      
//       $a = new SMTP_mail;
//       $res = $a->sendMail('vasimlook@gmail.com','vasim','9099384773','hi');                                  
        $this->load->model('adminm/Login_m');
        $this->load->helper('url');                        
        $this->load->helper('functions');         
        $_SESSION['securityToken2']=$_SESSION['securityToken1'];
        sessionCheckToken();
        $_SESSION['securityToken1'] = bin2hex(random_bytes(24));                     
        if (isset($_SESSION['user_id'])) {            
            $result = $this->Login_m->getTokenAndCheck($_SESSION['usertype'],$_SESSION['user_id']);            
            if ($result) {                
                $token = $result['token'];
                if($_SESSION['tokencheck'] != $token) {
                    session_destroy(); 
                    redirect(ADMIN_LOGIN_LINK);
                }
            }
        }
//        $method=$this->router->fetch_method();
//        visitLog($method,"Home");
    }           
    public function dashboard() {                     
        $data['title'] = ADMIN_DASHBOARD_TITLE;        
        $this->load->admin_view('adminside/dashboard',$data);
    }
    public function update_profile(){
        $result=array();               
        if(isset($_POST['user_current_password']) && $_POST['user_current_password']!=''){            
            if($this->Login_m->check_current_password($_POST['user_current_password'])){                
                $res = $this->Login_m->update_password($_POST);                    
                if($res){
                    successOrErrorMessage("Password changed successfully", 'success');
                    $result['success']="success";                   
                }                
            }
            else{
                $result['success']="fail";
            }
            echo json_encode($result);die;            
        }        
        $data['title']=ADMIN_UPDATE_PROFILE_TITLE;        
        $this->load->admin_view('adminside/update_profile',$data);
    } 
}
