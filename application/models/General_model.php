<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */

    public function get_role(){
        $current_session = $this->setting_model->getCurrentSession();
        $userdata = $this->session->userdata();
        if(array_key_exists('student', $userdata)){
            $role = "student";
        }else{
            $role = "admin";
        }
        return $role;
        
    }
    public function get_account_id(){
        $current_session = $this->setting_model->getCurrentSession();
        $userdata = $this->session->userdata();

        if(array_key_exists('student', $userdata)){
            $account_id = $userdata['student']['student_id'];
        }else if(array_key_exists('admin', $userdata)){
            $account_id = $userdata['admin']['id'];
        }else{ 
            $account_id = 1;
        }
        return $account_id;
        
    }

    public function get_account_name($account_id="",$account_type=""){
        // $this->db->select("*");
        // $this->db->from("students");
        // $this->db->where("id",5);
        if($account_type=="admin"){
            return $this->db->select("*")->where("id",$account_id)->get("staff")->result_array(); 
        }else{
            return $this->db->select("*")->where("id",$account_id)->get("students")->result_array(); 
        }
          
    }

    public function get_classes(){
        return $this->db->select("*")->get("classes")->result_array();   
    }

    public function get_subjects(){
        return $this->db->select("*")->get("subjects")->result_array();   
    }
        


}
