<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Causes_c extends CI_Controller {

    public function __construct() {
        parent::__construct();
        securityToken1();
        sessionCheckAdmin();
        include APPPATH . 'third_party/image-resize/imageresize.php';
//        include APPPATH . 'third_party/smtp_mail/smtp_send.php';                                      
//       $a = new SMTP_mail;
//       $res = $a->sendMail('vasimlook@gmail.com','vasim','9099384773','hi');                          
        $this->load->model('adminm/Causes_m');
        $this->load->model('adminm/Login_m');
        $this->load->helper('url');
        $this->load->helper('functions');
        $_SESSION['securityToken2'] = $_SESSION['securityToken1'];
        sessionCheckToken();
        $_SESSION['securityToken1'] = bin2hex(random_bytes(24));
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
//        $method=$this->router->fetch_method();
//        visitLog($method,"Home");
    }

    public function add_causes() {
        if (isset($_POST['uploadd_file_name'])) {
            if ($_REQUEST['uploadd_file_name'] && $_REQUEST['uploadd_file_name'] != '') {
                $_REQUEST['user_id'] = $this->userId;
                if (($_FILES['uploadd_file_original_name']['name']) != '') {
                    $fileRes = singleFileUpload('uploadd_file_original_name');

                    if (!empty($fileRes[2]['file_name'])) {
                        $_REQUEST['uploadd_file_name'] = $fileRes[2]['file_name'];
                        $_REQUEST['uploadd_file_original_name'] = $fileRes[2]['original_file_name'];
                        $res = $this->Causes_m->add_causes($_REQUEST);
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
        $data['title'] = ADMIN_ADD_CAUSES_TITLE;
        $this->load->admin_view('adminside/causes/add', $data);
    }

    public function file_list() {
        $data['title'] = ADMIN_FILE_LIST_TITLE;
        $this->load->admin_view('adminside/causes/file_list', $data);
    }

}
