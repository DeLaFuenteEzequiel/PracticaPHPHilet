<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ingresar extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('usuario_model');
	}

	public function index(){
		$this->load->view('header');
		$this->load->view('ingreso');
		$this->load->view('footer');
	}
    public function ingresar(){
        $usuario=$this->input->post("usuario");
        $pass=$this->input->post("pass");
        if ($this->usuario_model->autenticar($usuario,$pass)){
            redirect("inicio/index");
        }else{
            redirect("ingresar/index");
        }
    }
}