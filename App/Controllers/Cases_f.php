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
        sessionCheckCustomer();          
        $this->Login_m = new Login_m();  
        $this->Cases_m = new Cases_m();         
        if (isset($_SESSION['customer']['customer_id'])) {           
                $result = $this->Login_m->getTokenAndCheck('customer', $_SESSION['customer']['customer_id']);
                if ($result) {                    
                    $token = $result['token'];
                    if ($_SESSION['customer']['customer_tokencheck'] != $token) {                          
                            logoutUser('customer');
                            header('Location: ' . FRONT_LOGIN_LINK);
                            exit();                        
                    }   
                }            
        } 
    }             
    
    public function view_cases($case_id) {        
        $data['caseDetails']=$this->Cases_m->get_view_cases($case_id);
        $data['involved_peopel']=$this->Cases_m->get_involved_peopel($case_id);
        $data['comments']=$this->Cases_m->get_comments($case_id);
        $data['title'] = FRONT_VIEW_CASES_TITLE;       
        echo front_view('frontside/view_cases',$data);
    }
    public function cases_list() {            
        $data['title'] = FRONT_LIST_CASES_TITLE;                
        echo front_view('frontside/cases_list',$data);
    }
}
