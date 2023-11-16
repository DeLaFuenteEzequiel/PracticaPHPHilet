<?php
    class usuario_model extends CI_Model{
        protected $tabla="usuarios";
        protected $pk="id";
        protected $nombre="nombre";
        protected $pass="pass";


        public function autenticar($usuario=null,$pass=null){
            if(!is_null($usuario)){
                if(!is_null($pass)){
                    $this->db->where($this->nombre,$usuario);
                    $this->db->where($this->pass,$pass);
                    $this->db->limit(1);
                    $this->db->get($this->tabla)->row_array();
                    if ($this->db->affected_rows()){
                        return true;
                    }
                }
            }
            return false;
        }
    }
?>