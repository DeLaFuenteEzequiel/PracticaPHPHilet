<?php
class items_model extends CI_Model {
    protected $table = "items";
    protected $pk = "item_id";
    protected $cantidad = "cantidad";

    public function get_items($item_id=null) {
        if(!is_null($item_id)){
            $this->db->where($this->pk,$item_id);
            $this->db->limit(1);
            return $this->db->get($this->table)->row_array();
        }
        return $this->db->get($this->table)->result_array();
    }

    public function delete($item_id) {
        try {
            $this->db->where($this->pk, $item_id);
            $this->db->delete($this->table);
            return $this->db->affected_rows();
        } catch (Exception $e) {
            error_log('error en delete:' . $e->getMessage());
            return 0;
        }
    }
    public function edit($item_id,$nueva_cantidad){
        if(!is_null($item_id)){
            $this->db->where($this->pk,$item_id);
            $this->db->set($this->cantidad,$nueva_cantidad);
        }
        $this->db->update($this->table);
    }
   

    public function create($data = array()) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

}
?>