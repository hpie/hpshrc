<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class Common_m extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db = db_connect();
        helper('functions');
    }
    public function register_customer($params){         
        $email_exist = $this->db->query("SELECT * FROM hpshrc_customer WHERE customer_email_id='".$params['customer_email_id']."' ");
        $res = $email_exist->getRowArray();                       
        if($res){
            return Array(
                'success' => false,
                'email_exist' => true
            );
        }    
        $params['customer_email_password'] = md5($params['customer_email_password']);
        unset($params['confirm_password']);
        unset($params['g-recaptcha-response']);     
                       
        $builder = $this->db->table('hpshrc_customer');
        $builder->insert($params);
        $insert_id = $this->db->insertID();
        
        if(!empty($insert_id)){
            return Array(
                'success' => true,
                'email_exist' => false,                
                'email' => $params['customer_email_id'],
                'customer_id '=>$insert_id
            );
        }
        return FALSE;
        //it will be return boolean value (true/false)
    }
    public function chek_code_exist($user_id,$link_code,$user_type) {       
        $q = "SELECT * FROM user_email_link WHERE user_id=$user_id AND user_type='$user_type' AND link_code='$link_code' ";
        $query = $this->db->query($q);
        $row = $query->getRowArray(); 
        if (isset($row))
        {
            $table="hpshrc_customer";
            $this->db->query("UPDATE $table SET customer_status='ACTIVE',customer_attempt=0,customer_locked_status=0,customer_email_verified_status=1 WHERE customer_id=$user_id ");
            $this->db->query("DELETE FROM user_email_link WHERE user_id=$user_id AND user_type='$user_type' AND link_code='$link_code'");
            return true;
        }
        return false;
    }
    public function user_email_link($params) {               
        $builder = $this->db->table('user_email_link');
        $builder->insert($params);
        $insert_id = $this->db->insertID();        
        if (!empty($insert_id)) {
            return true;
        }
        return false;
     }
}
