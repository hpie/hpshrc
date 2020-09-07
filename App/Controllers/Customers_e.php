<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Employeem\Customers_m;
use App\Models\Adminm\Login_m;

class Customers_e extends Controller {

    private $Customers_m;
    private $Login_m;
    private $security;

    public function __construct() {
        helper('url');
        $this->security = \Config\Services::security();
        helper('functions');
        sessionCheckEmployee();
        $this->Customers_m = new Customers_m();
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
            
        }
    }

    public function customers_list() {
        $data['title'] = EMPLOYEE_CUSTOMER_LIST_TITLE;
        echo employee_view('employee/customers_list', $data);
    }
    public function approve_status() {
        if (isset($_REQUEST['table_id'])) {
            $res = $this->Customers_m->approve_status($_REQUEST);
            if ($res) {
                $data = array(
                    'suceess' => true
                );
            }
            $data['token'] = $this->security->getCSRFHash();
            echo json_encode($data);
        }
    }
    

}
