<?php

class UsersModel extends CI_Model{

    protected $table= "users";
    protected $pk= "user_id";

    public function default_select(){
        $this->db->select($this->table.".*");
    }
    

    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function getall() {
        $this->default_select();
        $this->default_join();
        return $this->db->get($this->table)->result_array();
    }
    
    public function get($user_id) {
        $this->default_select();
        $this->default_join();
        $this->db->where($this->table.".".$this->pk, $user_id);
        return $this->db->get($this->table)->row_array();
    }
    
    public function edit($user_id, $data) {
        $this->db->where($this->pk, $user_id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }
    
    public function delete($user_id) {
        $this->db->where($this->pk, $user_id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    

    public function login($user= "", $password= ""){
        $this->db->select($this->pk);
        $this->db->where("user", $user);
        $this->db->where("password", $password);
        $this->db->limit(1);
        $res= $this->db->get($this->table);
        if ($res->num_rows()){
            $id= $res->row_array();
            return $this->get($id[$this->pk]);
        } 
        return false;
    }


}

?>