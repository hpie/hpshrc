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
//        print_r($_SESSION);die;
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
            $params['case_update_date']=date("Y-m-d H:i:s");          
            $res =  $this->Cases_m->edit_cases($params,$cases_id);             
            if ($res) {                
                $params=array();
                $params['refCases_id']=$cases_id;
                $params['comment_type']='reassign';
                $params['comment_from']=$_SESSION['employee']['employee_user_id'];
                $params['comment_to']=$_POST['cases_assign_to'];
                $params['comment_from_usertype']='employee';
                $params['comment_to_usertype']='employee';
                $params['comment_datetime']=date("Y-m-d H:i:s");                
                $this->Cases_m->add_cases_comment($params);

                successOrErrorMessage("Data updated successfully",'success');                
            } else {                
                successOrErrorMessage("Somthing happen wrong plz try again",'error');
            }          
        }
        
        $data['cases_res']=$this->Cases_m->get_single_cases($cases_id);
        $data['res_employee']=$this->Cases_m->get_employee();        
        helper('form');
        $data['title'] = EMPLOYEE_EDIT_CASES_TITLE;        
        echo employee_view('employee/edit_cases',$data);
    }
    
    public function add_cases() { 
         if (isset($_POST['cases_title'])) { 
            
            $params=array();
            $params['customer_email_id']=$_POST['customer_email'];
            $params['customer_mobile_no']=$_POST['customer_contact'];
            $params['customer_email_password']=generateStrongPassword(); 
            $params['createdby_type']=$_SESSION['employee']['employee_usertype'];
            $params['created_by']=$_SESSION['employee']['employee_user_id'];                        
            $customer_id =  $this->Cases_m->create_customer($params);  
            
            $params=array();            
            $params['cases_priority']=$_POST['cases_priority'];
            $params['cases_title']=$_POST['cases_title'];
            $params['cases_message']=$_POST['cases_message'];
            $params['cases_assign_to']=$_POST['cases_assign_to'];
            $params['cases_dt_created']=date("Y-m-d H:i:s");
            $params['refCustomer_id']=$customer_id;
            $params['createdby_user_type']='employee';
            $params['created_by']=$_SESSION['employee']['employee_user_id'];
                        
            if($_POST['howtocontact']=='Email'){
                $params['customer_email']=$_POST['customer_email'];
            }  
            if($_POST['howtocontact']=='Mobile'){
                $params['customer_contact']=$_POST['customer_contact'];
            }
            if($_POST['howtocontact']=='Both'){
                $params['customer_email']=$_POST['customer_email'];
                $params['customer_contact']=$_POST['customer_contact'];
            }                           
            $res =  $this->Cases_m->create_case($params);             
            if ($res) {
//                echo '<pre>';print_r($_FILES);die;
                if (($_FILES['case_files_file']['name'][0]) != '') {
                    $cases_files = multiFileUpload('case_files_file', $res . '/');
                    $i = 0;
                    foreach ($cases_files as $row) {
                        $params = array();
                        $params['refCases_id'] = $res;
                        $params['case_files_title'] = $_POST['title_file'][$i];
                        $params['case_files_desc'] = $_POST['desc_file'][$i];
                        $params['case_files_name'] = $row[2]['original_file_name'];
                        $params['case_files_unique_name'] = $row[2]['file_name'];
                        $params['case_files_size'] = $row[2]['file_size'];
                        $params['case_files_ext'] = $row[2]['file_ext'];
                        $params['case_files_type'] = "main";
                        $this->Cases_m->add_cases_files($params);
                        $i = $i + 1;
                    }
                }
                $params=array();
                $params['refCases_id']=$res;
                $params['comment_type']='assign';
                $params['comment_from']=$_SESSION['employee']['employee_user_id'];
                $params['comment_to']=$_POST['cases_assign_to'];
                $params['comment_from_usertype']='employee';
                $params['comment_to_usertype']='employee';
                $params['comment_datetime']=date("Y-m-d H:i:s");
                $this->Cases_m->add_cases_comment($params);                
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
    
    public function add_comment() {
        $message = "fail";
        $comments="";
        $close_sts='no';
        if (isset($_POST['cases_id'])) {
            if (!empty($_POST['cases_message'])) {                                
                if(isset($_POST['cases_status'])){
                    $this->Cases_m->close_cases($_POST['cases_id']);
                    successOrErrorMessage("Case is closed", 'success');
                    $close_sts='yes';
                }                
                $params = array();
                $params['refCases_id'] = $_POST['cases_id'];
                $params['comment_description'] = $_POST['cases_message'];
                $params['comment_type'] = 'comment';
                $params['comment_from'] = $_SESSION['employee']['employee_user_id'];
                $params['comment_to'] = $_POST['customer_id'];
                $params['comment_from_usertype'] = 'employee';
                $params['comment_to_usertype'] = 'customer';
                $params['comment_datetime'] = date("Y-m-d H:i:s");
                $res = $this->Cases_m->add_cases_comment($params);
                if ($res) {
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
                    $comments=$this->comment_list($_POST['cases_id'],$_POST['last_comment_id']);                                        
                    $message = "success";
                }
            }
        }
        $result = array();
        $result['message'] = $message;
        $result['comments'] = $comments;
        $result['case_sts'] = $close_sts;
        echo json_encode($result);
    }  
    public function view_cases($case_id) {
        helper('form');        
        $data['caseDetails'] = $this->Cases_m->get_view_cases($case_id);
        $data['fileDetails'] = $this->Cases_m->get_file_details($case_id);
        $data['involved_peopel'] = $this->Cases_m->get_involved_peopel($case_id);
        $data['comments'] = $this->comment_list($case_id);
        $data['title'] = EMPLOYEE_VIEW_CASES_TITLE;
        echo employee_view('employee/view_cases', $data);
    }
    public function comment_list($case_id,$last_comment_id=0) {
        $data['comments'] = $this->Cases_m->get_comments($case_id,$last_comment_id);
        $data['commentFileDetails'] = $this->Cases_m->get_comment_file_details($case_id,$last_comment_id);
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
        return $this->generate_comment_view($result,$case_id);
     }
    public function generate_comment_view($comments,$case_id) {
        $return_str = '';
        if (!empty($comments)) {
            $i = 0;
            foreach ($comments as $crow) {
                $i = $i + 1;
                $lastcomment = '';
                $from_name = '';
                $datavalue = 0;
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
                }
                if ($crow['comment_from_usertype'] == 'customer') {
                    $from_name = strtoupper(substr($crow['fhc_customer_first_name'], 0, 1) . substr($crow['fhc_customer_last_name'], 0, 1));
                    $from_short_name = $crow['fhc_customer_first_name'] . ' ' . $crow['fhc_customer_last_name'] . ' (Customer)';
                    if ($crow['fhc_customer_first_name'] == '') {
                        $from_short_name = 'Guest (Customer)';
                    }
                }
                $return_str .= '<div class="nk-reply-item' . $lastcomment . '" data-value="' . $datavalue . '">                               
                            <div class="nk-reply-header">';
                $return_str .= '<div class="user-card">
                                    <div class="user-avatar sm bg-blue">
                                        <span>' . $from_name . '</span>
                                    </div>
                                    <div class="user-name">' . $from_short_name . '</div>
                                </div>                                                              
                                <div class="date-time">' . $date . '</div>
                            </div>
                            <div class="nk-reply-body">
                                <div class="nk-reply-entry entry">';
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
                    $return_str .= '<strong class="assign-title">Assign to</strong> @' . $assign_to_name;
                }
                if ($crow['comment_type'] == 'reassign') {
                    $re_assign_to_name = $crow['t_user_firstname'] . ' ' . $crow['t_user_lastname'];
                    $return_str .= '<strong class="assign-title">Reassign to</strong> @' . $re_assign_to_name;
                }
                $return_str .= '</div>';
                if(!empty($crow['comment_file'])) {                    
                    $return_str .= '<div class="attach-files">
                                    <ul class="attach-list">';
                    foreach ($crow['comment_file'] as $cfrow) {
                        $ext = $cfrow['case_files_ext'];
                        if ($ext == 'pdf') {
                            $ext = 'file';
                        } else {
                            $ext = 'img';
                        }
                        $return_str .= '<li class="attach-item">';
                        $file_url = UPLOAD_FOLDER . 'doc/' . $case_id . '/' . $cfrow['case_files_unique_name'];
                        $file_name = $cfrow['case_files_name'];
                        $return_str .= '<a class="download" target="_blank" href="' . $file_url . '"><em class="icon ni ni-' . $ext . '"></em><span>' . $file_name . '</span></a>
                                        </li>';
                    }
                    $return_str .= '</ul>                                    
                                </div>';
                }  
                           $return_str.='</div>                                                            
                        </div><!-- .nk-reply-item -->
                        <div class="nk-reply-meta">
                            <div class="nk-reply-meta-info"><strong>'.$datetime.'</strong></div>
                        </div><!-- .nk-reply-meta -->';
                }
            }
            return $return_str;
        }
        
//     public function load_more_comment_list() {        
//        $result = array();
//        $result['comments'] = $this->comment_list($_POST['case_id'],$_POST['last_comment_id']);
//        echo json_encode($result);
//     }                
}
