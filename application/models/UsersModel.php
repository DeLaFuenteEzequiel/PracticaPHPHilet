<?php

class UsersModel extends CI_Model {

    protected $table = "users";
    protected $pk = "user_id";

    public function create($data = array()) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_all_users() {
        return $this->db->get($this->table)->result_array();
    }

    public function login($data) {
        $this->db->select("*");
        $this->db->where("user", $data['user']);
        $this->db->where("password", $data['password']);
        $this->db->limit(1);
        $res = $this->db->get($this->table);

        if ($res->num_rows() > 0) {
            return $res->row_array();
        } else {
            return false;
        }
    }
}
