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
            'name' => $this->input->post('name'),
            'antiquity' => $this->input->post('antiquity'),
            'salary' => $this->input->post('salary')
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
    
    public function update_user_ajax($user_id) {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $this->UsersModel->update($user_id, $data);
    
            if ($result > 0) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Error updating user.'));
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
            // Log para verificar los datos recibidos
            error_log('Received Data: ' . print_r($data, true));
    
            // Obtiene los datos existentes del usuario
            $existing_data = $this->UsersModel->get_user_by_id($user_id);
    
            // Log para verificar los datos existentes
            error_log('Existing Data: ' . print_r($existing_data, true));
    
            // Verifica si hay cambios antes de intentar la actualización
            $changes_exist = $existing_data !== $data;
    
            if ($changes_exist) {
                // Log para verificar que se está intentando la actualización
                error_log('Intentando Actualización...');
    
                $result = $this->UsersModel->edit($user_id, $data);
    
                // Log para verificar el resultado de la actualización
                error_log('Resultado de Actualización: ' . ($result ? 'Éxito' : 'Error'));
    
                if ($result) {
                    // Devuelve la nueva información del usuario en caso de éxito
                    $response = array(
                        'status' => 'success',
                        'message' => 'Usuario modificado correctamente.',
                        'data' => $data
                    );
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Error al modificar el usuario. No se realizaron cambios en la base de datos.'
                    );
                }
            } else {
                $response = array(
                    'status' => 'info',
                    'message' => 'No se realizaron cambios en los datos del usuario.'
                );
            }
    
            echo json_encode($response);
        } catch (Exception $e) {
            $response = array(
                'status' => 'error',
                'message' => 'Error al procesar la solicitud: ' . $e->getMessage()
            );
    
            echo json_encode($response);
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
