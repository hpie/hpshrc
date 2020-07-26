<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_c extends CI_Controller {

    public function __construct() {
        parent::__construct();                       
        include APPPATH . 'third_party/smtp_mail/smtp_send.php'; 
        $this->load->model('adminm/Causes_m');
    }    
    public function index() {        
        $data['title'] = FRONT_HOME_TITLE;        
        $this->load->front_view('frontside/home',$data);
    }
    public function about() {        
        $data['title'] = FRONT_ABOUT_TITLE;        
        $this->load->front_view('frontside/about',$data);
    }
    public function download() { 
        $data['file_type']=$this->Causes_m->get_file_type('MAIN_TYPE');
        $data['title'] = FRONT_DOWNLOAD_TITLE;        
        $this->load->front_view('frontside/download',$data);
    }
    public function budget() {        
        $data['title'] = FRONT_BUDGET_TITLE;        
        $this->load->front_view('frontside/budget',$data);
    }
    public function gallery() {        
        $data['title'] = FRONT_GALLERY_TITLE;        
        $this->load->front_view('frontside/gallery',$data);
    }
    public function contact() {        
        $data['title'] = FRONT_CONTACT_TITLE;        
        $this->load->front_view('frontside/contact',$data);
    }
}
