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
        try {
            // Obtén los datos JSON del cuerpo de la solicitud
            $json_data = json_decode(file_get_contents('php://input'), true);
    
            // Verifica si se obtuvieron datos JSON correctamente
            if ($json_data !== null) {
                // Extrae los datos del usuario y nombre del objeto JSON
                $new_user = $json_data['user'];
                $new_name = $json_data['name'];
    
                // Realiza la modificación del usuario
                $result = $this->UsersModel->edit($user_id, ['user' => $new_user, 'name' => $new_name]);
    
                if ($result) {
                    echo json_encode(['status' => 'success']);
                } else {
                    $error_message = $this->db->error()['message']; // Obtén el mensaje de error de la base de datos
                    echo json_encode(['status' => 'error', 'message' => 'Error modifying user: ' . $error_message]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data.']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
    
    
    
}
