<?php
class InicioController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("UsersModel");
    }

    // ... (otras funciones del controlador)

    // Vistas
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

    // CRUD
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
                echo json_encode(array('status' => 'error', 'message' => 'Error al eliminar.'));
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
                echo json_encode(array('status' => 'error', 'message' => 'Error al actualizar.'));
            }
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }

    // Cálculos
    private function obtenerSalarios() {
        $salarios = [];
        foreach ($this->UsersModel->get_all_users() as $user) {
            $salarios[] = $user['salary'];
        }
        return $salarios;
    }

    private function calcularEstadisticas($salarios) {
        return [
            'promedio' => count($salarios) > 0 ? array_sum($salarios) / count($salarios) : 0,
            'total' => array_sum($salarios)
        ];
    }

    public function calcular_promedio() {
        $salarios = $this->obtenerSalarios();
        echo json_encode($this->calcularEstadisticas($salarios));
    }

    public function calcular_total() {
        $salarios = $this->obtenerSalarios();
        echo json_encode(['total' => array_sum($salarios)]);
    }

    public function obtener_menor_sueldo() {
        $salarios = $this->obtenerSalarios();
        $menorSueldo = min($salarios);
        echo json_encode(['menorSueldo' => floatval($menorSueldo)] + $this->calcularEstadisticas($salarios));
    }

    public function obtener_mayor_sueldo() {
        $salarios = $this->obtenerSalarios();
        $mayorSueldo = max($salarios);
        echo json_encode(['mayorSueldo' => floatval($mayorSueldo)] + $this->calcularEstadisticas($salarios));
    }
}
