<?php namespace App\Controllers;

use App\Models\Adminm\Causes_m;

class Home_c extends BaseController
{
    private $Causes_m;
    private $security;  
    public function __construct() {
        helper('url');
        helper('functions');
        $this->security = \Config\Services::security();           
        $this->Causes_m = new Causes_m();
    }    
    public function index() {        
        $data['title'] = FRONT_HOME_TITLE;        
        echo front_view('frontside/home',$data);
    }
    public function about() {        
        $data['title'] = FRONT_ABOUT_TITLE;        
        echo front_view('frontside/about',$data);
    }
    public function download() { 
        $data['file_type']=$this->Causes_m->get_file_type('MAIN_TYPE');
        $data['title'] = FRONT_DOWNLOAD_TITLE;        
        echo front_view('frontside/download',$data);
    }
    public function budget() {        
        $data['title'] = FRONT_BUDGET_TITLE;        
        echo front_view('frontside/budget',$data);
    }
    public function gallery() {        
        $data['title'] = FRONT_GALLERY_TITLE;        
        echo front_view('frontside/gallery',$data);
    }
    public function contact() {        
        $data['title'] = FRONT_CONTACT_TITLE;        
        echo front_view('frontside/contact',$data);
    }    
    public function page404() {        
        $data['title'] = FRONT_404_TITLE;        
        echo single_page('errors/html/custome_error_404',$data);
    }
}
