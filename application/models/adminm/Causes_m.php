<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Causes_m extends CI_Model {
    function __construct(){
        parent::__construct();                
    }  
    public function add_causes($params) {       
        $this->db->insert('user_uploadd_files',$params);
        return $this->db->insert_id();        
    }
}
