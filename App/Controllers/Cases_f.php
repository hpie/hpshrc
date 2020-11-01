<?php
namespace App\Controllers;

use App\Models\Adminm\Login_m;
use App\Models\Employeem\Cases_m;
use App\ThirdParty\smtp_mail\SMTP_mail;

class Cases_f extends BaseController {
    private $Login_m;
    private $Cases_m;
    private $security;
    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start();        
        helper('url');
        helper('functions');        
        $this->security = \Config\Services::security();                
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
            }else{
                    logoutUser('customer');
                    header('Location: ' . FRONT_LOGIN_LINK);
                    exit();
                } 
        }
    }
    public function cases_list() {
        $data['title'] = FRONT_LIST_CASES_TITLE;
        echo front_view('frontside/cases_list', $data);
    }
    
    
     public function update_profile() {
        $result = array();
        if (isset($_POST['user_current_password']) && $_POST['user_current_password'] != '') {
            if ($this->Login_m->check_current_password_front($_POST['user_current_password'])) {
                $res = $this->Login_m->update_password_front($_POST);
                if ($res) {
                    successOrErrorMessage("Password changed successfully", 'success');
                    $result['success'] = "success";
                }
            } else {
                $result['success'] = "fail";
            }
//            $result['token'] = $this->security->getCSRFHash();
            echo json_encode($result);
            die;
        }
        helper('form');
        $data['title'] = FRONT_UPDATE_PROFILE_TITLE;
        echo front_view('frontside/update_profile', $data);
    }
    
    
    public function add_comment() {
        $message = "fail";
        $comments = "";
        if (isset($_POST['cases_id'])) {
            if (!empty($_POST['cases_message'])) {
                $params = array();
                $params['refCases_id'] = $_POST['cases_id'];
                $params['comment_description'] = $_POST['cases_message'];
                $params['comment_type'] = 'comment';
                $params['comment_from'] = $_SESSION['customer']['customer_id'];
                $params['comment_to'] = $_POST['employee_id'];
                $params['comment_from_usertype'] = 'customer';
                $params['comment_to_usertype'] = 'employee';
                $params['comment_datetime'] = date("Y-m-d H:i:s");
                $res = $this->Cases_m->add_cases_comment($params);
                if ($res) {
                    if($_POST['employee_id']!=0){
                    include APPPATH . 'ThirdParty/smtp_mail/smtp_send.php'; 
                        $employee_data=$this->Cases_m->get_single_employee($_POST['employee_id']);                                        
                        if($employee_data['user_email_id']!=''){
                            $email_data=array();                            
                            $email_data['mail_title']='User is commented on case.';                        
                            $email_data['link_title']='View comment by clicking this link ';                                               
                            $email_data['case_link']=EMPLOYEE_VIEW_CASES_LINK.$_POST['cases_id'];
                            $sendmail = new \SMTP_mail();
                            $resMail = $sendmail->sendCommentDetails($employee_data['user_email_id'],$email_data); 
                        }
                    }
                                        
                    if (($_FILES['case_files_file']['name'][0]) != '') {
                        $cases_files = multiFileUpload('case_files_file', $_POST['cases_id'] . '/');
                        $i = 0;
                        foreach ($cases_files as $row) {
                            $params = array();
                            $params['refCases_id'] = $_POST['cases_id'];
                            $params['case_files_name'] = $row[2]['original_file_name'];
                            $params['case_files_unique_name'] = $row[2]['file_name'];
                            $params['case_files_size'] = $row[2]['file_size'];
                            $params['case_files_ext'] = $row[2]['file_ext'];
                            $params['case_files_type'] = "comment";
                            $params['refComment_id'] = $res;
                            $this->Cases_m->add_cases_files($params);
                            $i = $i + 1;
                        }
                    }
                    $comments = $this->comment_list($_POST['cases_id'], $_POST['last_comment_id']);
                    $message = "success";
                }
            }
        }
        $result = array();
        $result['message'] = $message;
        $result['comments'] = $comments;
        echo json_encode($result);
    }

    public function view_cases($case_id) {        
        helper('form');        
        $data['caseDetails'] = $this->Cases_m->get_view_cases($case_id);
        if($data['caseDetails']['refCustomer_id']==$_SESSION['customer']['customer_id']){
            $data['fileDetails'] = $this->Cases_m->get_file_details($case_id);
            $data['involved_peopel'] = $this->Cases_m->get_involved_peopel($case_id);
            $data['comments'] = $this->comment_list($case_id);
            $data['title'] = FRONT_VIEW_CASES_TITLE;
            echo front_view('frontside/view_cases', $data);
        }else{
            successOrErrorMessage("This is not youe case", 'error');
            return redirect()->to(FRONT_CASES_LIST_LINK);
        }
    }
    public function comment_list($case_id, $last_comment_id = 0) {
        $data['comments'] = $this->Cases_m->get_comments($case_id, $last_comment_id);
        $data['commentFileDetails'] = $this->Cases_m->get_comment_file_details($case_id, $last_comment_id);
        $result = array();
        if (!empty($data['comments'])) {
            foreach ($data['comments'] as $row) {
                $filesArray = array();
                foreach ($data['commentFileDetails'] as $row1) {
                    if ($row1['refComment_id'] == $row['comment_id']) {
                        array_push($filesArray, $row1);
                    }
                }
                $row['comment_file'] = $filesArray;
                array_push($result, $row);
            }
        }
        return $this->generate_comment_view($result, $case_id);
    }

    public function generate_comment_view($comments, $case_id) {
        $return_str = '';
        if (!empty($comments)) {
            if (!empty($comments)) {
                $i = 0;
                foreach ($comments as $crow) {
                    $i = $i + 1;
                    $lastcomment = '';
                    $from_name = '';
                    $datavalue = 0;
                    $user_img = '';
                    $comment_id = $crow['comment_id'];
                    $date = date("d-M-Y", strtotime($crow['comment_datetime']));
                    $datetime = date("d-M-Y h:i:sa", strtotime($crow['comment_datetime']));
                    if ($i == 1) {
                        $lastcomment = ' lastcomment';
                        $datavalue = $comment_id;
                    }
                    if ($crow['comment_from_usertype'] == 'employee') {
                        $from_name = strtoupper(substr($crow['f_user_firstname'], 0, 1) . substr($crow['f_user_lastname'], 0, 1));
                        $from_short_name = $crow['f_user_firstname'] . ' ' . $crow['f_user_lastname'] . ' (Employee)';
                        $user_img = UPLOAD_FOLDER . 'original/default2.png';
                    }
                    if ($crow['comment_from_usertype'] == 'customer') {
                        $from_name = strtoupper(substr($crow['fhc_customer_first_name'], 0, 1) . substr($crow['fhc_customer_last_name'], 0, 1));
                        $from_short_name = $crow['fhc_customer_first_name'] . ' ' . $crow['fhc_customer_last_name'] . ' (Customer)';
                        $user_img = UPLOAD_FOLDER . 'original/default.png';
                        if ($crow['fhc_customer_first_name'] == '') {
                            $from_short_name = 'Guest (Customer)';
                        }
                    }
                    $return_str .= '<div class="media' . $lastcomment . '" data-value="' . $datavalue . '">                     
                     <a class="pull-left" href="#"><img class="media-object" src="' . $user_img . '" alt=""></a>                                      
                    <div class="media-body">                                                                       
                        <h4 class="media-heading">' . $from_short_name . '</h4>';

                    if ($crow['comment_type'] == 'comment') {
                        if(strpos($crow['comment_description'],'<p>') !== false){
                            $description=$crow['comment_description'];
                        }
                        else{
                            $description='<p>'.$crow['comment_description'].'</p>';
                        }
                        $return_str .= $description;
                    }
                    if ($crow['comment_type'] == 'assign') {

                        $assign_to_name = $crow['t_user_firstname'] . ' ' . $crow['t_user_lastname'];
                        $return_str .= '<p><strong class="assign-title">Assign to</strong> @' . $assign_to_name . '</p>';
                    }
                    if ($crow['comment_type'] == 'reassign') {
                        $re_assign_to_name = $crow['t_user_firstname'] . ' ' . $crow['t_user_lastname'];
                        $return_str .= '<p> <strong class="assign-title">Reassign to</strong> @' . $re_assign_to_name . '</p>';
                    }
                    $return_str .= '<ul class="list-unstyled list-inline media-detail pull-left">';
                    if (!empty($crow['comment_file'])) {
                        foreach ($crow['comment_file'] as $cfrow) {
                            $return_str .= '<li">';
                            $file_url = UPLOAD_FOLDER . 'doc/' . $case_id . '/' . $cfrow['case_files_unique_name'];
                            $file_name = $cfrow['case_files_name'];
                            $return_str .= '<a class="download" target="_blank" href="' . $file_url . '"><span><i class="fa fa-file"> </i> ' . $file_name . '</span></a>&nbsp;&nbsp;&nbsp;
                            </li>';
                        }
                    }
                    $return_str .= '<li><i class="fa fa-calendar"></i>' . $datetime . '</li></ul>
                    </div>
                </div>
                <!-- COMMENT 1 - END -->';
                }
            }
        }
        return $return_str;
    }

}
