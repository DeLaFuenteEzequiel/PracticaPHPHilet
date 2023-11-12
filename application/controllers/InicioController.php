<?php
class InicioController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("UsersModel");
    }

    public function index() {
        $data['users'] = $this->UsersModel->get_all_users();
        $this->load->view('header');
        $this->load->view('Inicio', $data);
        $this->load->view('footer');
    }

    public function create() {
        $this->load->view('header');
        $this->load->view('CreateUser');
        $this->load->view('footer');
    }

    public function insert_user() {
        $data = array(
            'user' => $this->input->post('user'),
            'password' => $this->input->post('password'),
            'name' => $this->input->post('name')
        );

        $this->UsersModel->create($data);

        redirect("InicioController/index");
    }



    public function eliminar_ajax($user_id) {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
    
        try {
            echo "Deleting user with ID: " . $user_id;
            $result = $this->UsersModel->delete($user_id);
            
            if ($result > 0) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Error deleting user.'));
            }
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }
    
    
    
    public function modificar_ajax($user_id, $new_data) {
        
        $this->UsersModel->edit($user_id, $new_data);
        echo json_encode(array('status' => 'success'));
    }
    
    
}
