<?php
namespace App\Controllers;

use App\Models\Adminm\Login_m;
use App\Models\Employeem\Cases_m;

class Cases_e extends BaseController {
    private $Login_m;
    private $Cases_m;
    private $security;     
    public function __construct() {
        helper('url');
        helper('functions');
        $this->security = \Config\Services::security();           
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
    
     public function edit_cases($cases_id) { 
         if (isset($_POST['cases_title'])) { 
            $params=array();
            $params['cases_priority']=$_POST['cases_priority'];
            $params['cases_title']=$_POST['cases_title'];
            $params['cases_message']=$_POST['cases_message'];
            $params['cases_assign_to']=$_POST['cases_assign_to'];
            $params['case_update_date']=date("Y-m-d h:i:s");          
            $res =  $this->Cases_m->edit_cases($params,$cases_id);             
            if ($res) {
                successOrErrorMessage("Data updated successfully",'success');                
            } else {                
                successOrErrorMessage("Somthing happen wrong plz try again",'error');
            }          
        }
        helper('form');
        $data['cases_res']=$this->Cases_m->get_single_cases($cases_id);
        $data['res_employee']=$this->Cases_m->get_employee();
        $data['title'] = EMPLOYEE_EDIT_CASES_TITLE;        
        echo employee_view('employee/edit_cases',$data);
    }
    
    public function add_cases() { 
         if (isset($_POST['cases_title'])) { 
            $params=array();
            $params['cases_priority']=$_POST['cases_priority'];
            $params['cases_title']=$_POST['cases_title'];
            $params['cases_message']=$_POST['cases_message'];
            $params['cases_assign_to']=$_POST['cases_assign_to'];
            $params['cases_dt_created']=date("Y-m-d h:i:s");          
            $res =  $this->Cases_m->create_case($params); 
            
            if ($res) {
//                echo '<pre>';print_r($_FILES);die;
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
                successOrErrorMessage("Data added successfully",'success');                
            } else {                
                successOrErrorMessage("Somthing happen wrong plz try again",'error');
            }          
        }
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
