<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    public function __construct(){
        parent :: __construct();
        $this->load->model("UsersModel");
    }

    public function index()
    {
        $this->load->view('header');
		$this->load->view('Login');
		$this->load->view('footer');
    }

    public function validate_login()
    {
        $data['user'] = $this->input->post('user');
        $data['password'] = $this->input->post('password');
        $user_data = $this->UsersModel->login($data);
    
        if ($user_data) {
            echo "Inicio de sesión exitoso. ¡Bienvenido, " . $user_data['user'] . "!";
            redirect("InicioController/index");
        } else {
            echo '<script>
                    alert("Error en las credenciales");
                    window.location.href = "'. site_url('LoginController/index') .'";
                  </script>';
            return; 
        }
    }
    
    
    
}
