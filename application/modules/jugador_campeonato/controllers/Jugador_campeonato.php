<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jugador_campeonato extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('jugador_campeonato_model');
        $this->load->library(['ion_auth', 'form_validation']);

        date_default_timezone_set('America/Santiago');
    }


    public function getJugadorCampeonato()
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

            if ($query = $this->jugador_campeonato_model->getJugadorCampeonato()) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_jugador_campeonato = $res->id_jugador_campeonato;
                    $row->id_jugador = $res->id_jugador;
                    $row->nombre_jugador = $res->nombre_jugador;
    
                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }



    public function getJugadorCampeonatoById()
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

            $id_agendamiento = "";

            if (!empty($this->input->post('id_jugador_campeonato'))) {
                $id_jugador_campeonato = $this->security->xss_clean($this->input->post('id_jugador_campeonato'));
            }

            $where = " WHERE id_jugador_campeonato = " . $id_jugador_campeonato;

            if ($query = $this->jugador_campeonato_model->getJugadorCampeonatoById($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_jugador_campeonato = $res->id_jugador_campeonato;
                    $row->nombre_jugador = $res->nombre_jugador;
                    $row->id_jugador = $res->id_jugador;
     

                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function addJugadorCampeonato()
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


            if (!empty($this->input->post('id_jugador'))) {
                $request->id_jugador = $this->security->xss_clean($this->input->post('id_jugador'));
            }

            if (!empty($this->input->post('id_campeonato'))) {
                $request->id_campeonato = $this->security->xss_clean($this->input->post('id_campeonato'));
            }

            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'id_jugador' => $request->id_jugador,
                'id_campeonato' => $request->id_campeonato
            );


            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->jugador_campeonato_model->addJugadorCampeonato('jugador_campeonato', $datos)) {
                $response->proceso = 1;
                $response->id = $query;
                $response->data = $datos;
            } else {

                $response->errores[] = "El dato no pudo ser ingresado";
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function updateJugadorCampeonato()
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

            //COMPROBAMOS SI VIENE UN ID MEDIANTE LA PETICION POST, Y SI ES QUE VIENE LO GUARDAMOS (SI NO VIENE EL ID NO ES POSIBLE EDITAR, YA QUE NO ESTAMOS APUNTANDO A NINGUNA TUPLA DE DATOS)
            if ($this->input->post('id_jugador_campeonato')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_jugador_campeonato', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if (sizeof($response->errores) == 0) {
                //VERIFICAMOS LAS VARIABLES QUE RECIBIMOS PARA EDITAR.
                if (!empty($this->input->post('id_jugador'))) {
                    $request->id_jugador = $this->security->xss_clean($this->input->post('id_jugador'));
                }
    
                if (!empty($this->input->post('id_campeonato'))) {
                    $request->id_campeonato = $this->security->xss_clean($this->input->post('id_campeonato'));
                }
    
                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'id_jugador' => $request->id_jugador,
                    'id_campeonato' => $request->id_campeonato
                );
    
            }


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->jugador_campeonato_model->updateJugadorCampeonato('jugador_campeonato', 'id_jugador_campeonato', $datos, $request->id)) {
                    //SI EL PROCESO ES EXITOSO, DEVOLVERA UN VALOR DENTRO DEL ARRAY DE RESPUESTA IGUAL A 1
                    $response->proceso = 1;
                    $response->id = $query;
                    $response->data = $datos;
                }
            } else {
                $response->errores[] = "Ocurrió un problema al procesar la edicion";
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function deleteJugadorCampeonato()
    {
        if (true) {

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];

            $where = '';

            //COMPROBAMOS SI VIENE UN ID MEDIANTE LA PETICION POST, Y SI ES QUE VIENE LO GUARDAMOS.
            if ($this->input->post('id_jugador_campeonato')) {
                $request->id = $this->security->xss_clean($this->input->post('id_jugador_campeonato'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " id_jugador_campeonato=".$request->id;

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->jugador_campeonato_model->deleteJugadorCampeonato($where)) {
                    //SI EL PROCESO ES EXITOSO, DEVOLVERA UN VALOR DENTRO DEL ARRAY DE RESPUESTA IGUAL A 1
                    $response->proceso = 1;
                }
            } else {
                $response->errores[] = "Ocurrió un problema al procesar la eliminacion";
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

}
