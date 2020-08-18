<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Causes_c extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        $this->load->helper(array('url', 'functions', 'form'));
//        $this->load->library('session');
        sessionCheckAdmin();
        include APPPATH . 'third_party/image-resize/imageresize.php';                          
        $this->load->model('adminm/Causes_m');
        $this->load->model('adminm/Login_m');              
        if (isset($_SESSION['user_id'])) {
            $result = $this->Login_m->getTokenAndCheck($_SESSION['usertype'], $_SESSION['user_id']);
            if ($result) {
                $token = $result['token'];
                if ($_SESSION['tokencheck'] != $token) {
                    session_destroy();
                    redirect(ADMIN_LOGIN_LINK);
                }
            }
        }
        $this->userId = (int) $_SESSION['user_id'];
        $method=$this->router->fetch_method();
        visitLog($method,"Causes_c");
    }

    public function add_causes() {         
        if (isset($_POST['upload_file_title'])) {
            unset($_POST['g-recaptcha-response']); 
            if ($_POST['upload_file_title'] && $_POST['upload_file_title'] != '') {                
                $_POST['admin_user_id'] = $this->userId;
                if (($_FILES['upload_file_original_name']['name']) != '') {
                    $fileRes = singleFileUpload('upload_file_original_name');
                    if (!empty($fileRes[2]['file_name'])) {
                        $_POST['upload_file_location'] = $fileRes[2]['file_name'];
                        $_POST['upload_file_original_name'] = $fileRes[2]['original_file_name'];        
                        $res = $this->Causes_m->add_causes($_POST);
                        if ($res) {
                            //Success message : Complaint has been added
                            successOrErrorMessage("File has been added", 'success');
                            redirect(ADMIN_FILE_LIST_LINK);
                        } else {
                            //Error message
                            successOrErrorMessage("something happened wrong", 'error');
                        }
                    } else {
                            $message=$fileRes[1];
                            successOrErrorMessage($message, 'error');
                    }
                }
            }
        }
        $data['file_type']=$this->Causes_m->get_file_type('MAIN_TYPE');
        $data['title'] = ADMIN_ADD_CAUSES_TITLE;
        $this->load->admin_view('adminside/causes/add', $data);
    }
    
    public function edit_causes($upload_file_id) {         
        if (isset($_POST['upload_file_title'])) {   
            unset($_POST['g-recaptcha-response']);           
            if ($_POST['upload_file_title'] && $_POST['upload_file_title'] != '') {                
                $_POST['admin_user_id'] = $this->userId;            
                $res = $this->Causes_m->edit_causes($_POST,$upload_file_id);                
                if ($res) {                    
                    //Success message : File has been added
                    successOrErrorMessage("File has been updated", 'success');
                    redirect(ADMIN_FILE_LIST_LINK);
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                }
            }
        }
        $data['single_file']=$this->Causes_m->get_single_file($upload_file_id);
        if(isset($data['single_file'])){
            $data['file_type']=$this->Causes_m->get_file_type('MAIN_TYPE');
            $data['file_sub_type']=$this->Causes_m->get_sub_type($data['single_file']['upload_file_type']); 
            $data['upload_file_id']=$upload_file_id;
            $data['title'] = ADMIN_EDIT_CAUSES_TITLE;
            $this->load->admin_view('adminside/causes/edit', $data);
        }else{
            redirect(PAGE_404_LINK);
        }
    }

    public function file_list() {
        $data['title'] = ADMIN_FILE_LIST_TITLE;
        $this->load->admin_view('adminside/causes/file_list', $data);
    }
    public function load_sub_type(){
        if($_POST['category_code']){            
            $sub_type = $this->Causes_m->load_sub_type($_POST);           
            $result=array();
            $result['sub_type']=$sub_type;            
            $result['token'] = $this->security->get_csrf_hash();               
            echo json_encode($result);
        }
    }
    
    public function active_causes(){
        if(isset($_POST['upload_file_id'])){           
            $res = $this->Causes_m->active_causes($_POST);
            if($res){      
                $data = array(                    
                    'suceess' => true
                );
            }else{
                $data = array(                    
                    'suceess' => false
                );
            }
            $data['token'] = $this->security->get_csrf_hash(); 
            echo json_encode($data);
        }
    }
}
