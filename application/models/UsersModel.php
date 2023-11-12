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

    public function delete($user_id) {
        try {
            $this->db->where($this->pk, $user_id);
            $query = $this->db->get_compiled_delete($this->table);
            error_log("Deleting user with ID: $user_id. SQL Query: $query");
    
            $this->db->delete($this->table);
            return $this->db->affected_rows();
        } catch (Exception $e) {
            error_log('Error en UsersModel->delete: ' . $e->getMessage());
            return 0;
        }
    }
    
    
    public function edit($user_id, $data) {
        $this->db->where($this->pk, $user_id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }
}
