<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Employeem\Customers_m;
use App\Models\Adminm\Login_m;

class Customers_a extends Controller {

    private $Customers_m;
    private $Login_m;
    private $security;

    public function __construct() {
        helper('url');
        $this->security = \Config\Services::security();
        helper('functions');
        sessionCheckAdmin();
        $this->Customers_m = new Customers_m();
        $this->Login_m = new Login_m();
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'employee') {
                $result = $this->Login_m->getTokenAndCheck($_SESSION['usertype'], $_SESSION['user_id']);
                if ($result) {
                    $token = $result['token'];
                    if ($_SESSION['tokencheck'] != $token) {                        
                        if ($_SESSION['usertype'] == 'employee') {
                            sessionDestroy();
                            header('Location: ' . EMPLOYEE_LOGIN_LINK);
                        }
                        if ($_SESSION['usertype'] == 'admin') {
                            sessionDestroy();
                            header('Location: ' . ADMIN_LOGIN_LINK);
                        }
                    }
                }
            }
        }
    }
    public function customers_list() {
        $data['title'] = ADMIN_CUSTOMER_LIST_TITLE;
        echo admin_view('adminside/customer/customers_list', $data);
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
