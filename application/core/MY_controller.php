<?php

class MY_controller extends CI_Controller{
    protected $datos=array();

    public function __construct(){
        parent::__construct();
        $this->datos["titulo"]=TITULO;
    }

    public function mostrar($vista="",$parametros=array()){ 
        if(isset($parametros["mostrar_barra"])){
            $this->datos["mostrar_barra"] = $parametros["mostrar_barra"];
        } else {
            $this->datos["mostrar_barra"]=false;
        }

        $this->load->view("Plantillas/cabecera",$this->datos);
        $this->load->view(($vista=="")?"Plantillas/cuerpo":$vista,$this->datos);
        $this->load->view("Plantillas/pie",$this->datos);

        if(isset($parametros["mostrar_barra"])){
            $this->datos["mostrar_barra"] = $parametros["mostrar_barra"];
        } else {
            $this->datos["mostrar_barra"]=false;
        }

    }
}

?>