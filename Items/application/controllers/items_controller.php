<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class items_controller extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model("items_model");
    }

    public function index() {
        $data["items"] = $this->items_model->get_items();
        $this->load->view('header');
        $this->load->view('inicio',$data);
        $this->load->view('footer');
    }

    public function delete($item_id=null){	
	    $this->items_model->delete($item_id);	
		redirect("items_controller/index");
	}

    public function insert_item() {
        
        $this->form_validation->set_rules('item', 'Nombre del Item', 'required');
        $this->form_validation->set_rules('cantidad','cantidad','required');
        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
                'item' => $this->input->post('item'),
                'cantidad' => $this->input->post('cantidad'),  
            );
            $this->items_model->create($data);
            redirect("items_controller/index");
        }
    }

    public function add($item_id,$cantidad){
		if(!is_null($item_id)){
			$nueva_cantidad=$cantidad+1;
			$data["items"] = $this->items_model->edit($item_id,$nueva_cantidad);
				
		}
		redirect("items_controller/index");
	}
}
?>

