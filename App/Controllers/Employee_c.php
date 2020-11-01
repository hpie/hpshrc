<?php
namespace App\Controllers;

use App\Models\Adminm\Login_m;

class Employee_c extends BaseController {
    private $Login_m;
    private $security;      
    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start();                         
        helper('url');
        helper('functions');
        $this->security = \Config\Services::security();                  
        sessionCheckEmployee();  
        $this->Login_m = new Login_m();         
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
                  else{
                    logoutUser('employee');
                    header('Location: ' . EMPLOYEE_LOGIN_LINK);
                    exit();
                }
            
        } 
    }           
    public function dashboard() {
        $data['totaluser']=$this->Login_m->count_data1('hpshrc_customer','customer_id');
        $data['totalactiveuser']=$this->Login_m->count_data('hpshrc_customer','customer_id','customer_status','ACTIVE');
        $data['totalinactiveuser']=$this->Login_m->count_data('hpshrc_customer','customer_id','customer_status','REMOVED');
        
        $data['totalcases']=$this->Login_m->count_data1('cases','cases_id');
        $data['totalopencases']=$this->Login_m->count_data('cases','cases_id','cases_status','open');
        $data['totalclosedcases']=$this->Login_m->count_data('cases','cases_id','cases_status','closed');  
        $data['title'] = EMPLOYEE_DASHBOARD_TITLE;        
        echo employee_view('employee/dashboard',$data);
    }
    public function update_profile(){         
        $result=array();               
        if(isset($_POST['user_current_password']) && $_POST['user_current_password']!=''){            
            if($this->Login_m->check_emp_current_password($_POST['user_current_password'])){                
                $res = $this->Login_m->update_emp_password($_POST);                    
                if($res){
                    successOrErrorMessage("Password changed successfully", 'success');
                    $result['success']="success";                   
                }                
            }
            else{
                $result['success']="fail";
            }
//            $result['token'] = $this->security->getCSRFHash();  
            echo json_encode($result);die;            
        } 
        helper('form');
        $data['title']=EMPLOYEE_UPDATE_PROFILE_TITLE;        
        echo employee_view('employee/update_profile',$data);
    }        
}
