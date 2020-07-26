<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Causes_m extends CI_Model {
    function __construct(){
        parent::__construct();                
    }  
    public function add_causes($params) {       
        $this->db->insert('hpshrc_upload_files',$params);
        return $this->db->insert_id();        
    }
    public function get_file_type($category_ref_type) {       
        $ressult = $this->db->query("SELECT * FROM `hpshrc_categories` WHERE category_status='A' AND category_ref_type='$category_ref_type'");
        return $ressult->result_array();      
    }
    public function load_sub_type($params){
        $subtype_id = $params['category_code'];
        $res = $this->db->query("SELECT * FROM `hpshrc_categories` WHERE  category_status='A' AND category_ref_type='SUB_TYPE' AND ref_category_code='$subtype_id'");
        return $res->result_array();
    }
    public function get_sub_type($subtype_id){        
        $tehsil = $this->db->query("SELECT * FROM `hpshrc_categories` WHERE  category_status='A' AND category_ref_type='SUB_TYPE' AND ref_category_code='$subtype_id'");
        return $tehsil->result_array();
    }
    public function get_single_file($upload_file_id){        
        $tehsil = $this->db->query("SELECT * FROM `hpshrc_upload_files` WHERE upload_file_id='$upload_file_id'");
        return $tehsil->row_array();
    }
    public function edit_causes($params,$upload_file_id){        
        $res = $update = $this->db->update('hpshrc_upload_files', $params, array('upload_file_id' => $upload_file_id));
        return $res;
    }
     public function active_causes($params) {
        $query_res = $this->db->query("UPDATE  hpshrc_upload_files SET upload_file_status = '{$params['upload_file_status']}'
                                       WHERE upload_file_id='{$params['upload_file_id']}'");
        if ($query_res) {
            return true;
        }
        return false;
    }
    
}
