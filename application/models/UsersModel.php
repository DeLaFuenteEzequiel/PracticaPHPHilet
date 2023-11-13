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
    
    public function edit($user_id, $data) {
        try {
            // Obtiene los datos existentes
            $existing_data = $this->db->get_where($this->table, array($this->pk => $user_id))->row_array();
    
            // Verifica si hay cambios antes de intentar la actualización
            $changes_detected = false;
            foreach ($data as $key => $value) {
                if (isset($existing_data[$key]) && $existing_data[$key] !== $value) {
                    $changes_detected = true;
                    break;
                }
            }
    
            if ($changes_detected) {
                $this->db->where($this->pk, $user_id);
                $this->db->update($this->table, $data);
    
                if ($this->db->affected_rows() > 0) {
                    return array('status' => 'success');
                } else {
                    return array('status' => 'error', 'message' => 'No se realizaron cambios.');
                }
            } else {
                return array('status' => 'error', 'message' => 'No se realizaron cambios.');
            }
        } catch (Exception $e) {
            return array('status' => 'error', 'message' => $e->getMessage());
        }
    }
    
    
    
    
    
    
}
