<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class inicio extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('objeto_model');
	}

	public function index(){
		$datos["objetos"] = $this->objeto_model->listar();
		$this->load->view('header');
		$this->load->view('inicio');
		$this->load->view('lista_objetos',$datos);
		$this->load->view('footer');
	}

	public function ver($id=null){
		if(!is_null($id)){
			$datos["objeto"] = $this->objeto_model->listar($id);
			if($datos["objeto"]["estado"]==1){
				$this->load->view('header');
				$this->load->view('objeto',$datos);
				$this->load->view('footer');
			}else{
				$this->load->view('header');
				$this->load->view('no_existe');
				$this->load->view('footer');
			}
			
		}else{
			redirect("inicio/index");
		}	
	}
	public function estado($id=null,$estado=null){
		if(!is_null($id)){
			if($estado==0){
				$set=1;
			}else{
				$set=0;
			}
			$datos["objeto"] = $this->objeto_model->editar($id,$set);
				
		}
		redirect("inicio/index");
	}
	public function borrar($id=null){
		if(!is_null($id)){
			$this->objeto_model->eliminar($id);
		}
		redirect("inicio/index");
	}
}
