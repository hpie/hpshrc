<?php namespace App\Models\Adminm;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class Causes_m extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db = db_connect();
        helper('functions');
    }   
    public function add_causes($params) {
        $builder = $this->db->table('hpshrc_upload_files');
        $builder->insert($params);
        return $this->db->insertID();
    }
    public function get_file_type($category_ref_type) {       
        $ressult = $this->db->query("SELECT * FROM `hpshrc_categories` WHERE category_status='A' AND category_ref_type='$category_ref_type'");
        return $ressult->getResultArray();      
    }
    public function load_sub_type($params){
        $subtype_id = $params['category_code'];
        $res = $this->db->query("SELECT * FROM `hpshrc_categories` WHERE  category_status='A' AND category_ref_type='SUB_TYPE' AND ref_category_code='$subtype_id'");
        return $res->getResultArray();
    }
    public function get_sub_type($subtype_id){        
        $tehsil = $this->db->query("SELECT * FROM `hpshrc_categories` WHERE  category_status='A' AND category_ref_type='SUB_TYPE' AND ref_category_code='$subtype_id'");
        return $tehsil->getResultArray();
    }
    public function get_single_file($upload_file_id){        
        $tehsil = $this->db->query("SELECT * FROM `hpshrc_upload_files` WHERE upload_file_id='$upload_file_id'");
        return $tehsil->getRowArray();
    }
    public function edit_causes($params,$upload_file_id){  
        $builder = $this->db->table('hpshrc_upload_files');
        $builder->where('upload_file_id', $upload_file_id);
        $update =$builder->update($params);        
//        $update = $this->db->update('hpshrc_upload_files', $params, array('upload_file_id' => $upload_file_id));
        return $update;
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
