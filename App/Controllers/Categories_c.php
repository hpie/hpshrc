<?php
namespace App\Controllers;

use App\Models\Adminm\Login_m;
use App\Models\Adminm\Causes_m;

class Categories_c extends BaseController {    
    private $Login_m;
    private $Causes_m;
    private $security;
    private $userId;
    public function __construct() {               
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
    public function add_category() {        
        if (isset($_POST['category_code'])) {                       
            if ($_POST['category_code'] && $_POST['category_code'] != '') {                                
                $_POST['category_ref_type']='MAIN_TYPE';
                $res = $this->Causes_m->add_category($_POST);                
                if ($res) {
                    //Success message : Complaint has been added
                    successOrErrorMessage("Data added successfully", 'success');
                    return redirect()->to(ADMIN_CATEGORIES_LIST_LINK);
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                }                                    
            }
        }
        helper('form');         
        $data['title'] = ADMIN_ADD_CATEGORIES_TITLE;
        echo admin_view('adminside/categories/add', $data);
    }
    
    public function edit_category($category_code) {        
        if (isset($_POST['category_code'])) {                       
            if ($_POST['category_code'] && $_POST['category_code'] != '') {                                         
                $res = $this->Causes_m->edit_category($_POST,$category_code);                
                if ($res) {                    
                    //Success message : File has been added
                    successOrErrorMessage("Data has been updated", 'success');
                    return redirect()->to(ADMIN_CATEGORIES_LIST_LINK);
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                }
            }
        }
        helper('form');
        $data['category']=$this->Causes_m->get_single_category($category_code);               
        $data['category_code']=$category_code;
        $data['title'] = ADMIN_EDIT_CATEGORIES_TITLE;
        echo admin_view('adminside/categories/edit', $data);                   
    }
    
     public function add_sub_category() {        
        if (isset($_POST['category_code'])) {                       
            if ($_POST['category_code'] && $_POST['category_code'] != '') {                                
                $_POST['category_ref_type']='SUB_TYPE';
                $res = $this->Causes_m->add_category($_POST);                
                if ($res) {
                    //Success message : Complaint has been added
                    successOrErrorMessage("Data added successfully", 'success');
                    return redirect()->to(ADMIN_CATEGORIES_LIST_LINK);
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                }                                    
            }
        }
        helper('form');
        $data['file_type']=$this->Causes_m->get_file_type('MAIN_TYPE');        
        $data['title'] = ADMIN_ADD_SUB_CATEGORIES_TITLE;
        echo admin_view('adminside/categories/add_subcategory', $data);
    }
    
    public function edit_sub_category($category_code) {        
        if (isset($_POST['category_code'])) {                       
            if ($_POST['category_code'] && $_POST['category_code'] != '') {  
                $_POST['category_ref_type']='SUB_TYPE';
                $res = $this->Causes_m->edit_category($_POST,$category_code);                
                if ($res) {                    
                    //Success message : File has been added
                    successOrErrorMessage("Data has been updated", 'success');
                    return redirect()->to(ADMIN_CATEGORIES_LIST_LINK);
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                }
            }
        }
        helper('form');
        $data['file_type']=$this->Causes_m->get_file_type('MAIN_TYPE');  
        $data['category']=$this->Causes_m->get_single_category($category_code);               
        $data['category_code']=$category_code;
        $data['title'] = ADMIN_EDIT_SUB_CATEGORIES_TITLE;
        echo admin_view('adminside/categories/edit_subcategory', $data);                   
    }        
    public function categories_list() {
       $data['title'] = ADMIN_CATEGORIES_LIST_TITLE;
       echo admin_view('adminside/categories/categories_list', $data);
    }  
    public function active_category(){
        if(isset($_POST['category_code'])){           
            $res = $this->Causes_m->active_category($_POST);
            if($res){      
                $data = array(                    
                    'suceess' => true
                );
            }else{
                $data = array(                    
                    'suceess' => false
                );
            }
            echo json_encode($data);
        }
    }
}
