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
            $this->db->delete($this->table);
            return $this->db->affected_rows();
        } catch (Exception $e) {
            error_log('Error en UsersModel->delete: ' . $e->getMessage());
            return 0;
        }
    }
  
    public function get_user_by_id($user_id) {
        return $this->db->get_where($this->table, array($this->pk => $user_id))->row_array();
    }
    
    public function edit($user_id, $data) {
        try {
            // Log para verificar los datos que se están utilizando para actualizar
            error_log('Data to Update: ' . print_r($data, true));
    
            $this->db->where($this->pk, $user_id);
            $this->db->update($this->table, $data);
    
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log('Error en UsersModel->edit: ' . $e->getMessage());
            return false;
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
}
