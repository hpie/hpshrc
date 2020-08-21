<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Employeem\Login_m;

class Employee_c extends Controller {
    private $Login_m;
    private $security;     
    public function __construct() {
        helper('url');
        $this->security = \Config\Services::security();           
        helper('functions');
        sessionCheckEmployee();       
        $this->Login_m = new Login_m();                                        
        if (isset($_SESSION['user_id'])) {
            if($_SESSION['usertype']=='employee'){
            $result = $this->Login_m->getTokenAndCheck($_SESSION['usertype'],$_SESSION['user_id']);            
            if ($result) {                
                $token = $result['token'];
                if($_SESSION['tokencheck'] != $token) {
                    session_destroy(); 
                    header('Location: '.EMPLOYEE_LOGOUT_LINK);
                    exit(); 
                }
            }
            }
        }
    }           
    public function dashboard() {                     
        $data['title'] = EMPLOYEE_DASHBOARD_TITLE;        
        echo employee_view('employee/dashboard',$data);
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
            $result['token'] = $this->security->getCSRFHash();  
            echo json_encode($result);die;            
        } 
        helper('form');
        $data['title']=EMPLOYEE_UPDATE_PROFILE_TITLE;        
        echo employee_view('employee/update_profile',$data);
    } 
}
