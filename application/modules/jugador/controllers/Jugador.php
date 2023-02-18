<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jugador extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('jugador_model');
        $this->load->library(['ion_auth', 'form_validation']);

        date_default_timezone_set('America/Santiago');
    }


    public function getJugador()
    {
        if (true) {
            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];

            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];

            if ($query = $this->jugador_model->getJugador()) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_jugador = $res->id_jugador;
                    $row->nombre_jugador = $res->nombre;
    
                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

}
