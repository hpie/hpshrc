<?php namespace App\Models\Employeem;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class Cases_m extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db = db_connect();
        helper('functions');
    }
    
    public function create_case($params){ 
        $params['case_user_type']='employee';
        $params['refUser_id']=$_SESSION['employee']['employee_user_id'];        
        $builder = $this->db->table('cases');
        $builder->insert($params);
        $insert_id = $this->db->insertID();          
        if(!empty($insert_id)){
           return $insert_id;
        }
        return FALSE;       
    }
    public function add_cases_files($params) {
        $builder = $this->db->table('case_files');
        $builder->insert($params);
        return $this->db->insertID();
    }
      public function edit_cases($params,$cases_id){  
        $builder = $this->db->table('cases');
        $builder->where('cases_id', $cases_id);
        $update =$builder->update($params);        
        return $update;
    }
    
    public function get_single_cases($cases_id) {       
        $ressult = $this->db->query("SELECT * FROM `cases` WHERE cases_id='{$cases_id}'");
        return $ressult->getRowArray();      
    }
    public function get_employee() {       
        $ressult = $this->db->query("SELECT * FROM `employee` WHERE user_status='ACTIVE'");
        return $ressult->getResultArray();      
    }
    
    
    public function add_causes($params) {
        $builder = $this->db->table('hpshrc_upload_files');
        $builder->insert($params);
        return $this->db->insertID();
    }   
    public function edit_causes($params,$upload_file_id){  
        $builder = $this->db->table('hpshrc_upload_files');
        $builder->where('upload_file_id', $upload_file_id);
        $update =$builder->update($params);        
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
    public function approve_status($params) {                          
        $table=$params['table'];
        $table_update_field=$params['updatefield'];
        $table_where_field=$params['wherefield'];        
        $query_res = $this->db->query("UPDATE  $table SET $table_update_field = '{$params['user_status']}' WHERE $table_where_field='{$params['table_id']}'");       
        if ($query_res) {
            return true;
        }
    }
    
}
