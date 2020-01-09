<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('graficas_model');
        $this->load->helper('string');
    }

    public function indexAdmin() {
        $this->load->view('graficas_cajas');
    }

    public function graficas_data() {

        $data = $this->graficas_model->cajas_por_vehiculo();

        // Convert result to JSON response
        $response->cols[] = array(
            "id_cantidad_cajas" => "",
            "label" => "Cantidad de Cajas Registradas",
            "pattern" => "",
            "type" => "string"
        );

        $response->cols[] = array(
          "id_cantidad_cajas" => "",
          "label" => "Total",
          "pattern" => "",
          "type" => "number"
        );

        foreach ($data as $cd) {
            $response->rows[]["c"] = array(
                array(
                    "v" => "$cd->tipo_tramite",
                    "f" => null
                ),
                array(
                    "v" => (int)$cd->cantidad,
                    "f" => null
                )
            );
        }

        echo json_encode($response);
    }

    public function indexGestion() {
        $this->load->view('gestion_usuarios');
    }

    public function indexCrear() {
        $this->load->view('crear_usuario');
    }
}