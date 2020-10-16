<?php
namespace App\Controllers;

use App\Models\Adminm\Login_m;
use App\Models\Adminm\Causes_m;

class Expense_c extends BaseController {    
    private $Login_m;
    private $Causes_m;
    private $security;
    private $userId;
    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start();             
        helper('url');
        helper('functions');
        sessionCheckAdmin();              
        $this->Login_m = new Login_m();
        $this->Causes_m = new Causes_m();
        $this->security = \Config\Services::security();
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
        $this->userId = (int) $_SESSION['admin']['admin_user_id'];        
    }
    public function add_expense() {        
        if (isset($_POST['budget_soe'])) {                       
            if ($_POST['budget_soe'] && $_POST['budget_soe'] != '') {              
                $res = $this->Causes_m->add_expense($_POST);                
                if ($res) {
                    //Success message : Complaint has been added
                    successOrErrorMessage("Data added successfully", 'success');
                    return redirect()->to(ADMIN_EXPENSE_LIST_LINK.$_POST['budget_year']);
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                }                                    
            }
        }
        helper('form');         
        $data['title'] = ADMIN_ADD_EXPENSE_TITLE;
        echo admin_view('adminside/expense/add', $data);
    }    
    public function edit_expense($budget_id) {        
        if (isset($_POST['budget_soe'])) {                       
            if ($_POST['budget_soe'] && $_POST['budget_soe'] != '') {              
                $res = $this->Causes_m->edit_expense($_POST,$budget_id);                
                if ($res) {                    
                    //Success message : File has been added
                    successOrErrorMessage("Data has been updated", 'success');
                    return redirect()->to(ADMIN_EXPENSE_LIST_LINK.$_POST['budget_year']);
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                }
            }
        }
        helper('form');
        $data['budget']=$this->Causes_m->get_single_budget($budget_id);               
        $data['budget_id']=$budget_id;
        $data['title'] = ADMIN_EDIT_EXPENSE_TITLE;
        echo admin_view('adminside/expense/edit', $data);                   
    }            
    public function expense_list($year) {
       $data['year']=$year; 
       $data['title'] = ADMIN_EXPENSE_LIST_TITLE;
       echo admin_view('adminside/expense/expense_list', $data);
    }      
}
