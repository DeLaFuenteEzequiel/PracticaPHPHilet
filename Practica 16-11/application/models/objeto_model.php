<?php
    class objeto_model extends CI_Model{
        protected $tabla="objetos";
        protected $pk="id";
        protected $estado="estado";

        public function eliminar($id=null){
            if(!is_null($id)){
                $this->db->where($this->pk,$id);
                $this->db->delete($this->tabla);
            }
        }
        public function editar($id=null,$estado){
            if(!is_null($id)){
                $this->db->where($this->pk,$id);
                $this->db->set($this->estado,$estado);
            }
            $this->db->update($this->tabla);
        }
        public function listar($id=null){
            if(!is_null($id)){
                $this->db->where($this->pk,$id);
                $this->db->limit(1);
                return $this->db->get($this->tabla)->row_array();
            }
            return $this->db->get($this->tabla)->result_array();
        }
    }
?>