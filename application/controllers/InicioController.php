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

    public function delete_ajax($user_id) {
        try {
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
    
    
    public function modify_ajax($user_id) {
        // Obtén los datos del cuerpo de la solicitud POST como un objeto JSON
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
    
        try {
            // Llama a la función de edición del modelo
            $result = $this->UsersModel->edit($user_id, $data);
    
            // Verifica si la edición fue exitosa y devuelve una respuesta JSON
            $response = array(
                'status' => $result ? 'success' : 'error',
                'message' => $result ? 'Usuario modificado correctamente.' : 'Error al modificar el usuario.'
            );
    
            echo json_encode($response);
        } catch (Exception $e) {
            $response = array(
                'status' => 'error',
                'message' => $e->getMessage()
            );
    
            echo json_encode($response);
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
}
